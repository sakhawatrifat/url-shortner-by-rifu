@extends('auth.user.master')
@section('content')
    <!--begin::Form-->
    <form class="form" method="post" action="{{route('register.confirm')}}" autocomplete="on">
        @csrf

        <div class="mb-10">
            <label class="required fw-semibold fs-6 mb-2">Name</label>
            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{old('name')}}" autofocus required/>
            {{-- @error('name')
                <span class="text-danger text-sm text-red text-bold">{{ $message }}</span>
            @enderror --}}
        </div>

        <div class="mb-10">
            <label class="required fw-semibold fs-6 mb-2">Email</label>
            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="{{old('email')}}" required />
            {{-- @error('email')
                <span class="text-danger text-sm text-red text-bold">{{ $message }}</span>
            @enderror --}}
        </div>

        <div class="mb-6">
            <label class="required fw-semibold fs-6 mb-2">Password</label>
            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        </div>

        <div class="mb-6">
            <label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" required/>
        </div>

        <div class="auth-form-bottom d-flex justify-content-end mt-2 mb-4">
            <a class="d-inline-block ml-4" href="{{route('login')}}">Login</a>
        </div>


        <!--begin::Actions-->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
            <span class="indicator-label">
                Register
            </span>
        </button>
        </div>
        <!--end::Actions-->


    </form>
    <!--end::Form-->
@endsection
