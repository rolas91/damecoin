@extends('layouts.admin_new')

@section('content')
<!-- section -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      PaymentLimit
      <small></small>
    </h1>

  </section>
  <section class="content">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> !</h4>
      {{ Session::get('success') }}
    </div>

    @endif
    
    <table class="table table-striped mt-4 d-block" style="overflow-x: auto">
      <thead class="" style="position: -webkit-sticky;position: sticky;top: 0;left: 0;">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Wechat Limit</th>
          <th scope="col">Card Limit</th>
          <th scope="col">Card Max</th>
          <th scope="col">Bank Limit</th>
          <th scope="col">Bank Deposit Limit</th>
          <th scope="col">Paypal Limit</th>
          <th scope="col">Payoneer Limit</th>
          <th scope="col">Skrill Limit</th>
          <th scope="col">Alipay Limit</th>
          <th scope="col">Alipay Maximum</th>
          <th scope="col">WechatPay Limit</th>
          <th scope="col">WechatPay Maximum</th>
          <th scope="col">Mercadopago Limit</th>
          <th scope="col">Cuenta Alipay</th>
          <th scope="col">Cuenta Wechat Pay</th>
          <th scope="col">Paypal Email</th>
          <th scope="col">Payoneer Email</th>
          <th scope="col">Skrill Email</th>
          <th scope="col">commission</th>

        </tr>
      </thead>
      <tbody>

        @forelse ($limits as $limit)
        <tr>
          <th scope="row">1</th>
          <td>{{ $limit->wechat_minimum }} USD</td>
          <td>{{ $limit->card_minimum }} USD</td>
          <td>{{ $limit->card_maximum }} USD</td>
          <td>{{ $limit->bank_minimum }} USD</td>
          <td>{{ $limit->bank_deposit_minimum }} USD</td>
          <td>{{ $limit->paypal_minimum }} USD</td>
          <td>{{ $limit->payoneer_minimum }} USD</td>
          <td>{{ $limit->skrill_minimum }} USD</td>
          <td>{{ $limit->alipay_minimum }} CNY</td>
          <td>{{ $limit->alipay_maximum }} CNY</td>
          <td>{{ $limit->wechatpay_minimum }} CNY</td>
          <td>{{ $limit->wechatpay_maximum }} CNY</td>
          <td>{{ $limit->mercadopago_minimum }} ARS</td>
          <td>{{ $limit->cuenta_alipay }}</td>
          <td>{{ $limit->cuenta_wechatpay }}</td>
          <td>{{ $limit->paypal_email }}</td>
          <td>{{ $limit->payoneer_email }}</td>
          <td>{{ $limit->skrill_email }}</td>
          <td>{{ $limit->comision }}</td>
          <td><a href="{{ url('admin/payment-limit/'.$limit->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
        </tr>
        @empty
        <p>No Ciptos</p>
        @endforelse

      </tbody>
    </table>
    {{-- {{ $limits->links() }} --}}

    <div class="d-flex">
      <div class="d-flex flex-column mx-3 text-center">
        <span>Imagen QR Alipay</span>
        <img width="200px" src="{{asset('methodpayQR/'.$limit->qr_alipay)}}" alt="" id="input-image-alipay">
        <label for="imagen-alipay" style="cursor: pointer" class="btn btn-primary mt-2">Cambiar imagen</label>
        <input class="d-none" type="file" id="imagen-alipay" onchange="cambiarImagenAlipay()" accept="image/gif,image/jpeg,image/jpg,image/png">
      </div>

      <div class="d-flex flex-column mx-3 text-center">
        <span>Imagen QR Wechat Pay</span>
        <img width="200px" src="{{asset('methodpayQR/'.$limit->qr_wechat)}}" alt="" id="input-image-wechat">
        <label for="imagen-wechat" style="cursor: pointer" class="btn btn-primary mt-2">Cambiar imagen</label>
        <input class="d-none" type="file" id="imagen-wechat" onchange="cambiarImagenWechat()" accept="image/gif,image/jpeg,image/jpg,image/png">
      </div>
    </div>

    <button type="button" class="btn btn-success mx-3" onclick="actualizarImagenes()">Guardar</button>
    <span class="text-success" id="update"></span>
  </section>
</div>

<script>

let alipay = null
let wechat = null

function cambiarImagenAlipay(){
  let file_alipay =  document.getElementById("imagen-alipay")

  if(file_alipay.files && file_alipay.files[0]){
    var reader = new FileReader()
    reader.onload = function(e){
      document.getElementById("input-image-alipay").src = e.target.result
    }

    reader.readAsDataURL(file_alipay.files[0]);
    guardarimagenAlipay()
  }
}

function cambiarImagenWechat(){
  let file_wechat =  document.getElementById("imagen-wechat")

  if(file_wechat.files && file_wechat.files[0]){
    var reader = new FileReader()
    reader.onload = function(e){
      document.getElementById("input-image-wechat").src = e.target.result
    }

    reader.readAsDataURL(file_wechat.files[0]);
    guardarimagenWechat()
  }
}

function guardarimagenAlipay(){
  let file =  document.getElementById("imagen-alipay")
  var form_file = new FormData()
  form_file.append('file', file.files[0])

  alipay = {"file": form_file}
}

function guardarimagenWechat(){
  let file =  document.getElementById("imagen-wechat")
  var form_file = new FormData()
  form_file.append('file', file.files[0])

  wechat = {"file": form_file}
}

async function actualizarImagenes(){
  if(alipay !== null){
    await FetchActualizarImagenAlipay()
  }
  if(wechat !== null){
    await FetchActualizarImagenWechat()
  }

  $("#update").text('Actualizado corectamente')
}

async function FetchActualizarImagenAlipay()
{
    actualizarAlipay()
    .then((data) => {
        console.log(data)
    })
    .catch(err => console.log(err));
}

function actualizarAlipay(){
    return new Promise((resolve, reject) => {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}",
            }
        });

        $.post({
          url: `/actualizar-imagenqr-alipay/1`,
          data: alipay.file,
          method: "POST",
          processData: false,
          contentType: false,
        })
        .done(function(data) {
          if(data.success){
              resolve(data);
          }
          reject();
        });
    });
}

async function FetchActualizarImagenWechat()
{
  actualizarWechat()
    .then((data) => {
        console.log(data)
    })
    .catch(err => console.log(err));
}

function actualizarWechat(){
    return new Promise((resolve, reject) => {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}",
            }
        });

        $.post({
          url: `/actualizar-imagenqr-wechat/1`,
          data: wechat.file,
          method: "POST",
          processData: false,
          contentType: false,
        })
        .done(function(data) {
          if(data.success){
              resolve(data);
          }
          reject();
        });
    });
}


</script>
<!--section end -->
@endsection