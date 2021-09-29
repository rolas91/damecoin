<div class="container py-4">
    <h2 class="font-weight-bold text-center ">@lang('index.preguntasfrec')</h2>
    <div class="row mt-4">
        <div class="col-12 col-md-6">
              <div class="accordion acordion-preguntas" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @lang('index_questions.q1')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      @lang('index_questions.r1')
                    </div>
                  </div>
                </div>
                <div class="card mt-3">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        @lang('index_questions.q2')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                      @lang('index_questions.r2') 
                    </div>
                  </div>
                </div>
                <div class="card mt-3">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        @lang('index_questions.q3')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                      @lang('index_questions.r3')
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-12 col-md-6">
             <div class="accordion acordion-preguntas" id="accordionExample2">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">
                        @lang('index_questions.q4')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapse4" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample2">
                    <div class="card-body">
                      @lang('index_questions.r4')
                    </div>
                  </div>
                </div>
                <div class="card mt-3">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseTwo">
                        @lang('index_questions.q6')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
                    <div class="card-body">
                      @lang('index_questions.r6')
                    </div>
                  </div>
                </div>
                <div class="card mt-3">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
                        @lang('index_questions.q8')
                        <span class="icon"><i class="fas fa-angle-down"></i></span>
                      </button>
                    </h2>
                  </div>
                  <div id="collapse6" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample2">
                    <div class="card-body">
                      @lang('index_questions.r8')
                    </div>
                  </div>
                </div>
             </div>
        </div>
    </div>

</div>