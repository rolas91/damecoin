@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Landings
        <small></small>
      </h1>

      <div class="text-right">
        <a href="{{ url('admin/landings/create') }}" class="btn btn-primary">Crear</a>
      </div>

    <section class="content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Landing</th>
                            <th>Url Landing</th>
                            <th>Comentarios</th>
                            <th>Ticket Asana</th>
                            <th>Public</th>
                            <th>Agent</th>
                            <th>View</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
        

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($lading as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->url == 'No posee')

                                    @else
                                        {{ $item->url }}
                                    @endif
                                </td>
                                <td>{{ $item->comentarios }}</td>
                                <td>
                                    @if ($item->link_asana == 'No posee')

                                    @else
                                        <a href="{{ $item->link_asana }}" target="_blank">Link Asana</a>
                                    @endif
                                </td>
                                <td>{{ $item->state }}</td>
                                <td>{{ $item->agent }}</td>
                                <td>
                                    @if ($item->url == 'No posee')

                                    @else
                                        <a href="{{ $item->url }}" target="_blank" >Ver</a></td>
                                    @endif
                                <td><a href="{{ route('landing.edit',$item->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        {{-- <tr>
                            <td>1</td>
                            <td>Metodos de pago</td>
                            <td>/buy-btc-in-en-usd</td>
                            <td><a href="{{ url('/buy-btc-in-en-usd') }}" target="_blank" >Ver</a></td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Circunstancia</td>
                            <td>/buy-btc-without_commision/usd</td>
                            <td><a href="{{ url('/buy-btc-without_commision/usd') }}" target="_blank" >Ver</a></td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Skrill</td>
                            <td>/buy-btc/usd/with/skrill</td>
                            <td><a href="{{ url('/buy-btc/usd/with/skrill') }}" target="_blank" >Ver</a></td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Paypal</td>
                            <td>/buy-btc/usd/with/paypal</td>
                            <td><a href="{{ url('/buy-btc/usd/with/paypal') }}" target="_blank" >Ver</a></td>

                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Wester Union</td>
                            <td>/buy-btc/usd/with/westerUnion</td>
                            <td><a href="{{ url('/buy-btc/usd/with/westerUnion') }}" target="_blank" >Ver</a></td>
                        </tr>


                        <tr>
                            <td>6</td>
                            <td>Convert</td>
                            <td>/convert-btc-to-eu</td>
                            <td><a href="{{ url('/convert-btc-to-eu') }}" target="_blank" >Ver</a></td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td>Comprar y Vender</td>
                            <td>/buy-sell-ltc-usd-with</td>
                            <td><a href="{{ url('/buy-sell-ltc-usd-with') }}" target="_blank" >Ver</a></td>
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>Bizum</td>
                            <td>/buy-sell-ltc-usd-with</td>
                            <td><a href="{{ url('/buy-btc/usd/with/bizum') }}" target="_blank" >Ver</a></td>

                        </tr>

                        <tr>
                            <td>9</td>
                            <td>Precios</td>
                            <td colspan="2">Developing</td>
                             <td>/buy-sell-ltc-usd-with</td>
                            <td><a href="{{ url('/buy-btc/usd/with/bizum') }}" target="_blank" >Ver</a></td> 
                        </tr> --}}
                    </tbody>
                </table>
    </section>
</div>


    
<!--section end -->
@endsection