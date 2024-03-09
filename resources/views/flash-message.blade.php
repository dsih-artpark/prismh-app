<!--flash messege-->
<h5>error blog</h5>
@if ($message = Session::get('success'))
 <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark" role="alert">
            <span><i class="fa fa-check"></i></span>
            <strong>{{ $message }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
@endif


@if ($message = Session::has('error'))
<div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark" role="alert">
            <span><i class="fa fa-times"></i></span>
            <strong>{{ $message }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
@endif


@if ($message = Session::get('warning'))
         <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-yellow-dark" role="alert">
            <span><i class="fa fa-exclamation-triangle"></i></span>
            <strong>{{ $message }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
@endif


@if ($message = Session::get('info'))
 <div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-blue-dark" role="alert">
            <span><i class="fa fa-cog"></i></span>
            <strong>{{ $message }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
@endif


@if ($errors->any())
<div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark" role="alert">
            <span><i class="fa fa-times"></i></span>
            <strong>{{ $message }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
        </div>
@endif