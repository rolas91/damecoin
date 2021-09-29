<div class="row">
    <div class="col-md-4">
        {!! Form::label('name', 'Name') !!}
        {{ Form::text('name', null, [
    'class' => 'form-control square',
    'placeholder' => 'Enter name',
]) }}
    </div>
    <div class="col-md-4">
        {!! Form::label('amount', 'Amount') !!}
        {{ Form::text('amount', null, [
    'class' => 'form-control square',
    'placeholder' => 'Enter amount',
]) }}
    </div>
    <div class="col-md-4">
        {!! Form::label('description', 'Descripcion ') !!}
        {{ Form::text('description', null, [
    'class' => 'form-control square',
    'placeholder' => 'Descripcion',
]) }}
    </div>

    <div class="col-md-4">
        {!! Form::label('file_idioma', 'Archivo de idioma ') !!}
        {{ Form::text('file_idioma', null, [
    'class' => 'form-control square',
    'placeholder' => 'Archivo de idioma',
]) }}

    </div>

    <div class="col-md-4">
        {!! Form::label('cuenta_pago', 'Cuenta para recibir ') !!}
        {{ Form::text('cuenta_pago', null, [
    'class' => 'form-control square',
    'placeholder' => 'cuenta o email de pago',
]) }}

    </div>

    <div class="col-md-4">
        {!! Form::label('deposit_fees', 'deposit Fees') !!}
        {{ Form::text('deposit_fees', null, [
    'class' => 'form-control square',
    'placeholder' => 'Deposit Fees',
]) }}

    </div>
    <div class="col-md-4 text-center">
        {!! Form::label('modal', 'Modal ') !!}
        {{ Form::text('modal', null, [
    'class' => 'form-control square',
    'placeholder' => 'Modal',
]) }}
    </div>

    <div class="col-md-4">
        {!! Form::label('status', 'status') !!}
        {{ Form::select(
    'status',
    [
        '0' => 'Inactivo',
        '1' => 'Activo',

    ],
    null,
    ['required', 'class' => 'form-control', 'placeholder' => 'Select..'],
) }}
    </div>

    


</div>


<div class="row mt-5">
    <div class="col-md-4">
        {!! Form::label('form', 'Form') !!}
        {{ Form::select(
    'form',
    [
        '0' => 'Default',
        '1' => 'Paypal',
        '2' => 'Western Union',
        '3' => 'Bizum',
        '4' => 'Skrill',
        '5' => 'WeChat',
        '6' => 'AliPay',
    ],
    null,
    ['required', 'class' => 'form-control', 'placeholder' => 'Select..'],
) }}
    </div>
    

    <div class="col-md-4 text-center">
        {!! Form::label('file', 'Image') !!}
        {!! Form::file('file') !!}
    </div>

    <div class="col-md-4">
        <img width="52" height="52" src="{{ asset($file) }}">
    </div>
</div>
<div class="row mt-4 text-center">



</div>

<div class="row mt-4 text-center">
    <div class="col"></div>
    <div class="col">
        <a href="{{ route('payment-method.index') }}" class="btn btn-warning square">Back</a>

        {!! Form::submit('Save', [
    'class' => 'btn btn-info square',
]) !!}
    </div>


    <div class="col"></div>
</div>

<!--
<a href="#" class="btn btn-primary" style="display: flex;align-items: center;" data-toggle="modal"
    data-target="#AlipayPaymentModal" onclick="newAlipay()">
    <img src="{{ asset('img/alipay.svg') }}" class="left-icon" style="width: 50px;">
    @lang('index.title_alipay')
</a>
<div class="modal fade lg" id="AlipayPaymentModal" tabindex="-1" role="dialog" aria-labelledby="AlipayPaymentModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="SkrillPaymentLabel">@lang('index.title_alipay')</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px 30px">

                <textarea id="example" name="" id="" cols="30" rows="10">



                </textarea>

                <button type="button" onclick="enviarx()">Guardar<button>

            </div>
        </div>
    </div>
</div>
-->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    function enviarx() {
        var info = $("textarea#example").val();

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}",
            }
        });
        $.post("/admin/payment-method-file-s", {
                "info": info,
            })
            .done(function(data) {
                alert("si guardado")

            });
        //console.log(info);
        //alert("guardado");
    }

    function newAlipay() {

        calculateMinimum("idioma", "alipay")
            .then((data) => {

                console.log(data);
                $("textarea#example").val(data);
                return "";
                /*
               $('#calculatorAlipay').html(`${data.minUsd} (${data.min})`);
                $('#alipayEmail').html(`${data.emailAlipay}`);
                $('#alipayImagen').attr('src', '/methodpayQR/' + data.imagen);
                $('#calculatorAlipayMax').html(`${data.maxUsd} (${data.max})`);
                */
            })
            .catch(err => console.log(err));


    }

    function calculateMinimum(currency, metodo) {
        return new Promise((resolve, reject) => {
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}",
                }
            });
            $.post("/admin/payment-method-file", {
                    "idioma": "en",
                    "file": "dashboard_payment_method.php"
                })
                .done(function(data) {
                    resolve(data);
                    if (data.success == 'true') {
                        resolve(data);
                    }
                    reject();
                });
        });
    }

    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });

</script>
