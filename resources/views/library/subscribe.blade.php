 @extends('layouts.app')
 @section('title')
     Subscription
 @endsection

 @section('content')
     <div class="container mt-4">
         <div class="row gx-lg-5 justify-content-center">
             @foreach ($plans as $plan)
                 <div class="col-lg-3 col-md-6 mb-4">
                     <div class="card border border-dark">
                         <div class="card-header bg-white py-3">
                             <p class="text-uppercase small mb-2"><strong>{{ $plan->plan_name }}</strong></p>
                             <h5 class="mb-0"> &#8377;{{ $plan->price }}/{{ $plan->plan_duration }}</h5>
                         </div>
                         <div class="card-footer bg-white py-3">
                         <form action="/Plan/{{ $plan->id }}" method="post">
                                 <input type="text" name="price" hidden value={{ $plan->price }}>
                                 <input type="text" name="id" hidden value={{ $plan->id }}>
                                 <button  type="submit" class="btn btn-dark btn-sm">Buy now</button>
                                 @csrf
                             </form>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>


 @endsection
