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
        @if (session()->has('failed'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div class="px-3">
              {{ session('failed') }}
            </div>
        </div>
        @elseif(session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#check-circle-fill"/></svg>
          <div class="px-3">
            {{ session('success') }}
          </div>
        </div>
        @endif
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
                            <a class="btn btn-danger" href="{{ route('disconnect') }}">
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