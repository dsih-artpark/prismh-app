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
            <h3>Admin User</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.admin-user.index')}}">User</a></li>
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
              <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.admin-user.update', $user->admin_id)}}">
                @csrf @method('put')
                <div class="col-md-6 mb-3">
                  <label for="name">Name</label>
                  <input class="form-control" id="name" type="text" name="name" placeholder="Enter name" value="{{$user->name}}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email">Email</label>
                  <input class="form-control" id="email" type="email" name="email" placeholder="Enter email" value="{{$user->email}}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email">Phone</label>
                  <input class="form-control" id="phone" type="number" name="phone" placeholder="Enter Phone Number" value="{{$user->phone}}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="password">Password</label>
                  <input class="form-control" id="password" type="password" name="password" placeholder="Enter to change password">
                </div>
                <div class="btn-showcase text-end">
                  <input class="btn btn-primary" type="submit" value="Submit">
                  <a href="{{ route('admin.admin-user.index') }}" class="btn btn-light">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection