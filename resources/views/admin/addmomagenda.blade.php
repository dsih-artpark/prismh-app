@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>-->
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
          <h3>Agenda</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Agenda</li>
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
            <h5>Add Agenda</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.mom.agenda.store')}}" enctype='multipart/form-data'>
                @csrf
              
                  <div class="col-md-12">
                      <div class=" dynamic-field" id="dynamic-field-1">
                <div class="mb-3">
                   <label class="col-form-label">Select Topic</label>
                        <select class="js-example-basic-hide-search col-sm-12 topic"  id="topic" name="topic" required="">
                            <option label='Please Select' value=''>Select any one</option>
                            @foreach($mom['topic'] as $cat)
                            <option value="{{$cat->id}}">{{$cat->topic}}</option>
                            @endforeach
                        </select>
                </div>
                <div class=" mb-3 detailsdiv">
                   <label class="col-form-label">Details</label>
                       <input type="text" class="form-control details" id="details" name="details" readonly>
                       </div>
                <div class=" mb-3">
                   <label class="col-form-label">Select Department</label>
                        <select class="js-example-basic-hide-search col-sm-12 department"  id="department" name="department" required="">
                            <option label='Please Select' value=''>Select any one</option>
                            @foreach($mom['departments'] as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class=" mb-3 membersdiv">
                   <label class="col-form-label">Members</label>
                        <select class="js-example-basic-hide-search col-sm-12 members"  id="members" name="members" required="">

                        </select>
                </div>
                <div class=" mb-3 ">
                   <label class="col-form-label">Status</label>
                        <select class="js-example-basic-hide-search col-sm-12 status"  id="status" name="status" required="">
                            <option label='Please Select' value=''>Select any one</option>
                            <option value="1">No Progress</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>

                        </select>
                </div>
                </div>
                
                <div class="col-sm-12 col-md-6 mt-4 append-buttons">
    <div class="clearfix mb-3">
      <button type="button" id="add-button" class="btn btn-success float-end text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>
      </button>
      <button type="button" id="remove-button" class="btn btn-danger float-end text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>
      </button>
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
<!--<script src="{{asset('admin/assets/js/email-app.js')}}"></script>-->
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function(){
        
        $(".detailsdiv").hide();
        $(".membersdiv").hide();
        
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        
        	// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				
				//test
				
				 $.ajax({
            url: '{{route('admin.momtopiclist')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".topic").html(' ');
                    $(".topic").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".topic").append("<option value="+item.id+">"+item.topic+"</option>");      
                    });
                }
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
                    $(".members").html(' ');
                    $(".members").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".members").append("<option value="+item.id+">"+item.topic+"</option>");      
                    });
                }
            }
        }); 
				
        
        
        
          $('.topic').on('change', function() 
        {
            if($(this).val()){
                
             $.ajax({
                    url: '{{route('detail.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, id:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                       
                        if(data){    
                            $(".details").val(" ");

                             $(".detailsdiv").show();
                                $(".details").val(data); 
                        }
                        else{
                            $(".detailsdiv").hide();
                        }
                            
                        
                    }
                });
            }
            else{
                 $(".detailsdiv").hide();
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

@endsection