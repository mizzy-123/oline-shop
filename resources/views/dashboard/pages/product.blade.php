@extends('dashboard.layouts.main')

@section('title', 'Data Product')

@section('container')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
@endpush

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Product</h3>
                <p class="text-subtitle text-muted">ALl product</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Product</li>
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
                @foreach ($errors->all() as $message)
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div class="px-3">
                      {{ $message }}
                    </div>
                </div>
                @endforeach
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive col-lg-12">
                                <a href="{{ route('product.add') }}" class="btn btn-primary mb-3">Tambah Product</a>
                                  <table class="table table-striped table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->category()->first()->name }}</td>
                                            <td>{{ $p->qty }}</td>
                                            <td>Rp {{ $p->harga }}</td>
                                            <td>
                                              <button onclick="editProduct(this)" type="button" class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#editProduct" data-id="{{ $p->id }}" data-nama="{{ $p->name }}" data-description="{{ $p->description }}" data-harga="{{ $p->harga }}" data-category="{{ $p->category()->first()->id }}"><i class='bx bxs-edit'></i> Edit</button>
                                              <button onclick="editStock(this)" type="button" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#editStock" data-id="{{ $p->id }}" data-stock="{{ $p->qty }}"><i class='bx bxs-box' ></i> Edit Stock</button>
                                              <a href="{{ route('product.edit.photo', ['product' => $p->id]) }}" class="badge bg-info"><i class='bx bxs-photo-album' ></i> Edit Photo</a>
                                              <a href="{{ route('product.destroy', ['product' => $p->id]) }}" onclick="deleteProduct(event)" class="badge bg-danger"><i class='bx bxs-trash'></i> Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
</div>

<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formEditProduct" class="form form-vertical" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-12" id="editProductData">
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formEditStock" class="form form-vertical" method="POST">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-12" id="editStockData">
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>

@push('js')
  <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>>
  <script src="{{ asset('js/formatCurrency.js') }}"></script>
  <script type="text/javascript">
  function editProduct(ev){
    const elementProduct = document.getElementById('editProductData');
    const formEdit = document.getElementById('formEditProduct');
    const nama = ev.dataset.nama;
    const description = ev.dataset.description;
    const categoryId = ev.dataset.category;
    const productId = ev.dataset.id;
    const intCategoryId = parseInt(categoryId);
    let harga = ev.dataset.harga;

    formEdit.setAttribute("action", `/update-product/${productId}`);

    var value = harga.replace(/[^\d]/g, "");
    var formatted = new Intl.NumberFormat("id-ID", {
        style: "decimal",
    }).format(value);
    harga = "Rp " + formatted;

    const categories = {!! json_encode($categories) !!};
    
    elementProduct.innerHTML = `
                        <div class="form-group">
                            <label for="nama_product">Nama product</label>
                            <input type="text" id="nama_product" class="form-control"
                                name="name" placeholder="Product Name" value="${nama}" required>
                        </div>
                        <div class="form-group">
                          <label for="jenis_product">Jenis product</label>
                          <select class="form-select" aria-label="Default select example" id="jenis_product" name="category">
                              <option id="dJenisProduct">Open this select menu</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description Product</label>
                            <textarea class="form-control" placeholder="Description product" id="description" name="description">${description}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input oninput="formatCurrency(this)" type="text" id="harga" class="form-control"
                                name="harga" placeholder="Harga product" value="${harga}" required>
                        </div>
    `;

    const defaultJenisProduct = document.getElementById('dJenisProduct');
    categories.forEach(category => {
        // Set opsi yang dipilih jika sesuai dengan data yang diberikan
        if (category.id == categoryId) {
          const html1 = `<option value="${category.id}" selected>${category.name}</option>`;
          defaultJenisProduct.insertAdjacentHTML('afterend', html1);
        } else {
          const html1 = `<option value="${category.id}">${category.name}</option>`;
          defaultJenisProduct.insertAdjacentHTML('afterend', html1);
        }
    });

  }

  function editStock(ev){
    const elementProduct = document.getElementById('editStockData');
    const formEdit = document.getElementById('formEditStock');
    const stock = ev.dataset.stock;
    const productId = ev.dataset.id;

    formEdit.setAttribute("action", `/update-product-stock/${productId}`);
    
    elementProduct.innerHTML = `
                        <div class="form-group">
                            <label for="stock_product">Stock product</label>
                            <input type="number" id="stock_product" class="form-control"
                                name="qty" placeholder="Stock name" value="${stock}" required>
                        </div>
    `;
  }

    function deleteProduct(e){
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        confirmButtonText: 'Yes, delete it!',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        customClass: {
          confirmButton: 'mx-3', // Atur kelas CSS untuk tombol konfirmasi
          cancelButton: 'mx-3' // Atur kelas CSS untuk tombol cancel
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const url = e.target.getAttribute('href');
          window.location.href = url;
        }
      })
    }
  </script>
@endpush

@endsection