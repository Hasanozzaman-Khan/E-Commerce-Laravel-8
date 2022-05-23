@extends('front/layout')

@section('page_title', 'Change Password')

@section('container')


<!-- Cart view section -->
<section id="aa-myaccount">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
      <div class="aa-myaccount-area">
          <div class="row">
              <div class="col-md-3">

              </div>
            <div class="col-md-6">
              <div class="aa-myaccount-register">
               <h4>Change Password</h4>
               <form action="" class="aa-login-form" id="frmUpdatePassword">


                  <label for="">Password<span>*</span></label>
                  <input type="password" name="password" placeholder="Password" required>
                  <div id="thank_you_msg" class="field_error"></div>


                  <button type="submit" id="btnUpdatePassword" class="aa-browse-btn">Change Password</button>
                  @csrf
                </form>
              </div>
              <div id="thank_you_msg" class="field_error"></div>
            </div>
          </div>
       </div>
     </div>
   </div>
 </div>
</section>
<!-- / Cart view section -->

@endsection
