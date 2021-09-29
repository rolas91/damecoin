<div class="second-section corte-1 py-4" id="second-section">
  <div class="container ">
       <h2 class="text-center font-weight-bold ">@lang('index.pagosdispone')</h2>
       <ul class="nav nav-tabs filter-card mt-4" id="myTab" role="tablist">
           <li class="nav-item" role="presentation">
           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#Todos" role="tab" aria-controls="Todos" aria-selected="true">@lang('index.todos')</a>
           </li>
           <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Automaticos" role="tab" aria-controls="Automaticos" aria-selected="false">@lang('index.auto')</a>
           </li>
           <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Manuales" role="tab" aria-controls="Manuales" aria-selected="false">@lang('index.manual')</a>
           </li> -->
       </ul>
       <div class="tab-content" id="myTabContent">
           <div class="tab-pane fade show active" id="Todos" role="tabpanel" aria-labelledby="home-tab">
      
               <div class="row d-flex justify-content-center">

                   @if (count($metodos) > 0)
                       @foreach ($metodos as $item)    
                           <div class="col-12 col-md-6 col-lg-4 mt-4">
                               <div class="card card-metodo-pago">
                                   <div class="card-header d-flex justify-content-between align-items-start ">
                                   <span><img class="img-fluid" src="/{{$item->file}}"  style="height:50px; width: 50px;" alt=""></span> 

                                   @if($item->state == 1)
                                   <span class="tipo bg-green">@lang('index.auto')</span>
                                   @else
                                   <span class="tipo bg-blue">@lang('index.manual')</span>
                                   @endif
                                   </div>
                                   <div class="card-body pt-0">
                                       <h5 class="card-title "><strong>{{ $item->name }}</strong></h5>
                                       <p class="card-text">
                                           {{ $item->description }}
                                       </p>
                                       @if($item->name == 'mercadopago')
                                       <a href="{{ url(__('route.mercadopago', ['crypto' => "btc", 'metodo' => $item->name ])) }}" class="btn-link">@lang('index.showmethod')<span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                       
                                        @else
                                        <a href="{{ url(__('route.metodo', ['crypto' => "btc", 'divisa' => 'usd','method' => $item->name  ])) }}" class="btn-link">@lang('index.showmethod')<span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                       @endif
                                       
                                   </div>
                               </div>
                           </div>
                       @endforeach    
                   @endif                      
               </div>
      
           </div>
           <!-- <div class="tab-pane fade" id="Automaticos" role="tabpanel" aria-labelledby="profile-tab">
               <div class="row d-flex justify-content-center">
                   @if (count($metodos) > 0)
                       @foreach ($metodos as $item)  
                           @if ($item->state == 1)
                               <div class="col-12 col-md-6 col-lg-4 mt-4">
                                   <div class="card card-metodo-pago">
                                       <div class="card-header d-flex justify-content-between align-items-start ">
                                       <span><img class="img-fluid" src="/{{$item->file}}" alt=""></span> 

                                       @if($item->state == 1)
                                       <span class="tipo bg-green">@lang('index.auto')</span>
                                       @else
                                       <span class="tipo bg-blue">@lang('index.manual')</span>
                                       @endif
                                       </div>
                                       <div class="card-body pt-0">
                                           <h5 class="card-title "><strong>{{ $item->payment_method }}</strong></h5>
                                           <p class="card-text">
                                               {{ $item->description }}
                                           </p>
                                           <a href="#" class="btn-link">@lang('index.showmethod') <span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                       </div>
                                   </div>
                               </div>
                           @endif
                       @endforeach    
                   @endif
               </div>
           </div>
           <div class="tab-pane fade" id="Manuales" role="tabpanel" aria-labelledby="contact-tab">
               <div class="row d-flex justify-content-center">
                   
                   @if (count($metodos) > 0)
                       @foreach ($metodos as $item)  
                           @if ($item->state == 0)
                               <div class="col-12 col-md-6 col-lg-4 mt-4">
                                   <div class="card card-metodo-pago">
                                       <div class="card-header d-flex justify-content-between align-items-start ">
                                       <span><img class="img-fluid" src="/{{$item->file}}" alt=""></span> 

                                       @if($item->state == 1)
                                       <span class="tipo bg-green">>@lang('index.auto')</span>
                                       @else
                                       <span class="tipo bg-blue">@lang('index.manual')</span>
                                       @endif
                                       </div>
                                       <div class="card-body pt-0">
                                           <h5 class="card-title "><strong>{{ $item->payment_method }}</strong></h5>
                                           <p class="card-text">
                                               {{ $item->description }}
                                           </p>
                                           <a href="#" class="btn-link">@lang('index.showmethod') <span class="ml-2"><i class="fas fa-chevron-right"></i></span></a>
                                       </div>
                                   </div>
                               </div>
                           @endif
                       @endforeach    
                   @endif
               </div>
           </div> -->
       </div>
  </div>
</div>