@extends('dashboard.layouts.main')

@section('title', 'Gallery-product')

@section('container')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Gallery photo product</h3>
                <p class="text-subtitle text-muted">Multiple form layouts, you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallert product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
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
                @if (session()->has('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div class="px-3">
                      {{ session('error') }}
                    </div>
                </div>
                @elseif(session()->has('succes'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#check-circle-fill"/></svg>
                  <div class="px-3">
                    {{ session('succes') }}
                  </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary mb-3">Tambah Foto</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @php
                                $chunkedFoto = array_chunk($foto_product->toArray(), 4);
                            @endphp

                            @foreach ($chunkedFoto as $chunk)
                            <div class="row mt-2 mt-md-4 gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <a onclick="modalClick(this)" href="#" data-id="{{ $chunk[0]['id'] }}">
                                        <img class="w-100 active" src="{{ asset('storage/'.$chunk[0]['foto']) }}" data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $chunk[0]['id'] }}" id="galleryImg">
                                    </a>
                                </div>
                                @foreach ($chunk as $index => $foto)
                                    @php
                                        if ($index === 0) {
                                            continue;
                                        }
                                    @endphp
                                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                        <a onclick="modalClick(this)" href="#" data-id="{{ $foto['id'] }}">
                                            <img class="w-100" src="{{ asset('storage/'.$foto['foto']) }}" data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $foto['id'] }}" id="galleryImg">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog"
aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
role="document">
        <div class="modal-content">
            <form class="form form-vertical" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="formModal">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle">Our Gallery Example</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div id="Gallerycarousel" class="carousel slide carousel-fade">
                        {{-- <div class="carousel-indicators">
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $foto_product[0]->id }}" class="active" aria-current="true" aria-label="Slide {{ $foto_product[0]->id }}"></button>
                            @foreach ($foto_product->skip(1) as $f)
                            <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $f->id }}" class="active" aria-current="true" aria-label="Slide {{ $f->id }}"></button>
                            @endforeach
                        </div> --}}
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('storage/'.$foto_product[0]->foto) }}" id="modalImg" data-id="{{ $foto_product[0]->id }}">
                            </div>
                            @foreach ($foto_product as $f)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('storage/'.$f->foto) }}" id="modalImg" data-id="{{ $f->id }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label for="file_foto">Foto product</label>
                                <input type="file" id="file_foto" class="form-control"
                                    name="foto" placeholder="Foto product" value="{{ old('foto') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save and changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    
<script type="text/javascript">
    function modalClick(ev){
        const formModal = document.getElementById('formModal');
        const fotoId = ev.dataset.id;

        formModal.setAttribute("action", `/update-photo/${fotoId}`);

        previewImage(fotoId);
    }

    function previewImage(id){
        const fileFoto = document.getElementById('file_foto');
        const imgModal = document.querySelectorAll('#modalImg');
        const oFReader = new FileReader();
        fileFoto.addEventListener("change", (e) => {
            oFReader.readAsDataURL(fileFoto.files[0]);
            
            oFReader.onload = (oFREvent) => {
                imgModal.forEach((e) => {
                    if(e.dataset.id == id){
                        e.setAttribute("src", oFREvent.target.result)
                        // console.log(oFREvent.target.result);
                    }
                    // console.log("dataset "+e.dataset.id+"id"+id);
                });
            }

        });
    }
</script>

@endpush
@endsection