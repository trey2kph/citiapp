<?php include("../config.php"); ?>
// JavaScript Document

$(function ()
{
    
    /* CHECKOUT */

    $('#chkout_prod').iframePostForm
	({
		json : true,
		post : function ()
		{
			var chkout_msq;  
			
			if (!$('.chkout_msq').length)
			{
				$('#chkout_title').after('<div class="chkout_msq" style="display:none; padding:10px; text-align:center" />');
			}
            
            if ($('#txtconame').val().length && $('#txtcomobile').val().length && $('#txtcoaddress').val().length && $('#txtcoinstruct').val().length && $('#txtprovince').val() != 0 && $('#txtcity').val() != 0 && $('#txtcoptype').val() != 0)
            {            
                
                $('.chkout_msq')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing your purchase&hellip;')
                .css({
                    color : '#006100',
                    background : '#c6efce',
                    border : '2px solid #006100',
                    height : 'auto'
                })
                .slideDown();  
            }
            else
            {                
                $('.chkout_msq')
                    .html('All fields are required.')
                    .css({
                        color : '#9c0006',
                        background : '#ffc7ce',
                        border : '2px solid #9c0006',
                        height : 'auto'
                    })
                    .slideDown()
                    .effect('shake', {times: 3, distance: 5}, 420); 

                return false;
            }
            
            
		},
		complete : function (response)
		{
			var style,
				width,
				html = '';
			
			
			if (!response.success)
			{
				$('.chkout_msq').slideUp(function ()
				{
					$(this)
						.html(response.error)
						.css({
							color : '#9c0006',
							background : '#ffc7ce',
							borderColor : '#9c0006',
                            height : 'auto'
						})
						.slideDown();
				});
			}
			
			else
			{
				$('.chkout_msq').slideUp();
                alert('Your purchased has been successfully applied. We will an email about the purchase status ASAP. Thank you.');
                window.location.href='<?php echo WEB; ?>/order';
                
			}
		}
	});
    
    /* REGISTER */

    $('#reg_user').iframePostForm
	({
		json : true,
		post : function ()
		{
			var reg_msq;  
			
			if (!$('.reg_msq').length)
			{
				$('#reg_title').after('<div class="reg_msq" style="display:none; padding:10px; text-align:center" />');
			}
            
            if ($('#user_lastname').val().length && $('#user_firstname').val().length && $('#user_email').val().length && $('#user_password').val().length && $('#user_password2').val().length)
            {
                if ($('#user_password').val() != $('#user_password2').val()) {
                    
                    $('.reg_msq')
                        .html('Password mismatch.')
                        .css({
                            color : '#9c0006',
                            background : '#ffc7ce',
                            border : '2px solid #9c0006',
                            height : 'auto'
                        })
                        .slideDown()
                        .effect('shake', {times: 3, distance: 5}, 420); 

                    return false;
                    
                    
                } else {                
                
                    $('.reg_msq')
                    .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing registration&hellip;')
                    .css({
                        color : '#006100',
                        background : '#c6efce',
                        border : '2px solid #006100',
                        height : 'auto'
                    })
                    .slideDown();                    
                }
            }
            else
            {                
                $('.reg_msq')
                    .html('All fields are required.')
                    .css({
                        color : '#9c0006',
                        background : '#ffc7ce',
                        border : '2px solid #9c0006',
                        height : 'auto'
                    })
                    .slideDown()
                    .effect('shake', {times: 3, distance: 5}, 420); 

                return false;
            }
            
            
		},
		complete : function (response)
		{
			var style,
				width,
				html = '';
			
			
			if (!response.success)
			{
				$('.reg_msq').slideUp(function ()
				{
					$(this)
						.html(response.error)
						.css({
							color : '#9c0006',
							background : '#ffc7ce',
							borderColor : '#9c0006',
                            height : 'auto'
						})
						.slideDown();
				});
			}
			
			else
			{
				$('.reg_msq').slideUp();
                $("#floatdiv").addClass("invisible");
                alert('Your registration has been successfully applied. Please activate your account provided to your email (' + $('#user_email').val() + ')');
                
			}
		}
	});

    /* PROFILE */

    $('#uprofile form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var uprofile_msg;
			
			if (!$('.uprofile_msg').length)
			{
				$('#lasttable').after('<div class="uprofile_msg" style="display:none; padding:10px; text-align:center" />');
			}

            var x = new Array('position', 'lastname', 'firstname', 'middlename', 'nickname', 'address_num', 'address_street', 'address_brgy', 'address_city', 'address_region', 'address_zip', 'address_country', 'provincial_address', 'contact', 'email', 'birthplace', 'sss', 'tin', 'philhealth', 'pagibig', 'father_name', 'father_comp', 'mother_name', 'mother_comp', 'schoolname[0]', 'schoolname[1]', 'skill[0]', 'comp_supervisor[0]', 'department', 'local', 'corp_email', 'emergency_name', 'emergency_address', 'emergency_telno');
            
            for (var i = 0; i < x.length; i += 1)
            {
                l = document.forms['formpro'][x[i]];
                if (l.value == null || l.value == '' || l.value == 0) {
                    $('.uprofile_msg')
                    .html('Some fields are required.')
                    .css({
                        'color' : '#9c0006',
                        'background' : '#ffc7ce',
                        'border' : '2px solid #9c0006',
                        'margin-top' : '10px',
                        'height' : 'auto'
                    })
                    .slideDown()
                    .effect('shake', {times: 3, distance: 5}, 420); 
                    
                    return false;
                }
                else {
                    $('.uprofile_msg')
                    .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Updating your profile&hellip;')
                    .css({
                        'color' : '#006100',
                        'background' : '#c6efce',
                        'border' : '2px solid #006100',
                        'margin-top' : '10px',
                        'height' : 'auto'
                    })
                    .slideDown();
                }                       
            }
			
		},
		complete : function (response)
		{
			var style,
				width,
				html = '';
			
			
			if (!response.success)
			{
				$('.uprofile_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
						.css({
							'color' : '#9c0006',
							'background' : '#ffc7ce',
							'borderColor' : '#9c0006',
                            'margin-top' : '10px',
                            'height' : 'auto'
						})
						.slideDown();
				});
			}
			
			else
			{
				html += '<p>Your profile has been successfully updated.</p>';				
				
				$('.uprofile_msg').slideUp(function ()
				{
					$(this)
						.html(html)
						.css({
							'color' : '#006100',
							'background' : '#c6efce',
							'borderColor' : '#006100',
                            'margin-top' : '10px',
                            'height' : 'auto'
						})
						.slideDown();
				});
                
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/act_request.php?sec=table",
                    success: function(data) {                        
                        $("#activity_table").html(data);
                    }
                });
			}
		}
	});

    /* FORGOT PASSWORD */

    $('#forgot form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var forgot_msg;
			
			if (!$('.forgot_msg').length)
			{
				$('#forgot_title').after('<div class="forgot_msg" style="display:none; padding:10px; text-align:center" />');
			}
            
            if ($('#empidnum').val().length)
            {
                $('.forgot_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing&hellip;')
                .css({
                    color : '#006100',
                    background : '#c6efce',
                    border : '2px solid #006100',
                    height : 'auto'
                })
                .slideDown();
            }
            else
            {
                $('.forgot_msg')
                    .html('Employee ID is required.')
                    .css({
                        color : '#9c0006',
                        background : '#ffc7ce',
                        border : '2px solid #9c0006',
                        height : 'auto'
                    })
                    .slideDown()
                    .effect('shake', {times: 3, distance: 5}, 420); 
                
                return false;
            }           
			
		},
		complete : function (response)
		{
			var style,
				width,
				html = '';
			
			
			if (!response.success)
			{
				$('.forgot_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .css({
                            color : '#9c0006',
                            background : '#ffc7ce',
                            border : '2px solid #9c0006',
                            height : 'auto'
                        })
                        .slideDown();
				});
			}
			
			else
			{
				html += '<p>Your password has been successfully reset and sent you your email.</p>';				
				
				$('.forgot_msg').slideUp(function ()
				{
					$(this)
						.html(html)
						.css({
							'color' : '#006100',
							'background' : '#c6efce',
							'borderColor' : '#006100',
                            'margin-top' : '10px',
                            'height' : 'auto'
						})
						.slideDown();
				});
			}
		}
	});

    /* CHANGE PASSWORD */

    $('#fpass form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var fpass_msg;
			
			if (!$('.fpass_msg').length)
			{
				$('#fpass_title').after('<div class="fpass_msg" style="display:none; margin-bottom:20px; padding:10px; text-align:center" />');
			}
            
            if ($('#opassword').val().length && $('#npassword').val().length && $('#cpassword').val().length)
            {
                $('.fpass_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing&hellip;')
                .css({
                    color : '#006100',
                    background : '#c6efce',
                    border : '2px solid #006100',
                    height : 'auto'
                })
                .slideDown();
            }
            else
            {
                $('.fpass_msg')
                    .html('All fields are required.')
                    .css({
                        color : '#9c0006',
                        background : '#ffc7ce',
                        border : '2px solid #9c0006',
                        height : 'auto'
                    })
                    .slideDown()
                    .effect('shake', {times: 3, distance: 5}, 420); 
                
                return false;
            }           
			
		},
		complete : function (response)
		{
			var style,
				width,
				html = '';
			
			
			if (!response.success)
			{
				$('.fpass_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
						.css({
							'color' : '#9c0006',
							'background' : '#ffc7ce',
							'borderColor' : '#9c0006',
                            'margin-top' : '10px',
                            'height' : 'auto'
						})
						.slideDown();
				});
			}
			
			else
			{
				html += '<p>Your password has been successfully changed.</p>';				
				
				$('.fpass_msg').slideUp(function ()
				{
					$(this)
						.html(html)
						.css({
							'color' : '#006100',
							'background' : '#c6efce',
							'borderColor' : '#006100',
                            'margin-top' : '10px',
                            'height' : 'auto'
						})
						.slideDown();
				});
			}
		}
	});

});