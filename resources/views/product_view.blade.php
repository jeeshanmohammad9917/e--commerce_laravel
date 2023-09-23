@extends('layout_user')
@section('content')

<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ url('products') . '/' . $product->image }}" alt="..." /></div>
            <div class="col-md-6">
                <span class="small mb-1">{{$product->product_code}}</span>
                <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                <div class="fs-5 mb-5">
                    @if (!empty($product->sale_price))

                    <span class="text-muted text-decoration-line-through">  
                        {{'₹'.$product->price}}</span>
                        <span class="text-muted text-decoration-line-through">  
                            {{'₹'.$product->id}}</span>
                        {{'₹'.$product->sale_price}}
                    @else
                    {{'₹'.$product->price}}
                    @endif
                </div>
                <p class="lead">{{$product->description}}</p>
                <div class="d-flex">
                    <form method="post" action="{{ route('add_to_cart') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input class="form-control text-center me-3" id="inputQuantity" name="quantity" type="num" min="1" value="1"
                               style="max-width: 3rem"/>
                        <br>
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit" >
                        <i class="bi-cart-fill me-1"></i>
                        Add to Cart
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($relatedproduct as $relatedproduct)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    @if (!empty($relatedproduct->sale_price) && $relatedproduct->stock != 0)
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    @elseif($relatedproduct->stock == 0)                           
                     <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Out of stock</div>

                    @endif
                    <!-- Product image-->
                    <img class="card-img-top" style="height: 200px" src="{{ url('products') . '/' . $relatedproduct->image }}" alt="{{ $relatedproduct->name ?? 'product' }} Image" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$relatedproduct->name}}</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            @if (!empty($relatedproduct->sale_price))

                            <span class="text-muted text-decoration-line-through">  
                                {{'Rs'.$relatedproduct->price}}</span>
                                {{$relatedproduct->sale_price}}
                            @else
                            {{'Rs'.$relatedproduct->price}}
                            @endif
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product_info',['product'=> $relatedproduct->product_code])}}">View Product</a></div> <br>
                    </div>
                </div>
            </div>
           @endforeach    
        </div>
        
    </div>
</section>
@endsection