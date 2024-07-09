@extends('admin.layout.app')

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
            <h3>Zone</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Zone</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
  <div class="container-fluid default-dash">
    <div class="row"> 
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h6 class="font-roboto">Zone</h6>
                <h4 class="mb-0 counter">{{count($zones)}}</h4>
              </div>
              <!--<i class="fa fa-users fa-3x"></i>-->
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-secondary" role="progressbar" style="width:100%" aria-valuenow="{{count($zones)}}" aria-valuemin="0" aria-valuemax="{{count($zones)}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Zone</h5>
              <div class="mb-3 text-end">
                <a href="{{route('admin.zone.create')}}">
                  <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Zone</button>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Zone</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($zones as $key => $zone)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$zone->title}}</td>
                      <td>{{$zone->latitude}}</td>
                      <td>{{$zone->longitude}}</td>
                      <td>
                      <a href="{{route('admin.zone.edit' , $zone->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/notify/bootstrap-notify.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      var table = $('#table').DataTable();
    });
  </script>
@endsection