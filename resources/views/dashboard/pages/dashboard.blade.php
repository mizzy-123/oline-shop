@extends('dashboard.layouts.main')

@section('title', 'dashboard')

@section('container')

<div class="page-heading">
    <h3>Profile Statistics</h3>
  </div>
  <div class="page-content">
    <section class="row">
      <div class="col-12 col-lg-9">
        <div class="row">
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon green mb-2">
                      <i class='bx bxs-devices'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Whatsapp</h6>
                    <h6 class="font-extrabold mb-0" style="color: red" id="waStatus">Disconnect</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class='bx bx-message-alt-x'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Message Failed</h6>
                    <h6 class="font-extrabold mb-0">{{ $mesage_failed }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon green mb-2">
                      <i class='bx bx-message-alt-check'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Message Succes</h6>
                    <h6 class="font-extrabold mb-0">{{ $mesage_succes }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon purple mb-2">
                      <i class='bx bxs-receipt' ></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Order</h6>
                    <h6 class="font-extrabold mb-0">{{ $total_order }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class='bx bx-time'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Order Unpaid</h6>
                    <h6 class="font-extrabold mb-0">{{ $order_unpaid }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon green mb-2">
                      <i class='bx bxs-check-square'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Order Paid</h6>
                    <h6 class="font-extrabold mb-0">{{ $order_paid }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body px-4 py-4-5">
                <div class="row">
                  <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                    <div class="stats-icon red mb-2">
                      <i class='bx bxs-x-square'></i>
                    </div>
                  </div>
                  <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                    <h6 class="text-muted font-semibold">Order Cancel</h6>
                    <h6 class="font-extrabold mb-0">{{ $order_cancel}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
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
          @if (session()->has('errorSend'))
          <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div class="px-3">
                {{ session('errorSend') }}
              </div>
          </div>
          @elseif(session()->has('succesSend'))
          <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#check-circle-fill"/></svg>
            <div class="px-3">
              {{ session('succesSend') }}
            </div>
          </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h4>Send wa status</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <a onclick="resendAll(this)" href="{{ route('resend.all') }}" class="btn btn-primary mb-3">Resend all failed status</a>
                  <table class="table table-hover table-lg">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>No Telepon</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($waMessage as $wa)
                      <tr>
                        <td class="col-3">
                          <div class="d-flex align-items-center">
                            <p class="font-bold ms-3 mb-0">{{ $wa->name }}</p>
                          </div>
                        </td>
                        <td class="col-auto">
                          <p class="mb-0">{{ $wa->no_wa }}</p>
                        </td>
                        <td class="col-3">
                          @if ($wa->status == 1)
                          <p style="color: green">Succes</p>
                          @elseif($wa->status == 2)
                          <p style="color: red">Failed</p>
                          @endif
                        </td>
                        <td class="col-3">
                          <a onclick="resend(this)" href="{{ route('resend', ['wamessage' => $wa->id]) }}" class="btn btn-warning" @if ($wa->status == 1)
                            hidden
                          @endif><i class='bx bx-send'></i> Re-send</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-end">
                  {{ $waMessage->links() }}
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
              <div class="avatar avatar-xl">
                <img src="assets/images/faces/1.jpg" alt="Face 1" />
              </div>
              <div class="ms-3 name">
                <h5 class="font-bold">{{ auth()->user()->firstname }}</h5>
                <h6 class="text-muted mb-0">{{ '@'.auth()->user()->name }}</h6>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="card">
          <div class="card-header">
            <h4>Recent Messages</h4>
          </div>
          <div class="card-content pb-4">
            <div class="recent-message d-flex px-4 py-3">
              <div class="avatar avatar-lg">
                <img src="assets/images/faces/4.jpg" />
              </div>
              <div class="name ms-4">
                <h5 class="mb-1">Hank Schrader</h5>
                <h6 class="text-muted mb-0">@johnducky</h6>
              </div>
            </div>
            <div class="recent-message d-flex px-4 py-3">
              <div class="avatar avatar-lg">
                <img src="assets/images/faces/5.jpg" />
              </div>
              <div class="name ms-4">
                <h5 class="mb-1">Dean Winchester</h5>
                <h6 class="text-muted mb-0">@imdean</h6>
              </div>
            </div>
            <div class="recent-message d-flex px-4 py-3">
              <div class="avatar avatar-lg">
                <img src="assets/images/faces/1.jpg" />
              </div>
              <div class="name ms-4">
                <h5 class="mb-1">John Dodol</h5>
                <h6 class="text-muted mb-0">@dodoljohn</h6>
              </div>
            </div>
            <div class="px-4">
              <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">Start Conversation</button>
            </div>
          </div>
        </div> --}}
      </div>
    </section>
</div>
@push('js')
<script>
  function getChange(status) {
    if (status == 1) {
      let statusWa = document.getElementById('waStatus');
      statusWa.innerHTML = "Connected";
      statusWa.style.color = 'green';
    } else {
      let statusWa = document.getElementById('waStatus');
      statusWa.innerHTML = "Disconnect";
      statusWa.style.color = 'red';
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

function resendAll(obj){
  obj.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...`
}

function resend(obj){
  obj.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...`
}

setInterval(getWhatsAppStatus, 2000);
  
</script>
@endpush
@endsection