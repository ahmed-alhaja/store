@extends('layouts.dashboard')
@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection
@section('content')
    <div class="mb-5">
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-info">
            {{session('info')}}
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{asset('storage/' . $category->image)}}" alt="" height="50"></td>
                    <td>{{ $category->id }} </td>
                    <td>{{ $category->name }} </td>
                    <td>{{ $category->parent_id }} </td>
                    <td>{{ $category->created_at }} </td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit' ,$category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy' , $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <!-- Form Method Spoofing  -->
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Categories defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
