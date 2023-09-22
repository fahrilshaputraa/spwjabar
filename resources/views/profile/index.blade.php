@extends(auth()->user()->level_id === '1' ? 'layouts.admin' :
         (auth()->user()->level_id === '2' ? 'layouts.disdik' : 
          (auth()->user()->level_id === '3' ? 'layouts.kcd' : 
          'layouts.sekolah')))
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
       <h1>Profile</h1>
       <nav>
          <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="/">Home</a></li>
             <li class="breadcrumb-item active">Profile</li>
          </ol>
       </nav>
    </div>
    <section class="section profile">
       <div class="row">
          <div class="col-xl-4">
             <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                  <form action="{{route('UploadProfile')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="d-inline-block position-relative">
                        <input type="hidden" name="oldImage" value="{{$data->photo_profile}}" hidden>
                        <img src="{{ $data->photo_profile ? asset( $data->photo_profile) : 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCX5TOKkOk3MBt8V-f8PbmGrdLHCi4BoUOs_yuZ1pekOp8U_yWcf40t66JZ4_e_JYpRTOVCl0m8ozEpLrs9Ip2Cm7kQz4fUnUFh8Jcv8fMFfPbfbyWEEKne0S9e_U6fWEmcz0oihuJM6sP1cGFqdJZbLjaEQnGdgJvcxctqhMbNw632OKuAMBMwL86/w640-h596/pp%20kosong%20wa%20default.jpg' }}" alt="Profile" class="rounded-circle border border-2 border-secondary profile-pic">
                        <div class="p-image">
                           <i class="bi bi-camera-fill upload-button fs-4 text-dark"></i>
                           <input class="file-upload d-none" name="photo_profile" type="file" accept="image/*"/>
                        </div>
                     </div>
                     <div id="button-submit" class="mt-2" style="display: none; transition-timing-function: linear;">
                        <div class="d-flex justify-content-center gap-2">
                           <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-check"></i></button>
                           <a class="btn btn-outline-dark btn-sm" id="btn-close"><i class="bi bi-x"></i></a>
                        </div>
                     </div>
                  </form>
                  @error('photo_profile')
                     <div class="text-danger text-sm text-center">
                     {{ $message }}
                     </div>
                  @enderror
                   <h2>{{ $data->name }}</h2>
                   <h3>{{ $data->level_id === '1' ? 'Superadmin' : ($data->level_id === '2' ? 'Disdik' : ($data->level_id === '3' ? 'KCD' : 'Sekolah'))}}</h3>
                </div>
             </div>
          </div>
          <div class="col-xl-8">
             <div class="card">
                <div class="card-body pt-3">
                   <ul class="nav nav-tabs nav-tabs-bordered">
                      <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" >Profile</a></li>
                      <li class="nav-item"> <a href="#profile-change-password" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</a></li>
                   </ul>
                   <div class="tab-content pt-2">
                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                         <h5 class="card-title">Details</h5>
                         <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nama {{ $data->level_id === '1' ? 'Superadmin' : ($data->level_id === '2' ? 'Disdik' : ($data->level_id === '3' ? 'KCD' : 'Sekolah'))}}</div>
                            <div class="col-lg-9 col-md-8">{{$data->name}}</div>
                         </div>
                         @if ($data->level_id !== '1')
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">{{ $data->level_id !== '4' ? 'Jumlah' : 'Status'}} Sekolah</div>
                              <div class="col-lg-9 col-md-8 text-capitalize">{{$sekolah}}</div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">{{ $data->level_id !== '4' ? 'Jumlah' : ''}} Kab/Kota</div>
                              <div class="col-lg-9 col-md-8">{{$kab}}</div>
                           </div>
                              @if ($data->level_id !== '3')
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label">{{ $data->level_id !== '4' ? 'Jumlah' : ''}} KCD</div>
                                 <div class="col-lg-9 col-md-8">{{$kcd}}</div>
                              </div>
                              @endif
                           @endif
                      </div>
                      <div class="tab-pane fade pt-3" id="profile-change-password">
                         <form action="{{ route('UpdatePassword') }}" method="POST">
                           @csrf
                            <div class="row mb-3">
                               <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                               <div class="col-md-8 col-lg-9">
                                 <input name="old_password" type="password" class="form-control  @error('old_password') is-invalid @enderror"  value="{{ old('old_password') }}" id="currentPassword"> 
                                 @error('old_password')
                                 <div class="invalid-feedback">
                                   {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                            </div>
                            <div class="row mb-3">
                               <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                               <div class="col-md-8 col-lg-9">
                                 <input name="new_password" type="password" class="form-control  @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}" id="newPassword">
                                 @error('new_password')
                                 <div class="invalid-feedback">
                                   {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                            </div>
                            <div class="row mb-3">
                               <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukan Password Baru</label>
                               <div class="col-md-8 col-lg-9">
                                 <input name="new_password_confirmation" type="password" class="form-control  @error('new_password') is-invalid @enderror" value="{{ old('new_password_confirmation') }}" id="renewPassword">
                                 @error('new_password')
                                 <div class="invalid-feedback">
                                   {{ $message }}
                                 </div>
                                 @enderror
                               </div>
                            </div>
                            <div class="text-center"> <button type="submit" class="btn btn-warning">Ubah Password</button></div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
 </main>
 <script>
   $(document).ready(function () {
      @if(count($errors) > 0)
      Swal.fire("Error", "Kelola data gagal!", "error");
      @endif

      originalImageUrl =  $('.profile-pic').attr('src');

      var readURL = function(input) {
         if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                  $("#button-submit").show();
                  $('.profile-pic').attr('src', e.target.result);
               }
      
               reader.readAsDataURL(input.files[0]);
         }
      }
      

      $(".file-upload").on('change', function(){
         readURL(this);
      });

      $("#btn-close").on('click', function(){
         $("#button-submit").hide();
         $('.profile-pic').attr('src', originalImageUrl);
      });
      
      $(".upload-button").on('click', function() {
         $(".file-upload").click();
      });


      $('a[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
         localStorage.setItem('lastTab', $(e.target).attr('href'));
      });
      var lastTab = localStorage.getItem('lastTab');
      
      if (lastTab) {
         $('[href="' + lastTab + '"]').tab('show');
      }
   });
 </script>
@endsection