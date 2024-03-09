@extends('admin.main')

@section('menubar_script')
@parent

<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/timepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.5/bootstrap-tagsinput.min.css"/>
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Member</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Member</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit Member</h5>
          </div>
           <div class="card-body add-post">
               @if(($member->roles == 2 && $member->status == 1) || ($member->roles == 1 && $member->status == 2) )
              <!--member-->
              <form class="needs-validation" novalidate="" method="post" action="{{route('adminmember.update', ["id"=>$member->id])}}" enctype='multipart/form-data' >
                 @csrf
                  @method('PUT')
                  
                  <div class="col-sm-12">
                  <ul class="nav nav-tabs border-tab mb-0" id="top-tab" role="tablist">
                      
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true">Basic</a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false">Business </a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false">Reference</a>
                      <div class="material-border"></div>
                    </li>
                   
                  </ul>
                  <div class="tab-content mt-4" id="top-tabContent">
                      
                    <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        
                        <div class="row">
                            
                            
                           <div class="col-md-6 mb-3">
                  <label for="f1-first-name">Username</label>
                          <input class="form-control" id="f1-first-name" type="text" name="username" placeholder="" value="{{$member->username}}" required="">
                        </div>
                         <div class="col-md-6 mb-3">
                  <label for="password">Password</label>
                  <input class="form-control" id="password" type="password" name="password" placeholder="please enter password" value="{{$member->password}}" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Phone</label>
                    <input type="text" class="f1-last-name form-control" name="phone" title="please enter a valid phone number" required pattern="^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$" value="{{$member->phone}}"  oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" />

                          <!--<input class="f1-last-name form-control" id="f1-last-name" type="text" name="phone" min="9999999999" max="9999999999" placeholder="" value="{{$member->phone}}" required="">-->
                </div>
                <div class=" mb-3">
                     <label class="form-label" for="validationTextarea">Address</label>
                  <textarea id="editor" class="form-control is-invalid"  name="address" cols="10" rows="2" required="">{{$member->address}}</textarea>
               </div>
               <div class=" mb-3">
                     <label class="form-label" for="validationTextarea">Permanent Address</label>
                  <textarea id="editor" class="form-control is-invalid"  name="paddress" cols="10" rows="2" required="">{{$member->paddress}}</textarea>
               </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="gender">Gender</label>
                          <select class="form-select" id="gender" name="gender" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            
                            <option value="male" <?= $member->gender == "male" ? "selected":""; ?>>Male</option>
                            <option value="female" <?= $member->gender == "female" ? "selected":""; ?>>Female</option>
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-3">
                     <label for="f1-last-name">Email</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="email" placeholder="" value="{{$member->email}}" required="">
                </div>
                <div class="col-md-6 mb-3">
                          <label  for="dob">Date of Birth</label>
                          <input class="form-control digits" id="dob" type="text"  placeholder="Date" name="dob" required value="{{$member->dob}}">
                        </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="martial">Martial status</label>
                          <select class="form-select" id="martial" name="martial" required="" >
                            <option selected disabled="" value="">Choose any one</option>
                            
                            <option value="1" <?= $member->martial == '1' ? "selected":""; ?>>Married</option>
                            <option value="2" <?= $member->martial == '2' ? "selected":""; ?>>Unmarried</option>
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-3 mdiv">
                          <label  for="martial_date">Married Date</label>
                          <input class="form-control digits" id="martial_date" type="text"  placeholder="Date" name="martial_date"  value="{{$member->martial_date}}">
                        </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="category">Category</label>
                          <select class="form-select category" id="category" name="category" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $category = DB::table('pwa_category')->where('status',1)->get();
                        @endphp
                        @foreach($category as $categ)
                            
                            <option value="{{$categ->id}}" <?= $categ->id == $member->category ? "selected":""; ?>>{{$categ->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                        
                        <input type="hidden" id="subvalue" value="{{$member->subcategory}}">
                <div class="col-md-6 mb-2 subcatdivreg">
                          <label class="form-label" for="subcategory">Sub category</label>
                          <select class="form-select subcategory" id="subcategory" name="subcategory"  >
                              
                            <!--<option selected disabled="" value="">Choose any one</option>-->
                            @php
                        $subcategory = DB::table('pwa_subcategory')->where('cat_id',$member->category)->where('status',1)->get();
                        @endphp
                        @foreach($subcategory as $subcateg)
                            
                            <option value="{{$subcateg->id}}" <?= $subcateg->id == $member->subcategory ? "selected":""; ?>>{{$subcateg->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                        
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="vahini">Vahini's</label>
                          <select class="form-select" id="vahini" name="chapter" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $chapter = DB::table('pwa_chapter')->where('status',1)->get();
                        @endphp
                        @foreach($chapter as $chap)
                            
                            <option value="{{$chap->id}}" <?= $chap->id == $member->chapter ? "selected":""; ?>>{{$chap->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                <div class="mb-3">
                     <label class="form-label" for="validationTextarea">Description</label>
                  <textarea id="editor" class="form-control is-invalid"  name="descp" cols="10" rows="2">{{$member->descp}}</textarea>
               </div>
                <div class="col-md-6 mb-3">
                  <label for="f1-last-name">Gotra</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="gotra" placeholder="" value="{{$member->gotra}}" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="keyword">Keyword</label>
                  <input type="text" class="keyword form-control" id="keyword" name="keyword" value="{{$member->keyword}}" placeholder="Add Keywords with commas (,) " data-role="tagsinput" >
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label" for="f1-last-name">City</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="city" placeholder="" value="{{$member->city}}" required="">
                </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="state">State</label>
                          <select class="form-select" id="state" name="state" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $state = DB::table('pwa_state')->where('status',1)->get();
                        @endphp
                        @foreach($state as $sta)
                            
                            <option value="{{$sta->id}}" <?= $sta->id == $member->state ? "selected":""; ?>>{{$sta->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="country">Country</label>
                          <select class="form-select" id="country" name="country" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $country = DB::table('pwa_country')->where('status',1)->get();
                        @endphp
                        @foreach($country as $coun)
                            
                            <option value="{{$coun->id}}" <?= $coun->id == $member->country ? "selected":""; ?>>{{$coun->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-3">
                  <label for="f1-last-name">Pincode</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="pincode" placeholder="" value="{{$member->pincode}}" required="">
                </div>
                <div class="mb-3">
                    <label for="f1-last-name">Profile</label>
                          <input class="f1-last-name form-control" id="" type="file" name="profile" accept="image/*">
                </div>
                <div class="mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->profile;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->profile;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="100" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description"><?=$member->profile;?></figcaption>
                    </figure>
                </div>
                
                
                
                        </div>                
                        
                        
                      </div>
                    <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                        
                        <div class="row">
                           <div class="col-md-6 mb-3">
                  <label >Name</label>
                          <input class="form-control" type="text" name="bname" placeholder="" value="{{$member->bname}}" required="">
                        </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="designation_id">Designation</label>
                          <select class="form-select" id="designation_id" name="designation_id" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $desigdetails = DB::table('pwa_designation')->where('status',1)->get();
                        @endphp
                        @foreach($desigdetails as $desig)
                            
                            <option value="{{$desig->id}}" <?= $desig->id == $member->designation_id ? "selected":""; ?>>{{$desig->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-2">
                          <label class="form-label" for="nature">Nature of Business</label>
                          <select class="form-select" id="nature" name="nature" required="" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $nature = DB::table('pwa_nature')->where('status',1)->get();
                        @endphp
                        @foreach($nature as $nat)
                            
                            <option value="{{$nat->id}}" <?= $nat->id == $member->nature ? "selected":""; ?>>{{$nat->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Phone</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="bphone" placeholder="" value="{{$member->bphone}}" required="">
                </div>
                <div class="col-md-6 mb-3">
                     <label for="f1-last-name">Email</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="bemail" placeholder="" value="{{$member->bemail}}" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="f1-last-name">Website</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="website" placeholder="" value="{{$member->website}}" >
                </div>
                <div class="col-md-6 mb-3">
                  <label for="f1-last-name">Establish Date</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="bdate" placeholder="" value="{{$member->bdate}}" >
                </div>
                <div class="col-md-6 mb-3">
                     <label class="form-label" for="validationTextarea">Address</label>
                  <textarea id="editor" class="form-control is-invalid"  name="baddress" cols="10" rows="2" required="">{{$member->baddress}}</textarea>
               </div>
                            
                        </div>
                     
                    </div>
                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                      
                       <div class="row">
                           <div class="col-md-6 mb-3">
                  <label for="rname">Reference Name</label>
                          <input class="rname form-control" id="rname" type="text" name="rname" placeholder="" value="{{$member->rname}}" >
                </div>
                <div class="col-md-6 mb-3">
                  <label for="rphone">Reference Phone</label>
                          <input class="rphone form-control" id="rphone" type="text" name="rphone" placeholder="" value="{{$member->rphone}}" >
                </div>
                                     <div class="mb-3">
                  <label for="f1-last-name">Id proof</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="idproof" placeholder="" value="{{$member->idproof}}" >
                </div>
                        
                          <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Upload Id proof</label>
                          <input class="f1-last-name form-control" id="" type="file" name="idimage" accept="image/*">
                </div>
                
                 @if($member->idimage)
                <div class="col-md-4 mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->idimage;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                            @if(strpos($member->idimage, ".pdf") || strpos($member->idimage, ".doc"))
                                View
                              @else
                          <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->idimage;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="90" height="50">
                              </div>
                              @endif
                        </a>
                        <!--<figcaption itemprop="caption description"><?=$member->idimage;?></figcaption>-->
                    </figure>
                    
                                
                            
                </div>
                <div class="col-md-2 mb-3">
                   
                        <a href="{{route('adminmember.download', ['id' => $member->idimage])}}" ><i class="fa fa-download"></i> Download</a>
                      
                </div>
                @endif
                <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Upload Doc</label>
                          <input class="f1-last-name form-control" id="" type="file" name="doc" accept="image/*">
                </div>
                
                 @if($member->doc)
                <div class="col-md-4 mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->doc;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                            @if(strpos($member->doc, ".pdf") || strpos($member->doc, ".doc"))
                                View
                              @else
                          <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->doc;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="90" height="50">
                              </div>
                              @endif
                        </a>
                        <!--<figcaption itemprop="caption description"><?=$member->doc;?></figcaption>-->
                    </figure>
                    
                                
                            
                </div>
                <div class="col-md-2 mb-3">
                   
                        <a href="{{route('adminmember.download', ['id' => $member->doc])}}" ><i class="fa fa-download"></i> Download</a>
                      
                </div>
                @endif
                
                  <div class="col-md-6 mb-2">
                          <label class="form-label" for="others">Others</label>
                          <select class="form-select" id="others" name="others" >
                              
                            <option selected disabled="" value="">Choose any one</option>
                            @php
                        $docdetails = DB::table('pwa_document')->where('status',1)->get();
                        @endphp
                        @foreach($docdetails as $desig)
                            
                            <option value="{{$desig->id}}" <?= $desig->id == $member->others ? "selected":""; ?>>{{$desig->name}}</option>
                            @endforeach
                            
                          </select>
                        </div>
                
                
                 <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Upload Business Registration</label>
                          <input class="f1-last-name form-control" id="" type="file" name="breg" accept="image/*">
                </div>
                
                @if($member->breg)
                <div class="col-md-4 mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->breg;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                            @if(strpos($member->breg, ".pdf") || strpos($member->breg, ".doc"))
                                View
                              @else
                              <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->breg;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="90" height="50">
                              </div>
                              
                              @endif
                        </a>
                        <!--<figcaption itemprop="caption description"><?=$member->breg;?></figcaption>-->
                    </figure>
                    
                                
                            
                </div>
                <div class="col-md-2 mb-3">
                   
                        <a href="{{route('adminmember.download', ['id' => $member->breg])}}" ><i class="fa fa-download"></i> Download</a>
                      
                </div>
                @endif
                <div class="mb-2">
                          <label for="">GST/PAN</label>
                          <input class="form-control" id="" type="text" name="gst" placeholder=""  value="{{$member->gst}}">
                        </div>
                        
                       
                        <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Upload GST/PAN</label>
                          <input class="f1-last-name form-control" id="" type="file" name="gstcer" accept="image/*">
                </div>
                
                 @if($member->gstcer)
                <div class="col-md-4 mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->gstcer;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->gstcer;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="90" height="50">
                              </div>
                        </a>
                        <!--<figcaption itemprop="caption description"><?=$member->gstcer;?></figcaption>-->
                    </figure>
                    
                                
                            
                </div>
                <div class="col-md-2 mb-3">
                   
                        <a href="{{route('adminmember.download', ['id' => $member->gstcer])}}" ><i class="fa fa-download"></i> Download</a>
                      
                </div>
                 @endif       
                        
                            
                        </div>
                        
                        
                        
                        
                    </div>
                    
                    
                        <div class="buttons text-end">
                            
                <a href="{{route('adminapprovals')}}" class="btn btn-light">Cancel</a>
                          <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                   
                  </div>
                </div>
                
                
                
                
                
                
                
                
                     
                          
                          
                      
                    </form>
             @else 
               <!--guest-->
                <form class="needs-validation" novalidate="" method="post" action="{{route('adminmember.update', ["id"=>$member->id])}}" enctype='multipart/form-data' >
                 @csrf
                  @method('PUT')
                  
                  <div class="col-sm-12">
                        <div class="row">
                            
                            
                           <div class="col-md-6 mb-3">
                  <label for="f1-first-name">Username</label>
                          <input class="form-control" id="f1-first-name" type="text" name="username" placeholder="" value="{{$member->username}}" required="">
                        </div>
                <div class="col-md-6 mb-3">
                    <label for="f1-last-name">Phone</label>
                    <input type="text" class="f1-last-name form-control" name="phone" title="please enter a valid phone number" required pattern="^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$" value="{{$member->phone}}"  oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" />

                          <!--<input class="f1-last-name form-control" id="f1-last-name" type="text" name="phone" placeholder="" value="{{$member->phone}}" required="">-->
                </div>
                <div class="col-md-6 mb-3">
                     <label for="f1-last-name">Email</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="email" placeholder="" value="{{$member->email}}" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="password">Password</label>
                  <input class="form-control" id="password" type="password" name="password" placeholder="please enter password" value="{{$member->password}}" >
                </div>
                <div class="mb-3">
                    <label for="f1-last-name">Profile</label>
                          <input class="f1-last-name form-control" id="" type="file" name="profile" accept="image/*">
                </div>
                <div class="mb-3">
                    <figure class="col-md-3 col-6 img-hover hover-1" itemprop="associatedMedia" itemscope="">
                        <a href="{{asset('uploads/customer')}}/<?=$member->profile;?>" itemprop="contentUrl" data-size="1600x950" target="_blank">
                          <div>
                              <img src="{{asset('uploads/customer')}}/<?=$member->profile;?>" itemprop="thumbnail" alt="Image description" class="img-thumbnail" width="100" height="90">
                              </div>
                        </a>
                        <figcaption itemprop="caption description"><?=$member->profile;?></figcaption>
                    </figure>
                </div>
                
                <div class="col-md-6 mb-3">
                  <label class="form-label" for="f1-last-name">City</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="city" placeholder="" value="{{$member->city}}" required="">
                </div>
                
                <div class="col-md-6 mb-3">
                  <label for="f1-last-name">Pincode</label>
                          <input class="f1-last-name form-control" id="f1-last-name" type="text" name="pincode" placeholder="" value="{{$member->pincode}}" required="">
                </div>
               
                    
                        <div class="buttons text-end">
                            
                <a href="{{route('adminapprovals')}}" class="btn btn-light">Cancel</a>
                          <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                   
                  </div>
                </div>
                
                
                
                
                
                
                
                
                     
                          
                          
                      
                    </form>
              
              @endif
              
              
              
              
              
            
          </div>
         
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
  
  
  
  
  
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.5/bootstrap-tagsinput.min.js" ></script>
    <script src="{{asset('admin/assets/js/form-wizard/form-wizard-three.js')}}"></script>
    <script src="{{asset('admin/assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
    
 <script src="{{asset('admin/assets/js/time-picker/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/time-picker/highlight.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/time-picker/clockpicker.js')}}"></script>


<script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    
    <!--<script src="{{asset('admin/assets/js/form-wizard/form-wizard-three.js')}}"></script>-->
    <!--<script src="{{asset('admin/assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>-->
<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>

    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/photoswipe/photoswipe.js')}}"></script>
    
     <script src="{{asset('admin/assets/js/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/styles.js')}}"></script>
    <script src="{{asset('admin/assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script>
    
    
    
    
    <script type="text/javascript">
    $(document).ready(function(){
        
        $('#checkbox').on('change', function(){
        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
    });

 
var sub = document.getElementById('subvalue').value;
if(sub){
        $(".subcatdivreg").show();
    }
    else{
        $(".subcatdivreg").hide();
    }
    
    
    
    
    // $(".subcatdivreg").hide();
    
    
    
    
    
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     

    
    
    var marsts = document.getElementById('martial').value;
    if(marsts == 1){
        $('.mdiv').show();
    }
    else if(marsts == 2){
        $('.mdiv').hide();
    }
    else{
        $('.mdiv').hide();
    }
     
         
         $('[name=martial]').on('click', function(){
              if($(this).val() == 1 ){
                  
                  $('.mdiv').show();
                  $("input[name='martial_date']").prop('required',true);
                  
              }
              else{
                  $('.mdiv').hide();
                   $("input[name='martial_date']").prop('required',false);
              }
          });


       

        //subcategory
        
        $('.category').on('change', function()
        {

                $.ajax({
                    url: '{{route('registersubcategory.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, category:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        if(data.length > 0)
                        {
                            $(".subcatdivreg").show();
                            $(".subcategory").html('');
                            $(".subcategory").append("<option label='Choose any one' value=''>Choose any one</option>");
                            $.each(data, function(i, item)
                            {
                                $(".subcategory").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                        else
                        {
                            $(".subcatdivreg").hide();
                            $(".subcategory").attr('required',false);
                            
                            
                            
                        }
                    }
                });
        });
        
        


    });
</script>
    
    
    
    

@endsection


