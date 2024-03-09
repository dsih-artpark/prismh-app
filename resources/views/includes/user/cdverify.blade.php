@extends('includes.user.master')

@section('headerscript')
@parent

<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<style>
    video
    {
    width: -webkit-fill-available;
}
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>Verify</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       @if(Auth::guard('customer')->user()->profile)
      <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}"></a>
        
        @else
         <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
        @endif
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
</div>

@if(Session::has('success'))

<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif

   <div class="card card-style" style="margin-bottom: 80px!important;">
            <div class="content mb-0" >
                <form method="post" action="{{route('user.verifystore')}}" enctype='multipart/form-data'>
                @csrf
                <div class="row mb-4">
                   
                   
                <input type="hidden"  name="did" value="{{$id}}">
                
                 <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="file" class="form-control validate-text image" id="image" placeholder="image" name="image" >
                <label for="phone" class="color-highlight phonelabel">Upload Image</label>
                
            </div>
                   <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="dstatus" class="color-highlight profess-tag">Status*</label>
                <select  required class="form-select dstatus profess-tag-1" id="dstatus" name="dstatus" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                    <option label='Please Select' value=''>Select any one</option>
                    <option value="Designated Location">Designated Location</option>
                    <option value="Illegal Location">Illegal Location</option>
                </select>

            </div>  
            <div class="input-style input-style-always-active has-borders no-icon mb-4">
                <textarea id="descp" class="form-control descp" placeholder="Comments" name="descp" required></textarea>
                <label for="descp" class="color-highlight">Comments*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
           
                    <div class="p-2 btnsub">
            <input type="submit" class="btnsub1 btn btn-m btn-full rounded-sm shadow-l btn-primary text-uppercase font-700 mt-4" name="verify" value="Verify">
            <input type="submit" class="btnsub2 btn btn-m rounded-sm shadow-l btn-danger text-uppercase font-700 mt-4" name="notice" value="Notice">
        </div>
                </div>
                </form>


            </div>
        </div>
                
                
               
                
               
                
@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent

<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script type="text/javascript">

			"use strict";

		 $(document).ready(function(){

				// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
	$('.btnsub').hide();			
    $('.btnsub1').hide();
    $('.btnsub2').hide();
            $('body').on('change', '.dstatus', function () {
                var dstsval = $(this).val();
               
                if(dstsval == "Designated Location"){
                    $('.btnsub').show();			
                    $('.btnsub1').show();
                    $('.btnsub2').hide();
                }
                else if(dstsval == "Illegal Location"){
                   
                    $('.btnsub').show();			
                    $('.btnsub1').hide();
                    $('.btnsub2').show();
                }
                else{
                    
                    $('.btnsub').hide();			
                    $('.btnsub1').hide();
                    $('.btnsub2').hide();
                }
            
            });
				
				
	});
        
    </script>



@endsection