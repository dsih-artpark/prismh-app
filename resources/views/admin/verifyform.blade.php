@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
<style>
      .card .card-body {
          padding:30px!important;
      }
 </style>
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
          <h3>Verify</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Verify</li>
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
            <h5>Verify </h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " method="post" action="{{ route('adminverification.store', ["id"=>$id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="col-sm-12">
                <input type="hidden"  name="did" value="{{$id}}">
                <div class=" mb-3">
                  <label class="form-label" for="fileInput">Upload Image</label>
                  <input type="file" class="form-control" id="fileInput" name="image"  required>
                </div>
                
                         <div class="mb-3">
                  <label for="com">Comments</label>
                  <textarea class="form-control" name="descp" required=""></textarea>
                </div>
                 <div class="mb-3">
                          <label class="form-label" for="validationCustom04">Status</label>
                          <select class="form-select dstatus" id="validationCustom04" name="dstatus" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            <option value="Authorised">Authorised</option>
                            <option value="Un Authorised">Un Authorised</option>
                          </select>
                        </div>
                
              </div>
              <div class="btn-showcase text-end btnsub">
                <input class="btn btn-primary btnsub1" type="submit" name="verify" value="Verify">
                <input class="btn btn-danger btnsub2" type="submit" name="notice" value="Notice">
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


  <script type="text/javascript">

			"use strict";

		 $(document).ready(function(){

				// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
	$('.btnsub').hide();			
    $('.btnsub1').hide();
    $('.btnsub2').hide();
            $('body').on('change', '.dstatus', function () {
                var dstsval = $(this).val();
               
                if(dstsval == "Authorised"){
                    $('.btnsub').show();			
                    $('.btnsub1').show();
                    $('.btnsub2').hide();
                }
                else if(dstsval == "Un Authorised"){
                   
                    $('.btnsub').show();			
                    $('.btnsub1').hide();
                    $('.btnsub2').show();
                }
                else{
                    
                    $('.btnsub').hide();			
                    $('.btnsub1').hide();
                    $('.btnsub2').hide();
                }
            
            });
				
				
	});
        
    </script>

@endsection