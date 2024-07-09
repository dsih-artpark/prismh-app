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
            <h3>Spray Team</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
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
              <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.spray-team.store')}}" enctype='multipart/form-data'>
                  @csrf
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="role">Role</label>
                    <select class="form-control " id="role" name="roles" required readonly>
                      <option selected value="{{$role->id}}">{{$role->name}}</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="username" placeholder="Add User name" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input class="form-control" minlength="10" maxlength="10" oninput="onlyNumber(this)" id="phone" type="number" name="phone" placeholder="Add Phone number" required>
                    <span class="text-danger d-block" id="phone_err"></span>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="please enter email" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="password">Password </label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Enter to change password" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="ward">Ward</label>
                    <select class="form-select " id="ward" name="ward" required >
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
                          <input type="checkbox" value="1" name="status" checked><span class="switch-state"></span>
                        </label>
                      </div>
                  </div>    
                </div>
                <div class="btn-showcase text-end">
                  <input class="btn btn-primary" type="submit" value="Submit">
                  <a href="{{ route('admin.spray-team.index') }}" class="btn btn-light">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
  function onlyNumber(e) {
    var inputElement = e;
    var inputValue = inputElement.value;
    var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = sanitizedValue;
    if($(e).attr("name")=='phone' && inputElement.value.length == 10){
      validate_phone(inputElement.value);
    }
  }
  function validate_phone(number){
    $.ajax({
      method: "POST",
      url: "{{ route('asha_worker.validate_number') }}",
      data: {_token: "{{csrf_token()}}", phone: number}, 
    })
    .done(function (res) {
      if(res.success){
        $('#phone_err').text(res.message);
        $('#submit_btn').prop('disabled', true);
      }
      else{
        $('#phone_err').text('');
        $('#submit_btn').prop('disabled', false);
      }
    })
    .fail(function (err) {
      console.log(err);              
    });
  }
</script>
@endsection