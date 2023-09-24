@extends('main.layouts.main')

@section('title', 'Checkout')

@section('container')
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" viewBox="0 0 16 16">
                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            @foreach ($errors->all() as $message)
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div class="px-3">
                  {{ $message }}
                </div>
            </div>
            @endforeach
            {{-- <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <form action="{{ route('checkout.store') }}" method="POST" class="needs-validation">
                            @csrf

                            @auth
                            @else
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control @error('firstname')
                                        is-invalid
                                    @enderror" id="firstName" placeholder="" value="{{ old('firstname') }}" required name="firstname">
                                    @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control @error('lastname')
                                        is-invalid
                                    @enderror" id="lastName" placeholder="" value="{{ old('lastname') }}" required name="lastname">
                                    @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('username')
                                        is-invalid
                                    @enderror" id="username" placeholder="" required name="username" value="{{ old('username') }}">
                                    @error('username')
                                    <div class="invalid-feedback" style="width: 100%;">{{ $message }}</div>
                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control @error('email')
                                    is-invalid
                                @enderror" id="email" placeholder="" name="email" value="{{ old('email') }}">
                                @error('email')
                                    
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control @error('password')
                                    is-invalid
                                @enderror" id="password" placeholder="" name="password" value="{{ old('password') }}">
                                @error('password')
                                    
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation">Confirm Password *</label>
                                <input type="password" class="form-control @error('password_confirmation')
                                    is-invalid
                                @enderror" id="password_confirmation" placeholder="" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="wanumber">Whatsapp Number *</label>
                                <input type="text" class="form-control @error('wanumber')
                                    is-invalid
                                @enderror" id="wanumber" placeholder="" name="wanumber" value="{{ old('wanumber') }}">
                                @error('wanumber')
                                    
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @endauth
                            <div class="mb-3">
                                <label for="address">Alamat *</label>
                                <input type="text" class="form-control @error('alamat')
                                    is-invalid
                                @enderror" id="address" placeholder="" required name="alamat" value="{{ old('alamat') }}">
                                @error('alamat')
                                    
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Negara *</label>
                                    <select class="wide w-100 @error('negara')
                                        is-invalid
                                    @enderror" id="country" name="negara">
									    <option data-display="Select" value="">Choose...</option>
									    <option value="United States">Indonesia</option>
								    </select>
                                    @error('negara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                        
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">Kota *</label>
                                    <select class="wide w-100 @error('kota')
                                        is-invalid
                                    @enderror" id="state" name="kota">
									    <option data-display="Select" value="">Choose...</option>
									    <option>California</option>
								    </select>
                                    @error('kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip/Kode pos *</label>
                                    <input type="text" class="form-control @error('zip')
                                        is-invalid
                                    @enderror" id="zip" placeholder="" required name="zip" value="{{ old('zip') }}">
                                    @error('zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="mb-1">
                            <div id="dataOrder">

                            </div>
                            <button type="submit" id="subU" hidden></button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    @foreach ($ongkir as $o)
                                    <?php $angka = $loop->iteration; ?>
                                    <div class="custom-control custom-radio">
                                        <input id="ongkirId" type="hidden" name="idOngkir" value="{{ $o->id }}">
                                        <input id="shippingOption{{ $angka }}" name="shipping-option" class="custom-control-input" @if ($o->harga == 0)
                                        checked="checked"
                                        @endif type="radio" value="{{ $o->harga }}">
                                        <label class="custom-control-label" for="shippingOption{{ $angka }}">{{ $o->name }}</label> <span class="float-right font-weight-bold"><?php
                                            $angka = $o['harga'];
                                            $rupiah = number_format($angka, 0, ',', '.');
                                            echo 'Rp ' . $rupiah;
                                            ?></span> </div>
                                    <div class="ml-4 mb-2 small">@if ($o->description != null)
                                        ({{ $o->description }})
                                    @endif</div>
                                    @endforeach
                                    {{-- <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio" value="0">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio" value="10000">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">Rp10.000</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio" value="20000">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">Rp20.000</span> </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light" id="cartCheckout">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12" id="strukCheckout">
                            
                        </div>
                        <div class="col-12 d-flex shopping-box">
                            <a href="#" class="ml-auto btn hvr-hover" id="placeOrder">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
    @push('js')
        <script src="{{ asset('js/checkout.js') }}"></script>
    @endpush
@endsection