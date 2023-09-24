@extends('dashboard.layouts.main')

@section('title', 'order-detail')

@section('container')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Order detail</h3>
                <p class="text-subtitle text-muted">Multiple form layouts, you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="w-100 d-flex flex-column justify-content-start ps-4">
                                    <a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="Logo" srcset="" style="height: 5rem"/></a>
                                    <p class="fs-4 mt-3">
                                        STATUS : @if ($order->status == 1)
                                        <span class="text-success">PAID</span>
                                        @elseif($order->status == 0)
                                        <span class="text-danger">UNPAID</span>
                                        @elseif($order->status == 2)
                                        <span class="text-danger">CANCEL</span>
                                        @endif
                                    </p>

                                    <p>Dibuat tanggal : {{ $dibuat }}</p>
                                    @if ($order->status == 0)
                                    <p>Kadaluarsa tanggal : {{ $kadaluarsa }}</p>
                                    <p>{{ $peringatan }} </p>
                                    @endif
                                </div>
                            </div>

                            <hr class="mx-auto my-3">

                            <div class="row justify-content-center mx-auto">
                                <div class="w-50 d-flex flex-column py-4">
                                    {{-- <div class="mx-auto"> --}}
                                        <h4>Invoice</h4>
                                        <p>{{ $order->user()->first()->firstname }} {{ $order->user()->first()->lastname }}</p>
                                        <p>{{ $order->negara }}</p>
                                        <p>{{ $order->kota }}</p>
                                        <p>{{ $order->alamat }}</p>
                                        <p>{{ $order->zip }}</p>
                                    {{-- </div> --}}
                                </div>
                                <div class="w-50 d-flex flex-column py-4">
                                    {{-- <div class="mx-auto"> --}}
                                        <h4>Pembayaran</h4>
                                        <p>Muhammad Mizzy
                                            <br>
                                            Dana
                                            <br>
                                            082141765353</p>
                                        <p>MUHAMMAD MIZZY
                                            <br>
                                            Bank Mandiri
                                            <br>
                                            1350017150572</p>
                                    {{-- </div> --}}
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="mx-auto">
                                    <ul class="list-group">
                                        <li class="list-group-item py-3"><strong>Invoice Items</strong></li>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <strong>Your order</strong>
                                                <strong class="px-3">Amount</strong>
                                            </div>
                                        </li>
                                        <?php $dataHarga = 0 ?>
                                        @foreach ($order->orderDetail()->get() as $detail)
                                            <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    {{ $detail->product()->first()->name }} x {{ $detail->quantity }}
                                                </div>
                                                <div>
                                                    <?php
                                                    $angka = $detail->product()->first()->harga;
                                                    $rupiah = number_format($angka, 0, ',', '.');
                                                    echo 'Rp ' . $rupiah;
                                                    ?>
                                                </div>
                                            </div>
                                            <?php $dataHarga = $dataHarga + ($detail->product()->first()->harga * $detail['quantity']) ?>
                                            </li>
                                        @endforeach
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-end">
                                                <div class="w-25 d-flex justify-content-between">
                                                    <strong>{{ $order->shipper()->first()->name }}</strong>
                                                    <div><?php
                                                        $angka = $order['harga_ongkir'];
                                                        $rupiah = number_format($angka, 0, ',', '.');
                                                        echo 'Rp ' . $rupiah;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-end">
                                                <div class="w-25 d-flex justify-content-between">
                                                    <strong>Total</strong>
                                                    <div><?php
                                                        $angka = $dataHarga + $order['harga_ongkir'];
                                                        $rupiah = number_format($angka, 0, ',', '.');
                                                        echo 'Rp ' . $rupiah;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mx-auto">
                                    <span class="text-danger">*</span> Silahkan kirim bukti pembayaran ke no Whatsapp 082141765353
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection