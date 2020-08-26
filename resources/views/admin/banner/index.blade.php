@extends('admin.layouts.app')

@section('content')
 <div class="card">
    <div class="card-header">
    @if(Setting::get('DEMO_MODE')==0)
    <div class="col-md-12" style="height:50px;color:red;">
        ** Demo Mode : No Permission to Edit and Delete.
    </div>
    @endif
        <h4 class="card-title">Restaurant Banners</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block card-dashboard table-responsive">
            <table class="table table-striped table-bordered file-export">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Shop Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($BannerImage as $Index => $Banner)
                    <?php //print"<pre>";print_r($Order); exit;?>
                    <tr>
                        <td>{{ $Index + 1 }}</td>
                        <td>{{ @$Banner->shop->name }}</td>
                        <td>
                            <img src="{{ @$Banner->url }}" width="100px" height="100px" />
                        </td>
                        <td>{{ @$Banner->status }}</td>
                        <td>
                        @if(Setting::get('DEMO_MODE')==1)
                            <a href="{{ route('admin.banner.edit', $Banner->id) }}" class="table-btn btn btn-icon btn-success"><i class="fa fa-pencil-square-o"></i></a>
                            <button  class="table-btn btn  btn-danger" onclick="return confirm('Do You want To Remove This Banner?');" form="resource-delete-{{ $Banner->id }}" ><i class="fa fa-trash-o"></i></button>
                            
                                        <form id="resource-delete-{{ $Banner->id }}" action="{{ route('admin.banner.destroy',$Banner->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" value="{{$Banner->id}}" name="banner_id" />
                                            <input type="hidden" value="{{$Banner->status}}" name="status" />
                                        </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection