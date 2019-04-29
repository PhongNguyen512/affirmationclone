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
                @if ($errors->has('destroy'))
                    <span class="badge badge-danger" role="alert">
                        {{ $errors->first('destroy') }}
                    </span>
                @endif

                <h5 class="card-title mb-0">
                    <a class="text-fiord-blue" >{{$aff->id}}</a>
                </h5>
                <p class="card-text d-inline-block mb-2 "> {{ $aff->aff_content }} </p>
                <span class="d-block text-muted">{{ date('F d, Y', strtotime($aff->created_at)) }}</span>

                <div class="row mt-2">

                    <a href="{{ route('affirmations.edit', ['aff' => $aff->id]) }}" class="ml-3 btn btn-sm btn-outline-accent" 
                        data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="material-icons">edit</i>Edit
                    </a> 
                    @can('deleteItem', App\Category::class)
                            <form class="delete" method="POST" action="{{ route('affirmations.destroy', ['aff' => $aff->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class=" ml-3 btn btn-sm btn-outline-accent ">
                                    <i class="material-icons">delete</i> Destroy</button>
                            </form>
                        @endcan 

                </div> 
            </div>
        </div>
    </div>      
</div>

@php
    $catList = $aff->CatList()->get();
@endphp

{{-- Categories List --}}
@if(count( $catList ) > 0)
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
            <h3 class="page-title">Categories List</h3>        
        </div>
    </div>

    <div class="row">
        @foreach($catList as $cat)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 card-post--aside">

                    <div class="card-body py-3">                   
                        <h5 class="card-title mb-0">
                            <a class="text-fiord-blue" href="{{ route('categories.show', ['category' => $cat->id]) }}">{{$cat->category_title}}</a>
                        </h5>                  
                    <span class="d-block text-muted">{{ date('F d, Y', strtotime($cat->created_at)) }}</span>  
                    </div>

                </div>
            </div>
        @endforeach       
    </div>   
@endif

@endsection

@section('additional-script')
<script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });
</script>
@endsection