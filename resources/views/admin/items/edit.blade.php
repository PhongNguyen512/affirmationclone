@extends('admin.base-template.base')

@section('PostsStatus', 'active')

@section('main-content')
<form id="submitForm" class="" method="POST" action="{{ route('items.update', ['item' => $item->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Blog Posts</span>
            <h3 class="page-title">Update Post</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-9 col-md-12">
        <!-- Add New Post Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    
                    <input class="form-control form-control-lg mb-3" type="text" name="item_title" 
                        value="{{$item->item_title}}" placeholder="Your Post Title" required>
                    @if ($errors->has('item_title'))
                        <span class="badge badge-danger" role="alert">
                            {{ $errors->first('item_title') }}
                        </span>
                    @endif

                    <p id="deltaContent" hidden value="">{{ $item->item_content }}</p>
                    <input id="item_content" name="item_content" type="hidden" value="">
                    <div id="editor-container" class="add-new-post__editor mb-1"></div>
                    @if ($errors->has('item_content'))
                        <span class="badge badge-danger" role="alert">
                            {{ $errors->first('item_content') }}
                        </span>
                    @endif

                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Background Color</span>
                        </div>
                        <input name="background_color" type="hidden" id="color_value" value="{{$item->background_color}}">
                        <button class="jscolor {valueElement:'color_value'} {onFineChange:'update(this)'}" style="width:150px; height:40px;"></button>
        
                        <div class="input-group-prepend">
                            <span class="input-group-text">Icon</span>  
                            @if($item->icon !== null)
                                <div style="height:40px">
                                    <img class="input-group-text" style="height:40px" src="{{ asset($item->icon) }}">
                                </div>
                            @endif                                                              
                        </div>
                        <input id="" type="file" name="icon" type="text" class="form-control" 
                            placeholder="Upload an icon" aria-label="Upload an icon" aria-describedby="basic-addon1">
                    </div> 
                    
                </div>
                <li class="list-group-item d-flex px-3">
                    <button type="submit" class="btn btn-sm btn-outline-accent ">
                        <i class="material-icons">save</i> Update</button>
                </li>
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
                                            class="custom-control-input" {{ $c->category_title == $item->CategoryInfo->category_title ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="category{{$c->id}}">{{$c->category_title}}</label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <div class="input-group">
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary" 
                                    data-toggle="tooltip" data-placement="top" title="New">
                                    <i class="material-icons">edit</i>New Category
                                </a>                         
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Categories Overview -->
            <!-- Categories Overview -->
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
                                        <input type="radio" id="groupItem{{$gi->id}}" name="groupItemSelection" value="{{$gi->id}}" 
                                        class="custom-control-input" {{ $gi->group_item_title == $item->GroupItemInfo->group_item_title ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="groupItem{{$gi->id}}">{{$gi->group_item_title}}</label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <a href="{{ route('groupitems.create') }}" class="btn btn-sm btn-outline-primary" 
                                data-toggle="tooltip" data-placement="top" title="New">
                                <i class="material-icons">edit</i>New Group Item
                            </a> 
                    </li>
                    </ul>
                </div>
            </div>
            <!-- / Categories Overview -->
        </div>
    </div>
   
</form>

@endsection

@section('additional-script')

<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow', 
    });

    var deltaContent = document.getElementById('deltaContent').innerHTML;

    quill.setContents( JSON.parse(deltaContent) );

    $('#submitForm').on("submit", function(){
        var item_content = document.querySelector('input[name=item_content]');
        item_content.value = JSON.stringify(quill.getContents());
    });

</script>
    
@endsection