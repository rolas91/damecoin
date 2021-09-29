<div class="col-12 col-lg-6">
     <div class="card card-blue">
         <div class="card-header">
            
             @lang('dashboard_perfil.person_data')
         </div>
         <div class="card-body">
               <form action="/dash/profile/{{ $user->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                  <small>  @lang('dashboard_perfil.name')</small>
                  <div class="mb-3 input-group-custom-buton">
                      <input type="text"  value="{{ $user->name }}" name="name" value="{{ old('name') }}" class="form-control input-background-custom" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                
                  </div>

                  <small>@lang('dashboard_perfil.lastname')</small>
                  <div class=" mb-3 input-group-custom-buton">
                      <input type="text" value="{{ $user->lastName }}" name="lastName" value="{{ old('lastName') }}" class="form-control input-background-custom" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">

                  </div>

                  <small>@lang('dashboard_perfil.phone')</small>
                  <div class=" mb-3 input-group-custom-buton">
                      <input type="text" value="{{ $user->phone }}" name="phone" value="{{ old('phone') }}" class="form-control input-background-custom" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">

                  </div>

                  <small>@lang('dashboard_perfil.country')</small>
                  <div class="input-group input-dropdown-custom">
                    {!!Form::select('country_id', $getCountry, $user->country_id, [
                         'id' => 'getCountry',
                         'class' => 'form-control',
                         'placeholder' => 'País',
                         'required'=>'required'
                     ])!!}
                     <!--
                      <input type="text" class="form-control color-gray input-background-custom" aria-label="Text input with dropdown button" value="Colombia">
                      <span class="icon-input-text"><img src="{{asset('newdesign/assets/img/perfil/icon-pais.png')}}" alt=""></span>
                     -->
                      <div class="input-group-append">
                    
                      </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-add-tarjeta mx-auto mt-3"  >
                    <small class="text-white">
                    @lang('dashboard_perfil.btn_update')
                    </small>
                  </button>

               </form>
         </div>
       </div>
 </div>
 