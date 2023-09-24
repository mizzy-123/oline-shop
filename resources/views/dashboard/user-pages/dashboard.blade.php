@extends('dashboard.layouts.main')

@section('title', 'dashboard')

@section('container')

<div class="page-heading">
    <h3>Dashboard</h3>
  </div>
  <div class="page-content">
    <section class="row">
      <div class="col-12 col-lg-9">
        <div class="row">
          <div class="col-12 col-xl-12">
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
                <h4>Your order</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Pesanan</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($order as $o)
                        <tr>
                          <td class="col-3">
                            {{ $loop->iteration }}
                          </td>
                          <td class="col-auto">
                            PAF{{ $o->id }}
                          </td>
                          <td class="col-3">
                            @if ($o->status == 0)
                              <strong class="text-danger">UNPAID</strong>
                            @elseif($o->status == 1)
                              <strong class="text-success">PAID</strong>
                            @elseif($o->status == 2)
                            <strong class="text-danger">CANCEL</strong>
                            @endif
                          </td>
                          <td class="col-3">
                            <a href="{{ route('order.detail.user', ['order' => $o->id]) }}" class="badge bg-success"><i class="fa-regular fa-eye"></i> Detail</a>
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
      <div class="col-12 col-lg-3">
        <div class="card">
          <div class="card-body py-4 px-4">
            <div class="d-flex align-items-center">
              {{-- <div class="avatar avatar-xl">
                <img src="assets/images/faces/1.jpg" alt="Face 1" />
              </div> --}}
              <div class="ms-3 name">
                <h5 class="font-bold">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h5>
                <h6 class="text-muted mb-0">{{ '@'.auth()->user()->name }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@push('js')
@if (session()->has('success'))
<script>
  sessionStorage.removeItem("cart");
</script>
@endif
@endpush
@endsection