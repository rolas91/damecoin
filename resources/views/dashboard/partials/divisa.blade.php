
{!! Form::select('getCurrencies', $getCurrencies, $defaultCurrency->id, ['id' => 'getCurrencies', 'class' => 'form-control', 'onchange' => 'currenChange(this);', 'data-default' => $defaultCurrency->code, 'data-symbol' => $defaultCurrency->symbol]) !!}
<script>
    function currenChange(tr) {
        window.location.href = '/dash/currency/' + tr.value;
    }
</script>
