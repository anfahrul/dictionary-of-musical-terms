@extends('app')

@section('main-content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-6">
              @if (session()->has('loginError'))
              <div class="alert alert-danger" role="alert">
                  {{ session('loginError') }}
              </div>
              @endif
              <div class="card mb-0">
                  <div class="card-body p-0">
                    <div class="row">

                        <div class="col-6 p-0">
                            <a href="/admin/login" class="text-nowrap logo-img text-center d-block p-0 w-100">
                                <img src="/images/logos/musik-pedia-logo-2.png" width="360" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;"
                                alt="">
                            </a>
                        </div>

                        <div class="col-6 align-item-center">
                            <div class="me-4 py-4">
                                <form method="POST" action="/admin/login">
                                    @csrf
                                  <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                  </div>
                                  <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between mb-4">
                                    {{-- <div class="form-check">
                                      <input name="remember" class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked">
                                      <label class="form-check-label text-dark" for="flexCheckChecked">
                                        Ingat perangkat ini
                                      </label>
                                    </div> --}}
                                    {{-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> --}}
                                  </div>
                                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>
                                  <div class="d-flex align-items-center justify-content-left">
                                    <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                                    <a class="text-primary fw-bold ms-2" href="/admin/register">Buat sekarang</a>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
