@extends('layouts.admin_new') 

@section('content')
<!-- section -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Recurly Support
        <small></small>
      </h1>

    </section>
    <section class="content">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> !</h4>
            {{ Session::get('success') }}
          </div>
        @endif

        <a href="{{ url('admin/support-recurly/create') }}"> Nueva Divisa</a>
                <table class="table table-striped mt-4">
                        <thead class="">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Divisa</th>
                            <th scope="col">code</th>
                            <th scope="col">Default Conversión</th>
                            <th scope="col">stripe_id</th>
                            <th scope="col">userBy</th>
                            <th scope="col">Currency-Gateway</th>
                            <th scope="col">Actions<th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($supports as $support)
                          <tr>
                          <th scope="row">1</th>
                          <td>{{$support->currency->name}} </td>
                          <td>{{$support->currency->code}} </td>
                          <td>{{$support->default_conversion === 0 ? 'NO' : 'Yes'}} </td>
                          <td>{{$support->stripe_account->stripe_id}} </td>
                          <td>{{$support->stripe_account->user_by}}</td>
                          <td>
                          
                          {{$support->currency2->code}} -

                          
                            {{$support->stripe_account->gateways()->where(['stripe_account_id'=>$support->stripe_account_id,'currency_id'=>$support->currency_default])->first()->gateway_code}}
                          
                          </td>
                          
                          
                          <td>
                              <a href="{{ url('admin/support-recurly/'.$support->id.'/edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                          </td>
                          </tr>
                        @empty
                               
                        @endforelse
                        
                          
                        </tbody>
                      </table>
                      {{ $supports->links() }}
      
    </section>
</div>
    
<!--section end -->
@endsection