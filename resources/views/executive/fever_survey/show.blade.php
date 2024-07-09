@extends('executive.layout.app')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
  <style>
    .card .card-body {
      padding:30px!important;
    }
  </style>
@endsection

@section('content')
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>Survey Details</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('executive.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Details</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="user-profile">
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 xl-65">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="row product-page-main">
                    <div class="col-sm-12">
                      <div class="row">
                        @if($data->roles == 1)
                          <div class="col-md-12 mt-4">
                            <p>Asha Worker : <span class="font-primary email_add_5"> {{$data->username}}</span></p>
                          </div>
                        @else
                          <div class="col-md-12 mt-4">
                            <p>User : <span class="font-primary email_add_5"> {{$data->username}}</span></p>
                          </div>
                        @endif
                        @if($data->name)
                          <div class="col-md-12 mt-4">
                            <p>Name : <span class="font-primary email_add_5"> {{$data->name}}</span></p>
                          </div>
                        @endif
                        @if($data->phone)
                          <div class="col-md-12 mt-4">
                            <p>Phone : <span class="font-primary email_add_5"> {{$data->phone}}</span></p>
                          </div>
                        @endif
                        @if($data->latit)
                          <div class="col-md-12 mt-4">
                            <p>Latitude & Longitude : <span class="font-primary email_add_5"> {{$data->latit}}</span></p>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection