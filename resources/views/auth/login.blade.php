@include('admin.partials.header')
<style>
body { background:#fff;}
</style>
<div style="margin-top: 10%;"></div>

<div class="col-md-3 an_login">
<div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>-->
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
                        <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                            <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">        
                            <div style="margin-bottom: 25px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="email"
                                       class="form-control"
                                       name="email" placeholder="Username*"
                                       value="{{ old('email') }}">                                     
                                    </div>
                                
                            <div style="margin-bottom: 25px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock "></i></span>
                                       
										 <input type="password"
                                       class="form-control" placeholder="Password*"
                                       name="password">
                                    </div>
                                    
                              <div class="form-inline login_check">
                          
                                      <button type="submit"
                                        class="btn btn-info"
                                        style="margin-right: 15px;">
                                    {{ trans('quickadmin::auth.login-btnlogin') }}
									</button>
                   
                                     
                         
                                     
                                     
                                          <input type="checkbox" class=""
                                           name="remember">{{ trans('quickadmin::auth.login-remember_me') }}
                                    
                                  
                                
                                 </div>

                             
                                   
                                        <div class="login_submint">
                                            Don't have an account! 
                                        <a href="#" onclick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    
                                
                            </form>     



                        </div>                     
                    </div>
                      </div>
<!--@include('admin.partials.footer')-->
