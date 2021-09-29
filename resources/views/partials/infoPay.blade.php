<div class="row total">
    	<div class="col-md-12" id="finalx">
    		<p>
    			@lang('index.mesagge1',["divisa"=> $getCriptodefault->code ])
    		</p>
    		<p>
    			@lang('index.mesagge2',["divisa"=> $getCriptodefault->code ])
    		</p>
    		<p>
    			@lang('index.mesagge3',["divisa"=> $getCriptodefault->code ,"currency"=> $getCurrencyUser->code ])
    		</p>
        <p>
    			@lang('index.mesagge4').
    		</p>
		</div>
		
		<section class="invoice">
			<div class="row">
			   <div class="col-xs-12">
				  <h2 class="page-header">
					 <i class="fa fa-globe"></i> @lang('home_deposit.transferencia')
				  </h2>
			   </div>
			</div>
			@if(Session::has('msg'))
			<div class="alert alert-danger alert-dismissible " role="alert">
			   <strong>!</strong> {{Session::get('msg')}}
			   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			   <span aria-hidden="true">&times;</span>
			   </button>
			</div>
			@endif
			@php
			   $i = 0;
			@endphp
			@forelse ($banks as $bank)
			<form action="/processtransfe" method="POST" class="form-horizontal" enctype="multipart/form-data">
			   {{ csrf_field() }}
			   <input type="hidden" name="id" value="{{ $default->id }}">
			   <div class="row invoice-info">
				  <div class="col-sm-6 invoice-col">
					 <p style="font-size:2em"> {{ $bank->title }}</p>
					 <p><span style="font-weight:bold">@lang('home_deposit.destinatario')</span> {{ $bank->destinatary }}</p>
					 <p><span style="font-weight:bold">@lang('home_deposit.banco') </span>{{ $bank->name }}</p>
					 <p><span style="font-weight:bold">@lang('home_deposit.country') </span>{{ $bank->country }}</p>
					 <p><span style="font-weight:bold">@lang('home_deposit.swift')</span>{{ $bank->swift }}</p>
					 <p><span style="font-weight:bold">@lang('home_deposit.acount')</span> {{ $bank->numero_cuenta }}</p>
					 <address>
						{{--    <strong>Damecoins, Inc.</strong><br>Phone: (804) 123-123<br> --}}
						<p><span style="font-weight:bold">Concept: </span> <span style="color:red"> {{$concept}}</span></p>
						Email: info@damecoins.com
					 </address>
				  </div>
				  <div class="col-sm-6 invoice-col">
					 <div class="row">
						<div class="col-sm-6">
						   <label>@lang('home_deposit.totalt')</label>
						   <div class="input-group">
							  <input id="totalT{{$i}}" class='form-control' type="number" name='montot' required
								 autocomplete="off" value="{{ $limit }}" min="{{ $limit }}" onkeyup="totalT({{$i}})">
							  <div class="input-group-prepend">
								 <div class="input-group-text color-input">{{$default->code}}</div>
							  </div>
						   </div>
						</div>
					 </div>
					 <div class="row">
						<div class="col-sm-12">
						   <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
							  <label>@lang('home_deposit.recibo')</label>
							  <div class="col-md-12">
								 <input type="file" name="img" class="form-control" required>
								 @if ($errors->has('img'))
								 <span class="help-block">
								 <strong>{{ $errors->first('img') }}</strong>
								 </span>
								 @endif
							  </div>
						   </div>
						</div>
					 </div>
					 <div class="row">
						<div class='col-sm-12'>
						   <input type="hidden" name='currency' value=" {{$default->id}}">
						   <p class="final">@lang('home_deposit.totalt1') <span id="totalt{{$i}}"> </span> {{$default->code}}</p>
						   <p style="display:none;" class="final">
							  @lang('home_deposit.comisiont'){{ $default->detailCurrency->comision_abono }} %:<span
							  id="comisiont{{$i}}"></span> {{$default->code}} 
						   </p>
						   <p style="text-align:justify">@lang('home_deposit.mesaggetransfe') {{$default->code}} </p>
						</div>
					 </div>
				  </div>
			   </div>
			   <div class="row no-print">
				  <div class="col-xs-12">
					 <button type="submit" class="btn btn-warning pull-right" style="margin-right: 2px;">
					 <i class="fa fa-download"></i> @lang('home_deposit.bottontransfe')
					 </button>
				  </div>
			   </div>
			</form>
			<hr color="#ccc" style="background-color: red!important;">
			@php
				$i++;
			@endphp
			@empty
			@endforelse
		 </section>
</div>