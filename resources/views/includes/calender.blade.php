@extends('includes.master')

@section('headerscript')
@parent


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"/>
 
 <style>
     .fc-center{
             margin-top: 25px;

     }
     .fc-center h2{
             font-variant: all-petite-caps;
     }
     .fc-left{
             text-transform: uppercase;

     }
     
     
     
     .fc-today-button{
         text-transform: uppercase;
         /*background-color : #f71414;*/
         color:#000000;
     }
     
    
 </style>

@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.calenderhead') }}</h2>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       @if(Auth::guard('customer')->user()->profile)
      <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}"></a>
        
        @else
         <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
        @endif
  
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
</div>

@if(Session::has('success'))

<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif

<div class="card card-style opportunity_section calendar bg-theme shadow-xl rounded-m">
            <div class="content">
                <div class="row mb-3">
                   
                   <div id="calendar"></div>
                
                </div>
            </div>
        </div>






@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" ></script>
    
    



<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        let string;
        let chkedsr;
        // const eventsColors = $calender;
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            // defaultView: 'agendaWeek',
            events : [
                @foreach($calender as $appointment)
                {
                    title : '{{ $appointment->name }}',
                    start : '{{ $appointment->start_time }}',
                    @if($appointment->finish_time)
                            end: '{{ $appointment->finish_time }}',
                    @endif
                    display: 'background',
                    @if($appointment->eid)
                    url: "{{route('login.calender.detail',['id' => $appointment->eid])}}",
                    @endif
                     color : '{{ $appointment->color }}',
                  
                },
                @endforeach
                
            ],
            
           
           
          
        });
    });
</script>





@endsection