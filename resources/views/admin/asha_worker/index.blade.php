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
            <h3>Survey Users</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Survey Users</li>
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
              <h5>Survey Users Approved</h5>
              <div class="mb-3 text-end">
                <a href="{{route('admin.asha-workers.create')}}">
                <button class="btn btn-square btn-primary" type="button" data-bs-original-title="" title="">Add User</button> 
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Ward</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>ID Card</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1; @endphp
                    @foreach($asha_workers->where('status', 1) as $worker)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$worker->username}}</td> 
                      <td>{{$worker->phone}}</td>
                      <td>{{$worker->user_ward->name}}</td>
                      <td>{{$worker->role->name}}</td>
                      <td>
                        <div class="media-body text-center switch-sm">
                        @if($worker->status == 1)
                          <label class="switch">
                            <input type='checkbox' checked onchange="changeStatus({{$worker->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @else
                          <label class="switch">
                            <input type='checkbox' onchange="changeStatus({{$worker->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @endif                     
                        </div>                
                      </td>
                      <td>
                        @php $img_name = explode('/', $worker->id_card); @endphp
                        @if($worker->id_card) {{end($img_name)}} @endif
                      </td>
                      <td>
                      <a href="{{route('admin.asha-workers.edit' , $worker->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                  </tbody>
                </table>
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
              <h5>Survey Users Not Approved</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table_2" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Ward</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>ID Card</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1; @endphp
                    @foreach($asha_workers->where('status', 0) as $worker)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$worker->username}}</td> 
                      <td>{{$worker->phone}}</td>
                      <td>{{$worker->user_ward->name}}</td>
                      <td>{{$worker->role->name}}</td>
                      <td>
                        <div class="media-body text-center switch-sm">
                        @if($worker->status == 1)
                          <label class="switch">
                            <input type='checkbox' checked onchange="changeStatus({{$worker->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @else
                          <label class="switch">
                            <input type='checkbox' onchange="changeStatus({{$worker->id}})">
                            <span class="switch-state"></span>
                          </label>
                        @endif                     
                        </div>                
                      </td>
                      <td>
                        @php $img_name = explode('/', $worker->id_card); @endphp
                        @if($worker->id_card) {{end($img_name)}} @endif
                      </td>
                      <td>
                      <a href="{{route('admin.asha-workers.edit' , $worker->id)}}" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @php $i++; @endphp
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
      var table = $('#table_2').DataTable();
    });

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