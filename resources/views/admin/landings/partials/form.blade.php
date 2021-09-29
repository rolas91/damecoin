<div class="row">
    <div class="col-6">
        {{ Form::label('name','Name') }}
        {{ Form::text('name',null,['class' => 'form-control']) }}
        @if ($errors->has('name'))
         <strong style="color : red">{{ $errors->first('name') }}</strong>		@endif
    </div>
    <div class="col-6">
        {{ Form::label('url','Url') }}
        {{ Form::text('url',null,['class' => 'form-control']) }}
        @if ($errors->has('url'))
        <strong style="color : red">{{ $errors->first('url') }}</strong>		@endif
    </div>
</div>

<br>

<div class="row">
    <div class="col-6">
        {{ Form::label('comentarios','Comentarios') }}
        {{ Form::text('comentarios',null,['class' => 'form-control']) }}
        @if ($errors->has('comentarios'))
        <strong style="color : red">{{ $errors->first('comentarios') }}</strong>		@endif
    </div>
    <div class="col-6">
        {{ Form::label('link_asana','Link Asana') }}
        {{ Form::text('link_asana',null,['class' => 'form-control']) }}
        @if ($errors->has('link_asana'))
        <strong style="color : red">{{ $errors->first('link_asana') }}</strong>		@endif
    </div>
</div>

<br>

<div class="row">
    <div class="col-6">
        {{ Form::label('state','Estado') }}
        {{ Form::select('state',['En Desarrollo'=>'En Desarrollo','Con Errores'=>'Con Errores','Sin Publicar'=>'Sin Publicar','Publicado'=>'Publicar',],null, ['class' => 'form-control','placeholder' => 'Select...']) }}
        @if ($errors->has('state'))
        <strong style="color : red">{{ $errors->first('state') }}</strong>		@endif
    </div>
    <div class="col-6">
        {{ Form::label('agent','Agente') }}
        {{ Form::select('agent',['Mayron Uriales'=>'Mayron Uriales','Eduardo Martinez' => 'Eduardo Martinez', 'Gabriel Houltman' => 'Gabriel Houltman'],null, ['class' => 'form-control','placeholder' => 'Select...']) }}
        @if ($errors->has('agent'))
        <strong style="color : red">{{ $errors->first('agent') }}</strong>		@endif
    </div>
</div>

<br>

<center>
    <a href="{{ url('admin/landings') }}" class="btn btn-warning square">Back</a>
    {{ Form::submit('Save',['class' => 'btn btn-primary square']) }}
</center>
