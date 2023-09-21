@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Payment Receipt</h4>
                    </div>
                    <div class="card-body">
                        <h5>Order Details</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Order ID:</strong> ABC123</p>
                                <p><strong>Date:</strong> September 25, 2023</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Payment ID:</strong> PAY456</p>
                                <p><strong>Payment Date:</strong> September 25, 2023</p>
                            </div>
                        </div>

                        <h5>Payment Information</h5>
                        <hr>
                        <p><strong>Payment Amount:</strong> $50.00 USD</p>
                        <p><strong>Currency:</strong> USD</p>
                        <p><strong>Payment Status:</strong> Completed</p>

                        <h5>Customer Information</h5>
                        <hr>
                        <p><strong>Name:</strong> John Doe</p>
                        <p><strong>Email:</strong> johndoe@example.com</p>

                        <h5>Billing Address</h5>
                        <hr>
                        <p><strong>Street:</strong> 123 Main St</p>
                        <p><strong>City:</strong> Anytown</p>
                        <p><strong>State:</strong> CA</p>
                        <p><strong>ZIP Code:</strong> 12345</p>

                        <button class="btn btn-primary mt-3">Print Receipt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection