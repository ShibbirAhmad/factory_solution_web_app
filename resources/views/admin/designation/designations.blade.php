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
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($designations as $key=>$designation_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $designation_info->name }}</td>
                                        <td>
                                            <a href="{{ route('designation.edit',$designation_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('designation.destroy') }}" data-id="{{ $designation_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
