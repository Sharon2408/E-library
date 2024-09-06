@extends('layouts.app')
@section('title')
    Read Book
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($book as $book)
                <div class="col mt-5">
                    <img src="{{$book->image}}" alt="book image" height="500px">
                </div>
                <div class="col mt-5">
                    <h1>{{ $book->title }}</h1>
                    <p>{{ $book->description }}
                    <p>
                        <small class="float-right font-italic font-weight-bold">Author: {{ $book->author }}</small>
                        <br><br>
                        <a class="btn btn-outline-dark float-right" href="{{ asset('storage/'.$book->pdf) }}" target="blank">Read Now</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
