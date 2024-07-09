@extends('workers.layout.app')

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => __('messages.Dashboard'), 'back' => false])
    
    <div class="card card-style opportunity_section">
      <div class="content">
        <div class="row mb-3 pt-4">
          <div class="col-xl-6 col-sm-6 box-col-4">
            <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
              <div class="card-body">
                <div class="media d-flex align-item-end">
                  <div class="social-font" style="color:#228b22;">
                    <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                  </div>
                  <div class="media-body ms-5">
                    <h4 style="color:#228b22;">Houses Surveyed</h4>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row mb-0">
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap; color:#228b22;">{{$house_servey}}</h5>
                    <span class="font-roboto" style="font-weight:300px;font-size:18px;text-wrap:nowrap;">Total</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$weekly_servey}}</h5>
                    <span class="font-roboto" style="font-weight:300px;font-size:18px;text-wrap:nowrap;">Weekly</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$monthly_servey}}</h5>
                    <span class="font-roboto" style="font-weight:300px;font-size:18px;text-wrap:nowrap;">Monthly</span>   
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6 box-col-4">
            <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
              <div class="card-body">
                <div class="media d-flex align-item-end">
                  <div class="social-font" style="color:#228b22;">
                    <i class="fa fa-bug fa-2x" aria-hidden="true"></i>
                  </div>
                  <div class="media-body ms-5">
                    <h4 style="color:#228b22;">Breeding Spots</h4>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row mb-0">
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$total_breeding_spots}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$weekly_breeding_spots}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Weekly</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$monthly_breeding_spots}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Monthly</span>   
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6 box-col-4">
            <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
              <div class="card-body">
                <div class="media d-flex align-item-end">
                  <div class="social-font" style="color:#228b22;">
                    <img width=30 src="{{asset('images/avatars/source_reduction.svg')}}" alt="">
                  </div>
                  <div class="media-body ms-5">
                    <h4 style="color:#228b22;">Source Reduction</h4>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row mb-0">
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$source_reduction_cleared}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Cleared</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$source_reduction_sprayed}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Sprayed</span>   
                  </div>
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$source_reduction_pending}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Pending</span>   
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6 box-col-4">
            <div class="card social-widget-card" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 5px;">
              <div class="card-body">
                <div class="media d-flex align-item-end">
                  <div class="social-font" style="color:#228b22;">
                    <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                  </div>
                  <div class="media-body ms-5">
                    <h4 style="color:#228b22;">Wards Covered</h4>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row mb-0">
                  <div class="col text-center">
                    <h5 class="counter mb-0 font-roboto font-primary" style="font-size:25px;text-wrap:nowrap;color:#228b22;">{{$ward_count}}</h5>
                    <span class="font-roboto" style="font-weight:600px;font-size:18px;text-wrap:nowrap;">Total</span>   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mb-3 pt-4">
          <div class="col-md-3 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">49</h1>
            <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">Total larva survey</h5>
          </div>
          <div class="col-md-3  col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">0</h1>
            <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Todays larva survey</h5>
          </div>
          <div class="col-md-3  col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">0</h1>
            <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Todays larva survey</h5>
          </div>
          <div class="col-md-3 col-6 font-20 text-center px-0">
            <h1 class="color-highlight mb-0 pb-1">0</h1>
            <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Todays larva survey</h5>
          </div>
        </div> -->
      </div>
    </div>
    
  </div>
@endsection
