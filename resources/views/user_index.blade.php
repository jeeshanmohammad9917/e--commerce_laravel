@extends('layout_user')
@section('content')

<header>

                <div class="img">
                    <div class="slider">
                        <img src="{{asset('admin_assets').'/images/img1.jpg'}}" class="slide">
                        <img src="{{asset('admin_assets').'/images/img2.jpg'}}" class="slide">
                        <img src="{{asset('admin_assets').'/images/img3.jpg'}}" class="slide">
                       
                    </div>
                </div>
        </header>
        <!-- Section-->
        
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   @foreach($products as $product)
                   @if ($product->is_active != 0)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if (!empty($product->sale_price) && $product->stock != 0 )
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            @elseif($product->stock == 0)                           
                             <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Out of stock</div>

                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" style="height: 200px" src="{{ url('products') . '/' . $product->image }}" alt="{{ $product->name ?? 'product' }} Image" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product->name}}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    @if (!empty($product->sale_price))

                                    <span class="text-muted text-decoration-line-through">  
                                        {{'Rs'.$product->price}}</span>
                                        {{$product->sale_price}}
                                    @else
                                    {{'Rs'.$product->price}}
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product_info',['product'=> $product->product_code])}}">View Product</a></div> <br>
                                <div class="text-center"><form method="post" action="{{ route('add_to_cart') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input class="form-control text-center me-3" id="inputQuantity" name="quantity" type="hidden" min="1" value="1"
                                           style="max-width: 3rem"/>
                                    <br>
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit" >
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to Cart
                                </button>
                                </form></div>
                            </div>
                        </div>
                    </div>
                    @endif
                   @endforeach    
                       
                </div>
                <div class="d-grid gap-2 col-6 mx-auto"> <br>
                    <a href="{{ route('product_list') }}" class="btn btn-outline-dark">View All</a>
                </div>    
            </div>
        </section>
        @endsection