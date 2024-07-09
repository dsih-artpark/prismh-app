@extends('admin.layout.app')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
  <style>
    .card .card-body {
        padding:30px!important;
    }
    .in_valid{
      border: 1px solid red;
      border-radius: 6px;
    }
    ._valid{
      border: 1px solid green;
      border-radius: 6px;
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
            <h3>Executive</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">                                       
                  <i data-feather="home"></i>
                </a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('admin.executive.index')}}">                                     
                  Users
                </a>
              </li>
              <li class="breadcrumb-item">Add</li>
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
              <h5>Add Executive</h5>
            </div>
            <div class="card-body add-post">
              <form class="row needs-validation " onsubmit="validate_this()" novalidate="" method="post" action="{{ route('admin.executive.store') }}" enctype='multipart/form-data'>
                  @csrf
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="role">Role</label>
                    <select class="form-select " id="roles" name="roles" required onchange="set_role(this.value)">
                        @foreach($roles as $role)
                          <option {{old('roles')==$role->id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input class="form-control" value="{{old('username')}}" id="name" type="text" name="username" placeholder="Add User name" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input class="form-control" value="{{old('phone')}}" id="phone" type="number" name="phone" placeholder="Add Phone number" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" value="{{old('email')}}" id="email" type="email" name="email" placeholder="please enter email" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="password">Password </label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Enter password" required>
                  </div>
                  <div class="col-md-6 mb-3 zone-div">
                    <label class="form-label" for="zone">Zone</label>
                    <select class="form-select select2" id="zone" name="zone_ids[]">
                        @foreach($zones as $zone)
                          <option value="{{$zone->id}}">{{$zone->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3 division-div">
                    <label class="form-label" for="division">Divisions</label>
                    <select class="form-select select2" id="division" name="division_ids[]" >
                        @foreach($divisions as $division)
                          <option value="{{$division->id}}">{{$division->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3 ward-div">
                    <label class="form-label" for="ward">Ward</label>
                    <select class="form-select multiple" id="ward" name="ward_ids[]">
                        @foreach($wards as $ward)
                          <option value="{{$ward->id}}">{{$ward->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="col-form-label">Status</label><br>
                      <div class="media-body text-end" style="display: contents;">
                        <label class="switch">
                          <input type="hidden" name="status" value="0">
                          <input type="checkbox" value="1" checked name="status"><span class="switch-state"></span>
                        </label>
                      </div>
                  </div>    
                </div>
                <div class="btn-showcase text-end">
                  <input class="btn btn-primary" type="submit" value="Submit">
                  <a href="{{route('admin.executive.index')}}"><input class="btn btn-light" type="button" value="Cancel"></a>
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

@section('script')
  <script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
  <script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
  <script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
  <script src="{{asset('admin/assets/js/email-app.js')}}"></script>
  <script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>


  <script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#zone").select2({
        multiple: true,
        placeholder : "Select",
        minimumResultsForSearch: Infinity
      });
      $("#division").select2({
        multiple: true,
        placeholder : "Select",
        minimumResultsForSearch: Infinity
      });
      $("#ward").select2({
        multiple: true,
        placeholder : "Select",
        minimumResultsForSearch: Infinity
      });   
    });
    function validate_this(){
      let role = $('#roles').val();
      if(role == 3){
        let zone = $('#zone').val();
        if(!zone.length) $('#zone').data('select2').$container.addClass('in_valid').removeClass('_valid');
        else $('#zone').data('select2').$container.removeClass('in_valid').addClass('_valid');
      }else if(role == 4){
        let division = $('#division').val();
        if(!division.length) $('#division').data('select2').$container.addClass('in_valid');
        else $('#division').data('select2').$container.removeClass('in_valid');
      }else if(role == 5 || role == 6){
        let wards = $('#ward').val();
        if(!wards.length) $('#ward').data('select2').$container.addClass('in_valid');
        else $('#ward').data('select2').$container.removeClass('in_valid');
      }
    }
    function set_role(role){
      $('.zone-div').hide();
      $('.division-div').hide();
      $('.ward-div').hide();
      $('#zone').val(" ").trigger('change').prop('required',false);
      $('#division').val(" ").trigger('change').prop('required',false);
      $('#ward').val(" ").trigger('change').prop('required',false);
      if(role == 3){
        $('.zone-div').show();$('#zone').prop('required',true);
      }
      if(role == 4){
        $('.division-div').show();$('#division').prop('required',true);
      }
      if(role == 5 || role == 6){
        $('.ward-div').show();$('#ward').prop('required',true);
      }
    }
    set_role(3);
  </script>
@endsection