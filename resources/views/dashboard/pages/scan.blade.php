@extends('dashboard.layouts.main')

@section('title', 'scan')

@section('container')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Scan</h3>
                <p class="text-subtitle text-muted">Scan QRCODE WhatsApp</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Scan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Scan QRCODE</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p>Untuk mengirim pesan,</p>
                        <p>Anda harus Scan QRCODE untuk menghubungkan server ke WhatsApp</p>
                        <br>
                        <ol>
                            <li>Buka aplikasi <strong>WhatsApp</strong> di ponsel Anda</li>
                            <li>Ketuk <strong>Menu</strong> atau <strong>Setelan</strong> dan pilih Perangkat tertaut</li>
                            <li>Scan QRCODE dan tunggu hingga terhubung</li>
                            <li>Tetap hidupkan ponsel Anda dan sambungkan ke internet</li>
                            <li>Jika kode QR tidak muncul silahkan Refresh</li>
                        </ol>
                    </div>
                    <div class="col-md-4" id="qrcode">
                        <img class="mb-4" src="{{ $status ? $qr : asset('images/ceklist.png') }}" alt="qrcode" id="qrgenerate" width="276px" height="276px">
                        <div class="d-flex justify-content-around">
                            <a class="btn btn-primary" href="{{ route('scan') }}">
                                Refresh
                            </a>
                            <a class="btn btn-danger" href="">
                                Disconnect
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('js')
{{-- <script type="text/javascript">
    // console.log('{{ $qr }}');
    let qr = '{{ $qr }}';
    let image = new Image();
    image.src = qr;
    document.getElementById('qrcode').appendChild(image);
</script> --}}
{{-- <script src="{{ asset('js/qrcode.js') }}"></script> --}}
<script>
function getChange(status) {
    if (status == 1) {
        var qrImageURL = "{{ asset('images/ceklist.png') }}";
        $("#qrgenerate").attr("src", qrImageURL);
    }
}

function getWhatsAppStatus() {
    $.ajax({
        url: "/statuswa",
        type: "GET",
        success: function (response) {
            // Update tampilan dengan status WhatsApp terbaru
            getChange(response.status);
        },
    });
}

setInterval(getWhatsAppStatus, 5000); // Polling setiap 5 detik

</script>
@endpush
    
@endsection