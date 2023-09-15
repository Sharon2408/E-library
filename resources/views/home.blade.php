@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="container p-5 mt-3">
        <div class="row gy-5 d-flex">
            <form class="d-flex" action="{{ route('search') }}" method="post" role="search">
            @csrf
                <input class="form-control me-sm-2" type="search" placeholder="Search" value="{{ $query }}" name="q">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            @if(isset($categories))
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-12">
                    <a href={{ route('library.book', ['category_id' => $category->category_id]) }}>
                        <div class="card shadow-lg" style="width: 22rem;">
                            <img src={{ $category->image }} class="card-img-top" alt={{ $category->category_name }}>
                            <div class="card-body card-img-overlay text-light text-center mt-5 pt-5">
                                <p class="card-text text-white bg-dark bg-opacity-50 mt-5 fs-4">
                                    {{ $category->category_name }}</p>
                            </div>
                    </a>
                </div>
        </div>
        @endforeach 
        @endif
        @if(isset($details))
        <p>Search results for <b> {{ $query }} </b></p>
         @foreach ($details as $searchcategory)
                <div class="col-lg-4 col-md-12">
                    <a href={{ route('library.book', ['category_id' => $searchcategory->category_id]) }}>
                        <div class="card shadow-lg" style="width: 22rem;">
                            <img src={{ $searchcategory->image }} class="card-img-top" alt={{ $searchcategory->category_name }}>
                            <div class="card-body card-img-overlay text-light text-center mt-5 pt-5">
                                <p class="card-text text-white bg-dark bg-opacity-50 mt-5 fs-4">
                                    {{ $searchcategory->category_name }}</p>
                            </div>
                    </a>
                </div>
        </div>
        @endforeach
        @elseif(isset($message))
        <p>{{ $message }} for {{ $query }}</p>
        @endif
        <br>
    </div>
    </div>
@endsection
