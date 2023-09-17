@extends('dashboard.layouts.main')

@section('title', 'Tambah-Product')

@section('container')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Tambah</h3>
                <p class="text-subtitle text-muted">Multiple form layouts, you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Product</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_product">Nama product</label>
                                                <input type="text" id="nama_product" class="form-control @error('name')
                                                    is-invalid
                                                @enderror"
                                                    name="name" placeholder="Product Name" value="{{ old('name') }}" required>
                                                @error('name')
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_product">Jenis product</label>
                                                <select class="form-select" aria-label="Default select example" id="jenis_product" name="category">
                                                    <option>Open this select menu</option>
                                                    @foreach ($categories as $c)
                                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description Product</label>
                                                <textarea class="form-control @error('description')
                                                    'is-invalid'
                                                @enderror" placeholder="Description product" id="description" name="description">{{ old('description') }}</textarea>
                                                @error('description')
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input oninput="formatCurrency(this)" type="text" id="harga" class="form-control @error('harga')
                                                    is-invalid
                                                @enderror"
                                                    name="harga" placeholder="Harga product" value="{{ old('harga') }}" required>
                                                @error('harga')
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" id="dtock" class="form-control @error('qty')
                                                    is-invalid
                                                @enderror"
                                                    name="qty" placeholder="Stock product" value="{{ old('qty') }}" required>
                                                @error('qty')
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto Product</label>
                                                <input type="file" id="foto" class="form-control @error('foto')
                                                    is-invalid
                                                @enderror"
                                                    name="foto[]" placeholder="Foto Product" required>
                                                @error('foto')
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @enderror
                                                <a href="" class="btn btn-primary me-1 mb-1 mt-3" onclick="tambahFoto(event)" id="tFoto">Tambah foto</a>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href=""
                                                class="btn btn-light-secondary me-1 mb-1">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
</div>

@push('js')
    <script type="text/javascript">
        function tambahFoto(ev){
            ev.preventDefault();
            const foto = document.getElementById('tFoto');
            let html = `<input type="file" id="foto" class="form-control @error('foto')
                                                    is-invalid
                                                @enderror"
                                                    name="foto[]" placeholder="Foto Product" required>`
            foto.insertAdjacentHTML("beforebegin", html);
        }
    </script>
    <script src="{{ asset('js/formatCurrency.js') }}"></script>
@endpush
@endsection