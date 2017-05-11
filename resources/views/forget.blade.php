@include('admin.partials.header')
<style>
body { background:#fff;}
.numa_banner {opacity:1 !important; margin-top: 0; background: url(https://www.asknuma.com/public/front/img/banner01.jpg) no-repeat fixed center -25px / cover;height: 100vh; padding-top:10%;}

</style>

<div class="container-fluid numa_banner testing">
<div class="col-md-4 an_login">
<div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Forgot Password</div>
                        <div style="font-size: 80%; color: #414958;margin: 9px;text-align: center;">Just enter your email address below & we'll send you a new one</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body">

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                           @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            
                            <ul>
                                @foreach ($errors->all() as $error)
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
                        <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('forget') }}">
                            <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">        
                            <div style="margin-bottom: 25px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="email"
                                       class="form-control"
                                       name="email" placeholder="Enter email*"
                                       value="{{ old('email') }}">                                     
                                    </div>
                            
                                    
                              <div class="form-inline login_check">
                          
                                      <button type="submit"
                                        class="btn btn-info"
                                        style="margin-right: 15px;">
                                    Submit
									</button>
									
                                            <a href="{{ url('') }}">Go to home page</a>
                                        
                                 </div>

                             
                                   
                                        
                                    
                                
                            </form>     



                        </div>                     
                    </div>
                      </div>
</div>


<!--@include('admin.partials.footer')-->
