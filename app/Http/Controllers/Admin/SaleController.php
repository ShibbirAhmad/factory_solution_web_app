<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Client;
use App\Models\SaleItem;
use Barryvdh\DomPDF\PDF;
use App\Models\Warehouse;
use App\Models\OrderVariant;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\WarehouseProduct;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Cashbook\CashBookService;
use App\Services\ProductionSoftwareService;
use App\Http\Requests\Sale\SaleStoreRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sales'] = Sale::where('user_id',auth()->id())->orderByDesc('id')->with(['createdBy','client'])->paginate(30);
         return view('admin.sale.index')->with($data) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $data['clients']=Client::query()->where('user_id',auth()->id())->get();
         $data['warehouses']=Warehouse::query()->where('user_id',auth()->id())->get();
         $data['payment_methods']=PaymentMethod::orderBy('name')->get();
         $data['tasks'] = OrderVariant::where('order_id',8)->get();
         return view('admin.sale.create-sale')->with($data) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {

        DB::beginTransaction();
        try {
                $data=$request->validated();
                $data['user_id'] = auth()->id();
                $data['invoice_no'] = ProductionSoftwareService::uniqueInvoiceNoMaker(3);
                $data['created_by'] = auth()->id();
                $sale=Sale::query()->create($data);
                //inserting purchase items
                foreach ($data['sale_items'] as $key => $item) {

                    foreach($item['variants'] as $variant){
                        //save sale items according to variants
                        $s_item['sale_id'] = $sale->id ;
                        $s_item['product_id'] = $item['product_id'] ;
                        $s_item['price'] =  $item['price'] ;
                        $s_item['variant_id'] = $variant['id'] ;
                        $s_item['qty'] = $variant['qty'] ;
                        SaleItem::query()->create($s_item);
                        //update warehouse product stock
                        $p_variant = WarehouseProduct::where('warehouse_id',$data['warehouse_id'])->where('product_id',$item['product_id'])->where('variant_id',$variant['id'])->first();
                        $p_variant->stock = intval($p_variant->stock) - intval($variant['qty']) ;
                        $p_variant->save();
                    }

                }
                //updating client records
                $client=Client::findOrFail($data['client_id']);
                $client->total_amount = intval( $client->total_amount) + intval($data['total']) ;
                $client->total_paid = intval( $client->total_paid) + intval($data['paid']) ;
                $client->save();
                //storing cashbook of debit amount
                if ($data['payment_method'] && $data['paid'] > 0) {
                    $data['amount'] = $data['paid'] ;
                    $data['due_type'] = 'sale';
                    $data['is_discount_payment'] = 0 ;
                    CashBookService::paymentStore($data,$sale->invoice_no,2) ;
                }
                DB::commit();
                return response()->json([
                    "status" => 1,
                    "message" => "sale added successfully"
                ]);
        }catch (\Throwable $e) {

                LogTracker::failLog($e,ProductionSoftwareService::merchantUserId());
                DB::rollBack();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['sale'] = Sale::with('items.product')->findOrFail($id);
        $data['sale_items'] = SaleItem::query()->where('sale_id',$data['sale']->id)
                            ->select(DB::raw('product_id'))
                            ->groupBy('product_id')
                            ->get()->each(function($value){
                            $value->{'variants'} = SaleItem::where('product_id',$value->product_id)->select('variant_id','price','qty')->get();
                            });
        return view('admin.sale.show')->with($data);
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $data['sale'] = Sale::with('items.product')->findOrFail($id);
            $data['sale_items'] = SaleItem::query()->where('sale_id',$data['sale']->id)
                                        ->select(DB::raw('product_id'))
                                        ->groupBy('product_id')
                                        ->get()->each(function($value){
                                        $value->{'variants'} = SaleItem::where('product_id',$value->product_id)->select('variant_id','price','qty')->get();
                                  });

            $pdf = PDF::loadView('admin.pdf.sale_invoice',$data) ;
            return $pdf->stream();


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
