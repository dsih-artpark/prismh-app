@extends('includes.master')

@section('headerscript')
@parent
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
label.color-highlight.profess-tag {
    opacity: 1;
    left: 23px !important;
    transform: translateX(-14px) !important;
    margin-left: 0px !important;
    position: absolute;
    font-size: 12px;
    transition: all 250ms ease;
    background-color: #FFF;
    z-index: 996;
    top: -11px;
    padding: 0px 5px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 12px;
    right: 4px;
   
}
span.select2-selection.select2-selection--multiple {
    height: 53px !important;
    border-left-width: 1px !important;
    border-right-width: 1px !important;
    border-top-width: 1px !important;
    padding-left: 6px !important;
    padding-right: 10px !important;
    border-radius: 10px !important;
    padding-top: 8px !important;
    border-color: rgba(0, 0, 0, 0.08) !important;
}
span.select2-selection.select2-selection--multiple {
    height: 55px !important;
}

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

@section('header')
@parent
@endsection

@section('content')

   

        <div class="page-title page-title-small">
            <div class="text-center">
                <h2>Registration</h2>
        </div>
            <!--<a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png') }}"></a>-->
        </div>
        <div class="card header-card shape-rounded" data-card-height="150">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
        </div>
        
        @if(Session::has('error'))
        <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
            <span><i class="fa fa-times"></i></span>
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
        @endif

        <div class="card card-style">
            <div class="content mb-0 mt-1 mb-3">
                <form method="post" action="{{route('register.api')}}" enctype='multipart/form-data'>
                    @csrf
                    
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="name" class="form-control validate-name" id="name" placeholder="Enter the name" name="name" required>
                <label for="name" class="color-highlight font-400 font-13">Name</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Required)</em>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="phone" class="form-control validate-name" id="phone" placeholder="Enter the phone number" name="phone" required>
                <label for="phone" class="color-highlight font-400 font-13">Mobile</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Required)</em>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="email" class="form-control validate-name" id="email" placeholder="Enter the email" name="email" required>
                <label for="email" class="color-highlight font-400 font-13">Email</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Required)</em>
            </div>
            <!--<div class="input-style input-style-always-active has-borders no-icon validate-field mb-4" style="position: relative;margin-bottom: 15px !important;">-->
            <!--    <label for="roles" class="color-highlight profess-tag">Roles</label>-->
            <!--    <select  required class="form-control roles profess-tag-1" id="roles" name="roles" data-placeholder="Select any one"  style="border-color: rgba(0, 0, 0, 0.08) !important;">-->
            <!--    <option label='Please Select' value=''>Select any one</option>-->
            <!--    <option value="JHI">JHI</option>-->
            <!--     <option value="ACE">ACE</option>-->
            <!--    </select>-->

            <!--</div>-->
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="ward" class="color-highlight profess-tag ">Select Role*</label>
                <select  required class="form-control profess-tag-1" id="role" name="roles" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                  <option value="" selected disabled>Select Role</option>
                  @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="ward" class="color-highlight profess-tag ">Ward*</label>
                <select  required class="form-control ward profess-tag-1" id="ward" name="ward" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="id_card" class="color-highlight profess-tag ">ID Card*</label>
                <input type="file" class="form-control profess-tag-1" name="id_card" id="id_card" style="border-color: rgba(0, 0, 0, 0.08) !important;">
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="password" class="form-control validate-name" id="password" placeholder="Enter the password" name="password" required>
                <label for="password" class="color-highlight font-400 font-13">Password</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Required)</em>
            </div>
            
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="cpassword" class="form-control validate-name" id="cpassword" placeholder="Enter the confirm password" name="cpassword" required>
                <label for="form1" class="color-highlight font-400 font-13">Confirm Password</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Required)</em>
                <p id="vmessage"></p>
            </div>
            <center>
                <input type="submit" class="btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="Submit">
            </center>
            

                
                </form>
               
				

            </div>
        </div>

@endsection

@section('footer')
@parent
@endsection


@section('footerscript')
@parent


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() 
    {
        $(".form-select").select2({
          placeholder : "Placeholder",
          tags: true,
           minimumResultsForSearch: Infinity

      });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
                     $(".roles").html('');
                    $(".roles").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".roles").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
      
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
                    $(".ward").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".ward").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        
        
        
        $('#cpassword').on('keyup', function() {
    var password = $('#password').val();
    var confirmPassword = $(this).val();
    
    if (password === confirmPassword) {
      $('#vmessage').text('Passwords match!');
       $('#cpassword').attr('required',true);
      // Proceed with form submission or any other action
    } else {
      $('#vmessage').text('Passwords do not match. Please try again.');
       $('#cpassword').attr('required',false);
      // Prevent form submission or perform any other action to handle the mismatch
    }
  });
        
            
    

    });
</script>


@endsection