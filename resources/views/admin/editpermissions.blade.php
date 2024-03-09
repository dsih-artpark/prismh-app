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
          <h3>Permissions</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Permissions</li>
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
            <h5>Edit Permissions</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.permissions.update', ["id"=>$permissions['det']->id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="row">
                <div class="col-md-6 mb-3">
                    @php 
                    $permad = DB::table('pwa_admin')->where('admin_id', $permissions['det']->admin_id)->first();
                    @endphp
                    
                    <input type="hidden" name="users" value="{{$permissions['det']->admin_id}}" readonly>
                    <label for="user">User</label>
                    
                    <input class="form-control" id="user" type="text" value="{{$permad->name}}" readonly>
                    </div>
                <div class="col-md-6 mb-3">
                          <label class="form-label" for="validationCustom04">Roles</label>
                          <select class="form-select" id="validationCustom04" name="roles" required>
                            <option selected disabled="" value="">Select</option>
                            @foreach($permissions['roles'] as $roles)
                             @php 
                             $rolessel = ($roles->id == $permissions['det']->roles)?"selected":"";
                             @endphp
                            <option value="{{$roles->id}}" <?=$rolessel;?>>{{$roles->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        
               
              
               
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="modules">Modules</label>
                          <select multiple class="form-select " id="" name="modules[]" required="" >
                            @foreach($permissions['modules'] as $modules)
                             
                              @php
                              $mod = explode(',',$permissions['det']->modules);
                            $rols = DB::table('modules')->whereIn('id', $mod)->get(); 
                            
                            @endphp
                            <option value="{{$modules->id}}" 
                            <?php
                            
                            
                                foreach($rols as $impval){
                                    
                                    
                             echo $rolessel = ($modules->id == $impval->id)?"selected":"";
                            
                                   
                                }
                            ?>
                            >{{$modules->name}}</option>
                            
                            @endforeach
                              
                              
                             
                          </select>
                          <div class="invalid-feedback">Please select a Modules</div>
                        </div>
                        
                        
                        
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="validationCustom04">Ward</label>
                          <select multiple class="form-select ward" id="ward" name="ward[]" required>
                             @foreach($permissions['wards'] as $ward)
                             
                            
                               @php
                              $mod = explode(',',$permissions['det']->ward);
                            $rols = DB::table('ward')->whereIn('id', $mod)->get(); 
                            
                            @endphp
                            <option value="{{$ward->id}}" 
                            <?php
                            
                            
                                foreach($rols as $impval){
                                    
                                    
                             echo $rolessel = ($ward->id == $impval->id)?"selected":"";
                            
                                   
                                }
                            ?>
                            >{{$ward->name}}</option>
                            
                            @endforeach
                          </select>
                        </div>
                        
                             <div class="col-md-6 mb-3">
                          <label class="form-label" for="submodules">Capabilities</label>
                          <select multiple class="form-select submodules" id="submodules" name="capab[]" required="" fdprocessedid="xcyc5">
                              @php
                               $rol = DB::table('pwa_user_capabilities')->select('name')->where('admin_id', $permissions['det']->admin_id)->first();
                               $imp = explode(',',$rol->name);
                              @endphp
                              
                              <option value="View"
                              <?php
                  foreach($imp as $impval){
                    
                       
                      if( $impval == "View")
                      {  
                      echo "selected";
                      }
                  }
                  ?>
                              >View</option>
                              <option value="Edit"
                              <?php
                  foreach($imp as $impval){
                    
                       
                      if( $impval == "Edit")
                      {  
                      echo "selected";
                      }
                  }
                  ?>
                              >Edit</option>
                              <option value="Delete"
                              <?php
                  foreach($imp as $impval){
                    
                       
                      if( $impval == "Delete")
                      {  
                      echo "selected";
                      }
                  }
                  ?>
                  >Delete</option>
                          </select>
                          <div class="invalid-feedback">Please select a Capablities</div>
                        </div>
                        
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                          @php
                          $chk = $permissions['det']->status == '1' ? "checked" : " ";
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
            url: '{{route('zone.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".zone").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".zone").append("<option value="+item.id+">"+item.title+"</option>");      
                    });
                }
            }
        }); 
        
        //divisions
        $('.zone').on('change', function()
        {

                $.ajax({
                    url: '{{route('division.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, zone:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        $(".division").html('');
                        $(".division").append("<option label='Please Select' value=''>Select a Division</option>");
                        
                        
                        
                        if(data == '')
                        {
                            
                            
                        }
                        else
                        {
                            $(".division").html('');
                            $(".division").append("<option label='Please Select' value=''>Select </option>");
                            $.each(data, function(i, item)
                            {
                                $(".division").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        });
        
        //wards
        $('.division').on('change', function()
        {

                $.ajax({
                    url: '{{route('ward.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, division:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        $(".ward").html('');
                        $(".ward").append("<option label='Please Select' value=''>Select a Ward</option>");
                        
                        
                        
                        if(data == '')
                        {
                            
                            
                        }
                        else
                        {
                            $(".ward").html('');
                            $(".ward").append("<option label='Please Select' value=''>Select </option>");
                            $.each(data, function(i, item)
                            {
                                $(".ward").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        });
            
            //roles
        
        $.ajax({
            url: '{{route('roles.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".roles").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".roles").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        
        //modules  
            $.ajax({
            url: '{{route('modules.list')}}',
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
        
        //sub modules
        $('.modules').on('change', function()
        {

                $.ajax({
                    url: '{{route('submodules.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, modules:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        $(".submodules").html('');
                        $(".submodules").append("<option label='Please Select' value=''>Select a Module</option>");
                        
                        
                        
                        if(data == '')
                        {
                            
                            
                        }
                        else
                        {
                            $(".submodules").html('');
                            $(".submodules").append("<option label='Please Select' value=''>Select </option>");
                            $.each(data, function(i, item)
                            {
                                $(".submodules").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        });
        
        
        
        
    });
    </script>

@endsection