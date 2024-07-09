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
  @if ($errors->any())
    <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
      <div class="toast defaul-show-toast align-items-center text-white bg-danger position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
        <div class="toast-body">{{$errors->first()}}   
          <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>Division</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.division.index')}}">Division</a></li>
              <li class="breadcrumb-item">Add</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Add</h5>
            </div>
            <div class="card-body">
              <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.division.store')}}">
                @csrf
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="validationCustom01">Division Name</label>
                    <input class="form-control" id="validationCustom01" type="text" name="name" placeholder="Enter Division Name" required value="{{old('name')}}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label >Zone</label>
                    <select name="zone_id" class="form-control" required>
                      <option value="" disabled>Select Zone</option>
                      @foreach($zones as $zone)
                        <option {{old('zone_id') == $zone->id ? 'selected' : ''}} value="{{$zone->id}}">{{$zone->title}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="latitude">Latitude</label>
                    <input class="form-control" id="latitude" type="number" name="latitude" placeholder="Enter Division Latitude" required value="{{old('latitude')}}">
                  </div>    
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="longitude">Longitude</label>
                    <input class="form-control" id="longitude" type="number" name="longitude" placeholder="Enter Division Longitude" required value="{{old('longitude')}}">
                  </div>    
                </div>
                <div class="btn-showcase text-end">
                  <input class="btn btn-primary" type="submit" value="Submit">
                  <a href="{{ route('admin.division.index') }}" class="btn btn-light">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection