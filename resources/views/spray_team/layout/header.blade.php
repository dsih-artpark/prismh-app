<div class="page-title page-title-small">
  <h2>
    @if($back) <a href="#" data-back-button><i class="fa fa-arrow-left"></i></a> @endif
    {{$title}}
  </h2>
  <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150" style="height: 150px;">
  <div class="card-overlay bg-highlight opacity-95"></div>
</div>
@if(Session::has('success'))
  <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
  </div>
@endif
@if(Session::has('error'))
  <div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
    <span><i class="fa fa-times"></i></span>
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
  </div>
@endif