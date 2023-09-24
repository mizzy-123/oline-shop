@extends('dashboard.layouts.main')

@section('title', 'edit-account')

@section('container')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Form edit user</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit account</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
      <div class="row match-height">
        <div class="col-12">
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

            @if(session()->has('succes'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="16" height="16"><use xlink:href="#check-circle-fill"/></svg>
                  <div class="px-3">
                    {{ session('succes') }}
                  </div>
                </div>
            @endif
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Multiple Column</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <form action="{{ route('user.update', ['user' => auth()->user()->email]) }}" method="POST" class="form" data-parsley-validate>
                    @csrf
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <div class="form-group mandatory">
                        <label for="first-name-column" class="form-label">First Name</label>
                        <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="firstname" data-parsley-required="true" value="{{ $user->firstname }}" />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="last-name-column" class="form-label">Last Name</label>
                        <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lastname" value="{{ $user->lastname }}" />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="city-column" class="form-label">Username</label>
                        <input type="text" id="city-column" class="form-control" placeholder="Username" name="name" data-parsley-restricted-city="Jakarta" value="{{ $user->name }}" />
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label for="country-floating" class="form-label">No Whatsapp</label>
                        <input type="text" id="country-floating" class="form-control" name="no_wa" placeholder="No Whatsapp" value="<?php 
                        $nomorTelepon = $user['no_wa'];
                        if (substr($nomorTelepon, 0, 2) == '62') {
                            // Jika iya, tambahkan "0" di depannya
                            $nomorTelepon = '0' . substr($nomorTelepon, 2);
                        }
                        echo $nomorTelepon; ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                      <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection