@extends('layouts.admin_user')

 @section('content')
<!-- section -->

<style>
  .card-pasos .icon {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 40px;
    height: 40px;
    color: #fff;
    font-size: 1.3rem;
    background: #23509d;
    border-radius: 50%;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Pending
        <small></small>
      </h1>
    </section>

    <table class="table table-striped mt-4 table-bordered">
      <thead class="">
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Crypto Amount</th>
              <th scope="col">Amount to Pay</th>
              <th scope="col">Payment Method</th>              
              <th scope="col">Status</th>
              <th scope="col"></th>
          </tr>
      </thead>
      <tbody>

          @forelse ($payment_pendings as $payment_pendings)
            <tr>
              <td>{{ $payment_pendings->id }}</td>
            <td>{{ $payment_pendings->compra }} {{ $payment_pendings->code_crypto}}</td>
              <td>
                {{ number_format((($payment_pendings->total)), 2, '.', '') }} {{ $payment_pendings->code_currencies }} (update each <span id='contador'></span> sec)
              </td>
              <td>{{ $payment_pendings->pasarela }}</td>
              <td>Not verified yet (will take a few minutes)</td>
              <td>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class='btn btn-info'>
                  Complete your payment
                </a>
              </td>
            </tr>
              @empty <p>No Ciptos</p>
          @endforelse

      </tbody>
  </table>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Payment Introductions</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
             <div class="card-pasos">
               <div class="row">
                 <div class="col-md-2">
                    <span class="icon line">1</span>
                 </div>
                 <div class="col-md-4">
                    send payment of to:
                 </div>
                 <div class="col-md-6">
                  <strong>paypal@damecoins.co.uk</strong>
                 </div>
               </div>
              
               <div class="row" style="margin-top: 14px">
                 <div class="col-md-2">
                   <span class="icon line">2</span>
                 </div>
                 <div class="col-md-10">
                   We will verify in less than 24 hours and we will charge the money to your Damecoins account, so that you can use it to acquire cryptocurrencies. Let us know now about the payment in the 24h Chat to speed up the process
                 </div>
               </div>
             </div>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
   </div>
</div>

@endsection

@section('js')
    <script>
      var Time = 1 * 60; // 900s // 15 Minutos
      var progressBar = Time;
      setInterval(() => {
   
      if(Time == 0) {

          // bloked();
          return false;
      };
      
      --Time;
      var sec, min, hour;

      if(Time<3600){
          var a = Math.floor(Time/60); //minutes
          var b = Time%60; //Time

          min = a < 10 ? `0${a}`: a;

          sec = b < 10 ? `0${b}`: b;

          $('#contador').html(`${sec}`);
      }
    }, 1000);
    </script>
@endsection