    <div id="flActionButtons" class="col-lg-12">
        <div class="statbox widget box box-shadow  p-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Account No</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($payment_methods as $key=>$payment_method_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment_method_info->isBank == 1 ? "Banking" : ($payment_method_info->isBank == 2 ? "Mobile Banking" : "Hand Cash" ) }}</td>
                                        <td>{{ $payment_method_info->name }}</td>
                                        <td>{{ $payment_method_info->account_no }}</td>
                                        <td>
                                            @if(isset($payment_method) && $payment_method->id == $payment_method_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                                <a href="{{ route('paymentMethod.edit',$payment_method_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                                <button class="btn btn-danger erase" data-url="{{ route('paymentMethod.destroy') }}" data-id="{{ $payment_method_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
                                            @endif


                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
