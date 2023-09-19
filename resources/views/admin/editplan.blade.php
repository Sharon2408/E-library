@extends('layouts.app')
@section('title')
    Edit Plan
@endsection

@section('content')
    <div class="container mt-5">
    <h2 class="text-center"> Edit Plan : {{ $plan->plan_name }} </h2>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-sm-12 border border-dark rounded-3 shadow-lg col-md">
                <form action="/plan/{{ $plan->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('layouts/planform')
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