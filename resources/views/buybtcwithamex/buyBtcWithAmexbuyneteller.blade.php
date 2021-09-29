<section id="buy-neteller-instantly">
    <div class="container">
      <h4 class="mb-4">@lang('buyBtcWithAmex.tienes')</h4>

      <div class="row">
        <div class="col-md-6 col-xl-3">
          <label>@lang('buyBtcWithAmex.quiero')</label>

          <div class="form-group form-group-with-select mb-0">
            <input type="text" class="form-control" id="buy" aria-describedby="buyHelp">
            <div class="select-wrapper">
              <select class="form-control">
                <option>@lang('buyBtcWithAmex.btc')</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>

          <small id="buyHelp" class="form-text mb-2">@lang('buyBtcWithAmex.minimun')</small>
        </div>
        <div class="col-md-6 col-xl-3">
          <label>Pagas:</label>

          <div class="form-group form-group-with-select">
            <input type="text" class="form-control" id="pay">
            <div class="select-wrapper">
              <select class="form-control">
                <option>@lang('buyBtcWithAmex.pagas')</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-8 pt-2 col-xl-4">
          <div class="form-group multi-input mt-4 mb-1">
            <img src="{{ asset('img/landing/icons/credit-card.png') }}" class="prefix">
            <input type="text" class="form-control" placeholder="Número de tarjeta" name="card_number">
            <input type="text" class="form-control" placeholder="MM / YY" name="due_date" style="max-width: 25%;">
            <input type="text" class="form-control" placeholder="CVC" name="cvc" style="max-width: 17%;">
          </div>

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="anonymous">
            <label class="form-check-label" for="anonymous">
              <small>@lang('buyBtcWithAmex.goverment')</small>
            </label>
          </div>
        </div>
        <div class="col-md-4 col-xl-2 pl-xl-0 pr-xl-0 pt-2">
          <button type="submit" class="btn btn-light-blue-gradient w-100 mt-4" style="z-index: 1;position: relative;">
              @lang('buyBtcWithAmex.compra')
          </button>
        </div>
      </div>
    </div>
  </section>
