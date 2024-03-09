@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
 <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
 <style>
      .card .card-body {
          padding:30px!important;
      }
 </style>
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Users</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{route('adminusers')}}">                                       
                Users
              </a>
            </li>
            <li class="breadcrumb-item">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit User</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.users.update', $user->id)}}" enctype='multipart/form-data'>
                @csrf
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
                <input class="btn btn-light" type="reset" value="Cancel">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent

<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>


 <script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
 $(document).ready(function(){
        
        $(".form-select").select2({
          placeholder : "Select",
          tags: true,
           minimumResultsForSearch: Infinity

      });
        
 });
    
</script>


@endsection