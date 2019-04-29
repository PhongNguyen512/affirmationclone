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
                        value="{{ $category->category_title }}" placeholder="Enter title" aria-label="Enter title" aria-describedby="basic-addon1" disable>

                    </div>

                    <div class="row mt-2">
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="ml-3 btn btn-sm btn-outline-accent" 
                            data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="material-icons">edit</i>Edit
                        </a> 
                    </div>  

                </li>
            </ul>
        </div>
    </div>   
    <!--End Card Left-->

</div>

@php
    $affList = $category->AffList()->get();
@endphp

@if(count( $affList ) > 0)
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Affirmations Detail</h3>        
    </div>
</div>
    <!-- Default Light Table -->
    <div class="row">
        @foreach ($affList->sort() as $a)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 card-post--aside">

                    <div class="card-body py-3">                   
                        <h5 class="card-title mb-0">
                            <a class="text-fiord-blue" href="{{ route('affirmations.show', ['aff' => $a->id]) }}">{{$a->id}}</a>
                        </h5>
                        <p class="card-text d-inline-block mb-3 "> {{ $a->aff_content }} </p>
                        <span class="d-block text-muted">{{ date('F d, Y', strtotime($a->created_at)) }}</span>
                        
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <!-- End Default Light Table -->
@endif

@endsection