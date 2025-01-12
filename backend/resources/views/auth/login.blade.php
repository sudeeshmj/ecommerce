@extends('layouts.app')
@section('content')
    <!-- Login 13 - Bootstrap Brain Component -->

    <section class="bg-light "
        style="height:100vh;  background:linear-gradient( rgba(0,0,0,0.5), rgba(0, 0, 0, 0.5) ), url('images/bg.jpg');background-position: center;background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center min-vh-100">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border login-form">
                        <div class="card-body  p-3 p-md-4 p-xl-5 ">
                            <div class="text-center mb-3">
                                <a class="logo-text text-decoration-none">
                                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="login-logo">
                                    BOOKSTORE
                                </a>
                            </div>
                            <h6 class="text-center text-secondary mb-4 text-white">Sign in to your account</h6>
                            <form action="{{ route('do.login') }}" method="post">
                                @csrf
                                <div class="row  overflow-hidden">
                                    <div class="col-12 mb-4">

                                        <input type="email" required
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            id="email" placeholder="name@example.com">


                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        @if (session()->has('message'))
                                            <span>
                                                <strong
                                                    style="color: rgb(158, 31, 31)">{{ session()->get('message') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="col-12 mb-4">

                                        <input type="password"required
                                            class="form-control  @error('password') is-invalid @enderror" name="password"
                                            id="password" value="" placeholder="Password">


                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex gap-2 justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="rememberMe" id="rememberMe">
                                                <label class="form-check-label text-secondary text-white" for="rememberMe">
                                                    Keep me logged in
                                                </label>
                                            </div>
                                            <a href="#!" class="link-primary text-decoration-none text-white">Forgot
                                                password?</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-sm add_new_btn" type="submit">Log
                                                in</button>
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
@endsection
