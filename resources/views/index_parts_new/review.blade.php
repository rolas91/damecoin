<section id="testimonials" style="background: url({{ asset('img/landing/bg/testimonials.png') }});">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
          <div class="card">
            <div id="testimonialsCarousel">
              <div class="card-body">
                <p class="text-center">
                  @lang('index_review.p1')
                </p>

                <div class="testimonial">
                  <img src="{{ asset('img/landing/testimonials/03.png') }}" class="avatar">
                  <div class="testimonial-info">
                    <strong>Aaron P. L.</strong>
                    <span>Barcelona, España</span>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <p class="text-center">
                    @lang('index_review.p2')
                </p>

                <div class="testimonial">
                  <img src="{{ asset('img/landing/testimonials/05.png') }}" class="avatar">
                  <div class="testimonial-info">
                    <strong>Jefreyd Bonilla</strong>
                    <span>San Francisco, USA</span>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <p class="text-center">
                    @lang('index_review.p3')
                </p>

                <div class="testimonial">
                  <img src="{{ asset('img/landing/testimonials/02.png') }}" class="avatar">
                  <div class="testimonial-info">
                    <strong>Luciana Sánchez</strong>
                    <span>Medellín, Colombia</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center mt-4">
            <a href="#" id="prevArrowTestimonialCarousel" class="btn btn-light-blue-gradient p-0 mr-2">
              <img src="{{ asset('img/landing/icons/arrow-left.png') }}">
            </a>
            <a href="#" id="nextArrowTestimonialCarousel" class="btn btn-light-blue-gradient p-0">
              <img src="{{ asset('img/landing/icons/arrow-right.png') }}">
            </a>
          </div>
        </div>
      </div>
    </div>
</section>
