@extends('workers.layout.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
@endsection

@section('content')
  <div class="page-content" style="padding-bottom: 0px; transform: translateX(0px);">
    @include('workers.layout.header', ['title' => __('messages.Larva Survey'), 'back' => true])
    <div class="card card-style">
      <div class="content mb-0">
        <h1 class="text-center">{{__('messages.List of Wards')}}</h1>
        <div class="p-2">
          <div class="content mx-5">
            <div class="table-responsive">
              <table class="display" id="table" style="width:100%">
                <thead>
                  <tr>
                    <th>Ward Name</th>
                    <th class="text-center">Ward Number</th>
                    <th class="text-center">Survey Count</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 1; @endphp
                  @foreach($wards as $ward)
                    <tr>
                      <td>{{$ward->name}}</td> 
                      <td class="text-center">{{$ward->number}}</td>
                      <td class="text-center">{{$ward->survey_count}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-style">
      <div class="content mb-0">
        <h1 class="text-center">{{__('messages.Larva Survey')}}</h1>
        <div class="card card-style">
          <form action="{{ route('field-executive.servey_list') }}" method="get">
            <div class="row m-3 m-md-5">
              <h3>{{__('messages.Filter Ward')}}</h3>
              <div class="col-12 col-md-6 mb-3 mb-md-0">
                <label for="ward">Select Ward</label>
                <select name="ward" id="ward" class="form-control">
                  <option selected value="">All</option>
                  @foreach($wards as $ward)
                    <option {{request()->ward == $ward->id ? 'selected' :''}} value="{{$ward->id}}">{{$ward->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-md-6 align-self-end text-end text-md-start">
                <button class="btn btn-sm btn-primary p-0" type="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="row mb-0">
          @foreach($surveys as $survey)
          <div class="col-6 pe-0">
            <div class="card card-style me-2">
              @php $img = explode(',',$survey->image_data); @endphp
              <a  data-card-height="150" class="card preload-img mb-3" data-src="{{url('public/uploads/pick') }}/{{$img[0]}}"  href="{{route('field-executive.servey_details', $survey->id)}}"></a>
              <div class="content mt-0">
                <span class="color-black">Id : {{$survey->uid}}</span>
                <br>
                <div class="divider mb-0"></div>
                <span class="color-black">{{__('messages.Date')}} : {!! date('d-m-Y ', strtotime($survey->created_at)) !!}</span><br>
                <span class="color-black">{{__('messages.Time')}} : {!! date('h:i a', strtotime($survey->created_at)) !!}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="mb-4 mx-auto w-100 d-flex justify-content-center">
        {{ $surveys->links('vendor.pagination.paginate') }}
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