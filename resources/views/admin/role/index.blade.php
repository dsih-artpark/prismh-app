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
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>Role</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
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
                <h4 class="mb-0 counter">{{count($roles)}}</h4>
              </div>
              <!--<i class="fa fa-users fa-3x"></i>-->
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-secondary" role="progressbar" style="width:100%" aria-valuenow="{{count($roles)}}" aria-valuemin="0" aria-valuemax="{{count($roles)}}"><span class="animate-circle"></span></div>
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
                <h6 class="font-roboto">Active</h6>
                <h4 class="mb-0 counter">{{count($roles->where('status', 1))}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-success" role="progressbar" style="width: {{count($roles->where('status', 1)) * 100 / count($roles)}}%" aria-valuenow="{{count($roles->where('status', 1))}}" aria-valuemin="0" aria-valuemax="{{count($roles)}}"><span class="animate-circle"></span></div>
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
                <h6 class="font-roboto">Inactive</h6>
                <h4 class="mb-0 counter">{{count($roles->where('status', 0))}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-danger" role="progressbar" style="width: {{count($roles->where('status', 0)) * 100 / count($roles)}}%" aria-valuenow="{{count($roles->where('status', 0))}}" aria-valuemin="0" aria-valuemax="{{count($roles)}}"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Role</h5>
              <div class="mb-3 text-end">
                <a href="{{route('admin.role.create')}}">
                  <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add Role</button>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $key => $role)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$role->name}}</td>
                      <td>
                        <div class="media-body text-center switch-sm">
                        @if($role->status == 1)
                          <label class="switch">
                            <input type='checkbox' checked onchange="changeStatus({{$role->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @else
                          <label class="switch">
                            <input type='checkbox' onchange="changeStatus({{$role->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @endif                     
                        </div>                
                      </td>
                      <td>
                      @if(!in_array($role->id, [1,2]))
                      <a href="{{route('admin.role.edit' , $role->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      @endif
                      </td>
                    </tr>
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
  <script>
    $(document).ready(function(){
      var table = $('#table').DataTable();
    });

    function changeStatus(id){
      $.ajax({
        method: "PUT",
        url: "{{ route('admin.role.index') }}"+"/"+id,
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