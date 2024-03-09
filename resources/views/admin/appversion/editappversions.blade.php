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
          <h3>Versions</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Versions</li>
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
            <h5>Edit Versions</h5>
          </div>
          <div class="card-body add-post">
          
            <form class="f1" method="post" action="{{route('admin.appversions.update', ["id"=>$appversions->id])}}" enctype='multipart/form-data'>
                 @csrf
                  @method('PUT')
                  @php
                  $cntrow = count(explode('||',$appversions->title));
                 
                  @endphp
                  <input type="hidden" id="vercount" class="vercount" value="{{$cntrow}}">
                      
                      <div class="col-sm-12">
                          <div class="mb-3">
                  <label for="versions">Version</label>
                  <input class="form-control" id="versions" type="number" name="versions" placeholder="Add Version number" value="{{$appversions->versions}}" required="">
                </div>
                <div class="append">
                    
                    
                     @php
              $t = explode('||',$appversions->title);
              $p = explode('||', $appversions->descp);
              $im = explode('||', $appversions->image);
              $k=1;
              @endphp
              @foreach($t as $key=>$value)
              
              <div class="rt-{{$k}}">
              <div class="mb-3">
                  <label for="validationCustom01">Section / Part </label>
                  <input class="form-control" id="validationCustom01" type="text" name="title[]" placeholder="Add Section / Part Name" required="" value="{{$t[$key]}}">
                </div>
                <div class="mb-3">
                  <label class="form-label" for="validationTextarea">Content</label>
                  <textarea id="editor" class="form-control is-invalid"  name="textbox[]" cols="10" rows="2" required="">{{$p[$key]}}</textarea>
                </div>
                <div class=" mb-3">
                  <label class="form-label" for="fileInput">Upload Image</label>
                  <input type="file" class="form-control" id="fileInput" name="image[]"  >
                </div>
                
                <div class="mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/appversions')}}/{{$im[$key]}}" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/appversions')}}/{{$im[$key]}}" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="150" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description">{{$im[$key]}}</figcaption>
                    </figure>
                    </div>
                    <button type="button" class="btn btn-danger remove-tr" data-id="{{$k}}">Remove</button>
                    </div>
                    
                    @php
                    $k++;
                    @endphp
              @endforeach
                    
                    </div>
                <div class="mb-2 text-end">
                     <button type="button" name="add" id="add-btn" class="btn btn-success ">Add more</button>  
                </div>
                        
                        <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                        @php
                          $chk = $appversions->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> ><span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>
                        <div class="f1-buttons">
                          <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
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



<script type="text/javascript">
$(document).ready(function(){
    ctval = document.getElementById('vercount').value;
var i = ctval;
$("#add-btn").click(function(){
    alert('we');
++i;
$(".append").append('<div class="rt-'+i+'"><div class="mb-3 "><label for="validationCustom01">Section / Part </label><input class="form-control" id="validationCustom01" type="text" name="title[]" placeholder="Add Section / Part Name" required=""></div> <div class="mb-3"><label class="form-label" for="validationTextarea">Content</label><textarea id="editor" class="form-control is-invalid"  name="textbox[]" cols="10" rows="2" required=""></textarea></div><div class=" mb-3"><label class="form-label" for="fileInput">Upload Image</label><input type="file" class="form-control" id="fileInput" name="image[]"  ></div><button type="button" class="btn btn-danger remove-tr" data-id="'+i+'">Remove</button>');
});

$('body').on('click', '.remove-tr', function () { 
    var id = $(this).data("id");
$('.rt-'+id).remove();
}); 

});
</script>


@endsection