 @extends('frontend.main_master')
 @section('content')





 <div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-12 col-sm-6 sign-in">
	<h4 class="">Forget Password?</h4>
	<p class="">Hello, No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
	


	@if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


	<form method="POST" action="{{ route('password.email') }}">
	@csrf

		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" >
		</div>
        @error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{$message}}</strong>
				</span>
			@enderror
	  
		<br/><br/>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset Link</button><br>
		
	</form>					
</div>
<!-- Sign-in -->

<!-- create a new account -->

<!-- create a new account -->			</div><!-- /.row -->
		</div><!-- /.sigin-in-->



@include('frontend.body.brand')
  @endsection








