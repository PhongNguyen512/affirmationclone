@extends('admin.base-template.base')

@section('PostsStatus', 'active')

@section('main-content')

<div id='editor-container' ></div>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Overview</span>
        <h3 class="page-title">Items</h3>
        <a class="btn btn-outline-dark mt-3"  href="{{ route('items.create') }}">
            <i class="material-icons">add</i>
            <span>Add New Items</span>
        </a>
    </div>
</div>
<!-- End Page Header -->
<!-- Default Light Table -->
<div class="row">

    @for ($i = 0; $i < count($items) ; $i++)
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card card-small card-post card-post--1 card-post--aside">

                <div class="card-body pb-2">
                    <a href="{{ route('categories.show', ['category' => $items[$i]->CategoryInfo->id]) }}" class="card-post__category badge badge-pill badge-dark ml-2">{{ $items[$i]->CategoryInfo->category_title }}</a>                    
                    <h5 class="card-title mt-3 mb-0">
                        <a class="text-fiord-blue" href="{{ route('items.show', ['item' => $items[$i]->id]) }}">{{ $items[$i]->item_title }}</a>
                    </h5>
                    <p id="deltaContent" hidden>{{  $items[$i]->item_content }}</p>
                    <p class="card-text d-inline-block mb-3" id="i{{$items[$i]->id}}"></p>
                    <span class="text-muted">{{ date('F d, Y', strtotime($items[$i]->created_at)) }}</span>
                </div>

            </div>
        </div>
    @endfor
 
</div>
<!-- End Default Light Table -->
    
@endsection