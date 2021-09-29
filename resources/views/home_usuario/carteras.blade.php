@extends('layouts.home_user') @section('content')
<!-- section -->
<section class="hero-section">
    <div class="container">
    <div layout="row" layout-xs="column">
    <div flex="" style="background:#ccc;padding:10px;margin:2px">
    @if(Session::has('succes'))
    <h2>{{Session::get('succes')}}</h2>

    @endif
    {{$default->code}} Wallet
    <div class="row">
        <div class='col-sm-6'>
        {!!Form::select('getCurrencies', $getCurrencies, $default->id, ['id' => 'getCurrencies','class' => 'form-control'
                ])!!}
        </div>
    </div>    
    
     <p>{{$default->code}}  {{General::getCryptoWalettUser($default->id)}} </p>
     <div layout="row" layout-xs="column">
     
                    <div flex="40">
                    </div>
                    <div flex="30">
                        <md-button class="md-primary">Depositar</md-button>
                    </div>
                    <div flex="30">
                    <md-button class="md-primary"><a href="/retirar/{{$default->id}}">Retirar</a></md-button>
                    </div>
              
     </div>

    </div>

    </div>

        <div layout="row" layout-xs="column">
            @forelse($cryptos as $crypto)
            <div flex="" style="background:#ccc;padding:10px;margin:2px">
                <p>{{$crypto->name}}</p>
                <hr>
                <?php
                  $z=General::getCryptoUser($crypto->id);
                ?>
                <h2> <?php 
               echo $default->code." ".General::getConverCrypto($default->code,$crypto->code,$z);
                ?> </h2>

                <p><?php echo $z?> {{$crypto->code}}</p>

                <div layout="row">
                    <div flex="40">
                    </div>
                    <div flex="30">
                        <md-button class="md-primary"><a href="/comprar/{{$crypto->id}}/{{$default->id}}">comprar</a></md-button>
                    </div>
                    <div flex="30">
                    <md-button class="md-primary"><a href="/vender/{{$crypto->id}}/{{$default->id}}">vender</a></md-button>
                    </div>
                </div>
            </div>
            @empty
            <p>nada</p>
            @endforelse
        </div>


    </div>
    <script>
     $("#getCurrencies").change(function () {
            window.location = "/carteras/" + $(this).val();
            // alert("vendor/"+$("#getCryptos").val()+"/"+$(this).val());
        });
    </script>

</section>
<!--section end -->
@endsection