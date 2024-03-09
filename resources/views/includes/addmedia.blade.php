@extends('includes.master')
@section('headerscript')
@parent
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>

    

</style>
@endsection
@section('header')
@parent
@endsection
@section('content')

<div class="page-title page-title-small"> 
    <h2><a href="#" data-back-button=""><i class="fa fa-arrow-left"></i></a> Add {{ __('messages.menu5') }}</h2>
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

@if(Session::has('error'))

<div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
    <span><i class="fa fa-times"></i></span>
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif

                    
<div class="card card-style">
    <div class="content mb-0 mt-3">
        
        
        
           
           <form method="post" action="{{route('login.media.store')}}" enctype='multipart/form-data'>
    <!--<form action="php/contact.php" method="post" class="contactForm" id="contactForm">-->
    <!--                <fieldset>-->
    
     @csrf
     <div class="row mb-4">
         
         <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="text" class="form-control validate-text title" id="title" placeholder="title" name="title" required>
                <label for="title" class="color-highlight">Title*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            
            
                         
                         <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                            <textarea id="descp" class="form-control descp" placeholder="Description" name="descp"></textarea>
                            <label for="descp" class="color-highlight">Description*</label>
                            <i class="fa fa-times disabled invalid color-red-dark"></i>
                            <i class="fa fa-check disabled valid color-green-dark"></i>
                        </div>
                         <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="category" class="color-highlight profess-tag">Category*</label>
                <select   class="form-select category profess-tag-1" id="category" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>

                        <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                            <input type="file" class="form-control validate-text image file-lt" id="image" placeholder="Photo" name="image">
                            <label for="image" class="color-highlight">Photo</label>
                        </div>

                       
                       
                       
                     

                        <center>
            <input type="submit" class="btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="{{ __('messages.regformsubmit') }}">
            </center>
                    <!--</fieldset>-->
                    </div>
                </form>
                
                <div class=" mt-4 mb-3"></div>
                
                
    </div>
</div>


@endsection
@section('footer')
@parent
@endsection


    
    
@section('footerscript')
@parent
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        
        
        $('#image').bind('change', function() {
            
            var file = this.files[0];
var fileType = file["type"];
var validImageTypes = ["image/jpg", "image/jpeg", "image/png"];
if ($.inArray(fileType, validImageTypes) < 0) {
     alert("Image only allowed");
     $("#image").val('');
}
else{
            
            
        var a=(this.files[0].size);
        alert(a);
        if(a > 1048576) {
            alert("maximum allowed image size is 1MB");
            
            
            $("#image").val('');
        }
        
        
        
} 
    
         
        
    });
    
    
    
        
        $(".form-select").select2({
          placeholder : "Placeholder",
          tags: true,
           minimumResultsForSearch: Infinity

      });
      
     

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        
        
      //Opportunity Category
        
         $.ajax({
            url: '{{route('oppocategory.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".category").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".category").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 


    });
</script>


@endsection 