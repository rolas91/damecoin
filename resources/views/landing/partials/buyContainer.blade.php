<div class="row" id="buyContainer" >

          <div class="col-md-6">
             <h6>@lang('index.buydivisa')</h6>
             <div class="form-group form-group-with-select mb-0">
                <div class="form-control" id="buy" aria-describedby="buyHelp"  style="width: 152px;" >{{$getCriptodefault->code}}</div>
                <div class="select-wrapper">
                   {!!Form::select('getCryptos', $getCryptos, $getCriptodefault->code, [
                   'id' => 'getCryptos',
                   'class' => 'form-control',
                   'style' => 'width: 145px'
                   ])!!}
                </div>
             </div>

          </div>
          <div class="col-md-6 p-md-0">
             <h6>@lang('index.paydivisa')</h6>
             <div class="form-group form-group-with-select">
                <div class="form-control" style="width: 152px;" >{{$getCurrencyUser->code}}</div>
                <div class="select-wrapper">
                   {!!Form::select('getCurrencies', $getCurrencies, $getCurrencyUser->code, [
                   'id' => 'getCurrencies',
                   'style' => 'width: 145px',
                   'class' => 'form-control'])!!}
                </div>
             </div>
          </div>
       </div>
       