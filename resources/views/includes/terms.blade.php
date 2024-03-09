@extends('includes.master')

@section('headerscript')
@parent
<style>
    .footer{
        display:none;
    }
    .footer-bar-5{
        display:none;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2>Terms & Conditions</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       
         <!--<a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>-->
        
  
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
</div>




<div class="card card-style profile-section">
            <div class="content page-profile-team">
                
                
         
        
                
                <div class="row mb-0">
                    <div class="col-md-12">
                        <div class="p-4">
                            @php
                    $terms =  DB::table('pwa_terms')->where('status', 1)->first();
                    @endphp
                    {!!$terms->descp!!}
                        </div>
                    </div>
                    
                    
                    
                </div>
                
                
                
                
                
                
            </div>
        </div>
        

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection