@extends('main.layouts.main')

@section('title', 'Shop detail')

@section('container')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop Detail</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
                    <li class="breadcrumb-item active">Shop Detail </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @php
                            $fotoP = $product->fotoProduct()->get()
                        @endphp
                        <div class="carousel-item active"> <img class="d-block w-100" src="{{ asset('storage/'.$fotoP[0]->foto) }}" alt=""> </div>
                        @foreach ($fotoP->skip(1) as $f)
                        <div class="carousel-item"> <img class="d-block w-100" src="{{ asset('storage/'.$f->foto) }}" alt=""> </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span> 
                </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                    <i class="fa fa-angle-right" aria-hidden="true"></i> 
                    <span class="sr-only">Next</span> 
                </a>
                    <ol class="carousel-indicators">
                        @php
                            $foto = $product->fotoProduct()->get()
                        @endphp
                        <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                            <img class="d-block w-100 img-fluid" src="{{ asset('storage/'.$foto[0]->foto) }}" alt="" />
                        </li>
                        @foreach ($foto->skip(1) as $f)
                        <li data-target="#carousel-example-1" data-slide-to="{{ $loop->iteration }}">
                            <img class="d-block w-100 img-fluid" src="{{ asset('storage/'.$f->foto) }}" alt="" />
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{ $product->name }}</h2>
                    <h5><?php
                        $angka = $product['harga'];
                        $rupiah = number_format($angka, 0, ',', '.');
                        echo 'Rp ' . $rupiah;
                        ?></h5>
                    <p class="available-stock"><span> {{ $product->qty }} available<p>
                    <h4>Short Description:</h4>
                    <p>{{ $product->description }}</p>
                    <ul>
                        <li>
                            <div class="form-group quantity-box">
                                <label class="control-label">Quantity</label>
                                <input id="qtyProductDetail" class="form-control" min="0" max="{{ $product->qty }}" type="number" value="0">
                            </div>
                        </li>
                    </ul>

                    <div class="price-box-bar">
                        <div class="itemProduct cart-and-bay-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->harga }}" data-image="{{ asset('storage/'.$product->fotoProduct()->first()->foto) }}" data-route="{{ route('product.detail', ['product' => $product->slug]) }}">
                            {{-- <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a> --}}
                            <a onclick="tambahKeranjang(this, event)" class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@push('js')
<script src="{{ asset('js/shop-detail.js') }}"></script>
@endpush
@endsection