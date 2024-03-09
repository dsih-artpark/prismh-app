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
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.oppohead') }} {{ __('messages.oppoheadnote') }}</h2>
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

<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrte" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif

<div class="card card-style opportunity_section">
            <div class="content">
                <div class="row mb-0">
                    
            <!--Add button-->
            @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 4;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                    <div class="col-lg-3 col-sm-3 col-4">
                        <a href="{{route('login.opportunity.add')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="{{route('login.opportunity.add')}}">
                                      <img src="{{asset('images/avatars/vbf_plus.png')}}" class="rounded-circle bg-fade-red-light shadow-l" width="25">
                                      </a>  
                                </h1>
                                 <p class="mt-n2  fw-400 pb-sm-4 pb-2 mb-0  size-mobile color-highlight">Add
                                </p>
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    New
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                    </div>
                  <?php } ?>
             @endif 
             
             @if(Auth::guard('customer')->user()->roles == 2)
             @php
            $role = 2;
            $module = 2;
            $submodule = 4;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                    <div class="col-lg-3 col-sm-3 col-4">
                        <a href="{{route('login.opportunity.add')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="{{route('login.opportunity.add')}}">
                                      <img src="{{asset('images/avatars/vbf_plus.png')}}" class="rounded-circle bg-fade-red-light shadow-l" width="25">
                                      </a>  
                                </h1>
                                <p class="mt-n2  fw-400 pb-sm-4 pb-2 mb-0  size-mobile color-highlight">Add
                                </p>
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    New
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                    </div>
                   
                    
                  <?php } ?>
            @endif  
            
            <!--End add button-->
            
            <!--count for given-->
            
            @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                 <div class=" offset-sm-1 col-lg-3 col-sm-3 col-4">
                        <a href="#">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="#"><img src="{{asset('images/avatars/vbf_sav.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="25"></a>  
                                </h1>
                                
                                
                                <p class="mt-n2  fw-400 pb-sm-4 pb-2 mb-0  size-mobile color-highlight">
                                    {{count($data['given'])}}
                                </p>
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    Given
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                   </div>
            <?php } ?>
            @endif
            
            @if(Auth::guard('customer')->user()->roles == 2)
            @php
            $role = 2;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                    <div class=" offset-sm-1 col-lg-3 col-sm-3 col-4">
                        <a href="#">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="#"><img src="{{asset('images/avatars/vbf_salary.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="25"></a>  
                                </h1>
                                
                                <p class="mt-n2  fw-400 pb-sm-4  pb-2 mb-0  size-mobile color-highlight">
                                    {{count($data['received'])}}
                                </p>
                                
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    Received
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>

                    </div>
            <?php } ?>
             @endif 
            
            @if(Auth::guard('customer')->user()->roles == 2)
            @php
            $role = 2;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                 <div class=" offset-sm-1 col-lg-3 col-sm-3 col-4">
                        <a href="#">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="#"><img src="{{asset('images/avatars/vbf_sav.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="25"></a>  
                                </h1>
                                
                                <p class="mt-n2  fw-400 pb-sm-4 pb-2 mb-0  size-mobile color-highlight">
                                    {{count($data['given'])}}
                                </p>
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    Given
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                   </div>
            <?php } ?>
            @endif
            
            <!--End count for given-->
            
            <!--count for received-->
            
            
            @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                    <div class=" offset-sm-1 col-lg-3 col-sm-3 col-4">
                        <a href="#">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4  mt-2">
                                  <a href="#"><img src="{{asset('images/avatars/vbf_salary.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="25"></a>  
                                </h1>
                                
                                <p class="mt-n2  fw-400 pb-sm-4  pb-2 mb-0  size-mobile color-highlight">
                                    {{count($data['received'])}}
                                </p>
                                <p class="mt-n2 fw-400 pb-sm-4 pb-2 mb-0 size-mobile color-highlight">
                                    Received
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>

                    </div>
            <?php } ?>
             @endif
            
             
             
             <!--end count for received-->
             
                </div>
            </div>
        </div>
        <div class="card card-style opp-section-tab pb-0">
            <div class="content" id="tab-group-3">
                <div class="tab-controls tabs-small tabs-rounded vbf-opp-tab" data-highlight="bg-green-dark">
                
            
            @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            <a href="#" class="no-effect" data-active data-bs-toggle="collapse" data-bs-target="#tab-9">Received</a>
                    <?php }?>
                    @else 
                    @php
            $role = 2;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            <a href="#" class="no-effect" data-active data-bs-toggle="collapse" data-bs-target="#tab-9">Received</a>
            <?php } ?>
            @endif
                  @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
                    <a href="#" class="no-effect"  data-bs-toggle="collapse" data-bs-target="#tab-8">Given</a>
                    <?php }?>
                    @else 
                    @php
            $role = 2;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            <a href="#" class="no-effect" data-bs-toggle="collapse" data-bs-target="#tab-8"> Given</a>
            <?php } ?>
            @endif      
                    
                </div>
                <div class="clearfix mb-3"></div>
                
               
                
           
            
            
            
            
            @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            
             <div data-bs-parent="#tab-group-3" class="collapse show" id="tab-9">
                    @foreach($data['received'] as $oth)
                    <div class="card card-style opp-box-1 ">
                        <div class="content page-profile-team">
                            <a href="{{ url('login/opportunity')}}/{{$oth->id}}">
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <img src="{{asset('images/avatars/vbf_tab_1.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="40">
                                    </div>
                                    <div>
                                        <h5 class="mt-2 mb-0">{{$oth->name}}</h5>
                                        <p class="mb-0">{!! date('M d  Y', strtotime($oth->created_at)) !!}</p>
                                    </div>
                                    
                                    <div class="ms-auto mt-3">
                                         @if($oth->referalstatus == 1)
                                    <span class="badge bg-warning color-white font-10 py-1 px-2">Urgent</span>
                                    @endif
                                    @if($oth->referalstatus == 2)
                                    <span class="badge bg-danger color-white font-10 py-1 px-2">Very Urgent</span>
                                    @endif
                                    @if($oth->referalstatus == 3)
                                    <span class="badge bg-success color-white font-10 py-1 px-2">Standard</span>
                                    @endif
                                    &nbsp;
                                        <i class="fa fa-angle-right"></i>
                                    </div>
                                </div>
                              </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                    <?php }?>
            @endif
            @if(Auth::guard('customer')->user()->roles == 2)
            @php
            $role = 2;
            $module = 2;
            $submodule = 6;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            
             <div data-bs-parent="#tab-group-3" class="collapse show" id="tab-9">
                    @foreach($data['received'] as $oth)
                    <div class="card card-style opp-box-1 ">
                        <div class="content page-profile-team">
                            <a href="{{ url('login/opportunity')}}/{{$oth->id}}">
                                <div class="d-flex">
                                    <div class="align-self-center"><img src="{{asset('images/avatars/vbf_tab_1.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="40"></div>
                                    <div><h5 class="mt-2 mb-0">{{$oth->name}}</h5><p class="mb-0">{!! date('M d  Y', strtotime($oth->created_at)) !!}</p></div>
                                    
                                    <div class="ms-auto mt-3">
                                         @if($oth->referalstatus == 1)
                                    <span class="badge bg-warning color-white font-10 py-1 px-2">Urgent</span>
                                    @endif
                                    @if($oth->referalstatus == 2)
                                    <span class="badge bg-danger color-white font-10 py-1 px-2">Very Urgent</span>
                                    @endif
                                    @if($oth->referalstatus == 3)
                                    <span class="badge bg-success color-white font-10 py-1 px-2">Standard</span>
                                    @endif
                                    &nbsp;
                                    <i class="fa fa-angle-right"></i></div>
                                </div>
                              </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <?php } ?>
            @endif
             
                
                
                
             @if(Auth::guard('customer')->user()->roles == 1)
            @php
            $role = 1;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            
            
                <div data-bs-parent="#tab-group-3" class="collapse " id="tab-8">
                    @foreach($data['given'] as $res)
                    <div class="card card-style opp-box-1 ">
                        <div class="content page-profile-team">
                          <a href="{{ url('login/opportunity')}}/{{$res->id}}">
                            <div class="d-flex">
                                <div class="align-self-center"><img src="{{asset('images/avatars/vbf_tab_1.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="40"></div>
                                <div><h5 class="mt-2 mb-0 text-capitalize">{{$res->name}}</h5><p class="mb-0">{!! date('M d  Y', strtotime($res->created_at)) !!}</p></div>
                                
                                <div class="ms-auto mt-3">
                                    @if($res->referalstatus == 1)
                                    <span class="badge bg-warning color-white font-10 py-1 px-2">Urgent</span>
                                    @endif
                                    @if($res->referalstatus == 2)
                                    <span class="badge bg-danger color-white font-10 py-1 px-2">Very Urgent</span>
                                    @endif
                                    @if($res->referalstatus == 3)
                                    <span class="badge bg-success color-white font-10 py-1 px-2">Standard</span>
                                    @endif
                                    &nbsp;<i class="fa fa-angle-right"></i>
                                    </div>
                            </div>
                          </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            <?php }?>
            @else
            @php
            $role = 2;
            $module = 2;
            $submodule = 5;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            
                <div data-bs-parent="#tab-group-3" class="collapse" id="tab-8">
                    @foreach( $data['given'] as $res)
                    <div class="card card-style opp-box-1 ">
                        <div class="content page-profile-team">
                          <a href="{{ url('login/opportunity')}}/{{$res->id}}">
                            <div class="d-flex">
                                <div class="align-self-center"><img src="{{asset('images/avatars/vbf_tab_1.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="40"></div>
                                <div>
                                    <h5 class="mt-2 mb-0 text-capitalize">{{$res->name}}</h5>
                                    <p class="mb-0">{!! date('M d  Y', strtotime($res->created_at)) !!}</p>
                                </div>
                                
                                <div class="ms-auto mt-3">
                                     @if($res->referalstatus == 1)
                                    <span class="badge bg-warning color-white font-10 py-1 px-2">Urgent</span>
                                    @endif
                                    @if($res->referalstatus == 2)
                                    <span class="badge bg-danger color-white font-10 py-1 px-2">Very Urgent</span>
                                    @endif
                                    @if($res->referalstatus == 3)
                                    <span class="badge bg-success color-white font-10 py-1 px-2">Standard</span>
                                    @endif
                                    &nbsp;
                                    <i class="fa fa-angle-right"></i></div>
                            </div>
                          </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            <?php } ?> 
            @endif    
                
                
                
                
                
               
            </div>
        </div>

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
<script type="text/javascript">

        $(document).ready(function() {

//success and error messages

            $(".s-alrte").fadeTo(5000, 500).fadeOut(1000, function(){
                $(".s-alrte").fadeOut(1000);
            });
            
        });
        </script>
@endsection