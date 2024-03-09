<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <title>VBF</title>
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{asset('admin/assets/images/logo/small-logo.png')}}" alt="" width="30" height="35">
      </a>
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @php $i=1; @endphp
        @foreach($versions as $vr)
        @if($i == 1) 
        @php $sts = "active"; @endphp
        @else
        @php $sts = ""; @endphp
        @endif
        <li class="nav-item " role="presentation">
          <button class="nav-link {{$sts}}" id="pills-{{$vr->versions}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$vr->versions}}" type="button" role="tab" aria-controls="pills-{{$vr->versions}}" aria-selected="true">V.{{$vr->versions}}</button>
        </li>
        @php $i++; @endphp
        @endforeach
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 m-2">
        <div class="tab-content" id="pills-tabContent">
          @php $i=1; @endphp
          @foreach($versions as $vers) 
          @if($i == 1) 
          @php $sts = "show active"; @endphp
          @else
          @php $sts = ""; @endphp
          @endif
          <div class="tab-pane fade {{$sts}}" id="pills-{{$vers->versions}}" role="tabpanel" aria-labelledby="pills-{{$vers->versions}}-tab">
            <div class="col-sm-12 m-2 p-2">
              @php
              $t = explode('||',$vers->title);
              $p = explode('||', $vers->descp);
              $im = explode('||', $vers->image);
              @endphp
              @foreach($t as $key=>$value)
              <div class="content">
                <h2 class="text-capitalize">{{$t[$key]}}</h2>
                <div class="p-2">
                  <p class="text-capitalize">{{$p[$key]}}</p>
                </div>
                <div class="text-center p-4">
                  <img src="{{asset('uploads/versions')}}/{{$im[$key]}}" class="img-thumbnail" alt="version{{$key}}">
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @php $i++; @endphp
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <center>
        <p class="mb-0">Copyright 2022 © Mcware Technologies  </p>
      </center>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>