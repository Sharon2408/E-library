 @extends('layouts.app')
 @section('title')
     Books
 @endsection

 @section('content')
     <div class="container mt-4">
         <div class="row gx-lg-5 justify-content-center">
             <div class="col-lg-3 col-md-6 mb-4">

                 <!-- Card -->
                 <div class="card border border-dark">

                     <div class="card-header bg-white py-3">
                         <p class="text-uppercase small mb-2"><strong>Basic Reader</strong></p>
                         <h5 class="mb-0">	&#8377;19/week</h5>
                     </div>

                     <div class="card-footer bg-white py-3">
                         <button type="button" class="btn btn-primary btn-sm">Buy now</button>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 mb-4">

                 <!-- Card -->
                 <div class="card border border-dark">

                     <div class="card-header bg-white py-3">
                         <p class="text-uppercase small mb-2"><strong>Pro Reader</strong></p>
                         <h5 class="mb-0">	&#8377;99/3month</h5>
                     </div>

                     <div class="card-footer bg-white py-3">
                         <button type="button" class="btn btn-primary btn-sm">Buy now</button>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 mb-4">

                 <!-- Card -->
                 <div class="card border border-dark">

                     <div class="card-header bg-white py-3">
                         <p class="text-uppercase small mb-2"><strong>Premium Reader</strong></p>
                         <h5 class="mb-0">	&#8377;199/6month</h5>
                     </div>

                     <div class="card-footer bg-white py-3">
                         <button type="button" class="btn btn-primary btn-sm">Buy now</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
