
 @if(Session::has('successdetails'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('successdetails') }}
          </div>
        @endif
<form action="{{ url('admin/stripe-account-details') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" value='{{$stripe->id}}' name="stripe_account_id">
                     
                '','bank_id',''
      
                <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('retencions') ? ' has-error' : '' }}">
                    <label class="control-label">retencions</label>

                    <div class="">
                    {!!Form::select('retencions', [0 => 'No',1=>'Si',], '', [
                                        'id' => 'retencions',
                                        'class' => 'form-control'
                                    ])!!}
                        @if ($errors->has('retencions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('retencions') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>   

            <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('mounts') ? ' has-error' : '' }}">
                    <label class="control-label">monto</label>

                    <div class="">
                    <input id="mounts" type="text" class="form-control"  name="mounts" value="{{ old('mounts') }}">
               
                        @if ($errors->has('mounts'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mounts') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
             </div> 

             <div class="row">
                <div class="col-md-8 form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    <label class="control-label">Fecha</label>

                    <div class="">
                    <input id="fecha" type="date" class="form-control"  name="fecha" value="{{ old('fecha') }}">
               
                        @if ($errors->has('fecha'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
             </div> 

            <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                    <label class="control-label">Banks</label>
                    <div class="">
                    {!!Form::select('bank_id', $banks, '', [
                                        'id' => 'bank_id',
                                        'class' => 'form-control'
                                    ])!!}
                        @if ($errors->has('bank_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bank_id') }}</strong>
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