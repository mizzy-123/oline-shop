@extends('main.layouts.main')

@section('title', 'Home')
    
@section('container')
    <!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <li class="text-center">
            <img src="{{ asset('images/banner-01.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="{{ route('shop.index') }}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="{{ asset('images/banner-02.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="{{ route('shop.index') }}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="{{ asset('images/banner-03.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="{{ route('shop.index') }}">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ asset('images/categories_img_01.jpg') }}" alt="" />
                    <a class="btn hvr-hover" href="#">Lorem ipsum dolor</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ asset('images/categories_img_02.jpg') }}" alt="" />
                    <a class="btn hvr-hover" href="#">Lorem ipsum dolor</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{ asset('images/categories_img_03.jpg') }}" alt="" />
                    <a class="btn hvr-hover" href="#">Lorem ipsum dolor</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Categories -->

<div class="box-add-products">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="offer-box-products">
                    <img class="img-fluid" src="{{ asset('images/add-img-01.jpg') }}" alt="" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="offer-box-products">
                    <img class="img-fluid" src="{{ asset('images/add-img-02.jpg') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Products  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Fruits & Vegetables</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        {{-- <button class="active" data-filter="*">All</button> --}}
                        {{-- <button data-filter=".top-featured">Top featured</button>
                        <button data-filter=".best-seller">Best seller</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach ($product as $p)
            <div class="col-lg-3 col-md-6 special-grid">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        {{-- <div class="type-lb">
                            <p class="sale">Sale</p>
                        </div> --}}
                        @php
                            $foto = $p->fotoProduct()->first()->foto;
                        @endphp
                        <img src="{{ asset('storage/'.$foto) }}" class="img-fluid" alt="Image">
                        <div class="mask-icon itemProduct" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->harga }}" data-image="{{ asset('storage/'.$foto) }}" data-route="{{ route('product.detail', ['product' => $p->slug]) }}">
                            <ul>
                                <li><a href="{{ route('product.detail', ['product' => $p->slug]) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                            </ul>
                            <a class="cart" href="#" id="addcart">Add to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <a href="{{ route('product.detail', ['product' => $p->slug]) }}"><h4>{{ $p->name }}</h4></a>
                        <h6><strong>Quantity {{ $p->qty }}</strong></h6>
                        <h5><?php
                            $angka = $p['harga'];
                            $rupiah = number_format($angka, 0, ',', '.');
                            echo 'Rp ' . $rupiah;
                            ?></h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Products  -->

@push('js')
    {{-- <script src="{{ asset('js/cart.js') }}"></script> --}}
    {{-- <script>
        const addToCartButton = document.querySelectorAll("#addcart");
addToCartButton.forEach((button) => {
    button.addEventListener("click", function (e) {
        // e.preventDefault();
        const productDiv = this.closest(".mask-icon");
        const productId = productDiv.dataset.id;
        const productName = productDiv.dataset.name;
        const productPrice = parseFloat(productDiv.dataset.price);
        addToCard(productId, productName, productPrice);
    });
});

function addToCard(productId, productName, productPrice) {
    const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    let existingItem = cart.find((item) => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1,
        });
    }

    sessionStorage.setItem("cart", JSON.stringify(cart));
    updateCartDisplay();
}

function updateCartDisplay() {
    const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    const cartDiv = document.querySelector(".cart-list li");
    if (cart.length === 0) {
        cartDiv.innerHTML = "<p>Your Cart is Empty</p>";
    } else {
        const cartItems = cart
            .map(
                (item) =>
                    `<a href="#" class="photo"><img src="{{ asset('images/img-pro-01.jpg') }}" class="cart-thumb" alt="" /></a>
                    <h6><a href="#">${item.name} </a></h6>
                    <p>${item.quantity}x - <span class="price">Rp.${item.price}</span></p>`
            )
            .join("");
        cartDiv.insertAdjacentHTML("beforeend", cartItems);
    }
}

updateCartDisplay();

    </script> --}}
@endpush

@endsection
