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
            <h3>Spray Team</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('executive.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Edit</li>
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
              <h5>Edit</h5>
            </div>
            <div class="card-body">
              <form class="row needs-validation " novalidate="" method="post" action="{{route('executive.spray-team.update', $user->id)}}" enctype='multipart/form-data'>
                  @csrf @method('put')
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="name">Registration ID</label>
                    <input class="form-control" value="{{$user->reg_id}}" type="text" readonly>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="role">Role</label>
                    <select class="form-select " id="ward" name="roles" required="" >
                        @foreach($roles as $role)
                          <option {{$user->roles == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input class="form-control" value="{{$user->username}}" id="name" type="text" name="username" placeholder="Add User name" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input class="form-control" value="{{$user->phone}}" id="phone" type="number" name="phone" placeholder="Add Phone number" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" value="{{$user->email}}" id="email" type="email" name="email" placeholder="please enter email" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="password">Password </label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Enter to change password" >
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="fileInput">ID Card</label>
                    <input type="file" class="form-control" id="fileInput" name="id_card"  accept="image/*" >
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="ward">Ward</label>
                    <select class="form-select " id="ward" name="ward" required="" >
                        @foreach($wards as $ward)
                          <option {{$user->ward == $ward->id ? 'selected' : ''}} value="{{$ward->id}}">{{$ward->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="">Uploaded ID Card : @if(!$user->id_card) N/A @endif</label><br>
                    @if($user->id_card)
                    <img src="{{url('/').$user->id_card}}" height="200" alt="">
                    @endif
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="col-form-label">Status</label><br>
                      <div class="media-body text-end" style="display: contents;">
                        <label class="switch">
                          <input type="hidden" name="status" value="0">
                          <input type="checkbox" value="1" name="status" {{$user->status == '1' ? 'checked' : ''}}><span class="switch-state"></span>
                        </label>
                      </div>
                  </div>    
                </div>
                <div class="btn-showcase text-end">
                  <input class="btn btn-primary" type="submit" value="Submit">
                  <a href="{{ route('executive.spray-team.index') }}" class="btn btn-light">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection