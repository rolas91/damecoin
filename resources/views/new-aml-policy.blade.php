@extends('layouts.landing', [
  'title' => 'Iniciar Sesión'
])


@section('content')
  <section id="auth" style="background: url({{ asset('img/landing/bg/home.png') }})">
    @include('partials.landing.header')
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-5 d-flex flex-column justify-content-center mb-5 mb-lg-0">
          <h1 class="text-white text-center font-weight-normal">
            Aml Policy
          </h1>
        </div>

        <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-0 col-xl-6 offset-xl-1">
            <img src=" https://damecoins.com/img/about-img.png" alt="">
        </div>
      </div>
    </div>
  </section>
  <div class="w-75" style="margin: 0 auto; color: black !important">
     <h5>DAME Banking Group Ltd. Anti Money Laundering ("AML") and Counter Terrorist Financing ("CTF") Policy</h5>
                                <p>Money laundering is defined as the process where the identity of the proceeds of crime is so disguised that it gives an impression of legitimate income. Criminals specifically target financial services firms through which they attempt to launder criminal proceeds without the firms’ knowledge or suspicion.</p>
                                <p>In response to the scale and effect of money laundering, the European Union has passed Directives designed to combat money laundering and terrorism. These Directives, together with regulations, rules and industry guidance, form the cornerstone of our AML/CTF obligations and outline the offenses and penalties for failing to comply.</p>
                                <p>Whilst DAME Banking Group Ltd. is currently unregulated and does not fall within the scope of the AML/CTF obligations, the senior management have implemented systems and procedures that meet the standards set forth by the European Union. This decision reflects the senior management’s desire to prevent money laundering and not be used by criminals to launder proceeds of crime.</p><br><br>
                                <h5>Anti-Money Laundering (AML) Policy:</h5>
                                <p>The Trigox AML Policy is designed to prevent money laundering by meeting the European standards on combating money laundering and terrorism financing, including the need to have adequate systems and controls in place to mitigate the risk of the firm being used to facilitate financial crime. This AML Policy sets out the minimum standards which must be complied with and includes:</p>
<ul style="color: black !important;">
            <li>Appointing a Money Laundering Reporting Officer (MLRO) who has a sufficient level of seniority and independence,
                and who has responsibility for oversight of compliance with the relevant legislation, regulations, rules and
                industry guidance;</li>

            <li>Establishing and maintaining a Risk-Based Approach (RBA) to the assessment and management of money laundering and
                terrorist financing risks faced by the firm;</li>

            <li>Establishing and maintaining risk-based Customer Due Diligence (CDD), identification, verification and Know Your
                Customer (KYC) procedures, including enhanced due diligence for customers presenting a higher risk, such as
                Politically Exposed Persons (PEPs);</li>

            <li>Establishing and maintaining risk-based systems and procedures for the monitoring of on-going customer
                activity;</li>

            <li>Establishing procedures for reporting suspicious activity internally and to the relevant law enforcement
                authorities as appropriate;</li>
            <li>Maintaining appropriate records for the minimum prescribed periods;</li>
            <li>Providing training for and raising awareness among all relevant employees.</li>
        </ul><br><br>
                                <h5>Sanctions Policy:</h5>
                                <p>Trigox is prohibited from transacting with individuals, companies and countries that are on prescribed sanctions lists. DAME Banking Group Ltd. will therefore screen against United Nations, European Union, UK Treasury and US Office of Foreign Assets Control (OFAC) sanctions lists in all jurisdictions in which we operate.</p>
                                
    </div>
  <div class="d-flex justify-content-center align-items-center">
    <a href="/signup" class="site-btn sb-gradients sbg-line mt-5 mx-auto">@lang('index_about.about_signup')</a>
  </div>
@endsection


@section('scripts')

$("#idioma2").change(function () {
        var lang = $(this).val();
        window.location='/lang/'+lang;
});

@endsection
@section('footer')
  @include('partials.landing.footer')
@endsection