<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-body">
             Please create a free account first and log in to make a purchase. 
             <a class="link" href="/signup" style="    background: #4f8aff;
                color: white;
                padding: 5px 12px;
                border-radius: 9px;
                font-size: 15px;">SIGN UP</a>
             I already have an account
          </div>
       </div>
    </div>
 </div>
 
<div class="first-section px-lg-5">
  <div class="card">
      <div class="card-body pt-4">
          <h5 class="text-white">@lang('index.text')</h5>

          <div class="row mt-3">
              <div class="col-12 col-md-5">

                  <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white" >@lang('index.name')</small>
                              <input type="text" class="form-control" id="exampleFormControlInput1">
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white" >@lang('index.last_name')</small>
                              <input type="text" class="form-control" id="exampleFormControlInput1">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white" >@lang('index.email')</small>
                              <input type="text" class="form-control" id="exampleFormControlInput1">
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white">@lang('index.country')</small>
                              <div class="select-standard">
                                  <span class="icon"><i class="fas fa-angle-down"></i></span>
                                  {!!Form::select('countryx', $getCountry, '', [ 'id' => 'countryx', 'class' =>
                                    'form-control', 'placeholder' => __('index.form_country') ,
                                    'required'=>'required',
                                    'class' => 'form-control selectpicker' ])!!}
                                </div>
                          </div>
                      </div>
                  </div>
      

              </div>
              <div class="col-12 col-md-7">

                  <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white">@lang('index.buydivisa')</small>
                              <div class="container-select-list">
                                  <div class="icon"> 
                                      <span class="mr-2">{{$getCriptodefault->code}} </span>
                                      <span><i class="fas fa-angle-down"></i></span>
                                  </div>

                                  {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                                    'id' => 'getCryptossss',
                                    'class' => 'selectpicker'
                                    ])
                                !!}
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <small class="text-white" >@lang('index.paydivisa')</small>
                              <div class="container-select-list">
                                  <div class="icon"> 
                                      <span class="mr-2">{{$getCurrencyUser->code}}  </span>
                                      <span><i class="fas fa-angle-down"></i></span>
                                  </div>
                                      {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                                        'id' => 'getCurrenciesssss',
                                        'class' => 'selectpicker'
                                    ])!!}
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-12 col-md-4">
                          <div class="form-group">
                              <small>@lang('index.number_tarjet')</small>
                              <input type="text" class="form-control number" placeholder="---- ---- ---- ----" min="0" max="8" id="number_tarjet" class="number_tarjet">
                          </div>
                      </div>
                      <div class="col-12 col-md-3">
                          <div class="form-group">
                              <small>@lang('index.date_expired')</small>
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
                              <small>@lang('index.cvv')</small>
                              <input type="text" class="form-control number" placeholder="- - -" pattern="\d*" id="cvv" class="cvv" min="0" max="3">
                          </div>
                      </div>
                      <div class="col-12 col-md-3">
                          <div class="form-group">
                              <br>
                             <button  class="btn text-decoration-none button-gradient-blue mx-auto mt-0"  data-toggle="modal" data-target="#exampleModal" > <img class="mr-1" src="{{ asset('assets/img/metodo-pago/Group13.png')}}" alt=""> @lang('index.comprarapido')</button>
                          </div>
                      </div>
                  </div>

              </div>
          </div>

      </div>
  </div>
</div>