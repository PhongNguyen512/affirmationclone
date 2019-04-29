@extends('admin.base-template.base')

@section('CategoriesStatus', 'active')

@section('main-content')

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Edit Categories</h3>        
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <!--Card Left-->
    <div class="col-lg-9 col-md-12">
        <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3">
                    <form method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Category Title</span>
                            </div>
                            <input id="category_title" name="category_title" type="text" class="form-control {{ $errors->has('category_title') ? ' border-danger' : '' }}" 
                            value="{{ $category->category_title }}" placeholder="Enter title" aria-label="Enter title" aria-describedby="basic-addon1" required>

                            @if ($errors->has('category_title'))
                                <span class="badge badge-danger" role="alert">
                                    {{ $errors->first('category_title') }}
                                </span>
                            @endif
                        </div>

                        <li class="list-group-item d-flex px-3">
                            <button type="submit" class="btn btn-sm btn-outline-accent ">
                                <i class="material-icons">save</i> Update</button>
                        </li>
                        
                    </form>
                </li>
            </ul>
        </div>
    </div>   
    <!--End Card Left-->

    <!--Card Right-->
    <div class="col-lg-3 col-md-12">
        <div class='card card-small mb-3'>
            <div class="card-header border-bottom">
              <h6 class="m-0">Exist Categories</h6>
            </div>
            <div class='card-body p-0'>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3 pb-2">

                        <fieldset>
                            @foreach($categories as $c)                                    
                                <div class="custom-control custom-radio mb-1">
                                    <input type="radio" id="category{{$c->id}}" class="custom-control-input" 
                                    {{ $c->category_title == $category->category_title ? 'checked' : '' }} disabled>
                                    <label class="custom-control-label" for="category{{$c->id}}">{{$c->category_title}}</label>
                                </div>
                            @endforeach
                        </fieldset>
                    
                    </li>                
                </ul>
            </div>
        </div>
    </div>
    <!--End Card Right-->
</div>

@endsection