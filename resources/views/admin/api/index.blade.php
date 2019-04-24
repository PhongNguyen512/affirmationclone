@extends('admin.base-template.base')

{{-- @section('CategoriesStatus', 'active') --}}

@section('main-content')

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Get API</h3>        
    </div>
</div>

<div class="row">
     <!--Card Left-->
     <div class="col-lg-8 col-md-12">
        <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3">
                    <form method="POST" action="{{ route('getApi.get') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">API URL</span>
                            </div>
                            <input id="apiURL" name="apiURL" type="text" class="form-control {{ $errors->has('apiURL') ? ' border-danger' : '' }}" 
                            value="{{ old('apiURL') }}" placeholder="Input url" aria-label="Input url" aria-describedby="basic-addon1">

                            @if ($errors->has('apiURL'))
                                <span class="badge badge-danger" role="alert">
                                    {{ $errors->first('apiURL') }}
                                </span>
                            @endif
                        </div>

                        <li class="list-group-item d-flex px-3">
                            <button type="submit" class="btn btn-sm btn-outline-accent ">
                                <i class="material-icons">save</i> Get Data</button>
                        </li>                        
                    </form>
                </li>
            </ul>
        </div>
    </div>
    
</div>
    
@endsection