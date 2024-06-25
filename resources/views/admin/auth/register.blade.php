@extends('app')

@section('main-content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="POST" action="/admin/register">
                    @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" id="name" aria-describedby="textHelp">

                    @error('name')
                    <div id="nameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid  @enderror" id="email" aria-describedby="emailHelp">

                    @error('email')
                    <div id="emailFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                  <div class="mb-4">
                    <label for="password" class="form-label @error('password') is-invalid  @enderror">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @error('password')
                    <div id="passwordFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="/admin/login">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
