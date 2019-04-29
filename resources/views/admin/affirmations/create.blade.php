@extends('admin.base-template.base')

@section('AffsStatus', 'active')

@section('main-content')
<form id="submitForm" method="POST" action="{{ route('affirmations.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="page-header row no-gutters py-4">
        <div class="col-12 text-center text-sm-left mb-0">
            <h3 class="page-title">Create New Affirmation</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-9 col-md-12">
        <!-- Add New Post Form -->
            <div class="card card-small mb-3">
                <div class="card-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Affirmation ID</span>
                        </div>
                        <input id="id" name="id" type="text" class="form-control" value="{{$id}}" aria-label="Affirmation ID" readonly>
                        {{-- Avoid user modify id in inspect --}}
                        @if ($errors->has('id'))
                            <span class="badge badge-danger" role="alert">
                                {{ $errors->first('id') }}
                            </span>
                        @endif
                    </div>

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
                        <i class="material-icons">save</i> Create</button>
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
                                {{-- This input will contain all of checked value from the checkboxes --}}
                                <input id="categorySelection" name="categorySelection" type="hidden" value="">

                                @foreach($categories as $c)
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" id="category{{$c->id}}" class="custom-control-input" value="{{$c->id}}" name="catSelection">
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

    var categorySelection  = new Array();

    $('#submitForm').on("submit", function(){
        var aff_content = document.querySelector('input[name=aff_content]');
        
        aff_content.value = quill.getText();

        $.each($("input[name='catSelection']:checked"), function(){            
            categorySelection.push($(this).val());
        });

        document.querySelector('input[name=categorySelection]').value = categorySelection;
    });

</script>
    
@endsection