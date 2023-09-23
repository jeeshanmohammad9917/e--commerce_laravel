@extends('admin.layout_admin')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All Orders
                </div>
                <div class="card-body">
                    @include('flash_data')
                    <table id="datatablesSimple" >
                        <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>User Name</th>
                            <th>Sub Total</th>
                            <th>Tax Rate</th>
                            <th>Tax Amount</th>
                            <th>Shipping</th>
                            <th>Total Amount</th>
                            <th>Comment</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                        </thead>
                     
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>store- {{ $order->id }}</td>
                                <td>{{ $order->customerData->full_name }}</td>
                                <td>{{ $order->sub_total }}</td>
                                <td>{{ $order->tax_rate }}</td>
                                <td>{{ $order->tax_amount }}</td>
                                <td>{{ $order->shipping }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->comment }}</td>
                                {{-- <td>{{ $order->status }}</td> --}}
                                <td style="max-width: 30px">
                                    <form method="post" action="{{ route('admin_change_order_status', ['id' => $order->id]) }}">
                                        @csrf
                                        <select class="form-select" id="status"
                                                aria-label="Default select example"
                                                required="" name="status">
                                            <option selected disabled>Select</option>
                                            @foreach(\Illuminate\Support\Facades\Config::get('order_status') as $status)
                                                <option value="{{ $status }}" @if($status == $order->status) {{ 'selected' }} @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <div style="display: flex"><input type="submit" 
                                        style="color: #000;
                                            background-color: #ffc107;
                                            border-color: #ffc107;
                                            font-size:0.875rem;
                                            " class="" value="Update">
                                        </form>
                                        <a href="{{ route('get_line_items', ['id' => $order->id]) }}"
                                           class="btn btn-sm btn-warning">View</a></div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
