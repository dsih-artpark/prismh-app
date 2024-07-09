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
            <h3>Larva Survey</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Larva Survey</li>
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
              <h5>Larva Survey</h5>
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
                      <th>Within Ward</th>
                      <th>Remarks</th>
                      <th>Date</th>
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
      $('#table').DataTable({
          processing: false,
          serverSide: true,
          ajax: "{{route('admin.larva-survey.create')}}",
          order: [[0, 'desc']],
          columns: [
              { data: 'id' },
              { data: 'uid' },
              { data: 'username' },
              { data: 'q1' },
              { data: 'image_data' },
              { data: 'within_ward', orderable : false },
              { data: 'descp' },
              { data: 'created_at' },
              { data: 'action', orderable : false },
          ]
      });
    });
  </script>
@endsection