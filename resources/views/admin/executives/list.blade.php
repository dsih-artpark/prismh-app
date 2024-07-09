@extends('admin.layout.app')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
  <style>
    .card .card-body {
        padding:30px!important;
    }
  </style>
@endsection

@section('content')
  @if ($errors->any())
    <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
      <div class="toast defaul-show-toast align-items-center text-white bg-danger position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
        <div class="toast-body">{{$errors->first()}}   
          <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>Executives</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">                                       
                  <i data-feather="home"></i>
                </a>
              </li>
              <li class="breadcrumb-item">                                      
                Executives
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Executives</h5>
              <div class="mb-3 text-end">
                <a href="{{route('admin.executive.create')}}">
                <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Executive</button> 
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="authorities" style="width:100%">
                  <thead>
                    <tr>
                    <th>#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php  $i = 1; @endphp
                    @foreach($authorities as $authority)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$authority->username}}</td> 
                      <td>{{$authority->phone}}</td>
                      <td>{{$authority->role_name}}</td>
                      <td>
                        <div class="media-body switch-sm">
                          @if($authority->status == 1)
                            <label class="switch">
                              <input type='checkbox' checked onchange="changeStatus({{$authority->id}})">
                              <span class="switch-state"></span>
                            </label>
                          @else
                            <label class="switch">
                              <input type='checkbox' onchange="changeStatus({{$authority->id}})">
                              <span class="switch-state"></span>
                            </label>
                          @endif                     
                        </div>
                      </td>
                      <td>
                        <a href="{{route('admin.executive.edit' , $authority->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @php 
                    $i++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/notify/bootstrap-notify.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      // Variables
      var SITEURL = '{{url('')}}';
      // Csrf Field
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var table = $('#authorities').DataTable();
    });
  </script>
  <script>
    function changeStatus(id){
      $.ajax({
        method: "PUT",
        url: "{{ route('admin.asha-workers.index') }}"+"/"+id,
        data: {_token: "{{csrf_token()}}", id: id},              
      })
      .done(function (res) {
        if(res.success){
          show_notify(res.message);
        }
      })
      .fail(function (err) {
        console.log(err);            
      });
    }
    function show_notify(title){
      $.notify(
        {
          title:title,
          message:''
        },
        {
          type:'info',
          newest_on_top:true ,
          showProgressbar:false,
          spacing:10,
          timer:3000,
          placement:{
            from:'top',
            align:'right'
          },
          delay:1000 ,
          z_index:10000,
          animate:{
            enter:'animated flash',
            exit:'animated flash'
          }
        }
      );
    }
  </script>
@endsection