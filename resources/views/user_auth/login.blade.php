@extends('auth.master')

@section('content')

<div class="login-box">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1">WIMS</a>
        </div>
        <div class="card-body">

            <p class="login-box-msg">Sign in to start your session</p>

            <form id="login-form" action="{{ route('authenticate.user') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <label for="">
                        <i class="fa fa-fw fa-envelope"></i>
                        Emailfgdfg
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

                <div class="row">
                 {{--    <div class="col-8">
                       <div class="icheck-primary">
                           
                             <input type="checkbox" id="remember">
                            <p for="remember">
                                Forgot Password
                            </p>
                         
                            
                        </div> 
                    </div> --}}

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <div class="col-8">
                        <p class="mb-3 ml-4">
                            <a href="{{ route('forgot.password') }}">I forgot my password</a>
                        </p> 
                    </div>

                </div>
            </form>

             

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