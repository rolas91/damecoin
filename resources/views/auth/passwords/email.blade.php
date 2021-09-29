@extends('layouts.landing', [
  'title' => 'Login',

])


@section('content')
  <section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">
    @include('partials.landing.header')
    <div class="container">
      <div class="row">

        <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-0 col-xl-6 offset-xl-1">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label text-white">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </div>
            </div>
        </form>

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
@endsection

@section('footer')
  @include('partials.landing.footer')
@endsection