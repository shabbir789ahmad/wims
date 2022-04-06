@extends('auth.master')

@section('content')

<div class="login-box">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1">WIMS</a>
        </div>
        <div class="card-body">

            <p class="login-box-msg">Register to start your session</p>

            <form id="login-form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="">
                        <i class="fa fa-fw fa-envelope"></i>
                        Name
                    </label>
                    <x-forms.input name="name"></x-forms.input>
                </div>
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
                        <i class="fas fa-images"></i>
                        Image
                    </label>
                    <x-forms.input type="file" name="image"></x-forms.input>
                </div>

                <div class="row">
                    

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
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