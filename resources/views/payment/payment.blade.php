<button id="rzp-button1" hidden>Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "rzp_test_gB76NgJTAbbEVE",
        "amount": "{{ $response['amount'] }}",
        "currency": "{{ $response['currency'] }}",
        "name": "Verb-Voyage",
        "description": "Subscription to Verb-Voyage",

        "order_id": "{{ $response['orderId'] }}",
        "handler": function(response) {
            document.getElementById("rzp_paymentid").value = response.razorpay_payment_id;
            document.getElementById("rzp_orderid").value = response.razorpay_order_id;
            document.getElementById("plan_id").value = {{ $plan['id'] }};
            document.getElementById("amount").value = response.amount; 
            document.getElementById("rzp_signature").value = response.razorpay_signature;
            document.getElementById('rzp-paymentresponse').click();
        },

        "prefill": {

            "name": "{{ $response['name'] }}",
            "email": "{{ $response['email'] }}",

        },

        "theme": {
            "color": "#F37254"
        }
    }

    var rzp1 = new Razorpay(options);

    window.onload = function() {
        document.getElementById('rzp-button1').click();
    };

    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
</script>
@foreach ($plan as $plan)
    <form action="/payment/receipt/{{ $plan[0] }}" method="post" hidden>
            <input type="text" class="form-control" id="rzp_paymentid" name="rzp_paymentid">
            <input type="hidden" id="plan_id" name="plan_id" value="{{ $plan[0] }}">
            <input type="hidden" class="form-control"  id="amount" name="amount" value="{{ $response['amount'] }}">
            <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
            <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
            <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
            @csrf
        </form>

@endforeach
        
