<div class="col-md-12">
    <div class="card form-crypto">
        <div class="card-body">
            <div class="panel panel-default mt-2">
                <form action="" method="POST" id="paymentPayFlexi" role="form">

                    <div class="panel-body p-2" style="">
                        <div class="row mb-2" style="">
                           
                            <div class="col-md-10">
                                <!--
                                <div class="inner-addon left-addon mb-2">
                                    <i class="fa fa-envelope-o" style="color:rgb(6, 88, 118)"></i>
                                    <input
                                        type="text"
                                        id="clientId"
                                        class="form-control"
                                        value="houltman@gmail.com"
                                        name="clientId"
                                        placeholder="clientId"
                                        style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                        required="required"
                                        aria-required="true"></div>
                                </div>
                              -->
                              <label>Firstname:</label>
                                <div class="col-md-10">
                                    <div class="inner-addon left-addon mb-2">

                                        <input
                                            type="text"
                                            id="firstNamex"
                                            class="form-control"
                                            value=""
                                            name="firstNamex"
                                            placeholder="Firstname"
                                            style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                            required="required"
                                            aria-required="true"></div>
                                    </div>
                                    <label>Lastname:</label>
                                    <div class="col-md-10">
                                        <div class="inner-addon left-addon mb-2">

                                            <input
                                                type="text"
                                                id="lastNamex"
                                                class="form-control"
                                                value=""
                                                name="lastName"
                                                placeholder="Lastname"
                                                style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                                required="required"
                                                aria-required="true"></div>
                                        </div>
                                        <label>Currency:</label>
                                        <div class="col-md-10">
                                            <div class="inner-addon left-addon mb-2">

                                                <input
                                                    type="text"
                                                    id="currency"
                                                    class="form-control"
                                                    value=""
                                                    name="currency"
                                                    placeholder="USD,BTC,GBP"
                                                    style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                                    required="required"
                                                    maxlength="3"
                                                    aria-required="true"></div>
                                            </div>
                                            <label>Amount:</label>
                                            <div class="col-md-10">
                                                <div class="inner-addon left-addon mb-2">

                                                    <input
                                                        type="text"
                                                        id="amount"
                                                        class="form-control"
                                                        value=""
                                                        name="amount"
                                                        placeholder="amount"
                                                        style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                                        required="required"
                                                        max="5"
                                                        aria-required="true"></div>
                                                </div>
                                                <!--
                                                <div class="col-md-10">
                                                    <div class="inner-addon left-addon mb-2">

                                                        <input
                                                            type="text"
                                                            id="fundingSourceName"
                                                            class="form-control"
                                                            value="BTC"
                                                            name="fundingSourceName"
                                                            placeholder="btc"
                                                            style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                                            required="required"
                                                            aria-required="true"></div>
                                                    </div>

                                                  -->
<!--
                                                    <div class="col-md-10">
                                                        <div class="inner-addon left-addon mb-2">

                                                            <input
                                                                type="text"
                                                                id="returnUrl"
                                                                class="form-control"
                                                                value="https://success.damecoins.com/"
                                                                name="returnUrl"
                                                                placeholder="btc"
                                                                style="border-radius: 4px; margin-bottom:20px;padding-left: 35px;font-size: 14px;"
                                                                required="required"
                                                                aria-required="true"></div>
                                                        </div>
                                                      -->

                                                        <!-- <div class="inner-addon left-addon"> <i class="fa fa-credit-card"
                                                        style="color:rgb(6, 88, 118)"></i> <input type="text" class="form-control"
                                                        value="411111111111" name="card" id="cc" placeholder="Card Number"
                                                        style="border-radius: 4px;padding-left: 35px;font-size: 14px;"
                                                        onkeypress="return checkDigit(event)" required="required" aria-required="true">
                                                        </div> <div style="display: flex"> <div class="inner-addon left-addon"> <i
                                                        class="fa fa-calendar-o" style="color:rgb(6, 88, 118)"></i> <input
                                                        name="code_expire_month" id="mm" value="12" type="tel" pattern="[0-9]*"
                                                        spellcheck="false" autocapitalize="none" autocorrect="off" class="form-control
                                                        valid" placeholder="Mes(MM)" title="Month(MM)" maxlength="2"
                                                        aria-required="true" autocomplete="cc-exp-month" style="border-radius:
                                                        4px;padding-left: 35px;font-size: 14px;" aria-invalid="false"> </div> <div
                                                        class="inner-addon left-addon"> <i class="fa fa-calendar" style="color:rgb(6,
                                                        88, 118)"></i> <input name="code_expire_year" id="yy" value="2020" type="tel"
                                                        pattern="[0-9]*" spellcheck="false" autocapitalize="none" autocorrect="off"
                                                        class="form-control" placeholder="Year(AA)" title="Year(AA)" maxlength="4"
                                                        aria-required="true" autocomplete="cc-exp-year" style="border-radius:
                                                        4px;padding-left: 35px;font-size: 14px;"> </div> </div> <div class="inner-addon
                                                        left-addon"> <i class="fa fa-lock" style="color:rgb(6, 88, 118)"></i> <input
                                                        type="text" class="form-control"id="cv" value="123" name="cvv" placeholder="CVV"
                                                        style="margin-bottom:20px;padding-left: 35px;font-size: 14px;" maxlength="4"
                                                        required="required" aria-required="true"> </div> <input type="hidden"
                                                        name="currency" id="currency" value="USD"> <div id="errorPlacement"
                                                        style="font-size: 14px; color: red; display: none; flex-direction:
                                                        column;"></div> </div> -->
                                                        <div class="col-md-12 mt-2">
                                                            <button
                                                                class="btn btn-success btn-block mb-4 font-weight-bold"
                                                                id="confirm-purchase">Buy Cryptos
                                                            </button>

                                                        </div>

                                                        @if (Session::has('success'))
                                                        <div class="alert alert-success mt-4">
                                                            <center>{{Session::get('success') }}</center>
                                                        </div>
                                                        @endif @if (Session::has('danger'))
                                                        <div class="alert alert-danger mt-4">
                                                            <center>
                                                                {{ Session::get('danger') }}
                                                            </center>
                                                        </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

 <script>
 document.querySelector('#paymentPayFlexi').addEventListener('submit', function (event) {
  event.preventDefault();

    flexi={
      "firstName":$("#firstNamex").val(),
      "lastName":$("#lastNamex").val(),
      "clientId" :$("#firstNamex").val()+"-"+Math.random(),
      "currency":$("#currency").val(),
      "amount" :$("#amount").val(),
      "fundingSourceName":"BTC3",
      "returnUrl" :"https://success.damecoins.com/",
    };
  var ajax = $.ajax({
    	 url: "https://pay.damecoins.com/preparePost",
    	 method: 'post',
    	 data: flexi,
    	 dataType: 'json',
    });

    ajax.done(function (res) {
      mcTxId=res.mcTxId;
      secretId=res.secretId;
      window.location="https://pay.damecoins.com/BTC3/Start?mcTxId="+mcTxId;

    })
    ajax.fail(function() {
         console.log("fail");
    });



});
 </script>