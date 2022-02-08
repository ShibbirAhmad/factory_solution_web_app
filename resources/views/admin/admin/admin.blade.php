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
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key=>$admin_info)
                                    @php
                                        $image = !empty($admin_info->image) ? asset( \App\Helper\dynamicFileLink('admin').$admin_info->image) : \App\Helper\noImage();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin_info->name }}</td>
                                        <td>{{ $admin_info->email }}</td>
                                        <td> <img height="80" width="80" src="{{$image}}" alt="{{ $admin_info->image }}"></td>
                                        <td>{{ $admin_info->phone }}</td>
                                        <td>
                                             @if ($admin_info->status==1)
                                                <a href="{{ route('admin.show', $admin_info->id) }}"
                                                    class="btn btn-sm btn-warning btn_status_change">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                                @else
                                                <a href="{{ route('admin.show', $admin_info->id) }}"
                                                    class="btn btn-sm btn-success btn_status_change">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($admin) && $admin->id == $admin_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                                <a href="{{ route('admin.edit',$admin_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
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
