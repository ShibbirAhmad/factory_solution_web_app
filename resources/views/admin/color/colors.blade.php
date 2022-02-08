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
                                @forelse($colors as $key=>$color_info)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $color_info->name }}</td>
                                        <td>
                                            @if(isset($color) && $color->id == $color_info->id)
                                                <p class="badge badge-success p-4">Updating...</p>
                                            @else
                                            <a href="{{ route('color.edit',$color_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('color.destroy') }}" data-id="{{ $color_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
