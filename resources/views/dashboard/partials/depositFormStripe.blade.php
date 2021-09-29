<div class="row" style="border:solid 2px blue">
      <div class="col-md-8" >

        <div class="tab-content theme-tab-profile-content theme-profile-bg">
          <div role="tabpanel" class="{{App::getLocale() != 'ch' ? 'tab-pane active':'tab-pane'}}" id="favourite">
            <ul class="media-list" id="profileFavouritesList">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-row">
                    <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
                      @lang('index.paycard')
                    </label>
                    <div id="card-element" style="margin:8px!important">
                      <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert" style="color:red"></div>
                  </div>

                  <div class="paymentVender" style="margin-bottom: 20px;margin-left:0px;">
                    <ul style="display: flex;list-style: none;margin-left:0px;">
                      <li style="align-items: center;display: flex"><img src="{{asset('img/vender5.png')}}" alt=""
                          width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender6.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender1.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender2.png')}}" alt="" width="80px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender3.png')}}" alt="" width="50px"></li>
                      <li style="margin-left:10px;align-items: center;display: flex"><img
                          src="{{asset('img/vender4.png')}}" alt="" width="80px"></li>
                    </ul>
                  </div>
                </div>

              </div>

              <div class="row" style="margin:4px">
                @if (!$stripe_state->state)
                <div class="alert alert-warning" role="alert">
                  Apologizes, our card payment sistem is currently under maintenance. Please come back later to purchase
                  crypto using credit or debit card. If you need to purchase right now, plase ask our 24/7 Chat Support about payment by bank transfer or PayPal ! Thank you for choosing Damecoins.
                </div>
                @endif
                <div class='col-sm-5'>
                  <p style="text-align:justify">@lang('home_deposit.mesagge1',["currency"=>$default->code]) </p>
                  <p style="text-align:justify">@lang('home_deposit.mesagge2') </p>
                  <p style="text-align:justify">@lang('home_deposit.mesagge3') </p>

                </div>
                <div class='col-sm-7'>
                  <input type="hidden" name='currency' value=" {{$default->id}}">
                  <p class="final">@lang('home_deposit.total') <span id="total"> </span> {{$default->code}}</p>
                  {{--  <p class="final">@lang('home_deposit.comision') {{ $default->detailCurrency->comision_abono }}%: <span
                      id="comision"></span> {{$default->code}}</p>  --}}
                  <button type="submit" id="xxx" class='btn btn-warning mibuttom pull-right'
                    {{!$stripe_state->state ? 'disabled': ''}}>@lang('home_deposit.bottondeposit')
                    {{$default->code}}</button>
                </div>
              </div>
              </form>

            </ul>
          </div>

          <div role="tabpanel" class="{{App::getLocale() == 'ch' ? 'tab-pane active':'tab-pane '}}" id="settings"
            style="margin-bottom:20px;">

            <center>
              <div style="display:inline-grid;margin-top: 40px;margin-bottom:40px">
                <img src="{{asset('img/wechatpay.png')}}" alt="" width="250px" style="margin-bottom:20px">
                <button class="btn btn-success" id="wechat" {{!$stripe_state->state ? 'disabled': ''}}>Pay</button>
              </div>
            </center>

            <div class="row" style="margin:4px">
              @if (!$stripe_state->state)
              <div class="alert alert-warning" role="alert">
                Apologizes, our card payment sistem is currently under maintenance. Please come back later to purchase
                crypto using credit or debit card ! Thank you for choosing Damecoins.
              </div>
              @endif
              <div class='col-sm-5'>
                <p style="text-align:justify">@lang('home_deposit.mesagge1',["currency"=>$default->code]) </p>
                <p style="text-align:justify">@lang('home_deposit.mesagge2') </p>
                <p style="text-align:justify">@lang('home_deposit.mesagge3') </p>

              </div>
              <div class='col-sm-7'>
                <input type="hidden" name='currency' value=" {{$default->id}}">
                <p class="final">@lang('home_deposit.total') <span id="total2"> </span> {{$default->code}}</p>
                {{--  <p class="final">@lang('home_deposit.comision') {{ $default->detailCurrency->comision_abono }}%: <span
                    id="comision2"></span> {{$default->code}}</p>  --}}
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>