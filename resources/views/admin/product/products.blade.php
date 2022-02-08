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
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Purchased</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $key=>$product_info)
                                    @php
                                        $image = !empty($product_info->image) ? asset( \App\Helper\dynamicFileLink('product').$product_info->image) : \App\Helper\noImage();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img height="80" width="80" src="{{ $image }}" alt="{{ $product_info->image }}">
                                        </td>
                                        <td> {{ $product_info->code  }} </td>
                                        <td> {{ $product_info->category ? $product_info->category->name : ''  }} </td>
                                        <td> {{ $product_info->name  }} </td>
                                        <td> 0 </td>
                                        <td>
                                            <a href="{{ route('product.edit',$product_info->id) }}" class="btn btn-sm btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-sm btn-danger erase" data-url="{{ route('product.destroy') }}" data-id="{{ $product_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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
