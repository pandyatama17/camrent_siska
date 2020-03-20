<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>form-v1 by Colorlib</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="{{asset('regform/css/opensans-font.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('regform/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('regform/css/style.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datepicker.css')}}"/>
		<link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
		<style media="screen">
		.drp-calendar{
			background-image: -webkit-linear-gradient( 136deg, rgb(116,235,213) 0%, rgb(63,43,150) 100%);
		}
		.daterangepicker
		{
			border:none;
			box-shadow: 0px 8px 8px 0px rgba(0, 0, 0, 0.1), 0px 6px 20px 0px rgba(0, 0, 0, 0.19);
		}
		.available
		{
			font-weight: 400;
			transition: .5s
		}
		.available:hover
		{
			font-weight: 600;
			background: rgba(116,235,213,.25) !important;
		}
		thead tr:first-child
		{
			background-image: -webkit-linear-gradient(45deg, #293F61 0%, #293F61 9%, #3e4061 100%) !important;

		}
		.table-condensed td
		{
			border-radius: 0 !important;
		}
		thead tr:first-child > th
		{
			border: 1px solid #293F61 ;
		}
		thead tr:first-child > th
		{
			border-radius: 0 !important;
		}

		.calendar-table
		{
			background: rgba(255, 0, 0, 0) !important;
		}
		.off
		{
			border-radius: 0;
			background: rgba(0, 0, 0, 0.1) !important;
		}
		.monthselect, .yearselect {
			display:inline-block;
	    margin:30px;
	    position: relative;
			padding:10px;
	    border-radius:3px;
			border:0;
	    font-weight:900;
	    color:#FFF;
	    /* box-shadow: 0px 8px 8px 0px rgba(0, 0, 0, 0.1), 0px 6px 20px 0px rgba(0, 0, 0, 0.19); */
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
			linear-gradient(45deg, #293F61 0%, #293F61 9%, #3e4061 100%);
	    background-repeat: no-repeat, repeat;
	    background-position: right .7em top 50%, 0 0;
			/* color:#444; */
	    background-size: .65em auto, 100%;
		}
		.monthselect::-ms-expand , .yearselect::-ms-expand {
		    display: none;
		}
		.monthselect:hover , .yearselect:hover {
		    border-color: #888;
		}
		.monthselect:focus , .yearselect:focus {
		    border-color: #aaa;
		    /* box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7); */
		    /* box-shadow: 0 0 0 3px -moz-mac-focusring; */
		    color: #fff;
		    outline: none;
		}
		.monthselect option, .yearselect option {
		    font-weight:normal;
				color: #fff;
				background-color: #3e4061 !important;
    		text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
		}
		.monthselect option:hover, .yearselect option:hover {
		    box-shadow: 0 0 10px 100px #75ebd5 inset;
		}
		.error {
		  float: none;
		  color: red !important;
		  padding-left: .5em;
		  vertical-align: top;
		  display: block;
			font-size: 7pt;
		}
		.title
		{
			-webkit-border-top-left-radius: 10px;
			-webkit-border-top-right-radius: 10px;
			background-color: #3e4061 !important;
			text-align: center;
		}
		#form-total
		{
			-webkit-border-top-left-radius: 0!important;
			background-color: #3e4061 !important;
		}
		.back
		{
			color: white;
			float:left;
			vertical-align: bottom;
			padding-top: 15px;
			margin-top: 15px;
			margin-left: 20px;
			font-weight: 600;
		}
		</style>
</head>
<body>
	<div class="page-content">
		<div class="form-v1-content">
			<div class="wizard-form">
				<div class="title">
					<a href="/login" class="back"><i class="zmdi zmdi-arrow-left"></i> back to login</a>
					<a href="#" class="logo">
						<img src="{{asset('electro/img/logo.png')}}" alt="">
					</a>
				</div>
				<form id="form-register" class="form-register" method="POST" action="{{ route('register') }}">
					@csrf
		        	<div id="form-total">
		        		<!-- SECTION 1 -->
			            <h2>
			            	<p class="step-icon"><span>01</span></p>
			            	<span class="step-text">Personal Infomation</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="wizard-header">
									<h3 class="heading">Personal Infomation</h3>
									<p>Please enter your infomation and proceed to the next step so we can build your accounts.  </p>
								</div>
								<label class="error" for="first_name">@error('first_name'){{$message}}@enderror</label>
								<div class="form-row">
									<div class="form-holder">
										<fieldset>
											<legend>First Name</legend>
											<input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}"autocomplete="first_name" autofocus required>
										</fieldset>
									</div>
									<label class="error" for="last_name">@error('last_name'){{$message}}@enderror</label>
									<div class="form-holder">
										<fieldset>
											<legend>Last Name</legend>
											<input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<label class="error" for="email">@error('email'){{$message}}@enderror</label>
											<legend>Your Email</legend>
											<input type="email" name="email" id="email" class="form-control"  value="{{ old('email') }}" autocomplete="email" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="error" for="phone">@error('phone'){{$message}}@enderror</label>
										<fieldset>
											<legend>Phone Number</legend>
											<input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="phone" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="error" for="phone">@error('birth_date'){{$message}}@enderror</label>
										<fieldset>
											<legend>Birth Date</legend>
											<input type="text" id="birth_date" name="birth_date" class=" datepicker"required>
										</fieldset>
									</div>
								</div>
							</div>
			      </section>
						<!-- SECTION 2 -->
			      <h2>
			      	<p class="step-icon"><span>02</span></p>
			        <span class="step-text">Create Password</span>
			      </h2>
			      <section>
			      	<div class="inner">
			        	<div class="wizard-header">
									<h3 class="heading">Create Password</h3>
									<p>Please enter a password and proceed to the next step so we can build your accounts.</p>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<label class="error" for="password">@error('password'){{$message}}@enderror</label>
											<legend>Password</legend>
											<input type="password" name="password" id="password" class="form-control" placeholder="" required>
										</fieldset>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<fieldset>
											<label class="error" for="confirm"></label>
											<legend>Confirm Password</legend>
											<input type="password" name="confirm" id="confirm" class="form-control" placeholder="" required>
										</fieldset>
									</div>
								</div>

							</div>
			       </section>
			       <!-- SECTION 3 -->
			       <h2>
			       	<p class="step-icon"><span>03</span></p>
			        <span class="step-text">Verification</span>
			       </h2>
			       <section>
							 <div class="inner">
			         		<div class="wizard-header">
										<h3 class="heading">Verification</h3>
											<p>Please enter your infomation and wait for us to verify you.</p>
										</div>
										{{-- <div class="form-row">
											<div class="form-holder form-holder-2">
												<fieldset>
													<label class="error" for="verification_id"></label>
													<legend>Identity Card Number</legend>
													<input type="text" name="verification_id" id="verification_id" class="form-control" placeholder="" required>
												</fieldset>
											</div>
										</div> --}}
										<div class="form-row">
											<div class="form-holder form-holder-2">
												<fieldset>
													<label class="error" for="verification_file">@error('verification_file'){{$message}}@enderror</label>
													<legend>Identity Card File</legend>
													<input type="file" name="verification_file" id="verification_file" class="form-control" placeholder="" required>
												</fieldset>
											</div>
										</div>
								</div>
			       </section>
		    	</div>
				</form>
			</div>
		</div>
	</div>
	<script src="{{asset('regform/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('regform/js/jquery.steps.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js" charset="utf-8"></script>
	<script src="{{asset('regform/js/main.js')}}"></script>
	<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('adminlte/plugins/moment/moment.min.js')}}" charset="utf-8"></script>
	<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}" charset="utf-8"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".datepicker").daterangepicker({
				locale: {
		          format: 'YYYY-MM-DD',
		    },
		    singleDatePicker: true,
		    showDropdowns: true
			});
			// $('.datepicker').datepicker()
		})
	</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
