@extends('admin.base-template.base')

@section('CategoriesStatus', 'active')

@section('main-content')

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Overview</span>
        <h3 class="page-title">Categories</h3>
        <a class="btn btn-outline-dark mt-3" href="{{ route('categories.create') }}">
            <i class="material-icons">add</i>
            <span>Add New Category</span>
        </a>
    </div>
</div>
<!-- End Page Header -->
<!-- Default Light Table -->
<div class="row">
    <div class="col">
        <div class="card card-small mb-4">
            <div class="card-body p-0 pb-3 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Title</th>
                            <th scope="col" class="border-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->category_title}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col offset-3">
                                            <a href="{{ route('categories.show', ['category' => $c->id]) }}" class="float-left mb-2 btn btn-sm btn-outline-primary" 
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>Show
                                            </a>
                                            <a href="{{ route('categories.edit', ['category' => $c->id]) }}" class="float-left ml-2 mb-2 btn btn-sm btn-outline-primary" 
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>Edit
                                            </a>
                                            @can('deleteCategory', App\Category::class)
                                                <form class="delete" method="POST" action="{{ route('categories.destroy', ['category' => $c->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                
                                                    <button type="submit" class="btn btn-sm btn-outline-accent ">
                                                        <i class="material-icons">delete</i> Destroy</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Default Light Table -->
    
@endsection

@section('additional-script')
<script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });
</script>
@endsection