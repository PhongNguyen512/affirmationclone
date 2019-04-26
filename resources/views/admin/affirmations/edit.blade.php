@extends('admin.base-template.base')

@section('AffsStatus', 'active')

@section('main-content')
<form id="submitForm" class="" method="POST" action="{{ route('affirmations.update', ['aff' => $aff->id]) }}" enctype="multipart/form-data">
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

                    <p id="deltaContent" hidden value="">{{ $aff->aff_content }}</p>
                    <input id="aff_content" name="aff_content" type="hidden" value="">
                    <div id="editor-container" class="add-new-post__editor mb-1"></div>
                    @if ($errors->has('aff_content'))
                        <span class="badge badge-danger" role="alert">
                            {{ $errors->first('aff_content') }}
                        </span>
                    @endif
                    
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
                                {{-- @foreach($categories as $c)                                    
                                    <div class="custom-control custom-radio mb-1">
                                        <input type="radio" id="category{{$c->id}}" name="categorySelection" value="{{$c->id}}" 
                                            class="custom-control-input" >
                                        <label class="custom-control-label" for="category{{$c->id}}">{{$c->category_title}}</label>
                                    </div>
                                @endforeach --}}

                                @php
                                    $categoryArray = $aff->CatList()->get()->pluck('category_title')->toArray();
                                @endphp
                                
                                @foreach($categories as $c)
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" id="category{{$c->id}}" class="custom-control-input" value="{{$c->id}}"
                                            {{ in_array($c->category_title, $categoryArray) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="category{{$c->id}}">{{$c->category_title}}</label>
                                    </div>
                                @endforeach

                            </fieldset>
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
        "modules": {
            "toolbar": false
        }
    });

    var deltaContent = document.getElementById('deltaContent').innerHTML;

    quill.setText(deltaContent);    

    $('#submitForm').on("submit", function(){
        var aff_content = document.querySelector('input[name=aff_content]');
        
        aff_content.value = quill.getText();
    });

</script>
    
@endsection