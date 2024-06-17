@extends('layouts.app')

@section('content')
<div class="d-flex bg-info position-fixed h-100 w-100">
    <div class="w-50 d-flex flex-column justify-content-center align-items-center bg-dark">
        <img width="400px" class="img-fluid" src="{{asset('images/logo.png')}}" alt="">

    </div>
    <div class="w-50 d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card bg-dark text-info">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body border-info border-top">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email
                                        Address')
                                        }}</label>

                                    <div class="col-md-6">
                                        <input id="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{
                                        __('Password')
                                        }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-info">
                                            {{ __('Login') }}
                                        </button>
                                        <a href="{{route('register')}}" class="text-info d-flex mt-2">
                                            {{ __('Or register here') }}
                                        </a>
                                    </div>
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