<div class="row">
    <div class="col-md-12">
      <div class="form-row">
        <label for="card-element" class="subt" style="margin-top:5px;margin-bottom:5px">
          @lang('index.paycard')
        </label>

      </div>
    </div>
  </div>

<div class="row">
    <div class="col-md-12">
      <div class="form-row" style="{{ (!$paypal_state->status) ? 'display:none !important' : '' }}">
        {{-- Paypal  --}}
        <div class="d-flex justify-content-center" style="margin: 1.5rem 0;">
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paypalModal">
                    <i class="fa fa-paypal"></i> Pay With PayPal
                  </button> -->
          <a href="{{ $paypal_state->url }}" class="btn btn-primary" target="{{ $paypal_state->target }}">
            <i class="fa fa-paypal "></i> Pay With PayPal
          </a>
          <!-- Modal -->
          <div class="modal fade" id="paypalModal" tabindex="-1" role="dialog" aria-labelledby="paypalModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="paypalModalLabel"><i class="fa fa-paypal" aria-hidden="true"></i>
                    PayPal payment
                    steps</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>For paying with PayPal, please follow the next steps:</p>
                  <div class="d-flex justify-content-center align-items-center">
                    <ul class="steps">
                      <li>
                        Step 1
                        <span class="copy">Login to your PayPal account.</span>
                      </li>
                      <li>
                        Step 2
                        <span class="copy">Find “Send money” and write “paypal@damecoins.com” as receiver.</span>
                      </li>
                      <li>
                        Step 3
                        <span class="copy">Send the amount you wish to buy cryptocurrency with. (You can compare
                          how much crypto
                          will it buy you using the inputs
                          for choosing amount). Minimal amount is 500 USD or equivalent. You can send in any
                          currency you
                          wish.</span>
                      </li>
                      <li>
                        Step 4
                        <span class="copy">IMPORTANT:  Choose SEND TO FAMILY OR FRIENDS. If you send us the money
                          in “Buying goods
                          or services” mode, we will
                          immediately refund it back to you. This is a security measure against fraud.</span>
                      </li>
                      <li>
                        Step 5
                        <span class="copy">In transaction notes please write the email you have used to signup to
                          Damecoins.
                          If you have not signed up for a Damecoins account yet, please still write your email
                          there.</span>
                      </li>
                      <li>
                        Step 6
                        <span class="copy">If you hadn’t signed up yet, please go to Damecoins.com/signup and
                          create a free Dc
                          account. USE THE SAME EMAIL you
                          wrote in PayPal transaction notes.</span>
                      </li>
                      <li>
                        Step 7
                        <span class="copy">Complete the payment. Done! We will credit your Damecoins account in
                          less than 12h
                          (usually in less than 1h) when our
                          Financial Department verifies the payment. You will receive an email when your account
                          is credited, so
                          you can login
                          into Dc and purchase any crypto you want.</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center">Or</div>
      </div>
    </div>
  </div>