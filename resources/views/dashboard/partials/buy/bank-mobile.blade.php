<div class="modal fade modal-custom-comprar" id="modal-deposito" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('dash_general.account_bank')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <p class="card-text mb-0">
                @lang('dash_general.transfe1')
                <br>
                @lang('dash_general.transfe2')
            </p>

            <div class="accordion modal-acordion mt-0" id="accordionExample">
                <div class="card mt-0 pt-0">
                    <div class="card-header pt-0" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn  " type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                @lang('dash_general.more')
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            @lang('dash_general.transfe3')
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-acount">

               @foreach (Dashboard::getAccounts() as $index=>$account)
               
               <div class="card card-blue">
                    <div class="card-header d-flex align-items-center">
                        <span class="mr-3"><img src="assets/img/deposito/uk.png" alt=""></span>
                        {{ $account->title }}
                    </div>
                    <div class="card-body text-center">
                        <a class=" btn-link-succes m-auto " data-toggle="collapse" href="#collapse{{ $account->id }}"
                            role="button" aria-expanded="false" aria-controls="collapse{{ $account->id }}">
                           @lang('dash_general.see_data')
                            <span>
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse collapse-custom mt-1 {{($index == 0) ? 'show' : ''}}  " id="collapse{{ $account->id }}">
                           @include("dashboard.partials.buy.account.info")
                        </div>
                        @include("dashboard.partials.buy.account.bottom",["id" => $account->id,"divisa"=>$defaultCurrency->id,"type"=>"mobile" ])
                    </div>
                </div>

               @endforeach

            </div>

            <h5 class="card-title mt-3">
                <span class="mr-1"><img src="assets/img/deposito/anonymous.png" alt=""></span>
                Anonimous measures
            </h5>

            <p class="card-text">
                - Our bank accounts are not directly linked to any crypto chain so you can make your
                transfer
                without worring about local bank / Government restrictions agains Crypto:
                <br>

                - If you need other deposit methods (i.e. Alipay, WeChat Pay, Singapour Bank Account, etc.
                please contact our 24/7 Support Chat.
                <br>

                - If you need "Government & Bank Statement 100% Anonymous for bank transfer, please check it
                upon the bank details.
            </p>

        </div>

    </div>
</div>
</div>