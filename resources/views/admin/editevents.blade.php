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
          <h3>Events</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Events</li>
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
            <h5>Edit Events</h5>
          </div>
          <div class="card-body add-post">
          
            <form class="f1" method="post" action="{{route('admin.events.update', ["id"=>$events->events_id])}}" enctype='multipart/form-data'>
                 @csrf
                  @method('PUT')
                      <div class="f1-steps">
                        <div class="f1-progress">
                          <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                        </div>
                        <div class="f1-step active">
                          <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                          <p>Prime</p>
                        </div>
                        <div class="f1-step">
                          <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                          <p>Details</p>
                        </div>
                        <div class="f1-step">
                          <div class="f1-step-icon"><i class="fa fa-users"></i></div>
                          <p>joiner</p>
                        </div>
                      </div>
                      <fieldset>
                        <div class="mb-2">
                          <label for="f1-first-name">Name</label>
                          <input class=" form-control" id="f1-first-name" type="text" name="name" placeholder="" value="{{$events->prime_member}}" required="">
                        </div>
                        <div class="mb-2">
                          <label for="f1-last-name">Designation</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="desig" placeholder="" required="" value="{{$events->prime_member_desig}}">
                        </div>
                        <div class="mb-2">
                          <label for="f1-last-name">Image</label>
                          <input class="f1-last-name form-control" id="" type="file" name="image" >
                        </div>
                        <div class="mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/events')}}/<?=$events->prime_member_image;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/events')}}/<?=$events->prime_member_image;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="150" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description"><?=$events->prime_member_image;?></figcaption>
                    </figure>
                    </div>
                        <div class="f1-buttons">
                          <button class="btn btn-primary btn-next" type="button">Next</button>
                        </div>
                      </fieldset>
                      <fieldset>
                          <div class="mb-2">
                  <label class="form-label" for="validationTextarea">Title</label>
                          <input class="form-control title" id="title" type="text"  placeholder="title" name="title" value="{{$events->title}}" required>
                </div>
                
                 <input class="form-control" type="hidden" name="eid" value="{{$events->eid}}" required>
                
                          <div class="mb-2">
                  <label class="form-label" for="validationTextarea">About Event</label>
                  <textarea id="editor" class="form-control is-invalid"  name="textbox" cols="10" rows="2" required="">{{$events->descp}}</textarea>
                </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-email">Date</label>
                          <input class="form-control digits" id="minMaxExample" type="text"  placeholder="Date" name="date" required value="{{$events->date}}">
                        </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-password">Time</label>
                          <!--<input class="f1-password form-control" id="f1-password" type="text" name="f1-password" placeholder="Time" required="">-->
                          <div class="input-group clockpicker">
                          <input class="form-control" type="text" name="time" value="{{$events->time}}" required><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-repeat-password">Location</label>
                          <input class="f1-repeat-password form-control" id="f1-repeat-password" type="text" name="location" placeholder="place" required="" value="{{$events->location}}">
                        </div>
                        <div class="f1-buttons">
                          <button class="btn btn-primary btn-previous" type="button">Previous</button>
                          <button class="btn btn-primary btn-next" type="button">Next</button>
                        </div>
                      </fieldset>
                      <fieldset>
                          
                          <div class="row">
                              
                                @php
                              $x = explode ("|", $events->secondary_member_image);
                              $i = 1;
                              @endphp

                              @foreach($x as $key => $val)
                          
                          
                          
                          @php
                              $xname = explode (",", $events->secondary_member);
                               $iname = 1;
                              @endphp
                              @foreach($xname as $keyname => $valname)
                             
                              @if($i==$iname)
                              
                              
                              
                                <div class="col-sm-12 col-md-9 dynamic-field" id="dynamic-field-{{$i}}">
    <div class="row" >
         <div class="col-sm-6 col-md-6">
        <div class="mb-2">
                          <label for="">Name</label>
                          <input class="form-control" id="" type="text" name="secondary_name[]" value="{{$valname}}" placeholder="" >
                        </div>
      </div>
        <div class="col-sm-6 col-md-6">
        <div class="mb-2">
                          <label for="f1-last-name">Image</label>
                          <input class=" form-control" id="" type="file" name="image2[]" >
                        </div>
      </div>
     
      
            </div>
  </div>
 
                              
                              
                              
                              
                               
                               
                               
                               
                               
                               
                               
                              @endif
                              
                               @php
                               $iname++;
                              @endphp
                              
                              @endforeach
                              
                              
                              
                              
                              
                               @php
                               $i++;
                              @endphp
                              
                              @endforeach
                           <div class="col-sm-12 col-md-3 mt-4 append-buttons">
    <div class="clearfix mb-3">
      <button type="button" id="add-button" class="btn btn-success float-end text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>
      </button>
      <button type="button" id="remove-button" class="btn btn-danger float-end text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>
      </button>
    </div>
  </div>
                              
                          
                        </div>  
                          
                        <!--<div class="mb-2">-->
                        <!--  <label for="">Name</label>-->
                        <!--  <input class="form-control" id="" type="text" name="secondary_name" placeholder="" required="" value="{{$events->secondary_member}}">-->
                        <!--</div>-->
                       <!--<div class="mb-2">-->
                       <!--   <label for="f1-last-name">Image</label>-->
                       <!--   <input class="f1-last-name form-control" id="" type="file" name="image2" >-->
                       <!-- </div>-->
                         <div class="mb-3">
                             
                              @php
                              $x = explode ("|", $events->secondary_member_image);
                              $i = 1;
                              @endphp

                              @foreach($x as $key => $val)
                             
                             
                             <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/events')}}/{{$val}}" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/events')}}/{{$val}}" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="150" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description">{{$val}}</figcaption>
                    </figure>
                       @endforeach      
                             
                             
                    
                    </div>
                        <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                        @php
                          $chk = $events->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> ><span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>
                        <div class="f1-buttons">
                          <button class="btn btn-primary btn-previous" type="button">Previous</button>
                          <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                      </fieldset>
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
  var buttonAdd = $("#add-button");
  var buttonRemove = $("#remove-button");
  var className = ".dynamic-field";
  var count = 0;
  var field = "";
  var maxFields =50;

  function totalFields() {
   
    return $(className).length;
  }

  function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if(totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }
 
  function disableButtonRemove() {
    if (totalFields() === 1) {
      buttonRemove.attr("disabled", "disabled");
      buttonRemove.removeClass("shadow-sm");
    }
  }

  function disableButtonAdd() {
    if (totalFields() === maxFields) {
      buttonAdd.attr("disabled", "disabled");
      buttonAdd.removeClass("shadow-sm");
    }
  }

  function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
      buttonAdd.removeAttr("disabled");
      buttonAdd.addClass("shadow-sm");
    }
  }

  buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
  });

  buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
  });
});
</script>


@endsection