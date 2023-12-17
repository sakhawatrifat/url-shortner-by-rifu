@extends('auth.user.master')
@section('content')
    <!--begin::Form-->
    <form class="form" method="post" action="{{route('verification.resend')}}">
        @csrf
        <!--begin::Actions-->
        <span>Did not get any mail?</span>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Send Mail Again
            </span>
        </button>
        <!--end::Actions-->

        {{-- <div class="auth-form-bottom d-flex justify-content-end mt-2">
            <a class="d-inline-block" href="{{route('login')}}">Back To Login</a>
        </div> --}}


    </form>
    <!--end::Form-->
@endsection
