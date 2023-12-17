@extends('auth.user.master')
@section('content')
    <!--begin::Form-->
    <form class="form" method="post" action="{{route('login.confirm')}}" autocomplete="on">
        @csrf

        <div class="mb-10">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" autofocus required/>
            {{-- @error('email')
                <span class="text-danger text-sm text-red text-bold">{{ $message }}</span>
            @enderror --}}
        </div>

        <div class="mb-6">
            <label class="required fw-semibold fs-6 mb-2">Password</label>
            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        </div>

        <div class="auth-form-bottom d-flex justify-content-between mt-2 mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <a class="d-inline-block ml-4" href="{{route('password.forget.form')}}">Forgot Your Password?</a>
        </div>


        <!--begin::Actions-->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">
                    Login
                </span>
            </button>
        </div>
        <!--end::Actions-->

        <div class="auth-form-bottom d-flex justify-content-center mt-4">
            <a class="d-inline-block" href="{{route('register')}}">Create New Account?</a>
        </div>

    </form>
    <!--end::Form-->
@endsection
