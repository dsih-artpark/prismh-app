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
                  <h3>Resources</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admindashboard')}}">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Resources</li>
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
                    <!--<div class="card banner-wrraper"><img class="img-fluid w-100 bg-img-cover" src="{{asset('uploads/activities')}}/<?=$activities->image;?>" alt="blog-main"></div>-->
                    <div class="card">
                      <div class="card-body">
                        <div class="blog-details">
                          <ul class="blog-social">
                            <li><i class="fa fa-calendar-o"></i>{!! date('d M Y', strtotime($activities->updated_at)) !!}</li>
                            <li><i class="fa fa-clock-o"></i><?=$activities->status== '1' ? "Activated" : "Not-Activated";?></li>
                          </ul>
                          <h4>
                            {{$activities->title}}
                          </h4>
                          <div class="single-blog-content-top">
                              <p>{{$activities->descp}}</p>
                          </div>
                          <?= $activities->image != ''  ? "<hr>" : "";?>
                          
                          
                          <div class="mt-2">
                              <img width="150" height="150" class="img-responsive " src="{{asset('uploads/activities')}}/{{$activities->image}}" alt="blog-main">
                        </div>
                          @if(!empty($activities->image2))
                         <div class="divider mt-4"></div>

            <h4>Images</h4>
            

            <div class="row">
                @php
                $mul = explode("|",$activities->image2);
                @endphp
                @foreach($mul as $imgv)
                <div class="col-3">
                   <img src="{{url('public/uploads/activities/sub') }}/{{$imgv}}" data-src="{{url('public/uploads/activities/sub') }}/{{$imgv}}" width="105" height="105" class="img-thumbnail rounded-sm" alt="img">
                </div>
                @endforeach
                
            </div>
            @endif
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