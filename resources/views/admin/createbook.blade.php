{{-- @extends('layouts.sidenav') --}}
@extends('layouts.app')
@section('title')
    Create Book
@endsection

@section('content')
    <h2 class="text-center"> Add New Book </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5 border border-dark rounded-3 shadow-lg">
                <form action={{route('book.store')}} method="post" enctype="multipart/form-data">
                    @csrf
                    @include('layouts/bookform')
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection