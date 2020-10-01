<?php include("../../config.php"); ?>

// JavaScript Document

$(function ()
{
    var pagenum = $('#pagenum').val();

    /* PRODUCT */
    
    $('#frmprod form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var product_msg;  
            
            $("#btnproduct").addClass('invisible');
			
			if (!$('.product_msg').length)
			{
				$('#product_title').after('<div class="product_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#product_name').val().length && $('#product_model').val().length && $('#product_price').val() != 0 && $('#product_brand').val() != 0 && $('#product_cat').val() != 0 && $('#product_subcat').val() != 0 && $('#product_specs').val().length)
            {
            
                $('.product_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing product&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnproduct").removeClass('invisible');
                $('.product_msg')
                    .html('All fields are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.product_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnproduct").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Product information has been successfully created. <a href="<?php echo WEB; ?>/product?add=1">Add another</a> | <a href="<?php echo WEB; ?>/product?id=' + response.id + '">Edit this product</a> | <a href="<?php echo WEB; ?>/product">Back to product list</a></p>';				
                }
                else {
                    html += '<p>Product information has been successfully updated. <a href="<?php echo WEB; ?>/product">Back to product list</a></p>';				
                    $("#btnproduct").removeClass('invisible');
                }
				
				$('.product_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});
    
    /* BRAND */
    
    $('#frmbrand form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var brand_msg;  
            
            $("#btnbrand").addClass('invisible');
			
			if (!$('.brand_msg').length)
			{
				$('#brand_title').after('<div class="brand_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#brand_name').val().length && $('#brand_logo').val().length && $('#brand_country').val() != 0)
            {
            
                $('.brand_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing brand&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnbrand").removeClass('invisible');
                $('.brand_msg')
                    .html('Brand name, logo and country are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.brand_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnbrand").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Brand information has been successfully created. <a href="<?php echo WEB; ?>/brand?add=1">Add another</a> | <a href="<?php echo WEB; ?>/brand?id=' + response.id + '">Edit this brand</a> | <a href="<?php echo WEB; ?>/brand">Back to brand list</a></p>';				
                }
                else {
                    html += '<p>Brand information has been successfully updated. <a href="<?php echo WEB; ?>/brand">Back to brand list</a></p>';				
                    $("#btnbrand").removeClass('invisible');
                }
                
				$('.brand_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});
    
    /* CATEGORY */
    
    $('#frmcategory form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var category_msg;  
            
            $("#btncategory").addClass('invisible');
			
			if (!$('.category_msg').length)
			{
				$('#category_title').after('<div class="category_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#category_name').val().length)
            {
            
                $('.category_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing category&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btncategory").removeClass('invisible');
                $('.category_msg')
                    .html('Category name is required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.category_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btncategory").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Category information has been successfully created. <a href="<?php echo WEB; ?>/category?add=1">Add another</a> | <a href="<?php echo WEB; ?>/category?id=' + response.id + '">Edit this category and add subcategories</a> | <a href="<?php echo WEB; ?>/category">Back to category list</a></p>';				
                }
                else {
                    html += '<p>Category information has been successfully updated. <a href="<?php echo WEB; ?>/category">Back to category list</a></p>';				
                    $("#btncategory").removeClass('invisible');
                }
                
				$('.category_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});
    
    /* PROMO */
    
    $('#frmpromo form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var promo_msg;  
            
            $("#btnpromo").addClass('invisible');
			
			if (!$('.promo_msg').length)
			{
				$('#promo_title2').after('<div class="promo_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#promo_title').val().length && $('#promo_desc').val().length && $('#promo_type').val() != 0)
            {
            
                $('.promo_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing promo&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnpromo").removeClass('invisible');
                $('.promo_msg')
                    .html('Promo title, description and type are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.promo_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnpromo").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Promo information has been successfully created. <a href="<?php echo WEB; ?>/promo?add=1">Add another</a> | <a href="<?php echo WEB; ?>/promo?id=' + response.id + '">Edit this promo</a> | <a href="<?php echo WEB; ?>/promo">Back to promo list</a></p>';				
                }
                else {
                    html += '<p>Promo information has been successfully updated. <a href="<?php echo WEB; ?>/promo">Back to promo list</a></p>';				
                    $("#btnpromo").removeClass('invisible');
                }
                
				$('.promo_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});

    /* CONTENT */
    
    $('#frmcontent form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var content_msg;  
            
            $("#btncontent").addClass('invisible');
			
			if (!$('.content_msg').length)
			{
				$('#content_title').after('<div class="content_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#contents_title').val().length && $('#contents_text').val().length)
            {
            
                $('.content_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing content&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btncontent").removeClass('invisible');
                $('.content_msg')
                    .html('Title and content are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.content_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btncontent").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Content information has been successfully created. <a href="<?php echo WEB; ?>/content?add=1">Add another</a> | <a href="<?php echo WEB; ?>/content?id=' + response.id + '">Edit this content</a> | <a href="<?php echo WEB; ?>/content">Back to content list</a></p>';				
                }
                else {
                    html += '<p>Content information has been successfully updated. <a href="<?php echo WEB; ?>/content">Back to content list</a></p>';				
                    $("#btncontent").removeClass('invisible');
                }
				
				$('.content_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});

    /* CAREER */
    
    $('#frmcareer form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var career_msg;  
            
            $("#btncareer").addClass('invisible');
			
			if (!$('.career_msg').length)
			{
				$('#career_title').after('<div class="career_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#career_name').val().length && $('#career_requirement').val().length)
            {
            
                $('.career_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing career&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btncareer").removeClass('invisible');
                $('.career_msg')
                    .html('Career name and requirement are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.career_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btncareer").removeClass('invisible');
			}
			
			else
			{
                if (response.add)
                {
				    html += '<p>Career information has been successfully created. <a href="<?php echo WEB; ?>/career?add=1">Add another</a> | <a href="<?php echo WEB; ?>/career?id=' + response.id + '">Edit this career</a> | <a href="<?php echo WEB; ?>/career">Back to career list</a></p>';				
                }
                else {
                    html += '<p>Career information has been successfully updated. <a href="<?php echo WEB; ?>/career">Back to career list</a></p>';				
                    $("#btncareer").removeClass('invisible');
                }
				
				$('.career_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});

    /* STORE */
    
    $('#frmstore form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var store_msg;  
            
            $("#btnstore").addClass('invisible');
			
			if (!$('.store_msg').length)
			{
				$('#store_title').after('<div class="store_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#store_name').val().length && $('#store_address').val().length && $('#store_x').val().length && $('#store_y').val().length && $('#store_province').val() != 0 && $('#store_city').val() != 0)
            {
            
                $('.store_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing store&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnstore").removeClass('invisible');
                $('.store_msg')
                    .html('All fields are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.store_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnstore").removeClass('invisible');
			}
			
			else
			{
                var store_page = $("#store_page").val();
                if (response.add)
                {
				    html += '<p>Store information has been successfully created. <a href="<?php echo WEB; ?>/stores?add=1">Add another</a> | <a href="<?php echo WEB; ?>/stores?id=' + response.id + '">Edit this store</a> | <a href="<?php echo WEB; ?>/stores/page/' + store_page + '">Back to store list</a></p>';				
                }
                else {
                    html += '<p>Store information has been successfully updated. <a href="<?php echo WEB; ?>/stores/page/' + store_page + '">Back to store list</a></p>';				
                    $("#btnstore").removeClass('invisible');
                }
				
				$('.store_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});
    
    /* USER */
    
    $('#frmuser form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var user_msg;  
            
            $("#btnuser").addClass('invisible');
			
			if (!$('.user_msg').length)
			{
				$('#user_title').after('<div class="user_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#user_lastname').val().length && $('#user_firstname').val().length && $('#user_email').val().length && $('#user_password').val().length && $('#user_type').val() != 0)
            {
            
                $('.user_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing user&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnuser").removeClass('invisible');
                $('.user_msg')
                    .html('User lastname, firstname, email, password and type are required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.user_msg').slideUp(function ()
				{
					$(this)
						.html('There was a problem on processing user')
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnuser").removeClass('invisible');
			}
			
			else
			{
				
                if (response.add)
                {
				    html += '<p>User information has been successfully created. <a href="<?php echo WEB; ?>/user?add=1">Add another</a> | <a href="<?php echo WEB; ?>/user?id=' + response.id + '">Edit this user</a> | <a href="<?php echo WEB; ?>/user">Back to user list</a></p>';				
                }
                else {
                    html += '<p>User information has been successfully updated. <a href="<?php echo WEB; ?>/user">Back to user list</a></p>';				
                    $("#btnuser").removeClass('invisible');
                }		
				
				$('.user_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
				});
                
			}
		}
	});
    
    /* SETTING */
    
    $('#frmsetting form').iframePostForm
	({
		json : true,
		post : function ()
		{
			var setting_msg;  
            
            $("#btnsetting").addClass('invisible');
			
			if (!$('.setting_msg').length)
			{
				$('#setting_title').after('<div class="setting_msg callout callout-warning" style="display:none;" />');
			}
            
            if ($('#set_val').val().length)
            {
            
                $('.setting_msg')
                .html('<i class="fa fa-refresh fa-spin fa-lg"></i> Processing setting&hellip;')
                .removeClass('callout-success')
                .addClass('callout-warning')
                .removeClass('callout-danger')
                .css({
                    height : 'auto'
                })
                .slideDown();                     
            }
            else
            {
                $("#btnsetting").removeClass('invisible');
                $('.setting_msg')
                    .html('Value is required.')
                    .removeClass('callout-success')
                    .removeClass('callout-warning')
                    .addClass('callout-danger')
                    .css({
                        height : '50px'
                    })
                    .slideDown();

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
				$('.setting_msg').slideUp(function ()
				{
					$(this)
						.html(response.error)
                        .removeClass('callout-success')
                        .removeClass('callout-warning')
                        .addClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
				});
                $("#btnsetting").removeClass('invisible');
			}
			
			else
			{
                html += '<p>Setting information has been successfully updated. <a href="<?php echo WEB; ?>/setting">Back to setting list</a></p>';				
                $("#btnsetting").removeClass('invisible');
                
				$('.setting_msg').slideUp(function ()
				{
					$(this)
						.html(html)
                        .addClass('callout-success')
                        .removeClass('callout-warning')
                        .removeClass('callout-danger')
						.css({
                            height : 'auto'
						})
						.slideDown();
                                       
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
				$('#forgot_title').after('<div class="forgot_msg" style="display:none; margin-top:10px; padding:10px; text-align:center" />');
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
				$('#fpass_title').after('<div class="fpass_msg" style="display:none; padding:10px; margin-top:10px; margin-bottom:10px; text-align:center" />');
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

