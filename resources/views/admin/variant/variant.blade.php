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
                                    <th>Attribute ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($variants as $key=>$variant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $variant->attribute->name }}</td>
                                        <td>{{ $variant->name }}</td>
                                         <td>
                                            <a href="{{ route('variant.edit',$variant->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
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
