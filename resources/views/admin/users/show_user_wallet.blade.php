@extends('layouts.admin_new') 

@section('content')
<!-- section -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Usuarios Wallets
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/users"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">list</li>
      </ol>
    </section>

    <section class="content">
		 <!--cripto Wallet-->
		<h2> {{ $user->email }} {{ $user->firsName }} {{ $user->lastName }} </h2>
		 <div class="row">
				@forelse($wallets as $crypto)
					<div class="col-sm-12 col-md-6">
						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title"><img style="width:50px;height:50px" src="{{ asset('uploads/img') }}/{{ $crypto['crypto']->img }}" alt=""> {{$crypto['crypto']->code}}</h3>
								<!-- /.box-tools -->
							</div>
							<!-- /.box-header -->
							<div class="box-body">
	
							<div class="row" style="margin:0;padding:0;">
						   
								<div class="col-sm-6 col-md-5">
								 
									<?php //$z = General::getCryptoUser($crypto->id);?>
									<h4 style="margin:0;color:#367fa9;font-weight:bold">  {{ $crypto['amount'] }} {{$crypto['crypto']->code}}
									</h4>
	
									<p style="font-size:15px;color:#4dcbea">{{$crypto['crypto']->name }}</p>
									
								</div>
								<div class="col-sm-6 col-md-7" style="">
								
									<div class="row" style="margin:0;padding:0;">
									<div class="col-sm-12 col-md-12">
											<a class="btn btn-block btn-primary" href="/admin/users-retirar/{{ $user->id }}/{{ $crypto['crypto']->id}}"> 
												retirar {{$crypto['crypto']->code}} a wallets externo</a>
										</div>
										
									</div>
									
									
									
								</div>
								
	
							</div>
							
						 </div>
						  <!-- /.box-body -->
				</div>
						<!-- /.box -->
			</div>
				@empty
					<p></p>
				@endforelse
			</div>

          

    </section>


  
</div>
    
<!--section end -->
@endsection