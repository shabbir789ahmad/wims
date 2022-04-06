@extends('auth.master')

@section('content')

<div class="login-box">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1">Raqmitech</a>
        </div>
        <div class="card-body">

            <p class="login-box-msg">Reset Password</p>

            <form id="login-form" action="{{ route('password.reset') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{$token}}">
                <div class="form-group">
                    <label for="">
                        <i class="fa fa-fw fa-envelope"></i>
                        Email
                    </label>
                    <x-forms.input name="email"></x-forms.input>
                </div>

                <div class="form-group">
                    <label for="">
                        <i class="fa fa-fw fa-key"></i>
                        Password
                    </label>
                    <x-forms.input type="password" name="password"></x-forms.input>
                </div>
                 <div class="form-group">
                    <label for="">
                        <i class="fa fa-fw fa-key"></i>
                       Conform Password
                    </label>
                    <x-forms.input type="password" name="password_confirmation"></x-forms.input>
                </div>

                <div class="row">
                     

                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </div>

                </div>
            </form>

            {{-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> --}}

        </div>

        <div class="overlay d-none">
            <i class="fas fa-2x fa-spin fa-sync-alt"></i>
        </div>

    </div>

</div>

@endsection

@section('script')

@parent

<script>
    $(document).ready(function() {

        $('#login-form').submit(function() {
            
            $('.overlay').removeClass('d-none');

        });
        
    });
</script>

@endsection