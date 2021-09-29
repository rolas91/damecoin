<style>
    .button-color{
        background-color: #23d160;
        padding: 10px;
        border-radius: 14px;
        box-shadow: 1px 2px 11px 0px #7ee0a0;
        cursor: pointer;
        margin-right: 20px;
        background: linear-gradient(360deg, rgb(19 222 89) 0%, rgb(148 232 14) 100%);
        box-shadow: 1px 2px 11px 6px #56ca7d8f;
        width: 135px;
        height: 95px;
        border: 0px;
    }

    .form-class1{
        width: 140px!important;
        margin-left: 23px!important;
    }

    .form-class{
        width: 140px!important;
        margin-left: 15px!important;
    }

    .form-class2{
        width: 140px!important;
        margin-left: 15px!important;
    }

    .row-form {
    display: -webkit-box!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -ms-flex-wrap: wrap!important;
    flex-wrap: wrap!important;
    margin-right: -3px!important;
    margin-left: -15px!important;
    width: 100%;
}
</style>

<div class="row justify-content-center p-2">
    <h6 for="card-element" class="subt" style="margin-top:5px;margin-bottom: 19px;padding: 0 25px;display: block;width: 100%;font-size: 16px;color: #717171;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;text-align: left;">Please chose the amount to pay by credit/debit card</h6>
    <div class="row-form">
        <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8" class="form-class1">
            <button class="button-color">
                <p style="margin-bottom: 0;color: white;font-size: 18px; ">
                    CHARGE
                </p>
                <p style="font-size: 25px;color: #12582a;font-weight: bold; ">
                    300 USD
                </p>
            </button>
            <input name="buttonId" type="hidden" value="BwZNXyJ02KT2HON667h74pHM4zdDwPgGysr1anv9Z2epqlEfXEXiEg=="/>
            <input name="merchantId" type="hidden" value="676646"/>
            <input name="accountId" type="hidden" value="679389"/>
            <input name="description" type="hidden" value="300 USD topup "/>
            <input name="referenceCode" type="hidden" value="234672"/>
            <input name="amount" type="hidden" value="300.00"/>
            <input name="tax" type="hidden" value="0.00"/>
            <input name="taxReturnBase" type="hidden" value="0.00"/>
            <input name="currency" type="hidden" value="USD"/>
            <input name="lng" type="hidden" value="en"/>
            <input name="approvedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="declinedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="pendingResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="paymentMethods" type="hidden" value="MASTERCARD-1,DINERS-1,CODENSA-1,VISA-1,AMEX-1,VISA_DEBIT"/>
            <input name="displayBuyerComments" type="hidden" value="true"/>
            <input name="buyerCommentsLabel" type="hidden" value="es:El email de su cuenta de DC o cuenta futura para que podamos vincularle el pago|en:The email of your DC account / future account so we can link the payment to you.|pt:O e-mail de sua conta DC / conta futura para que possamos vincular o pagamento."/>
            <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
            <input name="buttonType" value="SIMPLE" type="hidden"/>
            <input name="signature" value="09981f620c9325fb76665bbdbbc9853dbde70c5998200992367bb4b5b95e1aad" type="hidden"/>
        </form>
        <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8" class="form-class">
            {{-- <input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/btn-pagar-eng-peq.png" onClick="this.form.urlOrigen.value = window.location.href;"/> --}}
            <button class="button-color">
                <p style="margin-bottom: 0;color: white;font-size: 18px; ">
                    CHARGE
                </p>
                <p style="font-size: 25px;color: #12582a;font-weight: bold; ">
                    700 USD
                </p>
            </button>
            <input name="buttonId" type="hidden" value="rAzIIhiIngIgMVgcrT6jOrz9z5Lv5NDk88Dmj0tbZ0vVrIBj/1wJaQ=="/>
            <input name="merchantId" type="hidden" value="676646"/>
            <input name="accountId" type="hidden" value="679389"/>
            <input name="description" type="hidden" value="700 USD topup "/>
            <input name="referenceCode" type="hidden" value="234673"/>
            <input name="amount" type="hidden" value="700.00"/>
            <input name="tax" type="hidden" value="0.00"/>
            <input name="taxReturnBase" type="hidden" value="0.00"/>
            <input name="currency" type="hidden" value="USD"/>
            <input name="lng" type="hidden" value="en"/>
            <input name="approvedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="declinedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="pendingResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="paymentMethods" type="hidden" value="MASTERCARD-1,DINERS-1,CODENSA-1,VISA-1,AMEX-1,VISA_DEBIT"/>
            <input name="displayBuyerComments" type="hidden" value="true"/>
            <input name="buyerCommentsLabel" type="hidden" value="es:El email de su cuenta de DC o cuenta futura para que podamos vincularle el pago|en:The email of your DC account / future account so we can link the payment to you.|pt:O e-mail de sua conta DC / conta futura para que possamos vincular o pagamento."/>
            <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
            <input name="buttonType" value="SIMPLE" type="hidden"/>
            <input name="signature" value="1b80a267d7231e2cf3689b32acd746aad3ce2c13d8dd042f52af0a7a0d3add2e" type="hidden"/>
        </form>
        <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8" class="form-class2">
            <button class="button-color">
                <p style="margin-bottom: 0;color: white;font-size: 18px; ">
                    CHARGE
                </p>
                <p style="font-size: 25px;color: #12582a;font-weight: bold; ">
                    1400 USD
                </p>
            </button>
            <input name="buttonId" type="hidden" value="INFeWv6OpmVgrb54MZG+BMFRuhMpwAOVUTtYtd/TY/1vCSe+6Kc61Q=="/>
            <input name="merchantId" type="hidden" value="676646"/>
            <input name="accountId" type="hidden" value="679389"/>
            <input name="description" type="hidden" value="1400 USD topup "/>
            <input name="referenceCode" type="hidden" value="2346788"/>
            <input name="amount" type="hidden" value="1400.00"/>
            <input name="tax" type="hidden" value="0.00"/>
            <input name="taxReturnBase" type="hidden" value="0.00"/>
            <input name="currency" type="hidden" value="USD"/>
            <input name="lng" type="hidden" value="en"/>
            <input name="approvedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="declinedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="pendingResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="paymentMethods" type="hidden" value="MASTERCARD-1,DINERS-1,CODENSA-1,VISA-1,AMEX-1,VISA_DEBIT"/>
            <input name="displayBuyerComments" type="hidden" value="true"/>
            <input name="buyerCommentsLabel" type="hidden" value="es:El email de su cuenta de DC o cuenta futura para que podamos vincularle el pago|en:The email of your DC account / future account so we can link the payment to you.|pt:O e-mail de sua conta DC / conta futura para que possamos vincular o pagamento."/>
            <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
            <input name="buttonType" value="SIMPLE" type="hidden"/>
            <input name="signature" value="ea0db874d707e32cda3d7847b0ceaa414c0c7163c521b3029645303e9f49535e" type="hidden"/>
        </form>
        <form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8" class="form-class2">
            <button class="button-color">
                <p style="margin-bottom: 0;color: white;font-size: 18px; ">
                    CHARGE
                </p>
                <p style="font-size: 25px;color: #12582a;font-weight: bold; ">
                    3000 USD
                </p>
            </button>
            <input name="buttonId" type="hidden" value="sUriCGrDtohLsQydw7ui7+0Fx8ynumuVoyN1VhIVdFsEC24MpQW+TA=="/>
            <input name="merchantId" type="hidden" value="676646"/>
            <input name="accountId" type="hidden" value="679389"/>
            <input name="description" type="hidden" value="3000 USD topup "/>
            <input name="referenceCode" type="hidden" value="2346789"/>
            <input name="amount" type="hidden" value="3000.00"/>
            <input name="tax" type="hidden" value="0.00"/>
            <input name="taxReturnBase" type="hidden" value="0.00"/>
            <input name="currency" type="hidden" value="USD"/>
            <input name="lng" type="hidden" value="en"/>
            <input name="approvedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="declinedResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="pendingResponseUrl" type="hidden" value="https://damecoins.com/signup"/>
            <input name="paymentMethods" type="hidden" value="MASTERCARD-1,DINERS-1,CODENSA-1,VISA-1,AMEX-1,VISA_DEBIT"/>
            <input name="displayBuyerComments" type="hidden" value="true"/>
            <input name="buyerCommentsLabel" type="hidden" value="es:El email de su cuenta de DC o cuenta futura para que podamos vincularle el pago|en:The email of your DC account / future account so we can link the payment to you.|pt:O e-mail de sua conta DC / conta futura para que possamos vincular o pagamento."/>
            <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
            <input name="buttonType" value="SIMPLE" type="hidden"/>
            <input name="signature" value="ea663d4da58424a35499a4f8487d8adc820ee3755b0239b539c2cbeb3ab0068a" type="hidden"/>
        </form>
    </div>
    <div class="align-self-center">
        <img class="img-responsive" style="height:50px;margin-top: 18px;" src="https://damecoins.com/img/kindpng.png">
    </div>
</div>