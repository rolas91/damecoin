{{-- Transferencias Bancarias --}}

<div class="modal fade" id="transfernsModal" tabindex="-1" role="dialog" aria-labelledby="TransferenciaBank"
    aria-hidden="true" style="margin-top: 120px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #ecf0f5;">
            <div class="modal-header" style="padding: 20px 30px 10px;">
                <h4 class="modal-title" id="TransferenciaBank">@lang('index.titleTransfeBank')</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="outline: none;font-size: 30px;padding: 0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="padding: 1px 30px 1px 30px; margin-top: 0.5rem; margin-bottom: 0.5rem">
                <small>@lang('index.titleTransfeBank1')</small>
                <br>
                <small>@lang('index.subtitleAllPopups')</small>
            </div>
            <div class="modal-body" style="padding: 1px 30px 1px 30px;">
                <div class="row" style="margin: 0!important">

                    <small style="font-size: 80%; font-weight: 400;">
                        @lang('index.textBank')
                    </small>

                    <br>

                    <div class="text-center" style="margin-top: 10px;">
                        <a href="{{ url('/login') }}" class="btn btn-primary">@lang('index.newBtn')</a>
                    </div>

                    <br>

                    <div style="width: 100%; margin-top: 10px;" class='contentDataBnak'></div>

                    <div class="text-center" style="width: 100%;">
                        <a href="{{ url('/login') }}" class="btn btn-primary">@lang('index.newBtn')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#transfernsModal"
    style="display: flex;align-items: center;" onclick="newTransferBank()">
    <img src="{{ asset('assets/img/form-transferencia/Group185.png') }}" class="left-icon" style="width: 25px;">
    @lang('index.TransfeBank')
</a>


<script>
    function newTransferBank() {
        currency = '{{ $getCurrencyUser->code }}';
        calculateMinimum(currency, "transfe")
            .then((data) => {
                console.log(data)
                $('#amountAccount').html(`${data.minUsd} (${data.min})`);
            })
            .catch(err => console.log(err));
    }

</script>
