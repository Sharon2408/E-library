 @extends('layouts.app')
 @section('title')
     Error
 @endsection

 @section('content')
<div class="container mt-5 text-center">
    <div class="row">
        <div class="col">
            <h4>Oops! Something went wrong&#128531;</h4>
            <a href="{{route('home')}}" class="btn btn-outline-dark">Retry</a>
        </div>
    </div>
</div>
@endsection
