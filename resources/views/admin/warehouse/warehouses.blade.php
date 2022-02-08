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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($warehouses as $key=>$warehouse_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $warehouse_info->name }}</td>
                                        <td>{{ $warehouse_info->phone }}</td>
                                        <td>{{ $warehouse_info->address }}</td>
                                        <td>
                                            @if(isset($warehouse) && $warehouse->id == $warehouse_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                            <a href="{{ route('warehouse.edit',$warehouse_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('warehouse.destroy') }}" data-id="{{ $warehouse_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
