@extends('admin.main')

@section('menubar_script')
@parent
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')

 <div class="page-body">
     
     @if(\Session::get('succes'))
         <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
                      <div class="toast defaul-show-toast align-items-center text-white bg-success position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
                      <div class="toast-body">{{ \Session::get('succes') }}   
                        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                    </div>
        @endif
    {{ \Session::forget('succes') }}
    
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Designation</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Designation</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          
          
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="blog-single">
                  <div class="blog-box blog-details">
                   <div class="card">
                      <div class="card-body">
                        <div class="blog-details">
                          <ul class="blog-social">
                            <li><i class="fa fa-calendar-o"></i>{!! date('d M Y', strtotime($designation->updated_at)) !!}</li>
                            <li><i class="fa fa-clock-o"></i><?=$designation->status== '1' ? "Activated" : "Not-Activated";?></li>
                          </ul>
                          <h4>
                            {{$designation->name}} <?= $designation->name_ka != ''  ? "--" : "";?> {{$designation->name_ka}}
                          </h4>
                          
                          <?= $designation->image != ''  ? "<hr>" : "";?>
                          
                          
                          <div class="mt-2">
                              <img width="150" height="150" class="img-responsive " src="{{asset('uploads/designation')}}/{{$designation->image}}" alt="blog-main">
                        </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent
 
@endsection