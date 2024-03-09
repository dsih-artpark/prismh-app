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
            <li class="breadcrumb-item">Users</li>
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
            <h5>Add Users</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.users.store')}}" enctype='multipart/form-data'>
                @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name">Name</label>
                  <input class="form-control" id="name" type="text" name="name" placeholder="Add User name" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="phone">Phone</label>
                  <input class="form-control" id="phone" type="number" name="phone" placeholder="Add Phone number" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email">Email</label>
                  <input class="form-control" id="email" type="email" name="email" placeholder="please enter email" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="password">Password </label>
                  <input class="form-control" id="password" type="password" name="password" placeholder="please enter password" >
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label" for="fileInput">Image</label>
                  <input type="file" class="form-control" id="fileInput" name="image"   accept="image/*"  required>
                </div>
                
                <div class="col-md-6 mb-3">
                          <label class="form-label" for="ward">Ward</label>
                          <select multiple class="form-select ward" id="ward" name="ward[]" required="" >
                              
                          </select>
                          <div class="invalid-feedback">Please select multiple wards</div>
                        </div>
                <!--        <div class="col-md-6 mb-3">-->
                <!--          <label class="form-label" for="submodules">Capabilities</label>-->
                <!--          <select multiple class="form-select submodules" id="submodules" name="capab[]" required="" fdprocessedid="xcyc5">-->
                <!--              <option value="View">View</option>-->
                <!--              <option value="Edit">Edit</option>-->
                <!--              <option value="Delete">Delete</option>-->
                <!--          </select>-->
                <!--          <div class="invalid-feedback">Please select a Capablities</div>-->
                <!--        </div>-->
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


 <script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
 $(document).ready(function(){
        
        $(".form-select").select2({
          placeholder : "Select",
          tags: true,
           minimumResultsForSearch: Infinity

      });
        
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            //zones
        
        $.ajax({
            url: '{{route('allward.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".ward").append("<option label='Please Select' value=''>Select Multiple Wards</option>");
                    $.each(data, function(i, item)
                    {
                        $(".ward").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
 });
    
</script>


@endsection