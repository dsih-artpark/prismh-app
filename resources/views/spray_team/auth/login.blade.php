@extends('spray_team.auth.app')

@section('style')
  <style>
    .header{
        display:none;
    }
    .back-to-top{
        display : none;
    }
    #footer-bar {
        display:none;
    }
    .footer-card{
        bottom : 0px !important;
    }
  </style>
@endsection

@section('content')
  <div class="card card-style">
    <div class="content">
      <div class="col-12 ps-0">
        <div class="text-center">
          <img src="{{asset('admin/assets/images/logo/small-logo.png')}}" width="75" height="75" class="rounded-xl ">
        </div>
      </div>
    </div>
    <div class="content mt-2 mb-0">
      <h2 class="mb-3 color-highlight">User Login</h2>
      <form method="post" action="{{route('spray_team.login')}}">
        @csrf
        <div class="input-style no-borders has-icon validate-field mb-4">
          <i class="fa fa-user"></i>
          <input type="number" class="form-control validate-name" id="form1a"  name="phone" placeholder="Phone" required>
          <label for="form1a" class="color-blue-dark font-10 mt-1">Phone</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>(required)</em>
        </div>
        <div class="input-style no-borders has-icon validate-field mb-4">
          <i class="fa fa-lock"></i>
          <input type="password" class="form-control validate-password" id="form3a" placeholder="Password" name="password" required>
          <label for="form3a" class="color-blue-dark font-10 mt-1">Password</label>
          <i class="fa fa-times disabled invalid color-red-dark"></i>
          <i class="fa fa-check disabled valid color-green-dark"></i>
          <em>(required)</em>
        </div>
        <center>
          <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="Login">
        </center>
      </form>
      <div class="divider mt-4 mb-3"></div>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
@endsection
