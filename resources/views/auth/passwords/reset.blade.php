@extends('layouts.landing', [
  'title' => 'Login'
])

@section('content')

<section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">

    @include('partials.landing.header')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 col-12 m-auto  bg-white mt-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-muted text-center mb-3 mt-3">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/password/reset">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label text-muted">E-Mail Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label text-muted">Password</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-12 control-label text-muted">Confirm Password</label>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


@endsection


@section('scripts')
    $("#idioma2").change(function () {
        var lang = $(this).val();
        window.location='/new-index/lang/'+lang;
    });

    var nameCrypto = localStorage.getItem('name_scrypto');
    var d = document.getElementById('buyCryptoTop');

    if(nameCrypto){
      d.innerText = nameCrypto;
    } else {
      d.innerText = 'Bitcoin';
    }

@endsection

@section('footer')
  @include('partials.landing.footer')
@endsection
