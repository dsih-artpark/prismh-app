@extends('includes.master')

@section('headerscript')
@parent
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

        <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.memhead') }}</h2>
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
    
     @if(Auth::guard('customer')->user()->roles == 2)
 @php
            $role = 2;
            $module = 1;
            $submodule = 2;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
    <div class="card card-style bg-dark">
        
        <div class="content mt-0 mb-0">
            <div class="search-box search-color shadow-xl border-0 bg-dark rounded-l bottom-0">
            <i class="fa fa-search"></i>
            <input type="text" class="search border-0" placeholder="Search here... ">
            </div>
            
            
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="text-end">
            
             <a href="#" data-menu="chapter"><span class="badge bg-highlight color-white font-12 py-2 px-4"><i class="fa fa-filter" aria-hidden="true"></i> Filter by Vahini</span></a>
            
        </div>
        
    </div>
    </div>
    <?php }?>
    @endif
            
<div class="result" style="margin-bottom:80px;">
     @php
            $role = 2;
            $module = 1;
            $submodule = 2;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
        
        <div class="resultdiv">
            @foreach($members as $mem)
        <div class="card card-style member_directory mt-4">
           
            <div class="content page-profile-team">
                <div class="row mb-0 align-items-center">
                    <div class=" col-lg-1 col-md-2 col-sm-2 col-3">
                        <a href="{{ url('login/memberdetails')}}/{{$mem->id}}">
                           
                        </a>
                    </div>
                    <div class ="col-lg-11 col-md-10 col-sm-10 col-9 member-details-point">
                        <a href="{{ url('login/memberdetails')}}/{{$mem->id}}">
                            @php
                            $chk = Auth::guard('customer')->id();
                            
                            @endphp
                            @if($chk == $mem->id)
                            <h5 class="mb-0 text-capitalize">Me</h5>
                            @else
                            <h5 class="mb-0 text-capitalize">{{$mem->username}}</h5>
                            @endif
                            <p class="mb-0 member-dir-1">{{$mem->catname}}</p>
                            <p class="mb-0 member-dir-1">{{$mem->subcatname}}</p>
                            <a class="member-dir" href="tel:+{{$mem->phone}}">{{$mem->phone}}</a>
                            <p class="mb-0 member-dir-1">{{$mem->bname}}</p>
                        </a>
                       
                    </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        
        
        <?php } ?>
        </div>

@endsection

@section('footer')
@parent

@endsection

@section('footerscript')

            @php
             $catall = DB::table('pwa_category')->where('status',1)->get();
            @endphp
            @foreach($catall as $cat)
            <div id="category{{$cat->id}}" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="310" data-menu-effect="menu-over">
        <div class="list-group list-custom-small ps-1 pe-3">
            <a href="#" class="close-menu p-1 catlink" data-id="{{$cat->id}}">
                <span class="font-13">{{$cat->name}}</span>
            </a>
            </div>
    </div>
            @endforeach
           
        
<div id="chapter" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="310" data-menu-effect="menu-over" style="overflow: scroll !important;">
        <div class="list-group list-custom-small ps-1 pe-3 catlistdiv overflow-auto">
            @php
             $catall = DB::table('pwa_chapter')->where('status',1)->get();
            @endphp
            <a href="#" class="close-menu p-1 chaptlink" data-id="0">
                <span class="font-13">All</span>
            </a>
             @foreach($catall as $cat)
             <div class="catlist close-menu"  data-id="{{$cat->id}}">
                <a href="#" class=" p-1">
                    <span class="font-13">{{$cat->name}}</span><i class="fa fa-angle-right"></i>
                </a>
            </div>
            @endforeach
            
        </div>
    </div>
@parent


<script type="text/javascript">

    $(document).ready(function(){
        
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
         $('.search').on('keyup',function(){

     $.ajax({
                 url: '{{route('members.search')}}',
            type: 'POST',
            data: {_token: CSRF_TOKEN, search:$(this).val()},
            dataType: 'JSON',
                 success: function(data) {
                     $('.resultdiv').html('');
                     
                      $('.resultdiv').html(data);
                     
                 }
     });
     
     

});


				
                    $('body').on('click', '.catlink', function () {
						$.ajax({
							    url: '{{route('catmembers.list')}}',
                                type: 'POST',
                                data: {_token: CSRF_TOKEN, category:$(this).data("id")},
								 dataType: 'JSON',
								success: function (data) {
									 $('.resultdiv').html('');
                                        $('.resultdiv').html(data);
									
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
					
				});
				$('body').on('click', '.catlist', function () {
				    
                    // $.ajax({
                    //     url: '{{route('chaptercate.list')}}',
                    //     type: 'POST',
                    //     data: {_token: CSRF_TOKEN, chapter:$(this).data("id")},
                    //     dataType: 'JSON',
                    //     success: function(data) {
                    //         $('.catlistdiv').html('');
                            
                    //         $('.catlistdiv').html(data);
                            
                    //     }
                    // });
                    
                    	$.ajax({
							    url: '{{route('chaptmembers.list')}}',
                                type: 'POST',
                                data: {_token: CSRF_TOKEN, chapter:$(this).data("id")},
								 dataType: 'JSON',
								success: function (data) {
									 $('.resultdiv').html('');
                                    $('.resultdiv').html(data);
									
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
				     
				});
				
				 $('body').on('click', '.chaptlink', function () {
				     
				    
						$.ajax({
							    url: '{{route('chaptmembers.list')}}',
                                type: 'POST',
                                data: {_token: CSRF_TOKEN, chapter:$(this).data("id")},
								 dataType: 'JSON',
								success: function (data) {
									 $('.resultdiv').html('');
                                    $('.resultdiv').html(data);
									
								},
								error: function (data) {
								console.log('Error:', data);
								}
							});
					
				});


});
</script>
                     
@endsection