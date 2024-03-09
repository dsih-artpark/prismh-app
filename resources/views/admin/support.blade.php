@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
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
          <h3>Support</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Support</li>
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
            <h5>Add Support</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.support.store')}}" enctype='multipart/form-data'>
                @csrf
              <div class="col-sm-12">
                <div class="mb-3">
                  <label for="validationCustom01">Title</label>
                  <input class="form-control" id="validationCustom01" type="text" name="title" placeholder="Add Support Title" required="">
                </div>
                
                <div class="mb-3">
                          <label class="form-label" for="validationCustom04">Category</label>
                          <select class="form-select" id="validationCustom04" name="category" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                          </select>
                          <!--<div class="invalid-feedback">Please select any one cateory.</div>-->
                        </div>
                        <div class="mb-3">
                  <label class="form-label" for="validationTextarea">Description</label>
                  <textarea id="editor" class="form-control is-invalid"  name="textbox" cols="10" rows="2" required=""></textarea>
                </div>
                <div class=" mb-3">
                  <label class="form-label" for="fileInput">Image</label>
                  <input type="file" class="form-control" id="fileInput" name="image"   accept="image/*"  required>
                </div>
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                        <input type="checkbox" name="status"><span class="switch-state"></span>
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

@endsection