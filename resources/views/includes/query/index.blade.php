@extends('includes.master')

@section('headerscript')
@parent
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css">
@endsection

@section('header')
@parent
@endsection

@section('content')
@inject('categories', 'App\Models\TicketCategory')
  <div class="page-title page-title-small">
    <h2>
      <a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{__('messages.Query')}}
    </h2>
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
    <div class="content mb-5 mx-4" >
      <div class="d-flex justify-content-between mb-3">
        <div>
          <h4>Have a Query?</h4>
        </div>
        <div>
          <a href="https://wa.me/919066798311" class="btn btn-success">Chat Now</a>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-between ">
        <div>
          <h4>Support</h4>
        </div>
        <div>
          <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">Create New</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Model -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Ticket</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 mb-2">
              <label for="category_id"><b>Category</b></label>
              <select class="form-control" id="category_id" name="category_id">
                <option value="">Select Category</option>
                @foreach($categories->get() as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 mb-2">
              <label for="subcategory_id"><b>Sub-Category</b></label>
              <select class="form-control" id="subcategory_id" name="subcategory_id">
                <option value="">Select Sub-Category</option>
              </select>
            </div>
            <div class="col-12 mb-2">
              <label for=""><b>Issue in Brief</b></label>
              <textarea class="form-control" name="" id="" cols="30" rows="6"></textarea>
            </div>            
            <div class="col-12 mb-2">
              <label for=""><b>Photo Upload</b></label>
              <input class="form-control" type="file" name="" id="">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-success">Submit</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
@endsection