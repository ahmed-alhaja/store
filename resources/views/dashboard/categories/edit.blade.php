@extends('layouts.dashboard')
@section('title', 'Edit Categoty')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categoties</li>
    <li class="breadcrumb-item active">Edit Categoty</li>
@endsection
@section('content')
    <form action="{{ route('dashboard.categories.update' , $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
      @include('dashboard.categories._form' , [
        'button_label' => 'Update'
      ])
    </form>
@endsection
