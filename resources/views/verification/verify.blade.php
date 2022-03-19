@extends('layouts.app2')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('We have sent a verification link to your email. Please click the link to activate your account. If you cannot find the email, please check your spam folder. If you have not received any email from us, please') }}
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here') }}</button>
                    </form>

                    {{ __(' to request a new verification link. Thank you very much!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
