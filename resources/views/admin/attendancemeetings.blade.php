@extends('admin.main')

@section('menubar_script')
@parent

<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/timepicker.css')}}">

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
          <h3>Meetings</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Meetings</li>
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
            <h5>Meeting Attendance</h5>
          </div>
          <div class="card-body add-post">
          
            <form class="f1" method="post" action="{{route('admin.meetings.attendance.update', ["id"=>$meetings['det']->id])}}" enctype='multipart/form-data'>
                 @csrf
                  @method('PUT')
                     
                        <div class="mb-2">
                          <label for="f1-first-name">Meeting</label>
                          <input class=" form-control" id="f1-first-name" type="text" name="name" placeholder="" value="{{$meetings['det']->title}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="submodules">Present Members <span class="color-grey">(Mark for present members)</span></label>
                          <select multiple class="form-select submodules" id="submodules" name="custid[]" required="" fdprocessedid="xcyc5">
                            @foreach($meetings['members'] as $mem) 
                           
                            <option value="{{$mem->id}}" <?php
                            $da = DB::table('pwa_meetings_attendance')->select('*')->where('mid', $meetings['det']->id)->where('custid', $mem->id)->first();
                            if(isset($da)){
                            if($mem->id == $da->custid){ 
                                echo"selected";
                                
                            } 
                            }?> >{{$mem->username}}</option>
                            @endforeach
                          </select>
                        </div>
                       
                       
                        <div class="f1-buttons">
                          <input class="btn btn-primary" type="submit" value="Submit">
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

 <script src="{{asset('admin/assets/js/time-picker/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/time-picker/highlight.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/time-picker/clockpicker.js')}}"></script>


<script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    
    <script src="{{asset('admin/assets/js/form-wizard/form-wizard-three.js')}}"></script>
    <script src="{{asset('admin/assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>



<script>
    
    $(document).ready(function() {
        
        $(".submodules").select2({
                placeholder: "Select"
            });
            
            
            
         
        
    });
    
    </script>





@endsection