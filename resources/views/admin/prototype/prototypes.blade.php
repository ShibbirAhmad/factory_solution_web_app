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
                                        <th>Designer</th>
                                        <th class="text-center">Is Approved?</th>
                                        <th>Purchased</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($prototypes as $key=>$prototype_info)
                                    @php
                                        $image = !empty($prototype_info->ref_attachment) ? asset( \App\Helper\dynamicFileLink('prototype').$prototype_info->ref_attachment) : \App\Helper\noImage();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img height="80" width="80" src="{{ $image }}" alt="{{ $prototype_info->ref_attachment }}">
                                        </td>
                                        <td> {{ $prototype_info->code  }} </td>
                                        <td> {{ $prototype_info->category ? $prototype_info->category->name : ''  }} </td>
                                        <td> {{ $prototype_info->title  }} </td>
                                        <td> {{ $prototype_info->designer ? $prototype_info->designer->name : ''  }} </td>
                                        <td class="text-center">
                                            <label class="switch s-outline s-outline-success  mb-4 mr-2">
                                                <input type="checkbox" class="changeStatus" data-id="{{$prototype_info->id}}" data-status="{{ $prototype_info->status }}" {{ $prototype_info->status == 1 ? 'checked' : false }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td> 0 </td>
                                        <td>
                                            <a href="{{ route('prototype.edit',$prototype_info->id) }}" class="btn btn-success" > <i class="fa fa-edit fa-1x"></i> </a>
                                            <button class="btn btn-danger erase" data-url="{{ route('prototype.destroy') }}" data-id="{{ $prototype_info->id }}"> <i class="fa fa-trash-alt fa-1x"></i> </button>
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

