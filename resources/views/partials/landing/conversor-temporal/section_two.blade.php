<div class="first-section px-lg-5 pb-3">
    <div class="card">
        <div class="card-body pt-4">
            <h5 class="text-white">¿Ya tienes una billetera? Compra Bitcoin al Instante</h5>

            <div class="row mt-3">
                <div class="col-12 col-md-5">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white" >Nombres</small>
                                <input type="text" class="form-control" id="exampleFormControlInput1">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white" >Apellidos</small>
                                <input type="text" class="form-control" id="exampleFormControlInput1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white" >Email</small>
                                <input type="text" class="form-control" id="exampleFormControlInput1">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white">Selecion un pais</small>
                                <div class="select-standard">
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
                    </div>
        

                </div>
                <div class="col-12 col-md-7">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white">¿Qué divisa quieres comprar?</small>
                                <div class="container-select-list">
                                    <div class="icon"> 
                                        <span class="mr-2">BTC </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    <select class="selectpicker" data-live-search="true">
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                            Bitcoin (BTC)</option>
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Bitcoin (BTC)">
                                            Bitcoin (BTC)</option>
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Bitcoin (BTC)">
                                            Bitcoin (BTC)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <small class="text-white" >¿En qué divisa quieres pagar?</small>
                                <div class="container-select-list">
                                    <div class="icon"> 
                                        <span class="mr-2">USD </span>
                                        <span><i class="fas fa-angle-down"></i></span>
                                    </div>
                                    <select class="selectpicker" data-live-search="true">
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
                                            Dolares americanos</option>
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/1.png')}}'></img> Dolares americanos">
                                            Dolares americanos</option>
                                        <option value="h:464e" data-content="<img class='img-select' src='{{ asset('assets/img/formulario/2.png')}}'></img> Dolares americanos">
                                            Dolares americanos</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <small>Numero de tarjeta</small>
                                <input type="text" class="form-control" placeholder="---- ---- ---- ----" >
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <small>Fecha Exp.</small>
                                <div class="input-group input-group-fecha mb-3">
                                    <input type="text" class="form-control" placeholder="MM / YYYY" >
                                    <div class="input-group-append">
                                      <span class="input-group-text"> <img class="img-fluid" src="{{ asset('assets/img/formulario/calendar.png')}}" alt=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <small>CVV</small>
                                <input type="text" class="form-control" placeholder="- - -" >
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <br>
                               <button  class="btn text-decoration-none button-gradient-blue mx-auto mt-0"> <img class="mr-1" src="{{ asset('assets/img/metodo-pago/Group13.png')}}" alt=""> Comp. instantanea</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center">
        <img class="img-form" src="{{ asset('assets/nuevos/img/conversorTemporal/Frame277.png')}}" alt="">
    </div>
</div>