@extends('executive.layout.app')

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
            <h3>Breeding Spot Analysis</h3>
          </div>
          <div class="col-12 col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('executive.dashboard')}}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Analysis</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between aligin-items-center">
              <h5>Breeding Spot Analysis</h5>
              <div class="text-end">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-calendar" aria-hidden="true"></i> Months</button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                  <li><a class="dropdown-item active" href="{{route('executive.analysis_filter',1)}}">January</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',2)}}">February</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',3)}}">March</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',4)}}">April</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',5)}}">May</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',6)}}">June</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',7)}}">July</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',8)}}">August</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',9)}}">September</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',10)}}">October</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',11)}}">November</a></li>
                  <li><a class="dropdown-item" href="{{route('executive.analysis_filter',12)}}">December</a></li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th colspan="{{$daysInMonthth}}">{{$monthdetth}}
                        <tr>
                          <th>Sl. No.</th>
                          <th>Ward Name</th>
                          @for ($day = 1; $day <= $daysInMonthth; $day++)
                            <th>{{ $day }}</th>
                          @endfor
                        </tr>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1; @endphp
                    @foreach($reports as $ward)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$ward->name}}</td>
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                          <td>
                            @php
                              $day = str_pad($day, 2, '0', STR_PAD_LEFT);
                              $ddt = $currentYear.'-'.$currentMonth.'-'.$day;
                              $insdetails = DB::table('pick')->where('ward',$ward->id)->where('q1','=','Yes')->where('created_at','like', $ddt.'%')->get();
                              $cday = \Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            @if($cday < $ddt)
                              <span class="text-dark">-</span>
                            @else
                              @if($insdetails)
                                <span class="text-danger">{{$insdetails->count()}}</span>
                              @else
                                <span class="text-danger">0</span>
                              @endif
                            @endif
                          </td>
                        @endfor
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
    });
  </script>
@endsection