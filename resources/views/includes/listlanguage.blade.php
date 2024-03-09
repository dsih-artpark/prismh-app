@extends('includes.master')
@section('headerscript')
@parent
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

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small"> 
    <h2>{{ __('messages.reghead') }}</h2>
</div>

<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    
    <div class="card-bg preload-img" data-src=""></div>
</div>

@if(Session::has('success'))
<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>
@endif

@if(Session::has('error'))
<div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
    <span><i class="fa fa-times"></i></span>
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>
@endif

<div class="card card-style">
    <div class="content">
        <div class="col-12 ps-0">
            
            <div class="text-center">
                <img src="{{asset('admin/assets/images/logo/small-logo.png')}}" width="75" height="75" class="rounded-xl ">
                
            </div>
        </div>
    </div>
    <div class="content mt-2 mb-0">
       
        <!--<h2 class="mb-3 color-highlight">{{ __('messages.reghead') }}</h2>-->
        
<p>{{ Session::get('error') }}</p>
        <form method="post" action="{{route('language.store')}}">
            @csrf
            
            <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="lang" class="color-highlight profess-tag">{{ __('messages.regselect') }} {{ __('messages.language') }}</label>
                <select  required class="form-select lang profess-tag-1" id="lang" name="lang" data-placeholder="{{ __('messages.regselect') }}"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                    <option label='Please Select' value=''>Select any one</option>
                    <option value="en">English</option>
                    <option value="ka">Kannada</option>
                </select>

            </div>
            
            <center>
                <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="{{ __('messages.regformsubmit') }}">
            </center>
            
        </form>
        <!--<div class="divider mt-4 mb-3"></div>-->
        
       
    </div>
    
</div>

@endsection
@section('footer')
@parent
@endsection
@section('footerscript')
@parent
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
@endsection