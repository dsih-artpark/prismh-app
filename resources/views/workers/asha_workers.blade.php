@extends('workers.layout.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => 'Survey Users', 'back' => true])
    
    <div class="card card-style opportunity_section">
      <div class="content mx-5">
        <div class="table-responsive">
          <table class="display" id="table" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Ward</th>
                <th>Role</th>               
              </tr>
            </thead>
            <tbody>
              @php $i = 1; @endphp
              @foreach($asha_workers as $worker)
              <tr>
                <td>{{$i}}</td>
                <td>{{$worker->username}}</td> 
                <td>{{$worker->phone}}</td>
                <td>{{$worker->user_ward->name}}</td>
                <td>{{$worker->role->name}}</td>                
              </tr>
              @php $i++; @endphp
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
  <script>
    $(document).ready(function(){
      var table = $('#table').DataTable({
        language: {
          lengthMenu: 'Show _MENU_ records'
        }
      });
    });
  </script>
@endsection
