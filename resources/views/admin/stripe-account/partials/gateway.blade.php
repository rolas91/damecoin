
 @if(Session::has('successgateway'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('successgateway') }}
          </div>
        @endif
             <form action="{{ url('admin/gateway-recurly') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" value='{{$stripe->id}}' name="stripe_account_id">
                     
            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('currency_id') ? ' has-error' : '' }}">
                    <label class="control-label">Divisa</label>

                    <div class="">
                    {!!Form::select('currency_id', $currencies, '', [
                    'id' => 'currency_id',
                    'class' => 'form-control'
                ])!!}
                        @if ($errors->has('currency_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
      
              <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('gateway_code') ? ' has-error' : '' }}">
                    <label class="control-label">GatewayCode</label>

                    <div class="">
                    <input id="gateway_code" type="text" class="form-control"  name="gateway_code" value="{{ old('gateway_code') }}">
               
                        @if ($errors->has('gateway_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gateway_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
             </div>    

                <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button> 
                        </div>
                </div>
        </form>