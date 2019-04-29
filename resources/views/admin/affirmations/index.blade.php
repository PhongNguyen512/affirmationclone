@extends('admin.base-template.base')

@section('AffsStatus', 'active')

@section('main-content')

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Overview</span>
        <h3 class="page-title">Affirmations</h3>
        <a class="btn btn-outline-dark mt-3"  href="{{ route('affirmations.create') }}">
            <i class="material-icons">add</i>
            <span>Add New Affirmation</span>
        </a>
    </div>
</div>
<!-- End Page Header -->
<!-- Default Light Table -->
<div class="row">

    @for ($i = 0; $i < count($affirmation) ; $i++)
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card card-small card-post card-post--1 card-post--aside">

                <div class="card-body pb-2">
                    <h5 class="card-title mb-0">
                        <a class="text-fiord-blue" href="{{ route('affirmations.show', ['aff' => $affirmation[$i]->id]) }}"> {{$affirmation[$i]->id}} </a>
                    </h5>
                    
                    <p class="card-text d-inline-block mb-3 "> {{ $affirmation[$i]->aff_content }} </p>
                    <span class="d-block text-muted">{{ date('F d, Y', strtotime($affirmation[$i]->created_at)) }}</span>
                </div>

            </div>
        </div>
    @endfor
 
</div>
<!-- End Default Light Table -->
    
@endsection