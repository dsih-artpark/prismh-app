@extends('includes.master')
@section('headerscript')
@parent
<!--<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
 

<style>

    .header{
        display:none;
    }
    #footer-bar{
        display:none;
    }
    .footer-card{
        bottom : 0px !important;
    }
    input[type="date"]{
   -webkit-appearance: none;
}

</style>
@endsection
@section('header')
@parent
@endsection
@section('content')

<div class="page-title page-title-small"> 
    <h2>{{ __('messages.reghead') }}</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
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




@if(Session::has('success'))
    
    <div id="succmodal" class="modal fade s-alrt mt-4">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-green-dark">
           
            <div class="modal-body bg-green-dark rounded-2 ">
			  <h1 class="text-center mt-4"><i class="fa fa-3x fa-check-circle color-white "></i></h1>
        <p class="text-center mb-0 color-white">Thank you - Your Request for VBF Membership as been Received - Verification Process is in 
        Progress, we will notify through mail once it is approved, post that you will be able to login to the Portal</p>
       
        
            </div>
        </div>
    </div>
    </div>

@endif

                    
<div class="card card-style">
    <div class="content mb-0 mt-3">
        
        
        @if(Auth::guard('customer')->user())
           <p class="mb-3 color-highlight">For Vipra Business Owners Only *</p>
           @endif
       
        <form method="post" action="{{route('register.api')}}" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" class="rolesec" value="<?=Auth::guard('customer')->user() ? Auth::guard('customer')->user()->roles:'';?> ">
              
           
            @if(Auth::guard('customer')->user())
            <div class="moredetails">
            
            
            <div class="mb-4 pb-2">
                <h5 class="float-start font-19 font-600 mb-3 ps-1">PERSONAL DETAILS</h5>
            </div>
             @if(Auth::guard('customer')->user())
             
             @endif
             <div class="input-style input-style-always-active has-borders no-icon mb-4 mt-3">
                <textarea id="address" class="form-control address" placeholder="{{ __('messages.regform7') }}" name="address" required></textarea>
                <label for="address" class="color-highlight">{{ __('messages.regform7') }}</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="gender" class="color-highlight profess-tag">{{ __('messages.regform32') }}*</label>
                <select  required class="form-select gender profess-tag-1" id="gender" name="gender" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                    <option label='Please Select' value=''>Select any one</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text dob" id="dob" placeholder="{{ __('messages.regform14') }}" name="dob" required pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}">
                <label for="dob" class="color-highlight">{{ __('messages.regform14') }}*</label>
                
            </div>
             <label for="marital" class="color-highlight pb-2">{{ __('messages.regform15') }}*</label>
             <div class="main-box">
                 <div class="form-check icon-check">
                                <input class="form-check-input" type="radio" name="martial" value="1" id="radio1">
                                <label class="form-check-label" for="radio1">Married</label>
                                <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                                <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
                            </div>
                  <div class="form-check icon-check">
                                <input class="form-check-input" type="radio" name="martial" value="2" id="radio2" checked>
                                <label class="form-check-label" for="radio2">Unmarried</label>
                                <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                                <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
                            </div>
               </div>
               <div class="mdiv">
                   <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="text" class="form-control validate-text martial_date" id="martial_date" placeholder="Please enter your Anniversary Date" name="martial_date" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}">
                <label for="martial_date" class="color-highlight"> Date of Anniversary*</label>
                
            </div>
               </div>
           
              
              <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-4">
                <input type="text" class="form-control validate-text gotra" id="gotra" placeholder="{{ __('messages.regform16') }}" name="gotra" required>
                <label for="gotra" class="color-highlight">{{ __('messages.regform16') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                            <input class="form-check-input padd" type="checkbox" id="padd" name="padd">
                            <label class="form-check-label" for="padd">Same as Address for Permanent Address</label>
                            <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                            <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
                        </div>
            <div class="input-style input-style-always-active has-borders no-icon mb-4 mt-4">
                <textarea id="paddress" class="form-control paddress" placeholder="{{ __('messages.regform17') }}" name="paddress" required></textarea>
                <label for="paddress" class="color-highlight">{{ __('messages.regform17') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <!--<em class="mt-n3">(required)</em>-->
            </div>
             <div class="mb-3 pb-2">
                <h5 class="float-start font-19 font-600 mb-3 ps-1">BUSINESS DETAILS</h5>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-5">
                <input type="text" class="form-control validate-text bname" id="bname" placeholder="{{ __('messages.regform18') }}" name="bname" required>
                <label for="bname" class="color-highlight">{{ __('messages.regform18') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon mb-4">
                <textarea id="baddress" class="form-control baddress" placeholder="{{ __('messages.regform19') }}" name="baddress" required></textarea>
                <label for="baddress" class="color-highlight">{{ __('messages.regform19') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text bdate" id="bdate" placeholder="{{ __('messages.regform20') }}" name="bdate" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <label for="bdate" class="color-highlight">{{ __('messages.regform20') }}*</label>
                
            </div>
             <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="designation_id" class="color-highlight profess-tag">{{ __('messages.regform21') }}*</label>
                <select required  class="form-select designation_id profess-tag-1" id="designation_id" name="designation_id" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
             <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="nature" class="color-highlight profess-tag">{{ __('messages.regform22') }}*</label>
                <select required  class="form-select nature profess-tag-1" id="nature" name="nature" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="tel" class="form-control validate-text bphone" id="bphone" placeholder="{{ __('messages.regform23') }}" name="bphone" required>
                <label for="bphone" class="color-highlight">{{ __('messages.regform23') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="email" class="form-control validate-text bemail" id="bemail" placeholder="{{ __('messages.regform24') }}" name="bemail" required>
                <label for="bemail" class="color-highlight">{{ __('messages.regform24') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="text" class="form-control validate-text website" id="website" placeholder="{{ __('messages.regform25') }}" name="website" >
                <label for="website" class="color-highlight">{{ __('messages.regform25') }}</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
           
             <div class="mb-3 pb-2">
                <h5 class="float-start font-19 font-600 mb-3 ps-1">DOCUMENTS DETAILS</h5>
            </div>
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-5">
                <input type="text" class="form-control validate-text idproof" id="idproof" placeholder="{{ __('messages.regform26') }}" name="idproof" >
                <label for="idproof" class="color-highlight">{{ __('messages.regform26') }}</label>
               
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="file" class="form-control validate-text idimage file-lt" id="idimage" placeholder="{{ __('messages.regform27') }}" name="idimage" >
                <label for="idimage" class="color-highlight">{{ __('messages.regform27') }}</label>
                 <span class="text-danger">Max. upload size 1MB</span>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <!-- <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">-->
            <!--    <input type="file" class="form-control validate-text idaddress file-lt" id="idaddress" placeholder="{{ __('messages.regform28') }}" name="idaddress" >-->
            <!--    <label for="idaddress" class="color-highlight">{{ __('messages.regform28') }}*</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="file" class="form-control validate-text breg file-lt" id="breg" placeholder="{{ __('messages.regform29') }}" name="breg" >
                <label for="breg" class="color-highlight">{{ __('messages.regform29') }}</label>
                 <span class="text-danger">Max. upload size 1MB</span>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 ">
                <input type="text" class="form-control validate-text gst" id="gst" placeholder="{{ __('messages.regform30') }}" name="gst" >
                <label for="gst" class="color-highlight">{{ __('messages.regform30') }}</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="file" class="form-control validate-text gstcer file-lt" id="gstcer" placeholder="{{ __('messages.regform31') }}" name="gstcer" >
                <label for="gstcer" class="color-highlight">{{ __('messages.regform31') }}</label>
                <span class="text-danger">Max. upload size 1MB</span>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <!-- <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 ">-->
            <!--    <input type="text" class="form-control validate-text pan" id="pan" placeholder="{{ __('messages.regform32') }}" name="pan" >-->
            <!--    <label for="pan" class="color-highlight">{{ __('messages.regform32') }}*</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
            <!-- <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">-->
            <!--    <input type="file" class="form-control validate-text panimage file-lt" id="panimage" placeholder="{{ __('messages.regform33') }}" name="panimage" >-->
            <!--    <label for="panimage" class="color-highlight">{{ __('messages.regform33') }}*</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
             <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="others" class="color-highlight profess-tag">{{ __('messages.regform34') }}</label>
                <select  class="form-select others profess-tag-1" id="others" name="others" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;" >
                <option label='Please Select' value=''>Select any one</option>
                
                </select>

            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="file" class="form-control validate-text doc file-lt" id="doc" placeholder="{{ __('messages.regform35') }}" name="doc" >
                <label for="doc" class="color-highlight">{{ __('messages.regform35') }}</label>
                <span class="text-danger">Max. upload size 1MB</span>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            
            </div>
            @endif
              @if(Auth::guard('customer')->user())
            <div class="mb-3 pb-4">
                <h5 class="float-start font-19 font-600 mb-3 ps-1">MANDATORY FIELDS</h5>
            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 mt-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="category" class="color-highlight profess-tag">Category*</label>
                <select  required class="form-select category profess-tag-1" id="category" name="category" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4 subcatdivreg" style="position: relative;margin-bottom: 15px !important;">
                <label for="subcategory" class="color-highlight profess-tag">Sub category*</label>
                <select  required class="form-select subcategory profess-tag-1" id="subcategory" name="subcategory" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="chapter" class="color-highlight profess-tag">Vahini*</label>
                <select  required class="form-select chapter profess-tag-1" id="chapter" name="chapter" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
            
             <div class="input-style input-style-always-active has-borders no-icon mb-4">
                <textarea id="descp" class="form-control descp" placeholder="Description" name="descp" required></textarea>
                <label for="descp" class="color-highlight">Description*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon mb-4">
                <textarea id="keyword" class="form-control keyword" placeholder="Keyword" name="keyword" required></textarea>
                <label for="keyword" class="color-highlight">Keyword*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
             
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="state" class="color-highlight profess-tag">State*</label>
                <select   class="form-select state profess-tag-1" id="state" name="state" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="country" class="color-highlight profess-tag">Country*</label>
                <select  required class="form-select country profess-tag-1" id="country" name="country" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>

            </div>
           
            
            <div class="moredetails">
            <div class="mb-3 pb-2">
                <h5 class="float-start font-19 font-600 mb-3 ps-1">REFERENCE DETAILS</h5>
            </div>
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-5">
                <input type="text" class="form-control validate-text rname" id="rname" placeholder="{{ __('messages.regform36') }}" name="rname" required>
                <label for="rname" class="color-highlight">{{ __('messages.regform36') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <!--  <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 ">-->
            <!--    <input type="text" class="form-control validate-text rmem" id="rmem" placeholder="{{ __('messages.regform37') }}" name="rmem" >-->
            <!--    <label for="rmem" class="color-highlight">{{ __('messages.regform37') }}*</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
             <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
                <input type="tel" class="form-control validate-text rphone" id="rphone" placeholder="{{ __('messages.regform38') }}" name="rphone" required>
                <label for="rphone" class="color-highlight">{{ __('messages.regform38') }}*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            <!--  <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 ">-->
            <!--    <input type="email" class="form-control validate-text remail" id="remail" placeholder="{{ __('messages.regform39') }}" name="remail" >-->
            <!--    <label for="remail" class="color-highlight">{{ __('messages.regform39') }}</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
            <!-- <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">-->
            <!--    <input type="file" class="form-control validate-text signature file-lt" id="signature" placeholder="{{ __('messages.regform40') }}" name="signature" >-->
            <!--    <label for="signature" class="color-highlight">{{ __('messages.regform40') }}</label>-->
            <!--    <i class="fa fa-times disabled invalid color-red-dark"></i>-->
            <!--    <i class="fa fa-check disabled valid color-green-dark"></i>-->
            <!--</div>-->
            
            </div>
            
            @endif
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4">
                <div class="form-check icon-check">
 <input class="form-check-input" type="checkbox" value="1" id="check3" checked="" required>
<label class="form-check-label" for="check3">I Accept all <a href="{{route('terms.conditions')}}" target="_blank" class="color-highlight">Terms & Conditions</a></label>
<i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
<i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
</div>
                
            </div>
            <center>
            <input type="submit" class="btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="{{ __('messages.regformsubmit') }}">
            </center>
        </form>
        
        <div class="divider mt-4 mb-3"></div>
 @if(!Auth::guard('customer')->user())
                <div class="d-flex">
                    <div class="w-50  pb-2  opacity-60 pb-3 text-start font-900  color-highlight"><a href="{{ route('login') }}" class=" color-highlight">{{ __('messages.title') }}</a></div>
                    
                </div>
                @endif
    </div>
</div>


@endsection
@section('footer')
@parent
@endsection


    
    
@section('footerscript')
@parent
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" ></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
<script type="text/javascript">


function OnFileValidation() {

    var image = document.getElementsByTagName("input[type='file']");

    if (typeof (image.files) != "undefined") {

        var size = parseFloat(image.files[0].size / 1024).toFixed(2); 

        if(size > 2) {

            alert('Please select image size less than 1 MB');

        }else{

            alert('success');

        }

    } else {

        alert("This browser does not support HTML5.");

    }

}
 
$(document).ready(function(){
    // $("input[type='file']").change(function() {
    //     fileSize = this.files[0].size;
    //     if (fileSize > MAX_FILE_SIZE) {
    //         this.setCustomValidity("File must not exceed 1 MB!");
    //         this.reportValidity();
    //     } 
    // });

        
         $('.mdiv').hide();
         
       
         
         $('[name=martial]').on('click', function(){
              if($(this).val() == 1 ){
                  
                  $('.mdiv').show();
                  $("input[name='martial_date']").prop('required',true);
                  
              }
              else{
                  $('.mdiv').hide();
                   $("input[name='martial_date']").prop('required',false);
              }
          });
         
         
        if($(".rolesec").val() == 1){
               
        $('.moredetails').show();
     }
     else {
        $('.moredetails').hide();
     }
        
         var regExp = /[a-zA-Z]/i;
//   $('#gotra').on('keydown keyup', function(e) {
       $( ".gotra" ).keypress(function(e) {
      var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                    
                    
                    
    // var value = $(this).val();

    // // No letters
    // if (regExp.test(value)) {
    //   e.preventDefault();
    //   return true;
    // }
    // else{
    //     return false;
    // }
  });
        
        $('#paas').on('change', function(){
        $('#password').attr('type',$('#paas').prop('checked')==true?"text":"password"); 
    });
        
        $('.padd').on('click', function(){
            if($('#address').val())
            {
                $('#paddress').val($('#address').val()!= '' ? $('#address').val() : ''); 
            }
            else{
                $('.padd').prop('checked', false);
            }
        
        
    });
        
        
        
        $("#martial_date").datepicker();

        $("#dob").datepicker();
        $("#bdate").datepicker();

         $(".form-select").select2({
          placeholder : "Placeholder",
          tags: true,
           minimumResultsForSearch: Infinity

      });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        //Designation
        
         $.ajax({
            url: '{{route('registerdesignation.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".nature").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".nature").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        //Nature
        
         $.ajax({
            url: '{{route('registernature.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".designation_id").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".designation_id").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        //Member Category
        
         $.ajax({
            url: '{{route('membercategory.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".others").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".others").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
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
        
        //roles conditions
        
        $('.roles').on('change', function() 
        {
            if($(this).val() == 2)
            {
                $('.moredetails').show();
                $("input[type='text']").prop('required',true);
                $("input[type='email']").prop('required',true);
                $("input[type='file']").prop('required',true);
                $("input[type='date']").prop('required',true);
                $("input[type='radio']").prop('required',true);
                $("select").prop('required',true);
                $("textarea").prop('required',true);
                
                $("input[name='profile']").prop('required',false);
            }
            else if($(this).val() == 1)
            {
                $('.moredetails').hide();
                
                $("input[type='text']").prop('required',false);
                $("input[type='email']").prop('required',false);
                $("input[type='file']").prop('required',false);
                $("input[type='date']").prop('required',false);
                $("input[type='radio']").prop('required',false);
                $("select").prop('required',false);
                $("textarea").prop('required',false);
                
                
                $("input[name='name']").prop('required',true);
                $("input[name='email']").prop('required',true);
                $("input[name='phone']").prop('required',true);
                $("input[name='password']").prop('required',true);
                $("input[name='profile']").prop('required',false);
                $("input[name='city']").prop('required',true);
                 $("select[name='state']").prop('required',true);
                 $("select[name='country']").prop('required',true);
                 $("select[name='chapter']").prop('required',true);
                 $("select[name='category']").prop('required',true);
                 $("select[name='subcategory']").prop('required',true);
                $("textarea[name='descp']").prop('required',true);
                 $("textarea[name='keyword']").prop('required',true);
            }
            else{
                $('.moredetails').hide();
                $('.passw').hide();
            }
                 
        });
        
        
        //category
        
         $.ajax({
            url: '{{route('registercategory.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".category").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".category").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        //subcategory
        
        $('.category').on('change', function()
        {
                $.ajax({
                    url: '{{route('registersubcategory.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, category:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    {
                        if(data.length > 0)
                        {
                             $(".subcatdivreg").show();
                              $(".subcategory").attr('required',true);
                           $(".subcategory").html('');
                            $(".subcategory").append("<option label='Please Select' value=''>Select any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".subcategory").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                        else
                        {
                        //   alert('err'); 
                           $(".subcatdivreg").hide();
                            $(".subcategory").attr('required',false);
                           
                            
                        }
                    }
                });
        });
        
        //chapter

        $.ajax({
            url: '{{route('registerchapter.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                
                    $(".chapter").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".chapter").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                
            }
        }); 
        
        //state
        $.ajax({
            url: '{{route('registerstate.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                
                    $(".state").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".state").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                
            }
        }); 

        //country
        $('.state').on('change', function() 
        {
                 $.ajax({
                    url: '{{route('registercountry.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, state:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                            
                            $(".country").html(" ");

                            $(".country").append("<option label='Please Select' value=''>Select any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".country").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        
                    }
                });
        });


    });
</script>


@endsection 