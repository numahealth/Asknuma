@extends('admin.layouts.front')

@section('content')
<div class="">
	
	<div class="container-fluid login_mobile">
		
		<h1>Signup</h1>
		
		<div class="alert alert-danger col-sm-12" id="login-alert" style="display:none"></div>
		  @if (count($errors->signup) > 0)
                        <div class="alert alert-danger">
                            
                            <ul>
                                @foreach ($errors->signup->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
          @if (Session::has('message'))
			  {{--*/ $forclicknregistration = 1 /*--}}
                        <div class="alert alert-success">
					<ul><li>
                          {{ Session::get('message') }}
						  
						  
						</li></ul>
                        </div>
                    @endif
<form class="form-horizontal" role="form" method="POST" action="{{ url('/signup') }}" id='validation_form_signup'>
            <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}"> 

                         
                        
                         
                         
			<div class="input-group" > 
              {!! Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder'=> 'First Name*']) !!}
			  <span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
			<label for="first_name" generated="true" class="error error_reg" style="display:none" ></label>
            <div style="margin-top: 15px; " class="input-group" > 
              {!! Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder'=> 'Surname*']) !!}
			  <span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
			<label for="last_name" generated="true" class="error error_reg" style="display:none" ></label>
			<div class="input-group" style="margin-top: 15px; "> 
            {!! Form::number('age', old('age'), ['class'=>'form-control', 'placeholder'=> 'Age*','min'=>'1']) !!}
			<span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
			<label for="age" generated="true" class="error error_reg" style="display:none;"></label>
            <div class="input-group" style="margin-top: 15px;"> 
            <?php 
						$gender=Array(
							'Male' => 'Male',
							'Female' => 'Female',
							'Other' => 'Other'
							);?>
			{!! Form::select('gender', $gender, old('gender'), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
<label  generated="true" class="" style="display:none"></label>
             <div class="input-group" style="margin-top: 15px; "> 
             {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=> 'Email*']) !!}
			 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            </div>
            <label for="email" generated="true" class="error error_reg" style="display:none"></label>
             <div class="input-group" style="margin-top: 15px; ">
              <?php $values=array();
							  $symptom = DB::table('country_code')->get();
							  if(!empty($symptom))
								{
									 foreach($symptom as $records)
									 {
										 
										 $values[$records->phonecode]=$records->nicename.' +'.$records->phonecode;
									}
								}
							
							
				?>
				{!! Form::select('phone_code', $values, old('phone_code',234), array('style'=>'border-right: 1px solid #53b753 !important;', 'id'=>'search_keyword','class'=>'form-control phone_code phpn_drops')) !!}
 
			  {!! Form::number('phone', old('phone'), ['min'=>1,'class'=>'form-control', 'placeholder'=> 'Contact Number*','style'=>'width:54%']) !!}
			   <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            </div>
           
 <label for="phone" generated="true" class="error error_reg" style="display:none"></label>
              <div class="form-group">
			    <div class="col-xs-12 col-sm-12">
			      <button type="submit" style="margin-top:15px" class="btn btn-login">Signup</button>
			    </div>
			  </div>

                             
                                   
                                        <div class="form-group sign_up">
			    
			    <div class="col-xs-12 text-center ">
			      	<a href="{{url('/signin')}}">LOGIN</button>
			    </div>
			  </div>
          
         {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection