@extends('admin.layout.app')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatables.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/datatable-extension.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/daterange-picker.css')}}">
  <style>
    #table_processing{
      background-color: transparent !important;
      background: transparent !important;
      padding: 10px 0 20px 0;
      border-radius: 3px;
      font-weight: bold;
    }
    .card .card-body {
      padding:30px!important;
    }
    #overlay {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 2;
    background-color: #fff;
    filter: alpha(opacity=75);
    -moz-opacity: 0.75;
    opacity: 1;
    display: none;
    border-radius: 15px;
    }
  </style>
@endsection

@section('content')
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-12 col-sm-6">
            <h3>Report</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Report</li>
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
              <div class="row">
                <div class="col-3">
                  <label for="">Date Range</label>
                  <input class="form-control digits date_range" type="text" id="date_range" name="date_range" value="">
                </div>
                @if(count($user_zones) > 0)
                <div class="col-3">
                  <label for="">Zone filter</label>
                  <select class="form-control" id="zone_id" name="zone_id" onchange="get_divisions()">
                    <option value="" selected>Select Zone</option>
                    @foreach($user_zones as $zone)
                    <option value="{{$zone->id}}">{{$zone->title}}</option>
                    @endforeach
                  </select>
                </div>
                @endif
                @if(count($user_divisions) > 0)
                <div class="col-3">
                  <label for="">Division filter</label>
                  <select class="form-control" name="division_id" id="division_id">
                  <option value="" selected>Select Division</option>
                    @foreach($user_divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                  </select>
                </div>
                @endif
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <div id="overlay"></div>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ward</th>
                      <th>Ward Number</th>
                      <th>Survey Done</th>
                      <th>Breeding Spot</th>
                      <th>Source Reduction</th>
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
  <script src="{{asset('admin/assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var table = $('#table').DataTable( {
        processing: true,
        serverSide: true,
        dom: '<"d-flex justify-content-between align-items-start"lBf>rtip',
        language:{
            processing:'<div style="position:relative;"><div class="loader-wrapper" style="background: transparent;position:absolute;min-height: 10px;"><div class="loader"><div class="loader-bar"></div><div class="loader-bar"></div><div class="loader-bar"></div><div class="loader-bar"></div><div class="loader-bar"></div><div class="loader-ball"></div></div></div></div>',
        },
        buttons: [{
          extend: 'excelHtml5',
          text: 'Download Excel',
        }],
        ajax: {
          url: "{{route('admin.report.create')}}",
          data: function(data) {
            $("#overlay").show();
            data.zone = $("#zone_id").val();
            data.division = $("#division_id").val();
            data.date_range = $("#date_range").val();
          },
          dataSrc: function ( data ) {
            $("#overlay").hide();
            return data.aaData;
          },
        },
        order: [[0, 'desc']],
        lengthMenu: [10, 20,30, 40, 50],
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'number' },
            { data: 'survey', orderable : false, },
            { data: 'breeding_spot', orderable : false, },
            { data: 'source_reduction', orderable : false, },
        ],
        initComplete: function (settings, json) {
            $("#overlay").hide();
        }
      });
      $('#zone_id').bind("change", function(){
          table.draw();
      });
      $('#division_id').bind("change", function(){
          table.draw();
      });
      $('.date_range').daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        locale: {format: 'DD/MM/YYYY'},
      });
      $('.date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        table.draw();
      });
      $('.date_range').on('clear.daterangepicker', function(ev, picker) {
        $(this).val('');table.draw();
      });
      $('.date_range').on('blur', function(ev, picker) {
        table.draw();
      });
    });
    function get_divisions(){
      let id = $('#zone_id').val();
      $.ajax({
        method: "GET",
        url: "{{ route('admin.get-divisions') }}",
        data: {_token: "{{csrf_token()}}", id: id},
      })
      .done(function (res) {
        if(res.success){
          $('#division_id').html(res.html);
        }
      })
      .fail(function (err) {
        console.log(err);            
      });
    }
  </script>
@endsection