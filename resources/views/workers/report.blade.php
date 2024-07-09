@extends('workers.layout.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => __('messages.Report'), 'back' => true])
    @php
      $start_date = request()->date_range ? explode(' - ', request()->date_range)[0] : '';
      $end_date = request()->date_range ? explode(' - ', request()->date_range)[1] : '';
      $date_range = '';
      if($start_date && $end_date){
        $date_range = $start_date.' - '.$end_date;
      }
    @endphp
    <div class="card card-style opportunity_section">
      <form action="{{ route('field-executive.report') }}" method="get">
        @csrf
        <div class="d-flex m-5 mb-0 justify-content-center">
          <div class="">
            <label for="">Date Range</label>
            <input class="form-control digits date_range" type="text" name="date_range" value="{{$date_range}}">
          </div>
          <div class="d-flex flex-column justify-content-end ms-5">
            <button class="btn btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </form>
      <div class="content mb-5">
        <div class="table-responsive">
          <table class="display" id="table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Ward</th>
                <th>Survey Done</th>
                <th>Breeding Spot</th>
                <th>Source Reduction</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reports as $report)
              <tr>
                <td>{{$report['sr']}}</td>
                <td>{{$report['ward']}}</td>
                <td>{{$report['survey']}}</td>
                <td>{{$report['breeding_spot']}}</td>
                <td>{{$report['source_reduction']}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
  <script src="{{asset('admin/assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>
<script>
    $(document).ready(function(){
      var table = $('#table').DataTable({
        language: {
          lengthMenu: 'Show _MENU_ records'
        }
      });
      $('.date_range').daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        locale: {format: 'DD/MM/YYYY'}
      });
      $('.date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      });
      $('.date_range').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
    });
  </script>
@endsection
