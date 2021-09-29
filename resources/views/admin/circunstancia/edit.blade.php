@extends('layouts.admin_new') 
@section('content')
<!-- section -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="/admin/circunstancia"><i class="fa fa-dashboard"></i> Circumstance</a></li>
            <li class="active">Actualizar</li>
          </ol>
        </section>
        <section class="content">
        <form action="{{ url('admin/circunstancia/'.$circunstancia->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12      ">name</label>

                    <div class="col-md-12">
                        <input id="name" type="name" class="form-control" value="{{ $circunstancia->name }}" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-12      ">descripción</label>
    
                        <div class="col-md-12">
                            <textarea id="description" rows="4" cols="5" class="form-control" name="description" value="{{ $circunstancia->description }}" value="{{ old('description') }}">
                                {{$circunstancia->description}}
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug" class="col-md-12      ">slug</label>
    
                        <div class="col-md-12">
                            <textarea id="slug" rows="4" cols="5" class="form-control" name="slug" value="{{ $circunstancia->slug }}" value="{{ old('slug') }}">
                                {{$circunstancia->slug}}
                            </textarea>
                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>
                <div class="form-group {{ $errors->has('idioma') ? ' has-error' : '' }}">
                        <label class="col-md-12 ">idioma</label>
                        <div class="col-md-12">
                                {!!Form::select('idioma', config('idioma.es'),$circunstancia->idioma,  [
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