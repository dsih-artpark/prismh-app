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
            <h3>Spray Details</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Spray Details</li>
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
              <h5>Spray Details</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="display" id="table" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>UID</th>
                    <th>Customer Name</th>
                    <th>Breeding Spot</th>
                    <th>Image</th>
                    <th>Date</th>
                  </tr>
                  <tbody>
                    @php $z = 1; @endphp
                    @foreach($dumps as $data)
                    <tr>
                      <td>{{$z}}</td>
                      <td>{{$data->uid}}</td>
                      <td class="text-capitalize">{{$data->username ?? ''}}</td>
                      <td>{{$data->q1}}</td>
                      <td><?php if(!empty($data->image_data))    
                            echo '<img src="'.asset('uploads/dump/' . $data->image_data).'" class="rounded-circle" width="100" height="100" alt="No image">';
                          else
                            echo '<img alt="Image not found">'; ?>
                      </td>
                      <td>{{date("d/m/Y", strtotime($data->created_at))}}</td>
                    </tr>
                    @php $z++; @endphp
                    @endforeach
                  </tbody>
                </thead>
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
  </script>
@endsection