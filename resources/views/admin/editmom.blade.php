@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Mom</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Mom</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit Mom</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.mom.update', ["id"=>$mom['det']->id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="col-sm-12">
                <div class="mb-3">
                  <label for="validationCustom01">Topic</label>
                  <input class="form-control" id="validationCustom01" type="text" name="topic" placeholder="Add Mom Topic" value="{{$mom['det']->topic}}" required>
                </div>
                <div class="mb-3">
                  <label for="validationCustom03">Hosted / Chaired By</label>
                  <input class="form-control" id="validationCustom03" type="text" name="hosted" placeholder="please enter hosted by" value="{{$mom['det']->hosted}}" required="">
                </div>
                <div class="mb-3">
                          <label class="form-label" for="category">Meetings</label>
                          <select class="form-select" id="category" name="category" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            @foreach($mom['meetings'] as $cat)
                             @php 
                             $categorysel = ($cat->id == $mom['det']->category)?"selected":"";
                             @endphp
                            <option value="{{$cat->id}}" <?=$categorysel;?>>{{$cat->name}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="memberid">Members</label>
                          <select class="form-select" id="memberid" name="memberid" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            @foreach($mom['members'] as $cat)
                             @php 
                             $categorysel = ($cat->uid == $mom['det']->memberid)?"selected":"";
                             @endphp
                            <option value="{{$cat->uid}}" <?=$categorysel;?>>{{$cat->uname}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="responsibility">Members</label>
                          <select class="form-select" id="responsibility" name="responsibility" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            @foreach($mom['members'] as $cat)
                             @php 
                             $categorysel = ($cat->uid == $mom['det']->responsibility)?"selected":"";
                             @endphp
                            <option value="{{$cat->uid}}" <?=$categorysel;?>>{{$cat->uname}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                        <div class="mb-3">
                  <label class="form-label" for="validationTextarea">Details</label>
                  <textarea id="area1" class="form-control is-invalid"  name="details" cols="10" rows="2" required="">{{$cat->details}}</textarea>
                </div>
                <div class="mb-3">
                  <label for="date">Date</label>
                  <input class="form-control" id="date" type="date" name="date" value="{{date('m/d/y',strtotime($cat->date))}}"  required>
                </div>
                
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                          @php
                          $chk = $mom['det']->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> >
                         
                        <span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>    
              </div>
              <div class="btn-showcase text-end">
                <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-light" type="reset" value="Cancel">
              </div>
            </form>
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

<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>

    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>

@endsection