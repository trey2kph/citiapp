<?php 
    include("../config.php");
    include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
	$profile_name = $lognick;
	$profile_pic = $logpic;
	$profile_id = $userid;
	$profile_idnum = $logname;
	$profile_email = $email;
	$profile_level = $level;
    $profile_hash = md5('2014'.$profile_idnum);
    $profile_appr = $appr;

    //$logged = 1; 
?>   
// JavaScript Document

function parallax(){
    var scrolled = $(window).scrollTop();
    $('.splashbg').css('top', -(scrolled * 0.2) + 'px');
}

/* GOOGLE LOGIN */

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

/* REGISTRATION */

function datetounix(resdate, seconds) {    
    var sresdate = resdate.split(" ");
    var dresdate = sresdate[0].split("-");    
    var tresdate = sresdate[1].split(":");    
    var hresdate = parseInt(tresdate[0]);    
    if (hresdate == 12) {
        hresdate = 0;
    }
    if (sresdate[2] == 'PM') {        
        hresdate = hresdate + 12;
    }
    var cresdate = dresdate[1] + "/" + dresdate[2] + "/" + dresdate[0] + " " + hresdate + ":" + tresdate[1] + ":00";
    var resunix = new Date(cresdate).getTime();
    
    var newunix = resunix + (seconds * 1000); //3 hours pickdate
    
    return newunix;
}

function unixtodate(newt) {
    var tyear = newt.getFullYear();
    var tmonth = '0' + (parseInt(newt.getMonth()) + 1);
    var tday = '0' + newt.getDate();
    var thour = newt.getHours();
    var tmin = newt.getMinutes();
    var ampm = thour >= 12 ? 'PM' : 'AM';
    thour = thour % 12;
    thour = thour ? thour : 12;
    thour = thour < 10 ? '0' + thour : thour;
    tmin = tmin < 10 ? '0' + tmin : tmin;
    var ttime = thour + ':' + tmin + ' ' + ampm;    
    var newdate = tyear + "-" + tmonth.substr(-2) + "-" + tday.substr(-2) + " " + ttime;
    
    return newdate;
}

function unixtodatemidnight(newt) {
    var tyear = newt.getFullYear();
    var tmonth = '0' + (parseInt(newt.getMonth()) + 1);
    var tday = '0' + newt.getDate();
    var thour = newt.getHours();
    var tmin = newt.getMinutes();
    var ampm = thour >= 12 ? 'PM' : 'AM';
    thour = thour % 12;
    thour = thour ? thour : 12;
    thour = thour < 10 ? '0' + thour : thour;
    tmin = tmin < 10 ? '0' + tmin : tmin;
    var ttime = thour + ':' + tmin + ' ' + ampm;    
    var newdate = tyear + "-" + tmonth.substr(-2) + "-" + tday.substr(-2) + " 11:59 PM";
    
    return newdate;
}

function upperCase(strInput) {
    var theString = strInput.value;
    var strOutput = "";// Our temporary string used to build the function's output
    theString = theString.toUpperCase();  
    strOutput = theString;
    strInput.value = strOutput;
}
    
function updatePos(strInput) {
    theString = strInput.selectedIndex;
    strValue = document.getElementsByTagName("option")[theString].text;
    strOutput = "";
    strValue = strValue.toUpperCase();  
    strOutput = strValue;
    document.getElementById('comp_position').value = strOutput;
}
    
function updatePos2(strInput) {
    var theString = strInput.value;
    var strOutput = "";
    theString = theString.toUpperCase();  
    strOutput = theString;
    document.getElementById('comp_position').value = strOutput;
}
    
function updateHired(strInput) {
    var theString = strInput.value;
    var strOutput = "";
    theString = theString.toUpperCase();  
    strOutput = theString;
    document.getElementById('comp_from').value = strOutput;
}

function positionChk(val) {
    var p = val;
    if (p.options[p.selectedIndex].value == 1000000)
    {
        document.getElementById('divotherpos').style.display = "inline-block";        
    }
    else
    {
        document.getElementById('divotherpos').style.display = "none";        
    }
    return false;
}
    
function checkID(empID) {
    var theID = empID.value;
    $.ajax(
    {
        url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=checkid",
        data: "id=" + theID,
        type: "POST",
        complete: function(){
            $("#loading").hide();
        },
        success: function(data) {
            if (data != 0) { 
                $('#checkIDerr').html("Someone already used this employee ID"); 
            }
            else {
                $('#checkIDerr').html(""); 
            }
        }
    })
}

/* COMMENT */
function chkCommentTxt() {
    if ($('#comment_message').val().length < 2)
    {
        $("#btncreatecomment").addClass("invisible");	
    }
    else
    {
        $("#btncreatecomment").removeClass("invisible");	
    }
}

/* CART */

function cartAction(action, product_id) {
    var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
				queryString = 'action=' + action + '&pid=' + product_id + '&quantity=1';
			break;
			case "remove":
				queryString = 'action=' + action + '&pid=' + product_id;
			break;
			case "empty":
				queryString = 'action=' + action;
			break;
		}	 
	}
	jQuery.ajax({
        url: "cart_action.php",
        data: queryString,
        type: "POST",
        success: function(data){
            $("#cart-item").html(data);
            if(action != "") {
                switch(action) {
                    case "add":
                        $("#add_" + product_code).hide();
                        $("#added_" + product_code).show();
                    break;
                    case "remove":
                        $("#add_" + product_code).show();
                        $("#added_" + product_code).hide();
                    break;
                    case "empty":
                        $(".btnAddAction").show();
                        $(".btnAdded").hide();
                    break;
                }	 
            }
        },
        error: function(){}
	});	
}


