<div class=" banner-principal banner ">
    <div class="container">
          <div class="row">
              <div class="col-12 col-lg-5">
                  
                <div class="d-flex justify-content-start align-items-center ">
                    <img class="icon-coin" src="{{ asset('assets/img/conversor/icon1.png')}}" alt="">
                    <img class="icon-coin-small mx-3" src="{{ asset('assets/nuevos/img/detalle-metodo-pago/switch1.png')}}" alt="">
                    <img class="icon-coin" src="{{ asset('assets/nuevos/img/conversor/icon2.png')}}" alt="">
                </div>
                
                  <h2 class="text-white font-weight-bold mt-3">
                    Convierte y compra <br class="d-none d-lg-block">
                      <span class="color-green">
                        Bitcoins al instante con tu tarjeta de credito
                      </span>
                  </h2>

                  <p class="text-white mt-2">
                    DameCoins. Compra bitcoins y otras criptomonedas en segundos con tu tarjeta (admite tarjetas de crédito, débito y tarjetas de regalo). No se requiere verificación ID. Fácil y rapido.
                  </p>

                  <button class="btn btn-info link-gradient-blue mx-1">
                      <img class="mr-2" src="{{ asset('assets/nuevos/img/Features/Group.png') }}" alt="">
                      Crear cuenta gratis
                  </button>
                  
                  <ul class="list-punto-light mt-4">
                      <li>
                          Tras el pago los BTC serán instantáneamente 
                          añadidos a tu cartera en DameCoins.
                      </li>
                      <li>
                          Podrás acceder a tu cartera simplemente iniciando sessión. Recibirás un email con los datos de acceso al instante.
                      </li>
                      <li>
                          Puedes enviar tus monedas a una billetera externa o simplemente venderlas en cualquier momento y retirar el dinero a su cuenta bancaria (dependiendo de su país, puede tardar hasta 1-5 días en llegar a su cuenta bancaria).
                      </li>
                      <li>
                          Tus pagos nunca mostrarán ningún nombre relacionado con la criptomoneda en el extracto bancario, de tarjeta o historial de pagos. Tu privacidad es muy importante para nosotros.
                      </li>
                  </ul>

              </div>
              <div class="col-12 col-lg-7 mt-4">
                  <div class="card card-compra-instantanea ">
                 
                      <div class="card-header ">
                           <h3  class=" text-center font-weight-bold mt-3">Consultar</h3>
                          
                           <div class="row">
                               <div class="col-12 col-md-6">
                                   <strong class="font-small">Cuanto eran:  </strong>
                                  
                                   <div class="input-group input-group-cantidad-blue mb-3">
                                      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                      <div class="input-group-append">
                                        <span class="input-group-text">
                                            <img class="mr-1" src="{{ asset('assets/img/formulario/1.png')}}" alt="">
                                            BTC
                                        </span>
                                      </div>
                                    </div>

                                    <strong class="font-small">En la divisa:</strong>

                                    <div class="input-group input-group-cantidad-blue mb-3">
                                      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                      <div class="input-group-append">
                                        <span class="input-group-text">
                                            <img class="mr-1" src="{{ asset('assets/img/formulario/2.png')}}" alt="">
                                            USD
                                        </span>
                                      </div>
                                    </div>

                                    <strong class="font-small">En la fecha:</strong>

                                    <div class="input-group input-group-date mb-3">
                                      <div class="input-group-prepend ">
                                        <span class="input-group-text"> <img src="{{ asset('assets/img/formPaypal/calendar.png')}}" alt=""></span>
                                      </div>
                                      <input class="form-control" type="date" value="" >
                                      <div class="icon-arrow">
                                          <i class="fas fa-angle-left"></i>
                                          {{-- <i class="fas fa-angle-right"></i> --}}
                                      </div>
                                    </div>

                               </div>
                               <div class="col-12 col-md-6 d-flex align-items-center ">
                                   <img class="mr-2 d-none d-md-block" src="{{ asset('assets/nuevos/img/conversorTemporal/=.png')}}" alt="">
                                  <div class="card-blue p-3">
                                      <h6>El precio era:</h6>
                                      <strong class="color-succes h5">1332.22 USD</strong>
                                      <p class="m-0">
                                          was the value of 2.231 BTC in the 1st June 2011
                                      </p>
                                  </div>  
                               </div>
                           </div>

                      </div>

                      <div class="card-body">                    

                      
                          <div class="row container-datos light py-3" >
                              <div class="col-12">
                                  <p class=" mb-0">
                                      <span class="font-weight-bold h6 d-block"> Compralos instantaneamente con tu tarjeta de credito </span>
                                      Datos para tu nueva cuenta donde accederás a tus Criptodivisas  y podrás retirarlas a otros wallets,
                                      hacer trading, etc.
                                  </p>
                              </div>
                              <div class="col-12 col-md-6 mt-3" >
                                  <input type="text" class="form-control"  placeholder="Nombre" >
                              </div>
                              <div class="col-12 col-md-6 mt-3"   >
                                  <input type="text" class="form-control" placeholder="Apellidos" >
                              </div>
                              <div class="col-12 col-md-6 mt-3"   >
                                  <input type="text" class="form-control" placeholder="Emails" >
                              </div>
                              <div class="col-12 col-md-6 mt-3"  >
                                  <div class="select-standard light">
                                      <span class="icon"><i class="fas fa-angle-down"></i></span>
                                      <select id="Select " class="form-control selectpicker">
                                        <option>País</option>
                                        <option>País</option>
                                        <option>País</option>
                                        <option>País</option>
                                      </select>
                                    </div>
                              </div>
                          </div>
                          
                          <div class="form-group form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1"><small>Estoy de acuerdo con los Términos de Servicio</small></label>
                          </div>
                          
                      

                          <button class="btn btn-block button-gradient-blue-large py-3 ">
                              Comprar instantanemente - (0,0045 BTC)
                          </button>


                         <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                             <p class="my-0 mx-2"> <span class="color-succes"><i class="fas fa-check"></i></span>  Comisiones más bajas</p>
                             <p class="my-0 mx-2"> <span class="color-succes"><i class="fas fa-check"></i></span>  Pago Inmediato</p>
                             <p class="my-0 mx-2"> <span class="color-succes"><i class="fas fa-check"></i></span>  Proceso simple y sencillo</p>
                         </div>


                      </div>
                  </div>
              </div>
          </div>
    </div>
  </div>