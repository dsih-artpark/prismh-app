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
          <h3>Details</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
  <div class="col-xxl-12 col-lg-12 col-md-12 m-3">
                                <div class="col-sm-12">
                                  <div class="card shadow m-3">
                                      
                                      <div class="card-body add-post">
            
                                    <form class="theme-form needs-validation" novalidate="" action="{{route('vehicleAdd')}}" method="post" enctype='multipart/form-data'>
                                    
                                    @csrf
                                        
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-12">
                                            <label for="input-text-1" style="margin-left: 10px">Customer Phone Number</label>
                                            <input type="text" class="form-control btn-square" id="input-text-1" name="custphone" placeholder="Enter Customer phone number" required value="{{ old('custphone') }}" maxlength="10" onkeypress = 'javascript:return allowOnlyDigits(event)' style="margin-left:10px" />
                                            <div class="invalid-feedback" style="margin-left:10px">Please enter the phone number</div>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-sm-12 mb-3 draggable">
                                            <label class="form-label " for="validationCustom02">Vehicle Number</label>
                                            <input type="text" class="form-control btn-square" id="input-text-2" name="vehno" placeholder="Enter Vehicle number" required="" maxlength="12" onkeypress = 'javascript:return allowAllAlphabetsAllDigitsAndOnly1SpecialChar(event)' />
                                            <div class="invalid-feedback">Please enter the vehicle number</div>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-sm-12 mb-3 draggable">
                                            <label class="form-label " for="validationCustom02">Vehicle Photo</label>
                                            <input class="form-control btn-square" id="input-photo-3" type="file" name="vehphoto" required title="Select a vehicle photo" style="width: 300px" />
                                            <div class="invalid-feedback">Please choose a vehicle photo</div>
                                        </div>
                                    </div>

                                    <div class="card-header pb-0">
                                      <h3 class="text-center"> Vehicle Owner Details </h3>
                                    </div>
                                    
                                   
                                      <div class="row">
                                        <div class="col-12">
                                                              
                                              <div class="row">
                                                  
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="input-text-1">Name</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-4" name="owner_name" placeholder="Name" required="" onkeypress = 'javascript:return allowAllAlphabetsAndOnly1SpecialChar(event)' />
                                                        <div class="invalid-feedback">Please enter the owner's name</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="input-text-1">Phone</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-5" name="owner_phone" placeholder="Phone" required="" maxlength="10" onkeypress = 'javascript:return allowOnlyDigits(event)' />
                                                        <div class="invalid-feedback">Please enter the owner's phone number</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="input-text-1">Address</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-6" name="owner_addr" placeholder="Address" required="" />
                                                        <div class="invalid-feedback">Please enter the owner's address</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                                         <label class="form-label" for="validationCustom02">Photo</label>
                                                         <input class="form-control btn-square" id="input-photo-6" type="file" name="owner_photo" required="" title="Select an owner photo" />
                                                         <div class="invalid-feedback">Please choose an owner's photo</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                                        <label for="input-text-1">Aadhar number</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-7" name="owner_aadhar_num" placeholder="Aadhar number" required="" maxlength="12" onkeypress = 'javascript:return allowOnlyDigits(event)' />
                                                        <div class="invalid-feedback">Please enter the owner's Aadhar number</div>
                                                    </div>

                                                    <div class="col-lg-4 col-sm-12" style="margin-top:20px">
                                                        <label class="form-label " for="validationCustom02">Aadhar Image</label>
                                                        <input class="form-control btn-square" id="input-photo-8" type="file" name="owner_aadhar_img" required="" title="Select an owner's Aadhar image" />
                                                        <div class="invalid-feedback">Please choose the owner's Aadhar image</div>
                                                    </div>  
                                                  </div>



                                                  <div class="row mt-3">
                                                    <h3 class=" fw-bold mb-3 text-center">Driver Details</h3>

                                                    <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                                        <label class="form-label text-center" for="validationCustom02">Name</label>
                                                        <input class="form-control btn-square" id="input-text-9" type="text" name="driver_name" placeholder="Name" required="" onkeypress = 'javascript:return allowAllAlphabetsAndOnly1SpecialChar(event)' />
                                                        <div class="invalid-feedback">Please enter the driver's name</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                                        <label class="form-label text-center" for="validationCustom02">Phone</label>
                                                        <input class="form-control btn-square" id="input-text-10" type="text" name="driver_phone" placeholder="Phone" required="" maxlength="10" onkeypress = 'javascript:return allowOnlyDigits(event)' />
                                                        <div class="invalid-feedback">Please enter the driver's phone number</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-sm-12 mb-3 draggable">
                                                        <label class="form-label text-center" for="validationCustom02">Address</label>
                                                        <input class="form-control btn-square" id="input-text-11" name="driver_addr" placeholder="Address" required />
                                                        <div class="invalid-feedback">Please enter the driver's address</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-sm-12">
                                                        <label for="input-text-1">License No</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-12" name="driver_licnum" placeholder="License No" required="" maxlength="15" onkeypress = 'javascript:return allowAllAlphabetsAllDigitsAndOnly1SpecialChar(event)' />
                                                        <div class="invalid-feedback">Please enter the driver's license number</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                                        <label class="form-label text-center" for="validationCustom02">License Image</label>
                                                        <input class="form-control btn-square" id="input-photo-13" type="file" name="driver_licimg" required="" title="Select a DL photo" />
                                                        <div class="invalid-feedback">Please choose the driver's license image</div>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-lg-6 col-sm-12 mb-3  mt-2">
                                                        <label for="input-text-1">Aadhar number</label>
                                                        <input type="text" class="form-control btn-square" id="input-text-14" name="driver_aadhar_num" placeholder="Aadhar number" required="" maxlength="12" onkeypress = 'javascript:return allowOnlyDigits(event)' />
                                                        <div class="invalid-feedback">Please enter the driver's Aadhar number</div>
                                                    </div>

                                                    <div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                                        <label class="form-label text-center" for="validationCustom02">Aadhar Image</label>
                                                        <input class="form-control btn-square" id="input-photo-15" type="file" name="driver_aadhar_img" required="" title="Select an driver's Aadhar image" />
                                                        <div class="invalid-feedback">Please select the driver's Aadhar image</div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6 col-sm-12 mb-3 mt-2">
                                                        <label class="form-label" for="validationCustom02">Password</label>
                                                        <input class="form-control btn-square" id="input-text-16" type="password" name="pswd" placeholder="Enter the password" required="" />
                                                        <div class="invalid-feedback">Please enter the password</div>
                                                    </div>
                                                    
                                                    <div class="col-md-12 input-style-always-active has-borders no-icon mb-4">
                                                        <!--<div class="form-check icon-check">-->
                                                        
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="check3" checked="" required>
                                                            <label class="form-check-label" for="check3">I Accept all <a href="{{route('terms.conditions')}}" target="_blank" class="color-highlight">Terms & Conditions</a></label>
                                                            <i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
                                                            <i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
                                                        </div>
                                                    </div>
                                                </div>   
                                        
                                        
                                                <div class="col-lg-3 col-sm-12 mt-4 text-end">
                                                    <!--<button class="form-control btn-md btn-primary" type="submit">Generate QR Code</button>-->
                                                    
                                                    <button class="form-control btn-md btn-primary" type="submit">Submit</button>
                                                </div>
                                        </div>
                                      </div>
                                    
                                    
                                    </form>
                                  </div>
                                  </div>

                                </div>
                              </div>
  </div>
  <!-- Container-fluid Ends-->
</div>


<script type="text/javascript">
function allowAllAlphabetsAllDigitsAndOnly1SpecialChar(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    
    //if ((charCode >= 97 && charCode <= 122) || (charCode >= 65 && charCode <= 90) || (charCode >= 48 && charCode <= 57) || (charCode == 32) )
    
    if ( (charCode >= 65 && charCode <= 90) || (charCode >= 48 && charCode <= 57) || (charCode == 32) )
        return true;
    else
        return false;
}


function allowAllAlphabetsAndOnly1SpecialChar(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if ( (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || (charCode == 32) )
        return true;
    else
        return false;
}


function allowOnlyDigits(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if ( (charCode >= 48 && charCode <= 57) )
        return true;
    else
        return false;
}
</script>

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