<div class="col-12 col-lg-6 mt-4 mt-lg-0">
     <div class="card card-blue">
         <div class="card-header">
            
             @lang('dashboard_perfil.setting_account')
         </div>
         <div class="card-body">
            <form action="/dash/setting/{{ $user->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <small>  @lang('dashboard_perfil.locate')</small>
                <div class="input-group input-dropdown-custom-two pb-3">
                    <!--
                    <input type="text" class="form-control input-background-custom" aria-label="Text input with dropdown button" value="Español (ES)">
                    -->
                    {!!Form::select('idioma', config('idioma.'.App::getLocale()),App::getLocale(),  [
                       'id' => 'getCryptos',
                       'class' => 'form-control'
                   ])!!}
                </div>
               
                <small>@lang('dashboard_perfil.fiat_default')</small>
                <div class="input-group input-dropdown-custom-two">
                   {!!Form::select('currency', $getCurrencies,$currency ,  [
                       'id' => 'getCryptos',
                       'class' => 'form-control'
                   ])!!}
                </div>

                <small>@lang('dashboard_perfil.crypto_default')</small>
                <div class="input-group input-dropdown-custom-two">
                   {!!Form::select('crypto', $getCryptos,$crypto,  [
                       'id' => 'getCryptos',
                       'class' => 'form-control'
                   ])!!}
                </div>

                <hr>
                {{-- 
                <h6>Metodos de pago guardado</h6>

                <div class=" btn-with-tarjeta-two mt-3 py-2 text-left">
                    <span class="mr-3"><img src="assets/img/deposito/icon-tarjeta.png" alt=""></span>
                    <span class="mr-3">****</span><span class="mr-3">****</span><span class="mr-3">****</span>
                    <strong class="my-0">2345</strong>
                    <div class="options-tarjeta">
                        <a class="mx-2" href="#" data-toggle="modal" data-target="#exampleModal"> <img class="mr-1" src="assets/img/perfil/edit-white.png" alt=""> Editar</a> |
                        <a class="mx-2" href="#"> <img class="mr-1" src="assets/img/perfil/delete-white.png" alt=""> Elimininar</a>
                    </div>
                </div>

                <div class=" btn-with-tarjeta-two mt-3 py-3 text-left">
                    <span class="mr-3 "><img src="{{asset('newdesign/assets/img/perfil/visa.png')}}" alt=""></span>
                    <span class="mr-3">****</span><span class="mr-3">****</span><span class="mr-3">****</span>
                    <strong class="my-0">2345</strong>
                    <div class="options-tarjeta">
                        <a class="mx-2" href="#" data-toggle="modal" data-target="#exampleModal"> <img class="mr-1" src="assets/img/perfil/edit-white.png" alt=""> Editar</a> |
                        <a class="mx-2" href="#"> <img class="mr-1" src="assets/img/perfil/delete-white.png" alt=""> Elimininar</a>
                    </div>
                </div>
                --}}
                <!--
                <a href="#" class="btn-add-tarjeta mx-auto mt-3"  >
                    <span><img src="{{asset('newdesign/assets/img/deposito/Mask.png')}}" alt=""></span> 
                    Agregar metodo de pago
                </a>
                -->
                <button type="submit" class="btn btn-primary btn-add-tarjeta mx-auto mt-3"  >
                       <small class="text-white">
                           @lang('dashboard_perfil.btn_update')
                        </small>
                 </button>
            </form>
         </div>
       </div>
 </div>


              <!-- Modal -->
              <div class="modal fade moda-custom-perfil" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                   <h5 class="modal-title text-center" id="exampleModalLabel">Editar /agregar tarjeta</h5>
                   <img src="{{asset('newdesign/assets/img/perfil/mastercard.png')}}" alt="">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                   <div class="modal-body">
                       
  
                       <div class="form-group">
                           <label for="exampleInputEmail1">Nombres en la tarjeta</label>
                           <input type="text" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp">
                       </div>
                       <div class="form-group">
                           <label for="exampleInputEmail1">Numero tarjeta</label>
                           <input type="text" class="form-control" placeholder="XXXX - XXXX - XXXX - XXXX" id="exampleInputEmail1" aria-describedby="emailHelp">
                       </div>
  
                       <div class="row">
                           <div class="col-12 col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Fecha Vencimiento</label>
                                   <input type="text" class="form-control" placeholder="MM / YY" id="exampleInputEmail1" aria-describedby="emailHelp">
                               </div>
                           </div>
                           <div class="col-12 col-md-6">
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Codigo de seguridad</label>
                                   <input type="text" placeholder="CVV" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                               </div>
                           </div>
                       </div>
  
                   </div>
                   <div class="modal-footer">
                   <button type="button" class="btn btn-info btn-info-gradient px-4 mx-auto">Agregar tarjeta</button>
                   </div>
               </div>
               </div>
           </div>
           <!--modal-->