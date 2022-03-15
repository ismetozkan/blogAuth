@extends('back.layouts.master')
@section('content')
@section('title','All Categories')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('category.create') }}">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category" required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Add Category--></button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Categories</th>
                                <th>Articles in It</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($categories as $category)
                                <tr>

                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->articleNum() }}</td>

                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                        <a href="{{ route('category.delete', $category->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection
