@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
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
          <h3>Profile</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  
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
                            <img class="img-70 rounded-circle" alt="" src="{{asset('uploads/profile')}}/{{$profile->image}}">
                              <div class="media-body">
                                    @php
                            $name = Session::get('admin');
                            @endphp
                         
                                <h3 class="mb-1 f-20 txt-primary">{{$name->name}}</h3>
                                <p class="f-12">
                                    @if($profile->admin_id > 1)
                                    ADMIN
                                    @else
                                    SUPERADMIN
                                    @endif
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                   <form class="card " method="post" action="{{route('adminprofile.update', ["id"=>$profile->admin_id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                       
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{$profile->name}}" placeholder="Name">
                          </div>
                        </div>
                        @if($profile->admin_id == 1)
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" value="{{$profile->email}}" readonly>
                          </div>
                        </div>
                        
                        @else
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" value="{{$profile->email}}" >
                          </div>
                        </div>
                        @endif
                         <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="checkbox" id="checkbox">
                            <input class="form-control" type="password" id="password" placeholder="password" name="password" value="{{$profile->password}}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" placeholder="upload image" name="image">
                          </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control"  placeholder="Home Address" name="address">{{$profile->address}}</textarea>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" placeholder="City" name="city" value="{{$profile->city}}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input class="form-control" type="text" placeholder="Country" name="country" value="{{$profile->country}}">
                          </div>
                        </div>
                        <div class="col-sm-5 col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input class="form-control" type="number" placeholder="ZIP Code" name="pin" value="{{$profile->pin}}">
                          </div>
                        </div>
                       
                      </div>
                    </div>
                    <div class="card-footer text-end">
                       <input class="btn btn-primary" type="submit" value="Update Profile">
                    </div>
                  </form>
                  <!-- Container-fluid Ends-->
                </div>
              </div>
            </div>
          </div>
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

    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>
<script>
$(document).ready(function(){
    $('#checkbox').on('change', function(){
        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
    });
});
</script>
@endsection