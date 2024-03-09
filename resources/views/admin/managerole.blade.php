@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
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
          <h3>Role</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Role</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid default-dash">
    <div class="row"> 
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h6 class="font-roboto">Roles</h6>
                @php
                $total = DB::table('roles')->count();
                @endphp
                <h4 class="mb-0 counter">{{$total}}</h4>
              </div>
              <!--<i class="fa fa-users fa-3x"></i>-->
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-secondary" role="progressbar" style="width:100%" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <!--<h6 class="font-roboto">Activated</h6>-->
                
                <h6 class="font-roboto">Active</h6>
                @php
                $data = DB::table('roles')->where('status', 1)->count();
                @endphp
                <h4 class="mb-0 counter">{{$data}}</h4>
              </div>
              
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $data;
                if($fp > 0){
                $cal1 = $fp/$total;
                $per = $cal1 * 100;
                }
                else{
                 $per = 0;
                 }
                @endphp
                <div class="progress-gradient-success" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <!--<h6 class="font-roboto">Not Activated</h6>-->
                
                <h6 class="font-roboto">Not Active</h6>
                @php
                $data = DB::table('roles')->where('status', 2)->count();
                @endphp
                <h4 class="mb-0 counter">{{$data}}</h4>
              </div>
              
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                @php
                $fp = $data;
                if($fp > 0){
                $cal1 = $fp/$total;
                $per = $cal1 * 100;
                }
                else{
                 $per = 0;
                 }
                @endphp
                <div class="progress-gradient-danger" role="progressbar" style="width: {{$per}}%" aria-valuenow="{{$fp}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Server Side Processing start-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Role</h5>
            <div class="mb-3 text-end">
              <a href="{{route('adminrole.add')}}">
                <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Role</button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              
              <table class="display" id="roles" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php $z = 1; @endphp
  @foreach($roles as $role)  
                    <tr>
                        <td>{{$z}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                             @if($role->status == 1)
                                <span class="badge badge-success"> Activated</span>
            
                            @else
                                <span class="badge badge-danger">Not Activated</span>
                            
                            @endif
                        </td>
                        <td>
                          @if(!in_array($role->id,[1,2]))
                            <a href="{{route('admin.role.edit' , ['id' => $role->id])}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>

                            <a href="{{route('admin.role.delete' , ['id' => $role->id])}}" class="btn btn-outline-danger-2x" ><i class="icon-trash" ></i></a>
                          @endif
                        </td>
                    </tr>
                    @php
                    $z++;
                    @endphp
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Server Side Processing end-->
      
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

<script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

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
    
    var table = $('#roles').DataTable();
    
    
    
    // Updates DELETE SCRIPT
    $('body').on('click', '#show-delete', function () {
      var _id = $(this).data("id");
      $.ajax({
        type: "get",
        url: SITEURL + "/admin/roles/delete/"+_id,
        success: function (data) {
          
          var oTable = $('#roles').dataTable();
          oTable.fnDraw(false);
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
      
    });
    
  });
  
</script>




@endsection