$(function() {	
    
    
    if(localStorage.getItem('IAapp_PopUp') != 1) {
        $(".floatdiv").removeClass("invisible");
        $("#fppolicy").removeClass("invisible");            
    } else {
        $(".floatdiv").addClass("invisible");
        $("#fppolicy").addClass("invisible");
    }
    
    $("#btnppagree").on("click", function() {	
        localStorage.setItem('IAapp_PopUp', 1);
        $(".floatdiv").addClass("invisible");
        $("#fppolicy").addClass("invisible");
    });
    
    // PHIL PROVINCE
    $(window).load(function(){    
        var cityvar = new City();
        cityvar.showProvinces('#txtprovince');
        cityvar.showCities('#txtcity');
        
        /* CHECK GOOGLE LOGIN */
    
        var auth2 = gapi.auth2.getAuthInstance();

        if (auth2.isSignedIn.get()) {
            var profile = auth2.currentUser.get().getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());

            //console.log(profile);
        }

        console.log(profile);
    });

    // scrollable
    $(window).scroll(function(){
        parallax();
    });
    
    //MAIN MENU
    
    $('#showmenu').on("click", function() {
        $("#floatdiv2").show("slide");
    });
    
    $('#floatdiv2').on("mouseup", function(e) {
        if(e.target.id != $('#floatmenu').attr('id') && !$('#floatmenu').has(e.target).length)
        {
            $("#floatdiv2").hide("slide");
        }
    });
                                               
    //STAR RATING
                                               
    $('#star-rating').rating(function(vote, event){
        $('#reserve_rating').val(vote);                                 
    });
    
    //FLOAT BUTTON
                                               
    $('#linkreg, #mlinkreg').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").removeClass("invisible");
        $("#fforgot").addClass("invisible");
        $("#forder").addClass("invisible");
        $("#flog").addClass("invisible");
        $("#fcart").addClass("invisible");
        $("#fwish").addClass("invisible");
    });
                                               
    $('#linkforgot, #mlinkforgot').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").removeClass("invisible");
        $("#forder").addClass("invisible");
        $("#flog").addClass("invisible");
        $("#fcart").addClass("invisible");
        $("#fwish").addClass("invisible");
    });
                                               
    $('#linksign, #mlinksign').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").addClass("invisible");
        $("#forder").addClass("invisible");
        $("#flog").removeClass("invisible");
        $("#fcart").addClass("invisible");
        $("#fwish").addClass("invisible");
    });
    
    $('#linkorder, #mlinkorder').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").addClass("invisible");
        <?php if ($logged) : ?>
        $("#forder").removeClass("invisible");
        $("#flog").addClass("invisible");
        <?php else : ?>
        $("#forder").addClass("invisible");
        $("#flog").removeClass("invisible");
        <?php endif; ?>
        $("#fcart").addClass("invisible");
        $("#fwish").addClass("invisible");
    });
    
    $('#linkwish, #mlinkwish').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").addClass("invisible");
        $("#forder").addClass("invisible");
        $("#fcart").addClass("invisible");
        <?php if ($logged) : ?>
        $("#flog").addClass("invisible");
        $("#fwish").removeClass("invisible");
        <?php else : ?>
        $("#flog").removeClass("invisible");
        $("#fwish").addClass("invisible");
        <?php endif; ?>
    });
    
    $('#linkcart, #mlinkcart').on("click", function() {
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").addClass("invisible");
        $("#forder").addClass("invisible");
        $("#flog").addClass("invisible");
        $("#fcart").removeClass("invisible");
        $("#fwish").addClass("invisible");
    }); 
    
    $('#linksignout, #mlinksignout').on("click", function() {
        parent.location='<?php echo WEB; ?>/logout'; return false;
    });
        
    $(".bitem").mouseover(function() {
        $(this).animate({borderColor: "#EA171F"}, 100)
    });
        
    $(".bitem").mouseout(function() {
        $(this).animate({borderColor: "#CCC"}, 100)
    });
        
    $('.bitem').on("click", function() {
        brandid = $(this).attr("attribute");
        
        $.ajax(
	    {
	        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=setbrand",
	        data: "brandid=" + brandid,
	        type: "POST",
	        complete: function(){
	        	$("#loading").hide();
	    	},
	        success: function(data) {
                parent.location='<?php echo WEB; ?>/shop'; return false;
	        }
	    })
        
    });
        
    $('#shopmore').on("click", function() {
        parent.location='<?php echo WEB; ?>/shop'; return false;
    });

    // LATEST CYCLE
    $('#dashlatest').cycle({ 
        fx: 'scrollRight', 
        next: '#right', 
        delay: -4000, 
        easing: 'easeInOutBack' 
    });

	/* MAIN NAVIGATION */
	
	$("#nav1").on("click", function(){ parent.location='http://portal.megaworldcorp.com/papyrus.php'; return false; });
	$("#nav2").on("click", function(){ parent.location='http://portal.megaworldcorp.com/ihelp/'; return false; });
	$("#nav3").on("click", function(){ parent.location='http://portal.megaworldcorp.com/hr/'; return false; });
	$("#nav4").on("click", function(){ parent.location='http://portal.megaworldcorp.com/availability/'; return false; });
	$("#nav5").on("click", function(){ parent.location='http://portal.megaworldcorp.com/#'; return false; });

	$("#nav1").hover(function() {		
		$("#ftab1").hide();
		$("#ntab1").show();
		$("#tabtext1").addClass("lgraytext");	
	},function() {
		$("#ntab1").hide();
		$("#ftab1").show();
		$("#tabtext1").removeClass("lgraytext");	
	});
	
	$("#nav2").hover(function() {		
		$("#ftab2").hide();
		$("#ntab2").show();
		$("#tabtext2").addClass("lgraytext");	
	},function() {
		$("#ntab2").hide();
		$("#ftab2").show();
		$("#tabtext2").removeClass("lgraytext");	
	});
	
	$("#nav3").hover(function() {		
		$("#ftab3").hide();
		$("#ntab3").show();
		$("#tabtext3").addClass("lgraytext");	
	},function() {
		$("#ntab3").hide();
		$("#ftab3").show();
		$("#tabtext3").removeClass("lgraytext");	
	});
	
	$("#nav4").hover(function() {		
		$("#ftab4").hide();
		$("#ntab4").show();
		$("#tabtext4").addClass("lgraytext");	
	},function() {
		$("#ntab4").hide();
		$("#ftab4").show();
		$("#tabtext4").removeClass("lgraytext");	
	});
	
	$("#nav5").hover(function() {		
		$("#ftab5").hide();
		$("#ntab5").show();
		$("#tabtext5").addClass("lgraytext");	
	},function() {
		$("#ntab5").hide();
		$("#ftab5").show();
		$("#tabtext5").removeClass("lgraytext");	
	});

    /* FLOAT DIV CONTROL */ 

    /* Birthday */
    $(".btnbday").on("click", function() {		
		$(".mfloatdiv").removeClass("invisible");
		$("#bdayview").removeClass("invisible");

        empid = $(this).attr('attribute');

		$.ajax(
	    {
	        url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=bday",
	        data: "empid=" + empid,
	        type: "POST",
	        complete: function(){
	        	$("#loading").hide();
	    	},
	        success: function(data) {
	            var obj = $.parseJSON(data);
                $("#bday_subject").html(obj.bday_subject);                
                $("#bday_full").html(obj.bday_empname);    
                $("#bday_email").val(obj.bday_email);    
                $("#bday_tonickname").val(obj.bday_empnick);    
	        }
	    })

	    return false;
    });

    /* Comment */
    $(".commentdiv").on("mouseover", function() {	
        thisid = $(this).attr('attribute');
		$("#comtrash" + thisid).removeClass("invisible");
	});
    
    $(".commentdiv").on("mouseout", function() {	
		$("#comtrash" + thisid).addClass("invisible");
	});

    $(".btndelcomment").on("click", function() {		

        var r = confirm("Are you sure you want to remove this comment?");
        commentid = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/shout_request.php?sec=delete",
		        data: "shoutid=" + commentid,
		        type: "POST"
		    })
            
			$.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/shout_request.php?sec=comment",
                data: "shoutid=" + shoutid,
                type: "POST",
                success: function(data) {                        
                    $("#commentlist").html(data);
                }
            });    

		    return false;
		}

	});
        
    /* Email Newsletter */
        
    $("#txtemail").on("keypress", function(e) {
        if (e.keyCode == 13) {
            
            nlemail = $(this).val();
            
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=chkemail",
                data: "email=" + nlemail,
                type: "POST",
                success: function(data) {
                    if (data == '1') {
                        alert("Email address already exist");
                    } else {
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=subscribe",
                            data: "email=" + nlemail,
                            type: "POST",
                            success: function(data) {
                                alert("Your email address has been added to our database. You'll received a confirmation email for your email address activation");
                            }
                        });    
                    }
                }
            });    

		    return false;
            
        }
    });
        
    /* Order */
        
    $(".btncheckout").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/checkout';

	});
    
    $("#btnorderlink").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/order';

	});
    
    $(".btnvieworder").on("click", function() {	
        oid = $(this).attr('attribute');
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=orderdetail",
            data: "id=" + oid,
            type: "POST",
            success: function(data) {                        
                $("#divodetail").html(data);
            }
        });   

	});
        
    /* AJAX Pagination */
        
    $(".ajaxpage").on("click", function() {
        page = $(this).attr('attribute');
        target = $(this).attr('attribute2');
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=ajaxpage",
            data: "target=" + target + "&page=" + page,
            type: "POST",
            success: function(data) {                        
                $("#div" + target).html(data);
            }
        });   
        
    });
    
    /* Product */
    
    $(".btnview").on("click", function() {	
        
        id = $(this).attr('attribute');
        slug = $(this).attr('attribute2');

        window.location.href='<?php echo WEB; ?>/shop/' + id + '/' + slug;

	});
    
    $("#btnback").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/shop';

	});
        
    $(".btnwishtocart").on("click", function() {	
        
        var uid = $("#txtprofileid").val(); 

        var r = confirm("Are you sure you want to add this to cart");
        if (r == true)
        {
            
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=getwish",
                data: "uid=" + uid,
                type: "POST",
                success: function(data) {
                    
                    var w_array = data.split(',');

                    for(var i = 0; i < w_array.length; i++) {
                        w_array[i] = w_array[i].replace(/^\s*/, "").replace(/\s*$/, "");
            
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=addcart",
                            data: "prod=" + w_array[i] + "&quantity=1",
                            type: "POST",
                            success: function(data) {   
                                $("#btnbuy" + w_array[i]).removeAttr("disabled");
                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                                    type: "POST",
                                    success: function(data) {  
                                        $("#cartcount").html(data);
                                    }
                                })
                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                                    type: "POST",
                                    success: function(data) {  
                                        $("#cartdata").html(data);
                                    }
                                });    
                            }
                        }); 
                    }
                            
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=clearwish",
                        data: "uid=" + uid,
                        type: "POST",
                        success: function(data) {
                            alert('Wishlist has been successfully added to cart');    
                            
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishcount").html(data);
                                }
                            })
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishdata").html(data);
                                }
                            });    
                        }
                    });
                }
            });
            
        }

    });
        
    $(".btnwishlist").on("click", function() {
        <?php if ($logged) : ?>
        var product_id = $(this).attr('attribute');
        var profile_id = $("#txtprofileid").val();
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=chkwishlist",
            data: "prod=" + product_id,
            type: "POST",
            success: function(data) {                        
                if (data == 0) {
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                        data: "flag=0&prod=" + product_id + "&prof=" + profile_id,
                        type: "POST",
                        success: function(data) {   
                            alert('This product has been added to your wishlist');                            
                            $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Remove to Wishlist');
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishcount").html(data);
                                }
                            })
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishdata").html(data);
                                }
                            });    
                        }
                    }); 
                } else {
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=actwishlist",
                        data: "flag=" + data,
                        type: "POST",
                        success: function(data) {  
                            alert('This product has been removed to your wishlist');
                            $("#btnwishlist" + product_id).html('<i class="fa fa-gift"></i> Add to Wishlist');
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistcount",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishcount").html(data);
                                }
                            })
                            $.ajax(
                            {
                                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=wishlistdata",
                                type: "POST",
                                success: function(data) {  
                                    $("#wishdata").html(data);
                                }
                            });    
                        }
                    });           
                }
            }
        });  
        <?php else : ?>
        $("#floatdiv").removeClass("invisible");
        $("#freg").addClass("invisible");
        $("#fforgot").addClass("invisible");
        $("#forder").addClass("invisible");
        $("#fcart").addClass("invisible");
        $("#flog").removeClass("invisible");
        $("#fwish").addClass("invisible");
        <?php endif; ?>
    });
        
    
        
    $(".btnbuy").on("click", function() {
        var product_id = $(this).attr('attribute');
        var qty = $("#buyqty" + product_id).val();
        $("#btnbuy" + product_id).attr("disabled", "disabled");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=addcart",
            data: "prod=" + product_id + "&quantity=" + qty,
            type: "POST",
            success: function(data) {   
                alert('This product has been added to your cart');                            
                $("#btnbuy" + product_id).removeAttr("disabled");
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                    type: "POST",
                    success: function(data) {  
                        $("#cartcount").html(data);
                    }
                })
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                    type: "POST",
                    success: function(data) {  
                        $("#cartdata").html(data);
                    }
                });    
            }
        }); 
    });
        
    $(".btndelbuy").on("click", function() {
        var product_id = $(this).attr('attribute'); 
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=removecart",
            data: "prod=" + product_id + "&quantity=1",
            type: "POST",
            success: function(data) {   
                alert('The product has been removed to your cart'); 
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                    type: "POST",
                    success: function(data) {  
                        $("#cartcount").html(data);
                    }
                })
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                    type: "POST",
                    success: function(data) {  
                        $("#cartdata").html(data);
                    }
                });    
            }
        }); 
    });
        
    $(".btnclearcart").on("click", function() {
        
        var r = confirm("Are you sure you want to clear the cart");
        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=clearcart",
                type: "POST",
                success: function(data) {         
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=countcart",
                        type: "POST",
                        success: function(data) {  
                            $("#cartcount").html(data);
                        }
                    })
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/cart_request.php?sec=displaycart",
                        type: "POST",
                        success: function(data) {  
                            $("#cartdata").html(data);
                        }
                    });    
                }
            })

            return false;
        }
        
        
    });
        
    $("#txtcoptype").change("click", function() {		

        coptype = $(this).val();	
        
        if (coptype == 1) {
            $("#recdiv").html("Who will pick-up the order?");
        } else {
            $("#recdiv").html("Who will receive the order?");
        }

        return false;
    });
    
    $("#txtsearch").on("keypress", function(e) {
        if (e.keyCode == 13) {
            
            if ($(this).val().trim().length) {
		    
                if ($("#subcat99999").length) {
                    var catid = $("#subcat99999").attr('attribute2');    
                } else {
                    var catid = 99999;
                }

                var brandid = new Array();  
                var subcatid = new Array();  
                var priceval = new Array();  

                var sprod = $(this).val().trim();

                $('input[name^="brand"]').each(function(){                    
                    var checked = $(this).is(':checked');

                    if (checked) {
                        brandid.push($(this).val());                    
                    }
                });

                $('input[name^="subcat"]').each(function(){                    
                    var checked = $(this).is(':checked');

                    if (checked) {
                        subcatid.push($(this).val());                    
                    }
                });

                $('input[name^="price"]').each(function(){                    
                    priceval.push($(this).val());                    
                });

                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                    data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                    type: "POST",
                    success: function(data) {                        
                        $("#proddata").html(data);
                    }
                });  
            } else {
                return false;
            }
            
        }
	});
    
    $("#btnsearch").on("click", function() {
            
        if ($("#txtsearch").val().trim().length) {

            if ($("#subcat99999").length) {
                var catid = $("#subcat99999").attr('attribute2');    
            } else {
                var catid = 99999;
            }

            var brandid = new Array();  
            var subcatid = new Array();  
            var priceval = new Array();  

            var sprod = $("#txtsearch").val().trim();

            $('input[name^="brand"]').each(function(){                    
                var checked = $(this).is(':checked');

                if (checked) {
                    brandid.push($(this).val());                    
                }
            });

            $('input[name^="subcat"]').each(function(){                    
                var checked = $(this).is(':checked');

                if (checked) {
                    subcatid.push($(this).val());                    
                }
            });

            $('input[name^="price"]').each(function(){                    
                priceval.push($(this).val());                    
            });

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                type: "POST",
                success: function(data) {                        
                    $("#proddata").html(data);
                }
            });  
        } else {
            return false;
        }
	});
    
    $("#sstore").on("keypress", function(e) {
        if (e.keyCode == 13) {
            
            sstore = $("#sstore").val();
            window.location.href='<?php echo WEB; ?>/locator/' + sstore.toLowerCase() + '#mapanchor';
            
        }
	});
        
    $("#sstore").on("search", function () {
        window.location.href='<?php echo WEB; ?>/locator/#mapanchor';
    });
    
    $("#btndelsprod").on("click", function() {

        if ($("#subcat99999").length) {
            var catid = $("#subcat99999").attr('attribute2');    
        } else {
            var catid = 99999;
        }

        var brandid = new Array();  
        var subcatid = new Array();  
        var priceval = new Array();  

        var sprod = "";

        $('input[name^="brand"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                brandid.push($(this).val());                    
            }
        });

        $('input[name^="subcat"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                subcatid.push($(this).val());                    
            }
        });

        $('input[name^="price"]').each(function(){                    
            priceval.push($(this).val());                    
        });
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=clearprod",
            type: "POST",
            success: function(data) { 
                $("#txtsearch").val("");
                $("#proddata").html(data);
            }
        });  

       
	});
    
    $(".showcat").on("click", function() {
        autoHeight = $(".fbcat").css('height', 'auto').height();
        $(".fbcat").animate({height: autoHeight}, 200);
        $(".footcat").fadeOut("fast");
        //$(this).html('Show Less');
    });
                         
    /*, function() {
        $(".fbcat").animate({height: 195}, 200);
        $(this).html('Show More');
	});*/
    
    $(".showbrand").on("click", function() {
        autoHeight = $(".fbbrand").css('height', 'auto').height();
        $(".fbbrand").animate({height: autoHeight}, 200);
        $(".footbrand").fadeOut("fast");
        //$(this).html('Show Less');
    });
                       
    /*, function() {
        $(".fbbrand").animate({height: 195}, 200);
        $(this).html('Show More');
	});*/
    
    $(".catopt").on("click", function() {	
                     
        $(".fbcat").fadeOut("fast");
        $(".footcat").fadeOut("fast");
        var catid = $(this).attr('attribute');
        var catname = $(this).attr('attribute2');
        var brandid = new Array(); 
        var priceval = new Array();   

        var sprod = "";
        
        $('input[name^="brand"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                brandid.push($(this).val());                    
            }
        });
        
        $('input[name^="price"]').each(function(){                    
            priceval.push($(this).val());                    
        });

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcatsel",
            data: "catid=" + catid + "&catname=" + catname,
            type: "POST",
            success: function(data) {                        
                $(".fbcat").html(data);
                $(".fbcat").fadeIn("fast");
            }
        });  

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcatcount",
            data: "catid=" + catid,
            type: "POST",
            success: function(data) {    
                if (data > 6) {
                    $(".fbcat").animate({height: 195}, 200);
                    $(".showcat").html('Show More');
                    $(".footcat").fadeIn("fast");
                } 
            }
        });     
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
            data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&sprice=" + priceval,
            type: "POST",
            success: function(data) {                        
                $("#proddata").html(data);
            }
        });  
    });
    
    $(".subcatopt").on("click", function() {
        var catid = $(this).attr('attribute2');
        var subcathome = $(this).attr('attribute');
        var brandid = new Array();  
        var subcatid = new Array();  
        var priceval = new Array();   

        var sprod = ""; 

        if (subcathome == 99999) {
            catid = 99999;
            subcatid = 99999;
            
            $('input[name^="brand"]').each(function(){                    
                var checked = $(this).is(':checked');

                if (checked) {
                    brandid.push($(this).val());                    
                }
            });
        
            $('input[name^="price"]').each(function(){                    
                priceval.push($(this).val());                    
            });
            
            $(".footcat").fadeOut("fast");
            $(".fbcat").fadeOut("fast");	
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=catsel",
                type: "POST",
                success: function(data) {                        
                    $(".fbcat").html(data);
                    $(".fbcat").fadeIn("fast");
                }
            });   

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=catcount",
                type: "POST",
                success: function(data) {    
                    if (data > 7) {
                        $(".fbcat").animate({height: 195}, 200);
                        $(".showcat").html('Show More');
                        $(".footcat").fadeIn("fast");
                    } 
                }
            });   
            
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                type: "POST",
                success: function(data) {                        
                    $("#proddata").html(data);
                }
            });  
        } else {
            
            $('input[name^="brand"]').each(function(){                    
                var checked = $(this).is(':checked');

                if (checked) {
                    brandid.push($(this).val());                    
                }
            });
            
            $('input[name^="subcat"]').each(function(){                    
                var checked = $(this).is(':checked');

                if (checked) {
                    subcatid.push($(this).val());                    
                }
            });
        
            $('input[name^="price"]').each(function(){                    
                priceval.push($(this).val());                    
            });
        
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
                type: "POST",
                success: function(data) {                        
                    $("#proddata").html(data);
                }
            });  
        }
    });
    
    $(".brandopt").on("click", function() {
        
        if ($("#subcat99999").length) {
            var catid = $("#subcat99999").attr('attribute2');    
        } else {
            var catid = 99999;
        }
        
        var brandid = new Array();  
        var subcatid = new Array();  
        var priceval = new Array();    

        var sprod = "";
            
        $('input[name^="brand"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                brandid.push($(this).val());                    
            }
        });

        $('input[name^="subcat"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                subcatid.push($(this).val());                    
            }
        });
        
        $('input[name^="price"]').each(function(){                    
            priceval.push($(this).val());                    
        });

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
            data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
            type: "POST",
            success: function(data) {                        
                $("#proddata").html(data);
            }
        });  
    });
    
    $("#btnprange").on("click", function() {
        
        if ($("#subcat99999").length) {
            var catid = $("#subcat99999").attr('attribute2');    
        } else {
            var catid = 99999;
        }
        
        var brandid = new Array();  
        var subcatid = new Array();  
        var priceval = new Array();   

        var sprod = ""; 
            
        $('input[name^="brand"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                brandid.push($(this).val());                    
            }
        });

        $('input[name^="subcat"]').each(function(){                    
            var checked = $(this).is(':checked');

            if (checked) {
                subcatid.push($(this).val());                    
            }
        });
        
        $('input[name^="price"]').each(function(){                    
            priceval.push($(this).val());                    
        });

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
            data: "sprod=" + sprod + "&sbrand=" + brandid + "&scat=" + catid + "&ssubcat=" + subcatid + "&sprice=" + priceval,
            type: "POST",
            success: function(data) {                        
                $("#proddata").html(data);
            }
        });  
    });
    
    /* Promo */
    
    $(".btnpview").on("click", function() {	
        
        id = $(this).attr('attribute');
        slug = $(this).attr('attribute2');

        window.location.href='<?php echo WEB; ?>/whatsnew/' + id + '/' + slug;

	});
    
    $("#btnpback").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/whatsnew';

	});
    
    $("#txtpsearch").on("keypress", function(e) {
        if (e.keyCode == 13) {
            
            if ($(this).val().trim().length) {

                var sprom = $(this).val().trim();

                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/promo_request.php?sec=table",
                    data: "sprom=" + sprom,
                    type: "POST",
                    success: function(data) {                        
                        $("#promdata").html(data);
                    }
                });  
            } else {
                return false;
            }
            
        }
	});
    
    $("#btnpsearch").on("click", function() {
            
        if ($("#txtpsearch").val().trim().length) {
            
            var sprom = $("#txtpsearch").val().trim();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/promo_request.php?sec=table",
                data: "sprom=" + sprom,
                type: "POST",
                success: function(data) {                        
                    $("#promdata").html(data);
                }
            });  
        } else {
            return false;
        }
	});
        
    /* Store */
        
    $("#btnlistview").on("click", function() {
        
        $(this).addClass('invisible');
        $("#btnmapview").removeClass('invisible');
        $(".amap").addClass('invisible');
        $(".alist").removeClass('invisible');
        localStorage.setItem('Imp_MapView', 0)
        
	});
        
    $("#btnmapview").on("click", function() {
        
        $(this).addClass('invisible');
        $("#btnlistview").removeClass('invisible');
        $(".alist").addClass('invisible');
        $(".amap").removeClass('invisible');
        localStorage.setItem('Imp_MapView', 1)
        
	});
        
    /* Career */
    
    $(".btnjview").on("click", function() {	
        
        id = $(this).attr('attribute');
        slug = $(this).attr('attribute2');

        window.location.href='<?php echo WEB; ?>/career/' + id + '/' + slug;

	});
    
    $("#btnjback").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/career';
        return false;

	});
    
    /* User Management */
    
    $(".approveUser").live("click", function() {		

        userid = $(this).attr('attribute');	
        userstatus = $(this).attr('attribute2');		
        $(".ustatusDiv" + userid).html('<i class="fa fa-refresh fa-spin"></i>');

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=approveuser",
            data: "userid=" + userid + "&user_status=" + userstatus,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $(".ustatusDiv" + userid).html(data);
            }
        })

        return false;
    });
    
    $("#user_level").change("click", function() {		

        userlevel = $(this).val();	
        
        if (userlevel == 1) {
            $("#tdapp").removeClass("invisible");
            
        } else {
            $("#tdapp").addClass("invisible");
            $("#user_approver").val(0);
        }

        return false;
    });
    
    $("#user_dept").change("click", function() {		

        userdept = $(this).val();	
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=dropdown_approver",
            data: "dept=" + userdept,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#user_approver").html(data);
            }
        })

        return false;
    });
    
    $(".btnsendpassword").on("click", function() {		

        userid = $(this).attr('attribute');
        useremail = $(this).attr('attribute2');

        var r = confirm("Are you sure you want to send his/her password to " + useremail);
        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=send_password",
                data: "userid=" + userid,
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    alert("His/her password has been successfully to " + useremail);
                }
            })

            return false;
        }

    });
    
    $(".btnsendpasswordtoall").on("click", function() {		

        var r = confirm("Are you sure you want to send password to all");
        if (r == true)
        {
            
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=allsend_password",
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    alert("Password has been successfully to all");
                }
            })

            return false;
        }

    });
    
    $(".btnedituser").on("click", function() {
        
        $("#etitle").html("Edit");    
        $("#floatdiv").removeClass("invisible");
        $("#fedit").removeClass("invisible");
        $(".vuser_msg").css("display", "none");
        $(".btnsave").removeClass('invisible');

        uid = $(this).attr('attribute');

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=edit",
            data: "uid=" + uid,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                var obj = $.parseJSON(data);

                $("#user_empnum").val(obj.user_empnum);                    
                $("#user_fullname").val(obj.user_fullname);                  
                $("#user_level").val(obj.user_level);                  
                $("#user_dept").val(obj.user_dept);                  
                $("#user_telno").val(obj.user_telno);                  
                $("#user_email").val(obj.user_email);                  
                $("#user_id").val(obj.user_id);
                
                if (obj.user_level == 1) {
                    $("#tdapp").removeClass('invisible');                  
                } else {
                    $("#tdapp").addClass('invisible');                  
                }

                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=dropdown_approver",
                    data: "dept=" + obj.user_dept,
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        $("#user_approver").html(data);   
                        
                        $.ajax(
                        {

                            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=edit",
                            data: "uid=" + obj.user_id,
                            type: "POST",
                            complete: function(){
                                $("#loading").hide();
                            },
                            success: function(data) {    
                                var obj = $.parseJSON(data);                        
                                $("#user_approver").val(obj.user_approver);                  
                            }
                        })
                    }
                })
            }
        })

        return false;
    });

    $(".btndeluser").on("click", function() {

        var r = confirm("Are you sure you want to delete this user?");
        uid = $(this).attr('attribute');
        pagenum = $("#upage").val();				

        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=delete",
                data: "uid=" + uid,
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table&page=" + pagenum,
                        success: function(data) {                        
                            $("#user_table").html(data);
                        }
                    });
                }
            })

            return false;
        }
    });
    
    $("#searchusr").on("keypress", function(e) {	
        if (e.keyCode == 13) {
            searchusr = $("#searchusr").val();
            if (searchusr.trim() != "") {
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table",
                    data: "searchusr=" + searchusr,
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        $("#btnusrall").removeClass("invisible");
                        $("#user_table").html(data);

                    }
                })
            }
        }
    });
    
    $("#btnsearchusr").on("click", function() {
        searchusr = $("#searchusr").val();
        if (searchusr.trim() != "") {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table",
                data: "searchusr=" + searchusr,
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    $("#btnusrall").removeClass("invisible");
                    $("#user_table").html(data);

                }
            })
        }
    });
    
    $("#btnusrall").on("click", function() {	
        
        usrpage = 1;
        $(this).addClass("invisible");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table",
            data: "clear_search=1",
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#searchusr").val("");
                $("#btnusrall").addClass("invisible");
                $("#user_table").html(data);  
            }
        })
    });
    
    /* Department Management */
    
    $(".btneditdept").on("click", function() {
        
        $("#etitle").html("Edit");    
        $("#floatdiv").removeClass("invisible");
        $("#fedit").removeClass("invisible");
        $(".vdept_msg").css("display", "none");
        $(".btnsave").removeClass('invisible');

        did = $(this).attr('attribute');

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=edit",
            data: "did=" + did,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                var obj = $.parseJSON(data);                
                
                $("#dept_name").val(obj.dept_name);                  
                $("#dept_abbr").val(obj.dept_abbr);                                  
                $("#dept_id").val(obj.dept_id);                    
            }
        })

        return false;
    });

    $(".btndeldept").on("click", function() {

        var r = confirm("Are you sure you want to delete this department?");
        did = $(this).attr('attribute');
        pagenum = $("#dpage").val();				

        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=delete",
                data: "did=" + did,
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=table&page=" + pagenum,
                        success: function(data) {                        
                            $("#dept_table").html(data);
                        }
                    });
                }
            })

            return false;
        }
    });
    
    $("#searchdept").on("keypress", function(e) {	
        if (e.keyCode == 13) {
            searchdept = $("#searchdept").val();
            if (searchdept.trim() != "") {
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=table",
                    data: "searchdept=" + searchdept,
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        $("#btndeptall").removeClass("invisible");
                        $("#dept_table").html(data);

                    }
                })
            }
        }
    });
    
    $("#btnsearchdept").on("click", function() {
        searchdept = $("#searchdept").val();
        if (searchdept.trim() != "") {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=table",
                data: "searchdept=" + searchdept,
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    $("#btndeptall").removeClass("invisible");
                    $("#dept_table").html(data);

                }
            })
        }
    });
    
    $("#btndeptall").on("click", function() {	
        
        deptpage = 1;
        $(this).addClass("invisible");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/dept_request.php?sec=table",
            data: "clear_search=1",
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#searchdept").val("");
                $("#btndeptall").addClass("invisible");
                $("#dept_table").html(data);  
            }
        })
    });

    $(".closebutton").on("click", function() {	
		$(".floatdiv").addClass("invisible");
		$("#fview").addClass("invisible");
        $("#fview3").addClass("invisible");
		$("#fadd").addClass("invisible");
		$("#fedit").addClass("invisible");
		$("#bdayview").addClass("invisible");
	});

    $(".closebutton2").on("click", function() {	
		$(".floatdiv").addClass("invisible");
		$("#fview").addClass("invisible");
        $("#fview3").addClass("invisible");
		$("#fadd").addClass("invisible");
		$("#fedit").addClass("invisible");
		$("#bdayview").addClass("invisible");
	});

    $(".mclosebutton").on("click", function() {	
		$(".mfloatdiv").addClass("invisible");
		$("#mfview").addClass("invisible");
        $("#fview3").addClass("invisible");
		$("#fadd").addClass("invisible");
		$("#fedit").addClass("invisible");
		$("#bdayview").addClass("invisible");
	});

    /* CLEAR SEARCH */

    $(".btnsearchallsht").on("click", function() {	
        $.ajax(
	    {
	        url: "<?php echo WEB; ?>/lib/requests/shout_request.php?sec=clear_search",
	        type: "POST",
	        complete: function(){
	        	$("#loading").hide();
	    	},
	        success: function(data) {
	            window.location.href='<?php echo WEB; ?>/shoutbox';
	        }
	    })        
    });

    /* REGISTRATION */

    $(".iamhead").change(function() {	
        if ($("#iamhead").is(':checked')) {
            userlevel = 1; 
        } else {
            userlevel = 0; 
        }
        userdept = $("#department option:selected").val();
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=approvesel",
            data: "userlevel=" + userlevel + "&userdept=" + userdept,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#ihead").html(data);
            }
        })
    });

    $("#division").change(function() {	
        divid = $("#division option:selected").val();
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=deptsel",
            data: "divid=" + divid,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#department").html(data);

            }
        })
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=dgrpsel",
            data: "divid=" + divid,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#dgroup").html(data);

            }
        })
    });

    $("#department").change(function() {	
        if ($("#iamhead").is(':checked')) {
            userlevel = 1; 
        } else {
            userlevel = 0; 
        }
        deptid = $("#department option:selected").val();
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=approvesel",
            data: "userlevel=" + userlevel + "&userdept=" + deptid,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#ihead").html(data);
            }
        })
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/reg_request.php?sec=secsel",
            data: "deptid=" + deptid,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#dsection").html(data);
            }
        });
    });
    
    /* FLIP */
    $(".fitem, .aitem, .pitem, .jitem").flip({
        axis: 'y',
        trigger: 'hover',
        speed: 200
    });

    /* DATE/TIME PICKER */

    // report from
    $(".repdatein").datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate: "2014-01-01",
        maxDate: "0D",
        changeMonth: true,
        numberOfMonths: 2,
        onSelect: function (dateText, inst) {
            $('#btnlink').attr('href', "<?php echo WEB; ?>/report_summary/" + $(".repdatein").val() + "/" + $(".repdateout").val());
            $('#btnlink2').attr('href', "<?php echo WEB; ?>/report_trans/" + $(".repdatein").val() + "/" + $(".repdateout").val());
        },
        onClose: function(selectedDate) {
            $(".repdateout").datepicker("option", "minDate", selectedDate);
        }
    });

    // report to
    $(".repdateout").datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate: "2014-01-01",
        maxDate: "0D",
        changeMonth: true,
        numberOfMonths: 2,
        onSelect: function (dateText, inst) {
            $('#btnlink').attr('href', "<?php echo WEB; ?>/report_summary/" + $(".repdatein").val() + "/" + $(".repdateout").val());
            $('#btnlink2').attr('href', "<?php echo WEB; ?>/report_trans/" + $(".repdatein").val() + "/" + $(".repdateout").val());
        },
        onClose: function(selectedDate) {
            $(".repdatein").datepicker("option", "maxDate", selectedDate);

        }
    });

    $(".datepick").datepicker({ 
        dateFormat: 'yy-mm-dd',
        yearRange: "-80:-18",
        changeMonth: true,
        changeYear: true
    });  

    $(".datepickchild").datepicker({ 
        dateFormat: 'yy-mm-dd',
        yearRange: "-80:+1",
        changeMonth: true,
        changeYear: true
    });  
    
    $(".datepickreg").datepicker({ 
        dateFormat: 'yy-mm-dd',
        yearRange: "-6:+6",
        changeMonth: true,
        changeYear: true
    });  

    $(".datepick2").datepicker({ 
        dateFormat: 'yy-mm-dd',
        maxDate: "0D",
        changeMonth: true,
        changeYear: true
    });
    
    $(".datepick3").datepicker({ 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });  
    
    $('.datetimepick').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: "hh:mmtt",
        minDate: '<?php echo date("Y-m-d"); ?>',
        maxDate: '<?php echo date("Y-m-d", strtotime("+1 day")); ?>'
    });
    
    $('.datetimepick2').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: "hh:mmtt",
        minDate: '<?php echo date("Y-m-d"); ?>',
        maxDate: '<?php echo date("Y-m-d", strtotime("+2 day")); ?>'
    });
    
    $('.datetimepickfree').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: "hh:mmtt",
        minDate: '<?php echo date("Y-m-d", strtotime("-1 year")); ?>',
        maxDate: '<?php echo date("Y-m-d", strtotime("+1 year")); ?>'
    });
    
    $('.datetimepickmonth').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: "-1M",
        maxDate: "1M",
        changeMonth: true,
        changeYear: false
    });

    $(".checkindate").datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate: "-3M",
        maxDate: "12M",
        changeMonth: true
    });

    $('.timein').timepicker({ 
        timeFormat: 'h:mmtt',
        stepHour: 1,
        stepMinute: 30,
        hourMin: 6,
	    hourMax: 22
    });
    
    $("#dtBox2").DateTimePicker({
        defaultDate: new Date(),
        dateFormat: 'yyyy-MM-dd',
        buttonsToDisplay: ["SetButton"],        
        titleContentDate: ''
    });

    /* RESIZE CROP */

    $('.spromosqr').resizecrop({
        width: 200,
        height: 150,
        vertical: "top"
    });   

    $('.lpromosqr').resizecrop({
        width: 1100,
        height: 271,
        vertical: "top"
    });   

    $('.imgsqr').resizecrop({
        width: 100,
        height: 100,
        vertical: "top"
    });   

    $('.picsqr,.dimsqr').resizecrop({
        width: 100,
        height: 100,
        vertical: "top"
    });   

    $('.brandlogo').resizecrop({
        width: 100,
        height: 25,
        vertical: "top"
    }); 

    $('.picsqr2').resizecrop({
        width: 100,
        height: 100,
        vertical: "top"
    });   

    $('.profile_pic').resizecrop({
        width: 100,
        height: 100,
        vertical: "center"
    }); 

    $('.album_thumb').resizecrop({
        width: 194,
        height: 150,
        vertical: "center"
    });   

    $('.picture_thumb').resizecrop({
        width: 194,
        height: 150,
        vertical: "center"
    }); 

    $('.smallimg').resizecrop({
        width: 30,
        height: 30,
        vertical: "center"
    });  

    $(".shakelog").on("click", function() {	
        $("html, body").animate({ scrollTop: 0 }, 100);
        $('#errortd').html('<span class="redtext mediumtext2 bold">Please log-in</span>'); 
        $('.loginheader').effect('bounce', {times: 3, distance: 10}, 420); 
		return false;
    });

    /*$("#username").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            e.keyCode = newKey;
            e.charCode = newKey;
        }
    
        $("#username").val(($("#username").val()).toUpperCase());
    });*/

	$("#username").on("keypress", function(e) {
        if (e.keyCode == 13) {
            username = $("#username").val();
			password = $("#password").val();
		    $.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/login.php",
	            data: "username=" + username + "&password=" + password,
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
		        	if (data == 0) { 
		        		$('#errortd').html('<span class="redtext mediumtext2 bold">Access denied</span>'); 
		        		$('#frmlogin').effect('shake', {times: 3, distance: 10}, 420); 
		        	}
		        	else { 
		        		window.location.href='<?php echo WEB; ?>';
		        	}
		        }
		    })
        }
	});

	$("#password").on("keypress", function(e) {
        if (e.keyCode == 13) {
            username = $("#username").val();
            //username = username.toUpperCase();
			password = $("#password").val();
		    $.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/login.php",
	            data: "username=" + username + "&password=" + password,
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
		        	if (data == 0) { 
		        		$('#errortd').html('<span class="redtext mediumtext2 bold">Access denied</span>'); 
		        		$('#frmlogin').effect('shake', {times: 3, distance: 10}, 420); 
		        	}
		        	else { 
		        		window.location.href='<?php echo WEB; ?>';
		        	}
		        }
		    })
        }
	});

	$("#btnlogin").on("click", function() {	
		username = $("#username").val();
		password = $("#password").val();
	    $.ajax(
	    {
	        url: "<?php echo WEB; ?>/lib/requests/login.php",
            data: "username=" + username + "&password=" + password,
            type: "POST",
	        complete: function(){
	        	$("#loading").hide();
	    	},
	        success: function(data) {
	        	if (data == 0) { 
	        		$('#errortd').html('<span class="redtext mediumtext2 bold">Access denied</span>');
		            $('#frmlogin').effect('shake', {times: 3, distance: 10}, 420); 
	        	}
	        	else {                     
	        		window.location.href='<?php echo WEB; ?>';
	        	}
	        }
	    })
	});

});


  $(window).load(function() {
      $('#slider').nivoSlider({
        effect:'random',
        slices:27,
        animSpeed:500, //Slide transition speed
        pauseTime:10000,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:false, //Next & Prev
        directionNavHide:false, //Only show on hover
        controlNav:false, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, //Use image rel for thumbs
        keyboardNav:false, //Use left & right arrows
        pauseOnHover:false, //Stop animation while hovering
        manualAdvance:false, //Force manual transitions
        captionOpacity:0.8, //Universal caption opacity
   	 });
    });