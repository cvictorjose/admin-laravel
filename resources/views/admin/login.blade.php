@extends('admin.loginapp')

@section('content')
    <div class="login-box">
        <div class="login-logo"><b>Admin</b>SafeBag </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in</p>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}<br>
            </div>
            @endif
            <form  method="post" action="{{ URL::to('admin/login') }}">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group has-feedback">
                    <input type="email" name="login_email" id="login_email" class="form-control" placeholder="Email"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="login_pwd" id="login_pwd" class="form-control" placeholder="Password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="signin" id="signin" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <!--div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
            </div><!-- /.social-auth-links -->

            <a href="#">I forgot my password</a><br>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection
