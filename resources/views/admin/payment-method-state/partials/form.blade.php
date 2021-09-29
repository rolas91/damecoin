<div class="row">
    <div class="col">
        {!! Form::label('payment_method', 'Name') !!}
        {{ Form::text('payment_method',null, 
            [
                'class' => 'form-control square',
                'placeholder' => 'Enter name',
            ])
        }}
    </div>
</div>

<div class="row mt-2">                            
    <div class="col">
        {!! Form::label('state', 'State') !!}
        {!! 
            Form::select('state', [0 => 'Caido', 1=>'Activo'], null,
            [
                'placeholder' => 'Seleccione...',
                'class' => 'form-control square',
            ]);
        !!}
    </div>
</div>

<div class="row mt-2 text-center">
    <div class="col"></div>
    <div class="col">
        <a href="{{ route('payment-method-state.index') }}" class="btn btn-warning square">Back</a>
        {!! Form::submit('Save', 
            [
                'class' => 'btn btn-info square'
            ]) 
        !!}
    </div>
    <div class="col"></div>
</div>

