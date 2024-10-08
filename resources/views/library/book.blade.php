 @extends('layouts.app')
 @section('title')
     Books
 @endsection

 @section('content')
     <div class="container-fluid mt-4">
         <div class="row d-flex justify-content-center">
             @foreach ($books as $book)
                 <div class="col-lg-3 col-md-12">
                     <div class="card mb-3 float-end" style="max-width: 440px;">
                         <div class="row g-0">
                             <div class="col-md-4">
                                 <img id="main-img" src="{{$book->image}}"
                                     class="img-fluid rounded-start" alt="book_image" >
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body" >
                                     <h4 class="card-title">{{ $book->title }}</h4>
                                     <p class="card-text">{{ $book->description }}</p>
                                     <p class="card-text"><small class="text-muted">{{ $book->author }}</small></p>
                                 </div>
                                 <div class="d-flex">
                                     <form action="/library/{{ $book->id }}" method="post"
                                         enctype="multipart/form-data">
                                         @csrf
                                         <button class="btn btn-outline-warning p-1 me-2"
                                             href="/library/{{ $book->id }}" type="submit">Read Later</button>
                                     </form>
                                     @if (auth()->user()->subscription && $book->ispremium)
                                         <a href="/library/{{ $book->id }}/singlebookview">
                                             <button class="btn btn-outline-dark p-1 me-2">See More</button>
                                         </a>
                                     @elseif(!$book->ispremium)
                                         <a href="/library/{{ $book->id }}/singlebookview"><button
                                                 class="btn btn-outline-dark p-1 me-2">See More</button>
                                         </a>
                                     @else
                                         <a href="{{ route('subscribe') }}"><button class="btn btn-outline-primary p-1 me-2">Subscribe</button></a>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 @endsection
 <style>
     #main-img {
         width: 100%;
         height: 100%;
         object-fit: contain;
     }
 </style>
