@extends('layouts.app')
@section('title')
    Books
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{-- <div class="col-2">
                @extends('layouts.sidenav')
            </div> --}}
            @foreach ($book as $book)
                <div class="col mt-5">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="book image" height="500px">
                </div>
                <div class="col mt-5">
                    <h1>{{ $book->title }}</h1>
                    <p>{{ $book->detailed_description }}
                    <p>
                        <small class="float-right font-italic font-weight-bold">Author: {{ $book->author }}</small>
                        <br><br>
                        <a class="btn btn-outline-dark float-right" href="{{ asset('storage/'.$book->pdf) }}" target="blank">Read Now</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
