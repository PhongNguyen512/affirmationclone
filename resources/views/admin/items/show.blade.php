@extends('admin.base-template.base')

@section('PostsStatus', 'active')

@section('main-content')

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Blog Posts</span>
        <h3 class="page-title">Post Detail</h3>
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <div class="col-lg-9 col-md-12">
    <!-- Add New Post Form -->
        <div class="card card-small mb-3">
            <div class="card-body">   
                @if ($errors->has('destroy'))
                    <span class="badge badge-danger" role="alert">
                        {{ $errors->first('destroy') }}
                    </span>
                @endif                 
                <input class="form-control form-control-lg mb-3" type="text" name="item_title" 
                        placeholder="Your Post Title" value="{{$item->item_title}}" required>

                <p id="deltaContent" hidden value="">{{ $item->item_content }}</p>
                <div id="editor-container" class="add-new-post__editor mb-1"></div>      

                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Background Color</span>
                    </div>
                    <input name="background_color" type="hidden" id="color_value" value="{{$item->background_color}}">
                    <button class="jscolor {valueElement:'color_value'}" style="width:150px; height:40px;" disabled></button>
    
                    @if($item->icon !== null)
                        <div class="input-group-prepend">
                            <span class="input-group-text">Icon</span>                                
                                <div style="height:40px">
                                    <img class="input-group-text" style="height:40px" src="{{ asset($item->icon) }}">
                                </div>                                
                        </div>
                    @endif 
                </div>              
            </div>
            
        </div>
    <!-- / Add New Post Form -->
    </div>
    <div class="col-lg-3 col-md-12">

        <!-- Categories Overview -->
        <div class='card card-small mb-3'>
            <div class="card-header border-bottom">
            <h6 class="m-0">Categories</h6>
            </div>
            <div class='card-body p-0'>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3 pb-2">
                        <fieldset>
                            @foreach($categories as $c)                                    
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" id="category{{$c->id}}" name="categorySelection" value="{{$c->id}}" 
                                    class="custom-control-input" {{ $c->category_title == $item->CategoryInfo->category_title ? 'checked' : '' }} disabled>
                                    <label class="custom-control-label" for="category{{$c->id}}">{{$c->category_title}}</label>
                                </div>
                            @endforeach
                        </fieldset>
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-- / Categories Overview -->
        <!-- Group Item Overview -->
        <div class='card card-small mb-3'>
            <div class="card-header border-bottom">
                <h6 class="m-0">Group Items</h6>
            </div>
            <div class='card-body p-0'>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3 pb-2">
                        <fieldset>
                            @foreach($groupItems as $gi)
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" id="groupItem{{$gi->id}}" name="groupItemSelection" value="{{$gi->id}}" disabled
                                    class="custom-control-input" {{ $gi->group_item_title == $item->GroupItemInfo->group_item_title ? 'checked' : '' }} >
                                    <label class="custom-control-label" for="groupItem{{$gi->id}}">{{$gi->group_item_title}}</label>
                                </div>
                            @endforeach
                        </fieldset>
                    </li>
                    
                </ul>
            </div>
        </div>
        <!-- / Group Item Overview -->
            <!-- Action Overview -->
        <div class='card card-small mb-3'>
            <div class="card-header border-bottom">
                <h6 class="m-0">Action</h6>
            </div>
            <div class='card-body p-0'>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3 pb-2">
                        <div class="input-group">
                            <a href="{{ route('items.edit', ['item' => $item->id]) }}" class="btn btn-sm btn-outline-accent" 
                                data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="material-icons">edit</i>Edit
                            </a> 

                            @can('deleteItem', App\Item::class)
                                <form method="POST" action="{{ route('items.destroy', ['item' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class=" ml-3 btn btn-sm btn-outline-accent ">
                                        <i class="material-icons">delete</i> Destroy</button>
                                </form>
                            @endcan 
                            
                        </div>                                
                    </li>                            
                </ul>
            </div>
        </div>
            <!-- / Categories Overview -->
    </div>
</div>


@if( count($item->SubItemList) > 0 )
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <h3 class="page-title">Sub Post Detail</h3>
        </div>
    </div>
    <!-- Default Light Table -->
    <div class="row">
        @for ($i = 0; $i < count($item->SubItemList) ; $i++)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 card-post--aside">
    
                    <div class="card-body py-3">                   
                        <h5 class="card-title mb-0">
                            <a class="text-fiord-blue" href="{{ route('subitems.show', ['subItem' => $item->SubItemList[$i]->id]) }}">{{ $item->SubItemList[$i]->sub_item_title }}</a>
                        </h5>
                        <p class="card-text d-inline-block mb-3" id="i{{$item->SubItemList[$i]->id}}"></p>
                        <span class="text-muted">{{ date('F d, Y', strtotime($item->SubItemList[$i]->created_at)) }}</span>
                    </div>
    
                </div>
            </div>
        @endfor            
    </div>
    <!-- End Default Light Table -->       
@endif

@endsection

@section('additional-script')

<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        readOnly: true,
        "modules": {
            "toolbar": false
        }
    });

    var deltaContent = document.getElementById('deltaContent').innerHTML;

    quill.setContents( JSON.parse(deltaContent) );

</script>
    
@endsection