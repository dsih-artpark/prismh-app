@extends('includes.master')

@section('headerscript')
@parent

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
     .footer {
        display:none;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a> Pass a {{ __('messages.menu4') }} </h2>
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
                
                
                <form method="post" action="{{route('login.opportunity.store')}}" enctype='multipart/form-data'>
            @csrf
<div class="row mb-4">
    <input type="hidden" class="rolesec" value="{{Auth::guard('customer')->user()->roles}}">
    @if(Auth::guard('customer')->user()->roles == 2)
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="opportunitytype" class="color-highlight profess-tag">{{ __('messages.menu4') }} Type*</label>
                <select   class="form-select opportunitytype profess-tag-1" id="opportunitytype" name="opportunitytype" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                
                <div class="champdiv">
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="chapmember" class="color-highlight profess-tag">Members list*</label>
                <select   class="form-select chapmember profess-tag-1" id="chapmember" name="member" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                </div>
                
                <div class="categorydiv">
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="category" class="color-highlight profess-tag">Category*</label>
                <select   class="form-select category profess-tag-1" id="category" name="category" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                </div>
                <div class="subcategorydiv">
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="subcategory" class="color-highlight profess-tag">Sub Category*</label>
                <select   class="form-select subcategory profess-tag-1" id="subcategory" name="subcategory" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                </div>
                
                <!--<div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">-->
                <!--<label for="opportunityto" class="color-highlight profess-tag">Opportunity To*</label>-->
                <!--<select   class="form-select opportunityto profess-tag-1" id="opportunityto" name="opportunityto" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">-->
                <!--</select>-->
                <!--</div>-->
                @endif
                
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="referalstatus" class="color-highlight profess-tag">Priorities*</label>
                <select  required class="form-select referalstatus profess-tag-1" id="referalstatus" name="referalstatus" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                
                <div class="col-md-12 input-style-always-active has-borders no-icon mb-4" style="position: relative;margin-bottom: 15px !important;">
                <label for="referencetype" class="color-highlight profess-tag">Reference Type*</label>
                <select  required class="form-select referencetype profess-tag-1" id="referencetype" name="referencetype" data-placeholder="Select"  style="border-color: rgba(0, 0, 0, 0.08) !important;">
                </select>
                </div>
                
                <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2 ">
                <input type="text" class="form-control validate-text name" id="name" placeholder="Enter the contact name" name="name" required>
                <label for="name" class="color-highlight namelabel">Contact Name*</label>
            </div>
            
            @php
            
            $Cntname = Auth::guard('customer')->user()->username;
             $Cntphn = Auth::guard('customer')->user()->phone;
            @endphp
            
            <input type="hidden" class="rolename" id="rolename" value="{{$Cntname}}">
            <input type="hidden" class="rolephn" id="rolephn" value="{{$Cntphn}}">
            
            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4 mt-2">
                <input type="number" class="form-control validate-text phone" id="phone" placeholder="Enter the contact number" name="phone" required>
                <label for="phone" class="color-highlight phonelabel">Contact Number*</label>
                
            </div>
            
                <div class="input-style input-style-always-active has-borders no-icon mb-4">
                <textarea id="descp" class="form-control descp" placeholder="Enter the requirements" name="descp" ></textarea>
                <label for="descp" class="color-highlight">Requirements*</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
            </div>
            
              <center>
            <input type="submit" class="sbt btn btn-m btn-full rounded-sm shadow-l bg-green-dark text-uppercase font-700 mt-4" value="Submit">
            </center>
            
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script type="text/javascript">

 $(document).ready(function(){
     $('.champdiv').hide();
     $('.categorydiv').hide();
     $(".subcategorydiv").hide(); 
     
     $('.referencetype').on('change', function() 
        {
            
           if($(this).val() == 1){
               
               
              
                    $(".phone").prop('readonly',true);
                      $(".phone").val($('.rolephn').val());
                        $(".name").prop('readonly',true);
                       $(".name").val($('.rolename').val());
            
                
               
        $("#phone").prop('required',false);
        $(".phonelabel").html("Contact Number");
        $("#name").prop('required',false);
        $(".namelabel").html("Contact Name");
     }
     else{
         $("#phone").prop('required',true);
          $(".phonelabel").html("Contact Number*");
         $("#name").prop('required',true);
          $(".namelabel").html("Contact Name*");
          
           $(".phone").prop('readonly',false);
                      $(".phone").val('');
                        $(".name").prop('readonly',false);
                       $(".name").val('');
     }

      });
     
     $('.sbt').on('click', function() 
        {
           if($(".rolesec").val() == 2){
               
        $("#opportunitytype").prop('required',true);
        $("#opportunityto").prop('required',true);
     }
     else if($(".rolesec").val() == 1){
         $("#opportunitytype").prop('required',false);
        $("#opportunityto").prop('required',false);
     }

      });
     
$(".form-select").select2({
          placeholder : "Placeholder",
          tags: true,
           minimumResultsForSearch: Infinity

      });
      
     

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        
        //Opportunity type
        
         $.ajax({
            url: '{{route('listopttype.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".opportunitytype").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".opportunitytype").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        //Opportunity to
        
         $.ajax({
            url: '{{route('listoptto.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".opportunityto").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".opportunityto").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        //Referal Status
        
         $.ajax({
            url: '{{route('listoptreferal.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".referalstatus").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".referalstatus").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        //Referance Type
        
         $.ajax({
            url: '{{route('listoptreftype.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".referencetype").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".referencetype").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        
        //opportunity type
        $('.opportunitytype').on('change', function() 
        {
            if($(this).val() == 2){
                $('.champdiv').show();
                $('.categorydiv').hide();
            }
            else if($(this).val() == 3){
                $('.champdiv').show();
                $('.categorydiv').hide();
            }
            else if($(this).val() == 1){
                $('.champdiv').hide();
                $('.categorydiv').show();
            }
            else if($(this).val() == 4){
               $('.champdiv').hide();
                $('.categorydiv').hide();
            }
            else{
                $('.champdiv').hide();
                $('.categorydiv').hide();
            }
                 $.ajax({
                    url: '{{route('chapmember.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, val:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                            
                            $(".chapmember").html(" ");

                            $(".chapmember").append("<option label='Please Select' value=''>Select any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".chapmember").append("<option value="+item.id+">"+item.name+" - "+item.categ+"</option>");      
                            });
                        
                    }
                });
        });
        
        
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
        
        
        
         $('.category').on('change', function() 
        {
             $.ajax({
                    url: '{{route('subcategorymem.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, val:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                          $(".subcategorydiv").show(); 
                          
                            $(".subcategory").html(" ");

                            $(".subcategory").append("<option label='Please Select' value=''>Select any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".subcategory").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        
                    }
                });
            
        });
        
        
        
 });
</script>
@endsection