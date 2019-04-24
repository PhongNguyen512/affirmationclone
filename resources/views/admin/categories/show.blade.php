@extends('admin.base-template.base')

@section('CategoriesStatus', 'active')

@section('main-content')

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Category Detail</h3>        
    </div>
</div>
<!-- End Page Header -->
<div class="row">
    <!--Card Left-->
    <div class="col-lg-9 col-md-12">
        <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3">

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
                        @if ($errors->has('destroy'))
                            <span class="badge badge-danger" role="alert">
                                {{ $errors->first('destroy') }}
                            </span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Background Color</span>
                        </div>
                        <input name="background_color" type="hidden" id="color_value" value="{{$category->background_color}}">
                        <button class="jscolor {valueElement:'color_value'}" style="width:150px; height:40px;" disabled></button>

                        @if($category->icon !== null)
                            <div class="input-group-prepend">
                                <span class="input-group-text">Icon</span>                                
                                    <div style="height:40px">
                                        <img class="input-group-text" style="height:40px" src="{{ asset($category->icon) }}">
                                    </div>                                
                            </div>
                        @endif 
                    </div>
                </li>
            </ul>
        </div>
    </div>   
    <!--End Card Left-->

    <!-- Action Overview -->
    <div class="col-lg-3 col-md-12">
        <div class='card card-small mb-3'>
            <div class="card-header border-bottom">
                <h6 class="m-0">Action</h6>
            </div>
            <div class='card-body p-0'>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3 pb-2">
                        <div class="input-group">
                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-accent" 
                                data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="material-icons">edit</i>Edit
                            </a> 

                            @can('deleteSubItem', App\SubItem::class)
                                <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
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
    </div>
    <!-- / Categories Overview -->
</div>

@if(count($category->ItemList) > 0)
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Items Detail</h3>        
    </div>
</div>
    <!-- Default Light Table -->
    <div class="row">
        @for ($i = 0; $i < count($category->ItemList) ; $i++)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 card-post--aside">

                    <div class="card-body py-3">                   
                        <h5 class="card-title mb-0">
                            <a class="text-fiord-blue" href="{{ route('items.show', ['item' => $category->ItemList[$i]->id]) }}">{{ $category->ItemList[$i]->item_title }}</a>
                        </h5>
                        <p class="card-text d-inline-block mb-3" id="i{{$category->ItemList[$i]->id}}"></p>
                        <span class="text-muted">{{ date('F d, Y', strtotime($category->ItemList[$i]->created_at)) }}</span>
                    </div>

                </div>
            </div>
        @endfor
        
    </div>
    <!-- End Default Light Table -->
@endif

@endsection