@extends('layout_user')
@section('content')
@include('flash_data')
                               
        <!-- Account page navigation-->
          <br><br><br><br><br><br><br>
            <!-- Orders Section -->
            <div class="row">
                <div class="col-xl">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header"><h5>My Orders</h5></div>
                        <div class="card-body text-center">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Shipping Charge</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($lineitems as $lineitem)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $lineitem->productData->name }}</td>
                                        <td>{{ $lineitem->created_at }}</td>
                                        <td>₹ {{ $lineitem->price }}</td>
                                        <td>₹ {{ $lineitem->orderData->shipping ?? 10 }}</td>
                                        <td>{{ $lineitem->quantity }}</td>
                                        <td>₹ {{ $lineitem->total_price }}</td>
                                        <td>{{ $lineitem->orderData->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
