@extends('admin.layout.app')

@section('style')
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
          <h3>Profile</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admin.dashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header pb-0">
              <h4 class="card-title mb-0">My Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="profile-title">
                  <div class="media">                        
                  <img class="img-70 rounded-circle" alt="" src="{{asset('uploads/profile')}}/{{$user->profile}}">
                    <div class="media-body">
                      <h3 class="mb-1 f-20 txt-primary">{{strtoupper($user->username)}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- -- -->
        <div class="col-xl-8">
          <form class="card " method="post" action="{{route('admin.profile')}}" enctype='multipart/form-data'>
            @csrf
            <div class="card-header pb-0">
              <h4 class="card-title mb-0">Edit Profile</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6 col-md-3">
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="Name">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" placeholder="Email" name="email" value="{{$user->email}}" >
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Contact</label>
                    <input class="form-control" type="number" placeholder="Contact numaer" name="phone" value="{{$user->phone}}" >
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" id="password" placeholder="Enter to change password" name="password">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control"  placeholder="Home Address" name="address">{{$user->address}}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
                <input class="btn btn-primary" type="submit" value="Update Profile">
            </div>
          </form>
        </div>
        <!-- -- -->
      </div>
    </div>
  </div>
</div>
@endsection