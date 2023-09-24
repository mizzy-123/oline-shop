@extends('main.layouts.main')

@section('title', 'Shop')

@section('container')

@push('css')
<style>
.pagination .page-item .page-link {
background-color: #F5F5F5 !important;
color: #1F1F1F !important;
}

/* Warna latar belakang pagination saat aktif/hover */
.pagination .page-item.active .page-link,
.pagination .page-item .page-link:hover {
   background-color: #B0B435 !important;
   color: #F5F5F5 !important;
   border-color: #1F1F1F !important;
}
</style>
@endpush

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <span>Sort by </span>
                                <select onchange="filterHarga(this)" id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                    <option data-display="Select" value="0">Nothing</option>
                                    <option @if (request('orderPrice') == 'desc')
                                        selected
                                    @endif value="1">High Price → Low Price</option>
                                    <option @if (request('orderPrice') == 'asc')
                                        selected
                                    @endif value="2">Low Price → High Price</option>
                            </select>
                            </div>
                            <p>Showing all {{ $product->count() }} results</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">
                                    @foreach ($product as $p)
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
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
                                                    <a class="cart" href="" id="addcart">Add to Cart</a>
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
                            <div role="tabpanel" class="tab-pane fade" id="list-view">
                                @foreach ($product as $p)
                                @php
                                     $foto = $p->fotoProduct()->first()->foto;
                                @endphp
                                <div class="list-view-box">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    {{-- <div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div> --}}
                                                    <img src="{{ asset('storage/'.$foto) }}" class="img-fluid" alt="Image">
                                                    <div class="mask-icon" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->harga }}" data-image="{{ asset('storage/'.$foto) }}" data-route="{{ route('product.detail', ['product' => $p->slug]) }}">
                                                        <ul>
                                                            <li><a href="{{ route('product.detail', ['product' => $p->slug]) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                            <div class="why-text full-width itemProduct" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->harga }}" data-image="{{ asset('storage/'.$foto) }}" data-route="{{ route('product.detail', ['product' => $p->slug]) }}">
                                                {{-- <a href="{{ route('product.detail', ['product' => $p->slug]) }}"><h4>{{ $p->name }}</h4></a> --}}
                                                <h4>{{ $p->name }}</h4>
                                                <h5><?php
                                                    $angka = $p['harga'];
                                                    $rupiah = number_format($angka, 0, ',', '.');
                                                    echo 'Rp ' . $rupiah;
                                                    ?></h5>
                                                <p>{{ $p->description }}</p>
                                                <a class="btn hvr-hover" href="#" id="addcart">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-start">
                                {{ $product->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="search-product">
                        <form action="{{ route('shop.index') }}">
                            <input class="form-control" placeholder="Search here..." type="text" name="search" value="{{ request('search') }}">
                            <button type="submit"> <i class="fa fa-search"></i> </button>
                        </form>
                    </div>
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Categories</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            @foreach ($category as $c)
                            <a href="{{ route('shop.index', ['category' => $c->id]) }}" class="list-group-item list-group-item-action"> {{ $c->name }}  <small class="text-muted">({{ $c->product()->get()->count() }}) </small></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-price-left">
                        <div class="title-left">
                            <h3>Price</h3>
                        </div>
                        <form action="{{ route('shop.index') }}">

                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;" name="price">
                                    <button class="btn hvr-hover" type="submit">Filter</button>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->
@push('js')
<script>
function filterHarga(obj){
    let selected = obj.value;

    if(selected == '1'){
        window.location.href = "{{ route('shop.index', ['orderPrice' => 'desc']) }}";
    }else if (selected == '2'){
        window.location.href = "{{ route('shop.index', ['orderPrice' => 'asc']) }}";
    }else if(selected == '0'){
        window.location.href = "{{ route('shop.index') }}";
    }
}
</script>
@endpush
@endsection