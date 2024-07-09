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
            <h3>Breeding Spot</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Breeding Spot</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h5>Breeding Spot</h5>
                <div class="">
                  <label for="">Ward filter</label>
                  <select class="form-control" name="ward_id" id="ward_id">
                  <option value="" selected>Select Ward</option>
                    @foreach($wards as $ward)
                    <option value="{{$ward->id}}">{{$ward->name}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>UID</th>
                      <th>Asha Worker Name</th>
                      <th>Breeding Spot</th>
                      <th>Image</th>
                      <th>Remarks</th>
                      <th>Date</th>
                      <th>Source Reduction</th>
                      <th>Action</th>
                    </tr>
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
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var table = $('#table').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
          url: "{{route('admin.breeding-spot.create')}}",
          data: function(data) {
            data.ward = $("#ward_id").val();
          }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id' },
            { data: 'uid' },
            { data: 'username' },
            { data: 'q1' },
            { data: 'image_data' },
            { data: 'descp' },
            { data: 'created_at' },
            { data: 'source_reduction' },
            { data: 'action', orderable : false },
        ]
      });
      $('#ward_id').bind("change", function(){
          table.draw();
      });
    });
  </script>
@endsection