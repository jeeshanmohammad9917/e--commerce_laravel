@extends('layout_user')
@section('content')
<br><br><br><br>
<div class="col-md-12 col-lg-12 col-xl-12">
    <div class="card m-b-30">
        @include('flash_data')
        <h1> Make Payment</h1>                        
                                <table class="table table-borderless text-right">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total :</td>
                                            <td>₹ {{ $subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping :</td>
                                            <td>₹ {{ $shipping }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tax({{ $tax }}%) :</td>
                                            <td>₹ {{ $taxAmount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="f-w-7 font-18"><h4>Amount :</h4></td>
                                            <td class="f-w-7 font-18"><h4>₹ {{ $total }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- @php
                                      echo "<pre>";
                                    print_r($orderid);
                                    exit;
                                @endphp --}}
    </div>
    <button id="rzp-button1">Pay Now</button>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
            var urls="{{route('success')}}"
            var options = {
                "key": "rzp_test_KQtXcCLUR4Tucv", // Enter the Key ID generated from the Dashboard
                "amount": "{{$razorpayOrder->amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Acme Corp",
                "description": "Test Transaction",
                "image": "https://example.com/your_logo",
                "order_id": "{{$razorpayOrder->id}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response){
                    window.location.href= urls+'?payment_id='+response.razorpay_payment_id;
                    // alert(response.razorpay_payment_id);
                    // alert(response.razorpay_order_id);
                    // alert(response.razorpay_signature)
                },
                "prefill": {
                    "name": "Gaurav Kumar",
                    "email": "gaurav.kumar@example.com",
                    "contact": "9000090000"
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                    alert(response.error.code);
                    alert(response.error.description);
                    alert(response.error.source);
                    alert(response.error.step);
                    alert(response.error.reason);
                    alert(response.error.metadata.order_id);
                    alert(response.error.metadata.payment_id);
            });
            document.getElementById('rzp-button1').onclick = function(e){
                rzp1.open();
                e.preventDefault();
            }
</script>
@endsection

