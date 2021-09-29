@if (!Auth::user()->hasVerifiedPhone())
    <link href="{{ asset('tel/intlTelInput.css') }}" rel="stylesheet" type="text/css">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> </h4>


                <button class="btn" data-toggle="modal" data-target="#modal-tarjetas">check your phone now</button>
            </div>
        </div>
    </div>
    <!-- Modal modal tarjetas -->
    <div class="modal fade modal-custom-comprar" id="modal-tarjetas" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">validate your phone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p style="text-center">To make purchases, you must validate your phone number. We will send you a verification code by
                        SMS.</p>

                    <div class="select-tarjeta">

                        <div class="card-tarjeta">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center" id="numberx" style="display: none;color:red"></p>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="tel" value="" id="phone" name="phone"
                                        onKeyPress="return soloNumeros(event)"
                                        class="form-control  mb-3 mb-md-0 mb-lg-0" required="required"
                                        placeholder="@lang('index.form_phone')">
                                        <br>
                                    <span id="valid-msg" class="hide">✓</span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                                <div class="col-12 d-flex  justify-content-center" >
                                <p class="text-center">Enter the confirmation code</p>
                                </div>
                                <div class="col-12 d-flex  justify-content-center" >
                                    
                                    <input style="width: 280px" type="text" id="code" name="code" class="form-control" disabled>

                                </div>
                                <div class="col-12 d-flex  justify-content-center" style="margin: 8px;">
                                <button type="button" onclick="getCode()"
                                    class="btn text-white btn-info-gradient  mx-auto" id="getx">
                                    Get confirmation code</button>


                                <button type="button" onclick="validate()" style="display: none"
                                    class="btn text-white btn-info-gradient  mx-auto" id="validatex">
                                    validate code </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('tel/intlTelInput.js') }}"></script>

    <script>
        $("#code").val("");
        var input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");
        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        $("#phone").val("{{ Auth::user()->phone }}");
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        // var input = document.querySelector("#phone");
        // var errorMsg = document.querySelector("#error-msg");
        //var validMsg = document.querySelector("#valid-msg");
        //var contry=
        var iti = window.intlTelInput(input, {
            initialCountry: "ve",
            // any initialisation options go here
            utilsScript: "{{ asset('tel/utils.js') }}"
        });
        // on blur: validate
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
        var invertalId = null;

        function getCode() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {

                    var data = {
                        'phone': iti.getNumber(),
                        "_token": "{{ csrf_token() }}"
                    }
                    var ajax = $.ajax({
                        url: "/dash/getcode",
                        method: 'post',
                        data: data,
                        dataType: 'json'
                    });
                    ajax.done(function(data) {
                        if (data.error == "true") {
                            swal({
                                text: data.code,
                                icon: "error"
                            });
                        }

                        if (data.success == "false") {
                            swal({
                                text: data.code,
                                icon: "error"
                            });
                        }

                        if (data.success == "true") {
                            enviaCode();
                            var n = 180;
                            var l = document.getElementById("numberx");
                            invertalId = setInterval(function() {
                                l.innerHTML = n;
                                if (n == 0) {
                                    n=180;
                                    stopInterval();
                                }
                                n--;
                            }, 1000);
                           
                        }

                    })
                    ajax.fail(function(err) {
                        console.log(err);
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            //console.log(err.responseJSON);
                            swal({
                                text: "{{ __('index.form_error') }}",
                                icon: "error"
                            });
                        }
                    });
                    //validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                    swal({
                        text: "movil invalido",
                        icon: "error"
                    });
                }
            }
        }

        function stopInterval() {
            $("#numberx").css('display', "none");
            clearInterval(invertalId);
            activaCode();
        }

        function validate() {
            var code = $("#code").val();
            if (code == "") {
                swal({
                    text: "Invalid Code",
                    icon: "error"
                });
                return;
            }
            var data = {
                'code': code,
                "_token": "{{ csrf_token() }}"
            }
            var ajax = $.ajax({
                url: "/dash/validphone",
                method: 'post',
                data: data,
                dataType: 'json'
            });
            ajax.done(function(data) {
                if (data.error == "true") {
                    swal({
                        text: data.code,
                        icon: "error"
                    });
                }
                if (data.success == "true") {
                    swal({
                        text: data.code,
                        icon: "success"
                    });
                    location.reload();
                }


            })
            ajax.fail(function(err) {
                console.log(err);
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    //console.log(err.responseJSON);
                    swal({
                        text: "{{ __('index.form_error') }}",
                        icon: "error"
                    });
                }
            });


        }

        function activaCode() {
            
            $("#code").attr('disabled');
            $("#getx").css('display', "block");
            $("#validatex").css('display', "none");

        }


        function enviaCode() {
            $("#numberx").css('display', "block");
            $("#code").removeAttr('disabled');
            $("#getx").css('display', "none");
            $("#validatex").css('display', "block");
        }

        function intervalox(x) {
            //console.log(x);
            contador = x;
            if (x < 80) {
                saltarCodigo = true;
            };
            /*
                if(x==0){
                  clearInterval(this.interval);
                  this.getCodigo=false;

                  let alert = this.alertCtrl.create({
                    title: "Información",
                    subTitle: "El tiempo ha expirado, obtenga un nuevo código de confirmación",
                    buttons: ['OK']
                  });
                  alert.present();
                }
                */
            // console.log(x);
        }

    </script>
@endif
