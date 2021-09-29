<div class="card card-body text-left">
    <p>
        <strong>@lang('home_deposit.destinatario')</strong>
        {{ $account->destinatary }}
    </p>
    <p>
        <strong>@lang('home_deposit.country')</strong>
        {{ $account->country }}
    </p>
    <p>
        <strong>@lang('home_deposit.swift')</strong>
        {{ $account->swift }}
    </p>
    <p>
        <strong>@lang('home_deposit.acount')</strong>
        {{ $account->numero_cuenta }}
    </p>
    
    <p>
        <strong>@lang('dash_general.minimun_deposit')</strong>
        {{ $minBank}}
    </p>

    <p>
        <strong>Concept:</strong>
        {{ Auth::user()->name }}
    </p>
    <p>
        <strong>Email:</strong>
        {{ config('settings.emails.bank') }}
    </p>
</div>

