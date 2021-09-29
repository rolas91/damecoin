@extends('layouts.admin_new') 
@section('content')
<!-- section -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/country"><i class="fa fa-dashboard"></i> Circumstances</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">

        <form action="{{ url('admin/circunstancia') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-12 ">name</label>
    
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-12 ">descripción</label>
                            <div class="col-md-12">
                                <textarea id="description" rows="4" cols="5" class="form-control" name="description">
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="form-group {{ $errors->has('idioma') ? ' has-error' : '' }}">
                            <label class="col-md-12 ">idioma</label>
                            <div class="col-md-12">
                                    {!!Form::select('idioma', config('idioma.es'),"es",  [
                                        'id' => 'getCryptos',
                                        'class' => 'form-control'
                                    ])!!}
                                @if ($errors->has('idioma'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('idioma') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button> 
                        </div>
                </div>
        </form>
       
        </section>
</div>   

   
<!--section end -->
@endsection