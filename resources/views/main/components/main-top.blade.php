<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                {{-- <div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                        <option>¥ JPY</option>
                        <option>$ USD</option>
                        <option>€ EUR</option>
                    </select>
                </div> --}}
                <div class="right-phone-box">
                    <p>Call ID :- <a href="https://wa.link/3rhcme"> +62 821 417 65353</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        @auth
                        <li><a href="{{ route('dashboard') }}"><i class="fa fa-user s_color"></i> {{ auth()->user()->name }}</a></li>
                        @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-user s_color"></i> My Account</a></li>
                        @endauth
                        <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                        <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="login-box">
                    <select onchange="redirect(this)" id="basic" class="selectpicker show-tick form-control" data-placeholder="Sign In">
                        <option value="1">Register Here</option>
                        <option value="2">Sign In</option>
                    </select>
                </div>
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function redirect(e){
    let selected = e.value;

    if(selected == '1'){
        window.location.href = "{{ route('register') }}";
    }else if (selected == '2'){
        window.location.href = "{{ route('login') }}"
    }
}
</script>