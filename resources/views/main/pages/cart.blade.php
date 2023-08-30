@extends('main.layouts.main')

@section('title', 'cart')

@section('container')

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="table-main table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Images</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody id="cartT">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col-lg-6 col-sm-6">
          <div class="coupon-box">
            <div class="input-group input-group-sm">
              <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text" />
              <div class="input-group-append">
                <button class="btn btn-theme" type="button">Apply Coupon</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6">
          <div class="update-box">
            <input value="Update Cart" type="submit" />
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="col-lg-8 col-sm-12"></div>
        <div class="col-lg-4 col-sm-12" id="itemStruk">
          
        </div>
        <div class="col-12 d-flex shopping-box"><a href="{{ route('checkout') }}" class="ml-auto btn hvr-hover">Checkout</a></div>
      </div>
    </div>
</div>
<!-- End Cart -->

@push('js')
    <script src="{{ asset('js/cartDetail.js') }}"></script>
@endpush
    
@endsection