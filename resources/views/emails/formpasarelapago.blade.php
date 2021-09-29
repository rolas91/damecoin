@extends('beautymail::templates.ark')
 
@section('content')
        <div class="ml-3 mb-2">
            <span class="text-danger">Sus ingresos mensuales aproximados.</span>
            <p class="m-0">{{$ingress}}</p> 
        </div>

       <div class="ml-3" mb-2>
        <span class="text-danger">El sitio web que estás vendiendo (en caso de negocios en línea).</span>
            <p class="m-0">{{$site}}</p>   
        </div>

        <div class="ml-3 mb-2">
            <span class="text-danger">Naturaleza de los negocios.</span>
            <p class="m-0">{{$business}}</p>
        </div>

        <div class="ml-3 mb-2">
            <span class="text-danger">Cómo desea recibir los pagos que nos envían sus clientes (cuenta bancaria en qué país o BTC).</span>
            <p class="m-0">{{$account}}</p>
        </div>

        <div class="ml-3 mb-2">
            <span class="text-danger">Si desea adjuntar alguna cuenta de comunicación instantánea como Whatsapp es bienvenido a hacerlo para acelerar la comunicación.</span>
            <p class="m-0">{{$wpp}}</p> 
        </div>
@stop