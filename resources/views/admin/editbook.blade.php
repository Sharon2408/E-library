{{-- @extends('layouts.sidenav') --}}
@extends('layouts.app')
@section('title')
    Edit Book
@endsection

@section('content')
    <div class="container mt-5">
    <h2 class="text-center"> Edit Book : {{ $book->title }} </h2>
        <div class="row justify-content-center">
            <div class="col-5 border border-dark rounded-3 shadow-lg col-md">
                <form action="/admin/{{ $book->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('layouts/bookform')
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection