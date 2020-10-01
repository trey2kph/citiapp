<?php include("../config.php"); ?>   
// JavaScript Document

function parallax(){
    var scrolled = $(window).scrollTop();
    $('.splashbg').css('top', -(scrolled * 0.2) + 'px');
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
/*    
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
*/

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


$(function() {	

    // scrollable
    $(window).scroll(function(){
        parallax();
    });
    
    //MAIN MENU
    
    $('#showmenu').on("click", function() {
        $("#floatdiv2").show("slide");
    });
    
    $('#showmenumob').on("click", function() {
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
    
    $('#reservenow').on("click", function() {
        var appr = $("#txtappr").val();
        
        if (appr == 0) {
            alert("You have no approver has been set to your account please call Corporate Administration.");
        } else {        
            $(this).removeClass("floatbtnanimation");
            $("#floatdiv").removeClass("invisible");
            $("#freserve").removeClass("invisible");

            $('.addform').trigger("reset");

            $(".vreserve_msg").css("display", "none");

            $("#fapp").addClass("invisible");
            $("#fview").addClass("invisible");
            $("#fview3").addClass("invisible");
            $("#fedit").addClass("invisible");
        }
    });
                                               
    $('#cannounce').on("click", function() {
                                               
        $("#floatdiv").removeClass("invisible");
        $("#freserve").addClass("invisible");

        $("#fapp").addClass("invisible");
        $("#fview").addClass("invisible");
        $("#fview3").removeClass("invisible");
        $("#fedit").addClass("invisible");
    });
    
    $('#addnow').on("click", function() {
        $("#etitle").html("Add");    
        
        $('.addform').trigger("reset");
        $('#btnsavefleet').removeClass("invisible");
        $('#btndriversave').removeClass("invisible");
        $('#btnusersave').removeClass("invisible");
        $('#btndeptsave').removeClass("invisible");
        
        $(".vfleet_msg").css("display", "none");
        $(".vdriver_msg").css("display", "none");
        $(".vuser_msg").css("display", "none");
        $(".vdept_msg").css("display", "none");
        $("#floatdiv").removeClass("invisible");
        $("#fedit").removeClass("invisible");
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
    /*
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
    });*/

    /* Comment */
    $(".commentdiv").on("mouseover", function() {	
        thisid = $(this).attr('attribute');
		$("#comtrash" + thisid).removeClass("invisible");
	});
    
    $(".commentdiv").on("mouseout", function() {	
		$("#comtrash" + thisid).addClass("invisible");
	});
    /*
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

	});*/
    
    /* Product */
    
    $(".btnview").on("click", function() {		

        window.location.href='<?php echo WEB; ?>/product';

	});
    
    $("#btnback").on("click", function() {		

        window.location.href='<?php echo WEB; ?>';

	});
    
    /* Reservations */
    
    $("#searchres").on("keypress", function(e) {	
        if (e.keyCode == 13) {
            searchres = $("#searchres").val();
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/dashboard_request.php?sec=table",
                data: "searchres=" + searchres,
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    $("#btnresall").removeClass("invisible");
                    $("#dashboard_table").html(data);

                }
            })
        }
    });
    
    /*$("#btnsearchres").on("click", function() {
        searchres = $("#searchres").val();
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/dashboard_request.php?sec=table",
            data: "searchres=" + searchres,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#btnresall").removeClass("invisible");
                $("#dashboard_table").html(data);

            }
        })
    });
    
    $("#btnresall").on("click", function() {	
        
        respage = 1;
        $(this).addClass("invisible");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/dashboard_request.php?sec=table",
            data: "clear_search=1",
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#searchres").val("");
                $("#btnresall").addClass("invisible");
                $("#dashboard_table").html(data);  
            }
        })
    });
    
    
    /* Driver Management */
    /*
    $(".btneditdriver").on("click", function() {
        
        $("#etitle").html("Edit");    
        $("#floatdiv").removeClass("invisible");
        $("#fedit").removeClass("invisible");
        $(".vdriver_msg").css("display", "none");
        $(".btnsave").removeClass('invisible');

        did = $(this).attr('attribute');

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=edit",
            data: "did=" + did,
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                var obj = $.parseJSON(data);
                
                $("#driver_type").val(obj.driver_type);                    
                $("#driver_name").val(obj.driver_name);                  
                $("#driver_bday").val(obj.driver_bday);                  
                $("#driver_telno").val(obj.driver_telno);                  
                $("#driver_license").val(obj.driver_license);                  
                $("#driver_licexpire").val(obj.driver_licexpire);                        
                $("#driver_id").val(obj.driver_id);                    
            }
        })

        return false;
    });

    $(".btndeldriver").on("click", function() {

        var r = confirm("Are you sure you want to delete this driver?");
        did = $(this).attr('attribute');
        pagenum = $("#dpage").val();				

        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=delete",
                data: "did=" + did,
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=table&page=" + pagenum,
                        success: function(data) {                        
                            $("#driver_table").html(data);
                        }
                    });
                }
            })

            return false;
        }
    });
    
    $("#searchdrv").on("keypress", function(e) {	
        if (e.keyCode == 13) {
            searchdrv = $("#searchdrv").val();
            if (searchdrv.trim() != "") {
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=table",
                    data: "searchdrv=" + searchdrv,
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        $("#btndrvall").removeClass("invisible");
                        $("#driver_table").html(data);

                    }
                })
            }
        }
    });
    
    $("#btnsearchdrv").on("click", function() {
        searchdrv = $("#searchdrv").val();
        if (searchdrv.trim() != "") {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=table",
                data: "searchdrv=" + searchdrv,
                type: "POST",
                complete: function(){
                    $("#loading").hide();
                },
                success: function(data) {
                    $("#btndrvall").removeClass("invisible");
                    $("#driver_table").html(data);

                }
            })
        }
    });
    
    $("#btndrvall").on("click", function() {	
        
        drvpage = 1;
        $(this).addClass("invisible");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=table",
            data: "clear_search=1",
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#searchdrv").val("");
                $("#btndrvall").addClass("invisible");
                $("#btndexpire").removeClass("invisible");
                $("#driver_table").html(data);  
            }
        })
    });
    
    $("#btndexpire").on("click", function() {	
        
        drvpage = 1;
        $(this).addClass("invisible");
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/driver_request.php?sec=table",
            data: "dexpired=1",
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#btndrvall").removeClass("invisible");
                $("#btndexpire").addClass("invisible");
                $("#driver_table").html(data);  
            }
        })
    });
    
    /* User Management */
    /*
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
    /*
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
    });*/

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
    /*
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
    /*
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
    });*/
    
    /* FLIP */
    $(".aitem").flip({
        axis: 'y',
        trigger: 'hover',
        speed: 200
    });
    
    /* SLIDER */
    
    $("#price-range").slider({
        range: true,
        min: 0,
        max: 100000,
        values: [1000, 50000],
        slide: function(event, ui) {
            $("#pamount").html("P" + ui.values[0] + " - P" + ui.values[1]);
        }
    });

    /* DATE/TIME PICKER */
    /*
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
    });*/

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

    $('.profile_pic').resizecrop({
        width: 100,
        height: 100,
        vertical: "center"
    });  

    $('.activity_img').resizecrop({
        width: 200,
        height: 150,
        vertical: "top"
    });  

    $('.vactivity_img').resizecrop({
        width: 400,
        height: 300,
        vertical: "top"
    });  

    $('.latestpic').resizecrop({
        width: 300,
        height: 250,
        vertical: "top"
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

    $('.pixpic').resizecrop({
        width: 100,
        height: 75,
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

    $("#username").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            e.keyCode = newKey;
            e.charCode = newKey;
        }
    
        $("#username").val(($("#username").val()).toUpperCase());
    });

	/*$("#username").on("keypress", function(e) {
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
            username = username.toUpperCase();
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
	});*/

});