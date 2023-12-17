@extends('auth.user.master')
@section('content')
    <!--begin::Form-->
    <form class="form" method="post" action="{{route('password.reset')}}" autocomplete="on">
        @csrf
        <input type="hidden" name="token" value="{{ Request::route('token')}}">

        <div class="fv-row mb-10">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" autofocus required/>
        </div>

        <div class="fv-row mb-6">
            <label class="required fw-semibold fs-6 mb-2">Password</label>
            <input id="mPassword" type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" required/>
        </div>

        <div class="fv-row mb-6">
            <label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
            <input id="cPassword" type="password" name="password_confirmation" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" required/>
            <div id="cPasswordInvalid" class="fv-plugins-message-container invalid-feedback">
                <div data-field="email" data-validator="notEmpty"></div>
            </div>
        </div>
        <div class="auth-form-bottom d-flex justify-content-end mt-2 mb-4">
            <div></div>
            <a class="d-inline-block" href="{{route('password.forget.form')}}">Back To Resend Link</a>
        </div>

        <!--begin::Actions-->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Confirm
            </span>
        </button>
        </div>
        <!--end::Actions-->


    </form>
    <!--end::Form-->
@endsection
