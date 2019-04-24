@extends('admin.base-template.base')

@section('AffsStatus', 'active')

@section('main-content')

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <h3 class="page-title">Affirmation Detail</h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card card-small card-post card-post--1 card-post--aside">

            <div class="card-body py-3">                   
                <h5 class="card-title mb-0">
                    <a class="text-fiord-blue" >{{$aff->id}}</a>
                </h5>
                <p class="card-text d-inline-block mb-2 "> {{ $aff->aff_content }} </p>
            <span class="d-block text-muted">{{ date('F d, Y', strtotime($aff->created_at)) }}</span>
                
            </div>

        </div>
    </div>      
</div>

@php
    $catArray = $aff->CatList()->get()->toArray();
    $catList = $aff->CatList()->get();
@endphp

@if(count( $catArray ) > 0)
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Categories Detail</h3>        
    </div>
</div>

<div class="row">
    @for ($i = 0; $i < count( $catList ) ; $i++)
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card card-small card-post card-post--1 card-post--aside">

                <div class="card-body py-3">                   
                    <h5 class="card-title mb-0">
                        <a class="text-fiord-blue" href="{{ route('categories.show', ['category' => $catList[$i]->id]) }}">{{$catList[$i]->category_title}}</a>
                    </h5>                  
                <span class="d-block text-muted">{{ date('F d, Y', strtotime($catList[$i]->created_at)) }}</span>  
                </div>

            </div>
        </div>
    @endfor        
</div>
   
@endif

@endsection
