<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Cashbook;
use App\Models\PaymentMethod;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $data['current_balance'] = self::cashbookCurrentBalance();
        $data['total_client'] = Client::where('user_id',auth()->id())->count();
        $data['total_client_due_amount'] = Client::where('user_id',auth()->id())->select(DB::raw('SUM(total_amount - total_paid) as due_amount'))->first();
        $data['total_supplier'] = Supplier::where('user_id',auth()->id())->count();
        $data['total_supplier_due_amount'] = Supplier::where('user_id',auth()->id())->select(DB::raw('SUM(total_amount - total_paid - total_discount) as due_amount'))->first();
        $data['total_warehouse'] = Warehouse::where('user_id',auth()->id())->count();
        $data['on_going_production'] = Order::where('is_closed',0)->where('user_id',auth()->id())->count();
        $data['on_going_production_amount'] = Order::where('is_closed',0)->where('user_id',auth()->id())->sum('total');
        $data['completed_production'] = Order::where('is_closed',1)->where('user_id',auth()->id())->count();
        $data['completed_production_amount'] = Order::where('is_closed',1)->where('user_id',auth()->id())->sum('total');
        $data['pending_production'] = Order::where('is_closed',2)->count();
        $data['pending_production_amount'] = Order::where('is_closed',2)->where('user_id',auth()->id())->sum('total');
        $data['accounts'] = $this->balanceMethods();

        return $data ;
        return view('admin.admin-dashboard')->with($data);

    }




    public static function cashbookCurrentBalance(){

          $credit = Cashbook::where('user_id',auth()->id())->where('isExpense',0)->sum('amount');
          $debit = Cashbook::where('user_id',auth()->id())->where('isExpense',1)->sum('amount');
          $amount = $credit - $debit ;
          return $amount ;

    }




    public function balanceMethods(){

          $balances = PaymentMethod::get();
          foreach ($balances as $item) {
              $item->{'today_credit_amount'} = Cashbook::where('created_at','>=',Carbon::today()->startOfDay())
                                                    ->where('created_at','<=',Carbon::today()->endOfDay())
                                                    ->where('user_id',auth()->id())->where('isExpense',0)->sum('amount');

              $item->{'today_debit_amount'} = Cashbook::where('created_at','>=',Carbon::today()->startOfDay())
                                                    ->where('created_at','<=',Carbon::today()->endOfDay())
                                                    ->where('user_id',auth()->id())->where('isExpense',1)->sum('amount');

              $item->{'total_amount'} = self::totalBalanceOfMethod($item->id) ;

          }

    }




    public static function totalBalanceOfMethod($balance_id){

          $credit = Cashbook::where('user_id',auth()->id())->where('isExpense',0)->where('payment_method_id',$balance_id)->sum('amount');
          $debit = Cashbook::where('user_id',auth()->id())->where('isExpense',1)->where('payment_method_id',$balance_id)->sum('amount');
          $amount = $credit - $debit ;
          return $amount ;

    }








}
