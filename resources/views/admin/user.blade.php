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
          <h3>User</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">User</li>
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
            <h5>Add User</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.user.store')}}" enctype='multipart/form-data'>
                @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name">Name</label>
                  <input class="form-control" id="name" type="text" name="name" placeholder="Add User name" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email">Email</label>
                  <input class="form-control" id="email" type="email" name="email" placeholder="please enter email" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="password">Password <input type="checkbox" id="checkbox"></label>
                  <input class="form-control" id="password" type="password" name="password" placeholder="please enter password" value="cdwms<?=uniqid();?>" >
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label" for="fileInput">Image</label>
                  <input type="file" class="form-control" id="fileInput" name="image"   accept="image/*"  required>
                </div>
                
                <!--<div class="col-md-6 mb-3">-->
                <!--          <label class="form-label" for="modules">Modules</label>-->
                <!--          <select multiple class="form-select modules" id="modules" name="roles_id[]" required="" fdprocessedid="xcyc5">-->
                              
                <!--          </select>-->
                <!--          <div class="invalid-feedback">Please select a modules</div>-->
                <!--        </div>-->
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
        
        $('#checkbox').on('change', function(){
        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
    });
        
        $(".modules").select2({
                placeholder: "Select"
            });
        $(".submodules").select2({
                placeholder: "Select"
            });
            
            $.ajax({
            url: '{{route('admin.modules.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".modules").html('');
                    $(".modules").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".modules").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                    
                }
            }
        });
        
    });
    
</script>
@endsection