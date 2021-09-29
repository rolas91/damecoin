<section id="faqs">
    <img src="{{ asset('img/landing/bg/rectangle-blue-rotated.png') }}" class="position-absolute" style="z-index: -1;width: 100%;">
    <div class="container">
      <h2 class="text-dark-primary text-center mb-4">@lang('index_questions.title')</h2>

      <div class="row">
        <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
          <div class="accordion" id="faqsAccordion">
            <div class="card">
              <div class="card-header" id="heading01">
                <h2 class="mb-0">
                  <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#collapse01" aria-expanded="true" aria-controls="collapse01">
                    <span>
                      01
                    </span>
                        @lang('index_questions.q1')
                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse01" class="collapse show" aria-labelledby="heading01" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r1')
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="heading02">
                <h2 class="mb-0">
                  <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse02" aria-expanded="false" aria-controls="collapse02">
                    <span>
                      02
                    </span>
                        @lang('index_questions.q2')
                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse02" class="collapse" aria-labelledby="heading02" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r2') 
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="heading03">
                <h2 class="mb-0">
                  <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                    <span>
                      03
                    </span>
                        @lang('index_questions.q3')
                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r3')
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="heading04">
                <h2 class="mb-0">
                  <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse04" aria-expanded="false" aria-controls="collapse04">
                    <span>
                      04
                    </span>
                        @lang('index_questions.q4')
                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse04" class="collapse" aria-labelledby="heading04" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r4')
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="heading05">
                <h2 class="mb-0">
                  <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse05" aria-expanded="false" aria-controls="collapse05">
                    <span>
                      05
                    </span>
                        @lang('index_questions.q6')
                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse05" class="collapse" aria-labelledby="heading05" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r6')
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="heading06">
                <h2 class="mb-0">
                  <button class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse06" aria-expanded="false" aria-controls="collapse06">
                    <span>
                      06
                    </span>
                    @lang('index_questions.q8')

                    <img src="{{ asset('img/landing/icons/chevron-down.png') }}">
                  </button>
                </h2>
              </div>

              <div id="collapse06" class="collapse" aria-labelledby="heading06" data-parent="#faqsAccordion">
                <div class="card-body">
                    @lang('index_questions.r8')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>