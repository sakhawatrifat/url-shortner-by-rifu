@extends('auth.user.master')
@section('content')
    <!--begin::Form-->
    <form class="form" method="post" action="{{route('password.forget')}}">
        @csrf

        <div class="fv-row mb-10">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" autofocus required />
            {{-- @error('email')
                <span class="text-danger text-sm text-red text-bold">{{ $message }}</span>
            @enderror --}}
        </div>


        <div class="auth-form-bottom d-flex justify-content-end mt-2 mb-4">
            <a class="d-inline-block" href="{{route('login')}}">Back To Login</a>
        </div>


        <!--begin::Actions-->
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Send Password Reset Link
            </span>
        </button>
        <!--end::Actions-->


    </form>
    <!--end::Form-->
@endsection
