@extends('workers.layout.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => __('messages.Breeding Spots'), 'back' => true])
    
    <div class="card card-style opportunity_section">
          <div class="row mb-0 mt-3 mx-auto">
            <div class="col-6 w-100" style="min-width: 300px;">
              <label for="">Ward filter</label>
              <select class="form-control" name="ward_id" id="ward_id">
              <option value="" selected>Select Ward</option>
                @foreach($wards as $ward)
                <option value="{{$ward->id}}">{{$ward->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
      <div class="content mx-5">
        <div class="table-responsive">
          <table class="display" id="table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <!-- <th>UID</th> -->
                <!-- <th>Asha Worker Name</th> -->
                <!-- <th>Breeding Spot</th> -->
                <th>Image</th>
                <!-- <th>Remarks</th> -->
                <!-- <th>Date</th> -->
                <th>Source Reduction</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script>
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var table = $('#table').DataTable({
        language: {
          lengthMenu: 'Show _MENU_ records'
        },
        processing: false,
        serverSide: true,
        ajax: {
          url: "{{route('field-executive.breeding_spots_list')}}",
          data: function(data) {
            data.ward = $("#ward_id").val();
          }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id' },
          //  { data: 'uid' },
          //  { data: 'username' },
          //  { data: 'q1' },
            { data: 'image_data' },
          //  { data: 'descp' },
          //  { data: 'created_at' },
            { data: 'source_reduction' },
        ]
      });
      $('#ward_id').bind("change", function(){
          table.draw();
      });
    });
  </script>
@endsection
