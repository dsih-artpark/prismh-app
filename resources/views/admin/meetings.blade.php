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
            <h5>Add Meetings</h5>
          </div>
          <div class="card-body add-post">
          
            <form class="f1" method="post" action="{{route('admin.meetings.store')}}" enctype='multipart/form-data'>
                 @csrf
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
                          <div class="f1-step-icon"><i class="fa fa-th"></i></div>
                          <!--<p>joiner</p>-->
                          <p>Agenda</p>
                        </div>
                      </div>
                      <fieldset>
                          
                          
                         
                          
                          
                          
                          
                        <div class="mb-2">
                          <label for="f1-first-name">Name</label>
                          <input class=" form-control" id="f1-first-name" type="text" name="name" placeholder="" required="">
                        </div>
                        <div class="mb-2">
                          <label for="f1-last-name">Designation</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="desig" required="">
                        </div>
                        <div class="mb-2">
                          <label for="f1-last-name">Image</label>
                          <input class="f1-last-name form-control" id="" type="file" name="image" >
                        </div>
                        <div class="f1-buttons">
                          <button class="btn btn-primary btn-next" type="button">Next</button>
                        </div>
                      </fieldset>
                      <fieldset>
                          <div class="mb-2">
                  <label class="form-label" for="validationTextarea">Title</label>
                          <input class="form-control title" id="title" type="text"  placeholder="title" name="title" required>
                </div>
                           <div class="mb-2">
                  <label class="form-label" for="validationTextarea">About</label>
                  <textarea id="editor" class="form-control is-invalid"  name="textbox" cols="10" rows="2" required=""></textarea>
                </div>
               <div class="mb-2">
                          <label class="form-label" for="validationCustom04">Mode</label>
                          <select class="form-select modes" id="modes" name="mode" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                          </select>
                        </div>
                        <div class="modeiddiv mb-2">
                          <label class="sr-only" for="">Id</label>
                          <input class="form-control modeid" id="modeid" type="tel"  placeholder="Add online meeting id" name="modeid" >
                        </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-email">Date</label>
                          <input class="form-control digits" id="minMaxExample" type="text"  placeholder="Date" name="date" required>
                        </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-password">Time</label>
                          <!--<input class="f1-password form-control" id="f1-password" type="text" name="f1-password" placeholder="Time" required="">-->
                          <div class="input-group clockpicker">
                          <input class="form-control" type="text" name="time" value="00:00" required><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                        </div>
                        <div class="mb-2">
                          <label class="sr-only" for="f1-repeat-password">Location</label>
                          <input class="f1-repeat-password form-control" id="f1-repeat-password" type="text" name="location" placeholder="place" required="">
                        </div>
                        <div class="f1-buttons">
                          <button class="btn btn-primary btn-previous" type="button">Previous</button>
                          <button class="btn btn-primary btn-next" type="button">Next</button>
                        </div>
                      </fieldset>
                      <fieldset>
                          
                          
                          <div class="row">
                <div class="mb-3">
                  <label class="form-label" for="validationTextarea">Details</label>
                  <textarea id="editor1" class="form-control is-invalid"  name="details" cols="10" rows="2" required=""></textarea>
                </div>
                              
                                         
                          
                              
                          </div>
                          
                
                        <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                        <input type="checkbox" name="status"><span class="switch-state"></span>
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

 <script src="{{asset('admin/assets/js/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/styles.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script>


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
    field.find("textarea").val("");
    field.find("select").attr('selected', false);
    $(className + ":last").after($(field));
  }

  function removeLastField() {
    if (totalFields() > 1) {
      $(className + ":last").remove();
    }
  }

  function enableButtonRemove() {
    if (totalFields() === 2) {
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

<script type="text/javascript">

    $(document).ready(function(){
         $(".modeiddiv").hide();
        
        $('.modes').on('change', function() 
        {
            if($(this).val() == "Online"){
                 $(".modeiddiv").show();
                
            }
            else{
                 $(".modeiddiv").hide();
                  $(".modeid").val('');
            }
            
        });
       
        
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        
        	// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
        
        $.ajax({
            url: '{{route('admin.mommemlist')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".department").html(' ');
                    $(".department").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".department").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
				
        
        
        
         $('.department').on('change', function() 
        {
            
             $.ajax({
                    url: '{{route('depart.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, id:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                            
                            $(".members").html(" ");

                             $(".membersdiv").show();
                            //     $(".members").val(data);   
                                
                                 $(".members").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".members").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                            
                        
                    }
                });
                
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         
    });
    
</script>

@endsection