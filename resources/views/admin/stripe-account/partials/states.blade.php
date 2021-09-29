

<script src="{{ asset('js/jquery-2.2.4.min.js') }}" ></script> 
 @if(Session::has('successstate'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('successstate') }}
          </div>
        @endif
<form action="{{ url('admin/stripe-account-states') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" value='{{$stripe->id}}' name="stripe_account_id">
                     

      
                <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label class="control-label">status</label>

                    <div class="">
                    {!!Form::select('status', [0 => 'Inactivo',1=>'Activo',], 'status', [
                                        'placeholder'=>'Status',
                                        'id' => 'status',
                                        'class' => 'form-control'
                                    ])!!}
                        @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>   

            <div class="row">
                <div class=" col-md-8 form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label class="control-label">descripcion</label>
                    <div class="">
                    {!!Form::select('descripcion', [], '', [
                                        'id' => 'descripcion',
                                        'class' => 'form-control',
                                        'disabled'=>'disabled'
                                    ])!!}

                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
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


        <script>

$("#status").change(function () {
        var status = $(this).val();
        if(status=="1"){
                var activo = ["activa-activa", "activa-falta1erPO", "Phone verification after 1st pay", "Phone verification after big payments", "Domain proof","YA PAYOUTS"];
                $("#descripcion").prop("disabled",false);
                activo.sort();
                addOptions("descripcion", activo);
        }
        if(status=="0"){
                var inactivo = [
                    "Autorefund con-1erPO",
                    "cerrada tras 1erPO por risk",
                    "cerrada tras 1erPO por Autorefund",
                    " Signup - Risk impugnable",
                    "Signup - Risk (se deja así)",
                    "Signup - Risk (luchana y perdida)",
                    "Signup - Card verif. (se deja así)",
                    "Signup - Card verif. (luchana y perdida)",
                    "Autorefund pre-1erPO"];
                $("#descripcion").prop("disabled",false);
                inactivo.sort();
                addOptions("descripcion", inactivo);
            }

    });

    // Rutina para agregar opciones a un <select>
function addOptions(domElement, array) {
    $("#descripcion").empty();
 var select = document.getElementsByName(domElement)[0];

 for (value in array) {
  var option = document.createElement("option");
  option.text = array[value];
  select.add(option);
 }
}
        </script>