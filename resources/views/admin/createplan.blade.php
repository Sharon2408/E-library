@extends('layouts.app')
@section('title')
    Create Plan
@endsection

@section('content')
    <div class="container mt-5">
    <h2 class="text-center"> Add New Plan </h2>
        <div class="row justify-content-center">
            <div class="col-lg-5 border border-info rounded-3 shadow-lg col-md">
                <form action="{{ route('plan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('layouts/planform')
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Plan</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection