<div class="container-acount">

    @foreach (Dashboard::getAccounts() as $index => $account)

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="mr-3"><img src="assets/img/deposito/usa.png" alt=""></span>
                {{ $account->title }}
            </div>
            <div class="card-body text-center">
                <a class=" btn-link-succes m-auto " data-toggle="collapse" href="#collapse-mob{{ $account->id }}"
                    role="button" aria-expanded="false" aria-controls="collapse-mob{{ $account->id }}">
                    @lang('dash_general.see_data')
                    <span>
                        <i class="fas fa-chevron-down"></i>
                    </span>
                </a>
                <div class="collapse collapse-custom mt-1  {{($index == 0) ? 'show' : ''}} " id="collapse-mob{{ $account->id }}">
                    @include("dashboard.partials.buy.account.info")
                </div>
                @include("dashboard.partials.buy.account.bottom",["id" => $account->id,"divisa"=>$defaultCurrency->id,"type"=>"desktop" ])
            </div>
        </div>

    @endforeach

</div>
