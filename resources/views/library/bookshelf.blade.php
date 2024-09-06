 @extends('layouts.app')
 @section('title')
     Book Shelf
 @endsection

 @section('content')
     @vite(['resources/css/app.css'])

     <div class="container-fluid mt-4">
         <div class="row d-flex justify-content-center">
              @if($books->isNotEmpty())
             @foreach ($books as $book)
                 <div class="col-lg-3 col-md-12">
                     <div class="card mb-3 float-end" style="max-width: 440px;">
                         <div class="row g-0">
                             <div class="col-md-4">
                                 <img id="main-img" src="{{$book->image}}"
                                     class="img-fluid rounded-start" alt="book_image">
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body">
                                     <h4 class="card-title">{{ $book->title }}</h4>
                                     <p class="card-text">{{ $book->description }}</p>
                                     <p class="card-text"><small class="text-muted">{{ $book->author }}</small></p>
                                 </div>
                                 <div class="d-flex p-2">
                                  <form action="/bookshelf/{{ $book->id }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                 <button class="btn btn-outline-danger p-1 me-2" type="submit">Remove</button>
                                 </form>
                                     <a href="{{ asset('storage/'.$book->pdf) }}">
                                     <button class="btn btn-outline-primary p-1 me-2" type="submit">Read Now</button>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
       @else
             <h2 class="text-center">Looks like your shelf is empty!&#128531;</h2>
             <a class="btn btn-outline-dark col-lg-1 col-md-2" href="{{ route('home') }}">Add Now<a>
             @endif 
 @endsection
 <style>
 
 </style>
