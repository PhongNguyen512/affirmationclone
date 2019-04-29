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

<form id="submitForm" method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
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
                        </div>

                        <li class="list-group-item d-flex px-3">
                            <button type="submit" class="btn btn-sm btn-outline-accent ">
                                <i class="material-icons">save</i> Update</button>
                        </li> 

                    </li>
                </ul>
            </div>

            {{-- Affirmation List --}}
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
                    <h3 class="page-title">Affirmations List</h3>        
                </div>
            </div>
            <!-- Default Light Table -->
            <div class="row">

                @php
                    $affList = $category->AffList()->get();
                @endphp

                <input id="affirmationSelection" name="affirmationSelection" type="hidden" value="">

                @foreach($aff as $a)
                    <div class="col-lg-3 col-md-3 col-sm-4 mb-4">
                        <div class='card card-small mb-3'>
                            <div class='card-body p-0'>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-3 pb-2">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" id="aff{{$a->id}}" class="custom-control-input" value="{{$a->id}}"
                                                    {{ $affList->contains('id', $a->id) ? 'checked':'' }} name="affSelection">
                                                <label class="custom-control-label" for="aff{{$a->id}}" >
                                                    <a class="text-fiord-blue" title="{{$a->aff_content}}" data-toggle="tooltip" data-placement="top" 
                                                        href="{{ route('affirmations.show', ['aff' => $a->id]) }}">#{{$a->id}}</a>
                                                </label>
                                            </div>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Default Light Table -->

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

</form>

@endsection


@section('additional-script')

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var affSelection  = new Array();

    $('#submitForm').on("submit", function(){

        $.each($("input[name='affSelection']:checked"), function(){            
            affSelection.push($(this).val());
        });

        document.querySelector('input[name=affirmationSelection]').value = affSelection;
    });

</script>
    
@endsection