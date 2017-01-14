@extends('admin.layouts.front')

@section('content')
<div class="">
	
	<div class="container-fluid login_mobile">
		
		<h1>Login</h1>
		
		<div class="alert alert-danger col-sm-12" id="login-alert" style="display:none"></div>
		  
		  @if (count($errors->logins) > 0)
                        <div class="alert alert-danger">
                            
                            <ul>
                                @foreach ($errors->logins->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
			<form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('signin') }}">
                            <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">        
                            
                              <div class="form-group">
			    <div class="col-xs-12">
			      	<div class="input-group">
	                   <input type="email"
                                       class="form-control"
                                       name="email" placeholder="Username*"
                                       value="{{ old('email') }}"> 
	                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                </div>
			    </div>
			  </div> 
                          
                                 <div class="form-group">
			    <div class="col-xs-12">
			      	
	                <div class="input-group">
					 	 <input type="password"
                                       class="form-control" placeholder="Password*"
                                       name="password">
	                    <span class="input-group-addon"><i class="fa fa-lock "></i></span>
	                </div>
			    </div>
			  </div>   
                              <div class="form-group">
			    <div class="col-xs-12 col-sm-12">
			      <button type="submit" class="btn btn-login">Login</button>
			    </div>
			  </div>

                             
                                   
                                        <div class="form-group sign_up">
			    
			    <div class="col-xs-12 text-center ">
			      	<a href="{{url('/signup')}}">SIGNUP</a>
			    </div>
			    
			  </div>
			  <div class="form-group sign_up">
			    
			    <div class="col-xs-12 text-center ">
			      	<a href="{{url('/forget')}}">Forgot Password</a>
			    </div>
			    
			  </div>
                                
                            </form>
		</div>
	</div>
</div>
@endsection