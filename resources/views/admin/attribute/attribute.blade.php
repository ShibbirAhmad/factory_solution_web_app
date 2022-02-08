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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($attributes as $key=>$attribute)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attribute->name }}</td>
                                        <td>
                                            <a href="{{ route('attribute.edit',$attribute->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
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
