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
                                    <th>Company Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clients as $key=>$client_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client_info->name }}</td>
                                        <td>{{ $client_info->company_name }}</td>
                                        <td>{{ $client_info->phone }}</td>
                                        <td>{{ $client_info->address }}</td>
                                        <td>
                                           @if(isset($client) && $client->id == $client_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                            <a href="{{ route('client.edit',$client_info->id) }}" class="btn btn-success" style="width: 45px"> <i class="fa fa-edit fa-1x"></i> </a>
                                            <a href="{{ route('client.destroy',$client_info->id) }}" class="btn btn-warning" style="width: 45px"><i class="fas fa-ban"></i> </a>
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
