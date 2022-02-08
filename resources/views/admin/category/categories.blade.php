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
                                @forelse($categories as $key=>$category_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category_info->name }}</td>
                                        <td>
                                            <a href="{{ route('category.edit',$category_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('category.destroy') }}" data-id="{{ $category_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
