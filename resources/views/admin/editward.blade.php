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
          <h3>Ward</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Ward</li>
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
            <h5>Edit Ward</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.ward.update', ["id"=>$ward['det']->id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="col-sm-12">
                <div class="mb-3">
                          <label class="form-label" for="validationCustom04">Zones</label>
                          <select class="form-select" id="validationCustom04" name="division_id" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            @foreach($zones as $cat)
                             @php 
                             $categorysel = ($cat->id == $ward['det']->division_id)?"selected":"";
                             @endphp
                            <option value="{{$cat->id}}" <?=$categorysel;?>>{{$cat->name}}</option>
                            @endforeach
                          </select>
                          <!--<div class="invalid-feedback">Please select any one cateory.</div>-->
                        </div>
              <div class="mb-3">
                  <label for="validationCustom01">Ward</label>
                  <input class="form-control" id="validationCustom01" type="text" name="name" placeholder="Add Ward Name" value="{{$ward['det']->name}}" required>
                </div>
                 <div class="mb-3">
                  <label for="validationCustom01">Ward Number</label>
                  <input class="form-control" id="validationCustom01" type="text" name="number" placeholder="Add Ward number" value="{{$ward['det']->number}}" required>
                </div>
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                          @php
                          $chk = $ward['det']->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> >
                         
                        <span class="switch-state"></span>
                      </label>
                    </div>
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

    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>

@endsection