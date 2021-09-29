@extends('layouts.admin_new') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible " role="alert">
           <strong>!</strong> {{ Session::get('success') }}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
   @endif
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $pendiente->pendiente }} </h3>
              <p>Pendientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('admin/balance') }}" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ General::countUser() }}</h3>
                <p>usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
  </section>  

</div>  
<!-- section -->
<!--
<section class="hero-section">
    <div class="container">
    <h1>Balance</h1>
<div class="col-sm-4">
  <p>no procesados  {{ $pendiente->pendiente }} </p>
  <p>Totales   {{ $total->total }} </p>
  <a href=>ver</a>
</div>
    
    </div>
</section>
-->
<!--section end -->
@endsection