@extends('admin.base-template.base')

@section('ApisStatus', 'active')

@section('main-content')

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Get API</h3>        
    </div>
</div>

<div class="row">
     <div class="col-lg-8 col-md-12">
        <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3">
                    <form method="POST" action="{{ route('getApi.get') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">API URL</span>
                            </div>

                            <input id="apiURL" name="apiURL" type="text" class="form-control {{ count($errors->all()) > 0 ? ' border-danger' : '' }}" 
                            value="{{ old('apiURL') }}" placeholder="Input url" aria-label="Input URL" aria-describedby="basic-addon1">

                            @if ( count($errors->all()) > 0 )
                                @foreach($errors->all() as $message)
                                    <span class="badge badge-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @endforeach                                
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

<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-6 text-center text-sm-left mb-0">
        <h3 class="page-title">Response API</h3>        
    </div>
</div>

<div class="row">
     <div class="col-lg-8 col-md-12">
        <div class="card card-small mb-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">API URL</span>
                            </div>

                            <input id="apiURL" name="apiURL" type="text" class="form-control" value="{{ url(route('affAPI')) }}" 
                                aria-label="API URL" aria-describedby="basic-addon1" disabled>

                        </div>

                        <li class="list-group-item d-flex px-3">
                            <a href="{{ route('affAPI') }}" class="float-left mb-2 btn btn-sm btn-outline-primary" 
                                data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="material-icons">save</i>Data
                            </a>
                        </li>                        
                    </form>
                </li>
            </ul>
        </div>
    </div>    
</div>
    
@endsection