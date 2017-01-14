$.validator.addMethod("lessThan",
    function(value){
		if($('#rel_exp').val()=='')
		{
			var rel=0;
		}
		else{
			var rel=$('#rel_exp').val()
		}
        return parseInt(value) >= parseInt(rel);
    }, "It should be greater than relevant exp."
);
  var baseUrl = document.location.origin;
//var baseUrl = 'http://localhost/rmoney/mdfa';

   $("#validation_form").validate({
    ignore: [],
		rules: {
            phone: {
				required: true,
                minlength: 10,
                maxlength: 12
               
			},
			name: {
				required: true,
                maxlength: 100
               
			},
			first_name: {
				required: true,
                maxlength: 50
               
			},
			last_name: {
				required: true,
                maxlength: 50
               
			},
			dob: {
				required: true,
               
			},
			email: {
				required: true,
                email: true,
				maxlength: 100
               
			},
			age: {
				required: true,
				maxlength: 3
               
			},
			address1: {
				required: true,
				maxlength: 1000,
             },
            
		},
		messages: {
            name: {
				required: "User Name is required.",
				maxlength: "Maximum 100 Characters.",
               
			},
		first_name: {
				required: "First Name is required.",
				maxlength: "Maximum 50 Characters.",
               
			},
			last_name: {
				required: "Surname is required.",
				maxlength: "Maximum 50 Characters.",
               
			},	
        phone:{
              maxlength: "Maximum 12 digit.",
            } ,
		email: {
				required: 'Email is required',
				maxlength: "Maximum 100 Characters.",
               
			},
		age: {
				maxlength: "Maximum 3 digits.",
             },
		address1: {
				maxlength: "Maximum 1000 characters.",
             },
			
		}
	});
	$(document).ready(function () {

		$('.direc').each(function () {
			
			$(this).rules('add', {
				lettersonly: true
			});
		});

	});
 $("#validation_form_signup").validate({
    ignore: [],
		rules: {
            phone: {
				required: true,
                minlength: 10,
                maxlength: 12
               
			},
			name: {
				required: true,
                maxlength: 100
               
			},
			first_name: {
				required: true,
                maxlength: 50
               
			},
			last_name: {
				required: true,
                maxlength: 50
               
			},
			dob: {
				required: true,
               
			},
			email: {
				required: true,
                email: true,
				maxlength: 100
               
			},
			age: {
				required: true,
				maxlength: 3
               
			},
			address1: {
				required: true,
				maxlength: 1000,
             },
            
		},
		messages: {
            name: {
				required: "User Name is required.",
				maxlength: "Maximum 100 Characters.",
               
			},
		first_name: {
				required: "First Name is required.",
				maxlength: "Maximum 50 Characters.",
               
			},
			last_name: {
				required: "Surname is required.",
				maxlength: "Maximum 50 Characters.",
               
			},	
        phone:{
              maxlength: "Maximum 12 digit.",
            } ,
		email: {
				required: 'Email is required',
				maxlength: "Maximum 100 Characters.",
               
			},
		age: {
				maxlength: "Maximum 3 digits.",
             },
		address1: {
				maxlength: "Maximum 1000 characters.",
             },
			
		}
	});
	$(document).ready(function () {

		$('.direc').each(function () {
			
			$(this).rules('add', {
				lettersonly: true
			});
		});

	});
    $("#form_validation_pass").validate({
    ignore: [],
		rules: {
		  
            password: {
                minlength: 6 
			},
            rpassword:{
             equalTo: "#password"   
            },
			trade_name:{
				lettersonlys: true
			},

		},
		messages: {

      password:{
              minlength:""
            } ,
      rpassword:{
             equalTo: "Not Match To Password."   
            },
           
		}
	});
    $(document).ready(function() {
	
    $('.for_validation').validate({       // initialize plugin on each form
       ignore: [],
		rules: {
		  
			company_name: {
				required: true,
               
			},
			answer: {
				required: true,
               
			},
			admin_comment:  {
				required: true,
               
			},
			correct_check:{
				required: true,
			},
			name:{
				lettersonlys: true
			},
			registration_number:{
				alphanumeric:true
			},
			business_reg_info: {
				alphanumeric:true
			},
			
			names:{
				lettersonlys: true
			},
			contact: {
				required: true,
                minlength: 10,
                maxlength: 10
               
			},
			
			email: {
				required: true,
                email: true,
				remote: {
                     url: baseUrl+'/user/forunique',
                    type: "post",
                        }
               
			},
            contacts: {
				required: true,
                minlength: 10,
                maxlength: 10 
			},
            sort:{
              required: true,
              minlength: 9  
                            
            },
            account_number:{
              required: true,
              minlength: 10   
            } ,
            bvn:{
              minlength: 10   
            }       
		},
		messages: {
            company_name: {
				required: "Company Name is required.",
                },
			answer: {
				required: "Answer is required.",
                },
			admin_comment: {
				required: "Admin Comment is required.",
                },
			correct_check:{
				required: 'Enter correct location.',
			},
            sort:{
              minlength: "minimum length is 9"
            },
            account_number:{
              minlength:"Account Number should be 10 digit"
            } ,
            bvn:{
              minlength: "	Bank Verification Number should be 11 digit."  
            } ,
             contacts:{
              minlength:"Minimun 10 digit.",
              maxlength: "Maximum 10 digit.",
            } ,  
			contact:{
              minlength:"Minimun 10 digit.",
              maxlength: "Maximum 10 digit.",
            } ,
			email: {
                email: "Invalid email address.",
				remote: "Email alredy exits",
               
			},
			},
        });

     $.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[a-z0-9_-_s]+$/i.test(value);
    }, "This Field must contain only Letters, Numbers, or Underscore.");
    $('.for_jobmaster_add').each(function() {  // attach to all form elements on page
        $(this).validate({       // initialize plugin on each form
            ignore: [],
		rules: {
		  
			code: {
				required: true,
                loginRegex: true,
                remote: {
                    url: baseUrl+'/dbcpayroll/company/forunique',
                    type: "post",
                    data: {
                        username: 1,
                            }  , 
                        }
               
			},        
		},
		messages: {
            code: {
				required: "Category Code is required.",
                remote: "Oops Category Code already Exists!",
                
                },             
			},
        });
    });
    $('.defor_jobmaster_add').each(function() {  // attach to all form elements on page
        $(this).validate({       // initialize plugin on each form
            ignore: [],
		rules: {
		  
			code: {
				required: true,
                loginRegex: true,
                remote: {
                    url: baseUrl+'/dbcpayroll/company/forunique_des',
                    type: "post",
                    data: {
                        username: function() {
                        return $( "#username" ).val();
                      }
                            }   
                        }
               
			},        
		},
		messages: {
            code: {
				required: "Designation Code is required.",
                remote: "Oops Designation Code already Exists!",
                },             
			},
        });
    });
    $('.dpfor_jobmaster_add').each(function() {  // attach to all form elements on page
        $(this).validate({       // initialize plugin on each form
            ignore: [],
			rules: {
			  
				code: {
					required: true,
					loginRegex: true,
					remote: {
						url: baseUrl+'/dbcpayroll/company/forunique_dep',
						type: "post",
						data: {
							username: function() {
							return $( "#username" ).val();
						  }
								}   
							}
				   
				},        
			},
			messages: {
				code: {
					required: "Department Code is required.",
					remote: "Oops Department Code already Exists!",
				},             
			},
        });
    });
   /* $('.for_jobmaster_edit').each(function() {  // attach to all form elements on page
        $('.company_name').change(function(){
           $id_for_condition=$(this).parents('form').attr('id');
        })
        $(this).validate({       // initialize plugin on each form
            ignore: [],
		rules: {
		  
			name: {
				required: true,
                remote: {
                    url: baseUrl+'/dbcpayroll/company/forunique_edit',
                    type: "post",
                    data: {
                        condition: function() {
                        return $( "#condition"+$id_for_condition ).val();
                      }
                            }   
                        }
               
			},        
		},
		messages: {
            name: {
				required: "Company Name is required.",
                remote: "Name already in use!"
                },             
			},
        });
    });
    $('.defor_jobmaster_edit').each(function() {  // attach to all form elements on page
        $('.designation_name').click(function(){
          $id_for_condition=$(this).parents('form').attr('id');
        })
        $(this).validate({       // initialize plugin on each form
            ignore: [],
		rules: {
		  
			name: {
				required: true,
                remote: {
                    url: baseUrl+'/dbcpayroll/company/forunique_edit_de',
                    type: "post",
                    data: {
                        condition: function() {
                        return $( "#condition"+$id_for_condition ).val();
                      }
                            }   
                        }
               
			},        
		},
		messages: {
            name: {
				required: "Company Name is required.",
                remote: "Name already in use!"
                },             
			},
        });
    });
        $('.dpfor_jobmaster_edit').each(function() {  // attach to all form elements on page
        $('.department_name').change(function(){
           $id_for_condition=$(this).parents('form').attr('id');
        })
        $(this).validate({       // initialize plugin on each form
            ignore: [],
		rules: {
		  
			name: {
				required: true,
                remote: {
                    url: baseUrl+'/dbcpayroll/company/forunique_edit_dep',
                    type: "post",
                    data: {
                        condition: function() {
                        return $( "#condition"+$id_for_condition ).val();
                      }
                            }   
                        }
               
			},        
		},
		messages: {
            name: {
				required: "Company Name is required.",
                remote: "Name already in use!"
                },             
			},
        });
    });*/
});        