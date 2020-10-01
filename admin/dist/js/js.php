<?php include("../../config.php"); ?>
    
$(function() {
    // PHIL PROVINCE
    
    $(window).load(function(){    
        var cityvar = new City();
        cityvar.vcity = "<?php echo $_GET['stv']; ?>";
        cityvar.vprovince = "<?php echo $_GET['stp']; ?>";
        cityvar.showProvinces("#store_province");
        cityvar.showCities("#store_city");
    });
    
    accounting.settings = {
        currency: {
            symbol : "P",   // default currency symbol is '$'
            format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
            decimal : ".",  // decimal point separator
            thousand: ",",  // thousands separator
            precision : 2   // decimal places
        },
        number: {
            precision : 0,  // default precision on numbers is 0
            thousand: ",",
            decimal : "."
        }
    }

    /* PRODUCT */

    $("#sprod").on("keypress", function(e) {
        if (e.keyCode == 13) {
            sprod = $("#sprod").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=table",
                data: {sprod: sprod},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".productlist").html(data);
                    $('.picsqr2').resizecrop({
                        width: 100,
                        height: 100,
                        vertical: "top"
                    });  
		        }
		    })
        }
	});

    $(".btndelprod").on("click", function() {		

        var r = confirm("Are you sure you want to delete this product?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>';
                }
		    })

		    return false;
		}

	});

    $(".dimsqr").on("click", function() {		

        var r = confirm("Are you sure you want to delete this dimension image?");
        id = $(this).attr('attribute');
        gid = $(this).attr('attribute2');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=delpic",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/?id=' + gid;
                }
		    })

		    return false;
		}

	});

    $(".picsqr").on("click", function() {		

        var r = confirm("Are you sure you want to delete this extra image?");
        id = $(this).attr('attribute');
        gid = $(this).attr('attribute2');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=delpic",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/?id=' + gid;
                }
		    })

		    return false;
		}

	});
    
    $("#product_fprice").change(function() {
        
        var price = $(this).val();        
        fprice_format = accounting.formatMoney(price);        
        price_format = accounting.unformat(fprice_format);         
        $(this).val(fprice_format);      
        $("#product_price").val(price_format);
        
    });
    
    $("#product_cat").change(function() {
        catid = $("#product_cat option:selected").val();
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=catsel",
            data: {catid: catid},
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $("#product_subcat").html(data);
            }
        })
        
    });

    /* BRAND */

    $("#sbrand").on("keypress", function(e) {
        if (e.keyCode == 13) {
            sbrand = $("#sbrand").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/brand_request.php?sec=table",
                data: {sbrand: sbrand},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".brandlist").html(data);
		        }
		    })
        }
	});

    $(".btndelbrand").on("click", function() {		

        var r = confirm("Are you sure you want to delete this brand?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/brand_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>';
                }
		    })

		    return false;
		}

	});

    /* CATEGORY */

    $("#scategory").on("keypress", function(e) {
        if (e.keyCode == 13) {
            scategory = $("#scategory").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=table",
                data: {scategory: scategory},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".categorylist").html(data);
		        }
		    })
        }
	});

    $(".btndelcategory").on("click", function() {		

        var r = confirm("Are you sure you want to delete this category?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/category';
                }
		    })

		    return false;
		}

	});

    $("#txtaddsubcat").on("keypress", function(e) {
        if (e.keyCode == 13) {
        
            subcatname = $(this).val();
            catid = $("#category_id").val();
            
            if (subcatname.trim() == '') {
                alert("Subcategory name is required");
            } else {
        
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=addsubcat",
                    data: {subcatname: subcatname, catid: catid},
                    type: "POST",
                    success: function(data) {                        
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcattable",
                            data: {id: catid},
                            type: "POST",
                            complete: function(){
                                $("#loading").hide();
                            },
                            success: function(data) {
                                $(".datasubcat").html(data);
                            }
                        })
                    }
                })
            }

            return false;
        }

	});

    $(".btnaddsubcat").on("click", function() {		
        
        subcatname = $("#txtaddsubcat").val();
        catid = $("#category_id").val();
            
        if (subcatname.trim() == '') {
            alert("Subcategory name is required");
        } else {
        
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=addsubcat",
                data: {subcatname: subcatname, catid: catid},
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcattable",
                        data: {id: catid},
                        type: "POST",
                        complete: function(){
                            $("#loading").hide();
                        },
                        success: function(data) {
                            $(".datasubcat").html(data);
                        }
                    })
                }
            })
        }

        return false;

	});

    $(".txtsubcat").on("keypress", function(e) {
        if (e.keyCode == 13) {	
        
            subcatid = $(this).attr('attribute');
            subcatname = $(this).val();
            catid = $("#category_id").val();

            if (subcatname.trim() == '') {
                alert("Subcategory name is required");
            } else {

                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=upsubcat",
                    data: {subcatname: subcatname, subcatid: subcatid},
                    type: "POST",
                    success: function(data) {                        
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcattable",
                            data: {id: catid},
                            type: "POST",
                            complete: function(){
                                $("#loading").hide();
                            },
                            success: function(data) {
                                $(".datasubcat").html(data);
                            }
                        })
                    }
                })
            }

            return false;
        }

	});

    $(".btnupsubcat").on("click", function() {		
        
        subcatid = $(this).attr('attribute');
        subcatname = $("#txtsubcat" + subcatid).val();
        catid = $("#category_id").val();
            
        if (subcatname.trim() == '') {
            alert("Subcategory name is required");
        } else {
        
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=upsubcat",
                data: {subcatname: subcatname, subcatid: subcatid},
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcattable",
                        data: {id: catid},
                        type: "POST",
                        complete: function(){
                            $("#loading").hide();
                        },
                        success: function(data) {
                            $(".datasubcat").html(data);
                        }
                    })
                }
            })
        }

        return false;

	});

    $(".btneditsubcat").on("click", function() {		
        
        subcatid = $(this).attr('attribute');
            
        $(this).addClass('invisible');
        $("#btndelsubcat" + subcatid).addClass('invisible');
        $("#btnupsubcat" + subcatid).removeClass('invisible');
        $("#btncansubcat" + subcatid).removeClass('invisible');
        
        $("#subcat" + subcatid).addClass('invisible');
        $("#txtsubcat" + subcatid).removeClass('invisible');

        return false;

	});

    $(".subcat").on("click", function() {		
        
        subcatid = $(this).attr('attribute');
            
        $("#btneditsubcat" + subcatid).addClass('invisible');
        $("#btndelsubcat" + subcatid).addClass('invisible');
        $("#btnupsubcat" + subcatid).removeClass('invisible');
        $("#btncansubcat" + subcatid).removeClass('invisible');
        
        $(this).addClass('invisible');
        $("#txtsubcat" + subcatid).removeClass('invisible');

        return false;

	});

    $(".btncansubcat").on("click", function() {		
        
        subcatid = $(this).attr('attribute');
            
        $("#btneditsubcat" + subcatid).removeClass('invisible');
        $("#btndelsubcat" + subcatid).removeClass('invisible');
        $("#btnupsubcat" + subcatid).addClass('invisible');
        $(this).addClass('invisible');
        
        $("#subcat" + subcatid).removeClass('invisible');
        $("#txtsubcat" + subcatid).addClass('invisible');

        return false;

	});

    $(".btndelsubcat").on("click", function() {		

        var r = confirm("Are you sure you want to delete this subcategory?");
        subcatid = $(this).attr('attribute');
        catid = $("#category_id").val();
        
		if (r == true)
		{
        
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=delsubcat",
                data: {subcatid: subcatid},
                type: "POST",
                success: function(data) {                        
                    $.ajax(
                    {
                        url: "<?php echo WEB; ?>/lib/requests/category_request.php?sec=subcattable",
                        data: {id: catid},
                        type: "POST",
                        complete: function(){
                            $("#loading").hide();
                        },
                        success: function(data) {
                            $(".datasubcat").html(data);
                        }
                    })
                }
            })
        }

        return false;

	});

    /* CONTENT */

    $("#scontent").on("keypress", function(e) {
        if (e.keyCode == 13) {
            spromo = $("#scontent").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/promo_request.php?sec=table",
                data: {scontent: scontent},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".contentlist").html(data);
		        }
		    })
        }
	});

    /* PROMO */

    $("#spromo").on("keypress", function(e) {
        if (e.keyCode == 13) {
            spromo = $("#spromo").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/promo_request.php?sec=table",
                data: {spromo: spromo},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".promolist").html(data);
		        }
		    })
        }
	});

    $(".btndelpromo").on("click", function() {		

        var r = confirm("Are you sure you want to delete this promo?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/promo_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>';
                }
		    })

		    return false;
		}

	});

    /* CAREER */

    $("#scareer").on("keypress", function(e) {
        if (e.keyCode == 13) {
            scareer = $("#scareer").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/career_request.php?sec=table",
                data: {scareer: scareer},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".careerlist").html(data);
		        }
		    })
        }
	});

    $(".btndelcar").on("click", function() {		

        var r = confirm("Are you sure you want to delete this career?");
        id = $(this).attr('attribute');

        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/career_request.php?sec=delete",
                data: {id: id},
                type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/career';
                }
            })

            return false;
        }

    });
    
    /* ORDER */

    $("#sorder").on("keypress", function(e) {
        if (e.keyCode == 13) {
            sorder = $("#sorder").val();
            
            sstatus = $("#ostatus").val();
            sdfrom = $("#odfrom").val();
            sdto = $("#odto").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=table",
                data: {sorder: sorder, status: sstatus, dfrom: sdfrom, dto: sdto},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".orderlist").html(data);
		        }
		    })
        }
	});
    
    $("#datefrom").change(function(e) {
        sorder = $("#sorder").val();

        sstatus = $("#ostatus").val();
        sdfrom = $(this).val();
        sdto = $("#dateto").val();

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=table",
            data: {sorder: sorder, status: sstatus, dfrom: sdfrom, dto: sdto},
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $(".orderlist").html(data);
            }
        })
	});
    
    $("#dateto").change(function(e) {
        sorder = $("#sorder").val();

        sstatus = $("#ostatus").val();
        sdfrom = $("#datefrom").val();
        sdto = $(this).val();

        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=table",
            data: {sorder: sorder, status: sstatus, dfrom: sdfrom, dto: sdto},
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                $(".orderlist").html(data);
            }
        })
	});
    
    $(".orefnum").on("click", function() {
        transid = $(this).attr("attribute");
        $(this).addClass('invisible');
        $("#txtorefnum" + transid).removeClass('invisible');
    });
    
    $(".txtorefnum").on("keypress", function(e) {
        transid = $(this).attr("attribute");
        refnumval = $(this).val();
        transuser = $("#trans_user").val();
        if (e.keyCode == 13) {
            
            if (refnumval.trim != '') {
            
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=refnum",
                    data: {id: transid, refnum: refnumval, user: transuser},
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        alert("Reference number set");
                        $.ajax(
                        {
                            url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=dateupdate",
                            data: {id: transid},
                            type: "POST",
                            complete: function(){
                                $("#loading").hide();
                            },
                            success: function(data) {
                                $("#tdupdate" + transid).html(data);
                                $.ajax(
                                {
                                    url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=rnupdate",
                                    data: {id: transid},
                                    type: "POST",
                                    complete: function(){
                                        $("#loading").hide();
                                    },
                                    success: function(data) {
                                        $("#orefnum" + transid).removeClass('invisible');
                                        $("#txtorefnum" + transid).addClass('invisible');
                                        $("#orefnum" + transid).html(data);
                                    }
                                })
                            }
                        })
                    }
                })
            } else {
                alert("Reference number setting cancelled");
            }
        }
	});
    
    $(".trans_status").change(function() {
        transid = $(this).attr("attribute");
        transtat = $("#trans_status" + transid + " option:selected").val();
        transuser = $("#trans_user").val();
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=status",
            data: {id: transid, status: transtat, user: transuser},
            type: "POST",
            complete: function(){
                $("#loading").hide();
            },
            success: function(data) {
                alert("Status updated");
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/order_request.php?sec=dateupdate",
                    data: {id: transid},
                    type: "POST",
                    complete: function(){
                        $("#loading").hide();
                    },
                    success: function(data) {
                        $("#tdupdate" + transid).html(data);
                    }
                })
            }
        })
    });
    
    /* REPORT */
    
    
    $("#btnprintorder").on("click", function() {

        sstatus = $("#ostatus").val();
        sdfrom = $("#odfrom").val();
        sdto = $("#odto").val();
        
        $.ajax(
        {
            url: '<?php echo WEB; ?>/lib/requests/report_request.php?sec=report',
            data: {status: sstatus, dfrom: sdfrom, dto: sdto},
            type: "POST",
            success: function(data) {
                if(data == 1) {
                    window.open('<?php echo WEB; ?>/report?status=' + sstatus + '&from=' + sdfrom + '&to=' + sdto,'_blank');
                }
                else {
                    alert("No order listed with date indicated");
                }
            }
        })
        
        return false;
        
    });

    /* USER */

    $("#suser").on("keypress", function(e) {
        if (e.keyCode == 13) {
            suser = $("#suser").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table",
                data: {suser: suser},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".userlist").html(data);
		        }
		    })
        }
	});

    $(".btndeluser").on("click", function() {		

        var r = confirm("Are you sure you want to delete this user?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>';
                }
		    })

		    return false;
		}

	});

    
    /* ACTIVATE */

    $(".btndeactivate").on("click", function() {		
        
        id = $(this).attr('attribute');
        type = $(this).attr('attribute2');
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/" + type + "_request.php?sec=status",
            data: {id: id, status: 1},
            type: "POST",
            success: function(data) {                        
                $("#status" + id + " .btndeactivate").addClass('invisible');                      
                $("#status" + id + " .btnactivate").removeClass('invisible');
            }
        })

	});

    $(".btnactivate").on("click", function() {		
        
        id = $(this).attr('attribute');
        type = $(this).attr('attribute2');
        
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/" + type + "_request.php?sec=status",
            data: {id: id, status: 2},
            type: "POST",
            success: function(data) {                        
                $("#status" + id + " .btndeactivate").removeClass('invisible');                      
                $("#status" + id + " .btnactivate").addClass('invisible');
            }
        })

	});
    
    /* STORE */

    $("#sstore").on("keypress", function(e) {
        if (e.keyCode == 13) {
            sstore = $("#sstore").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/store_request.php?sec=table",
                data: {sstore: sstore},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".storelist").html(data);
		        }
		    })
        }
	});

    $(".btndelstore").on("click", function() {		

        var r = confirm("Are you sure you want to delete this store?");
        id = $(this).attr('attribute');

        if (r == true)
        {
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/store_request.php?sec=delete",
                data: {id: id},
                type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/stores';
                }
            })

            return false;
        }

    });

    /* USERS */

    $("#susers").on("keypress", function(e) {
        if (e.keyCode == 13) {
            susers = $("#susers").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=table",
                data: {susers: susers},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
                    $(".userlist").html(data);
		        }
		    })
        }
	});
    
    $("#users_status").change(function() {
        userstat = $("#users_status option:selected").val();
        if (userstat == 2) {
            $("#btnusers").html('Submit and Send Password');
        }
        else {
            $("#btnusers").html('Submit');
        }
    });

    $(".btnudeactivate").on("click", function() {		
        
        id = $(this).attr('attribute');
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=status",
            data: {id: id, status: 1},
            type: "POST",
            success: function(data) {                        
                $("#ustatus" + id + " .btnudeactivate").addClass('invisible');                      
                $("#ustatus" + id + " .btnuactivate").removeClass('invisible');
            }
        })

	});

    $(".btnuactivate").on("click", function() {		
        
        id = $(this).attr('attribute');
        $.ajax(
        {
            url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=status",
            data: {id: id, status: 2},
            type: "POST",
            success: function(data) {                        
                $("#ustatus" + id + " .btnudeactivate").removeClass('invisible');                      
                $("#ustatus" + id + " .btnuactivate").addClass('invisible');
            }
        })

	});

    $(".btndelusers").on("click", function() {		

        var r = confirm("Are you sure you want to delete this user?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/user_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>';
                }
		    })

		    return false;
		}

	});

    /* GALLERY */

    $(".btndelgal").on("click", function() {		

        var r = confirm("Are you sure you want to delete this gallery?");
        id = $(this).attr('attribute');
        
		if (r == true)
		{
			$.ajax(
		    {
		        url: "<?php echo WEB; ?>/lib/requests/gallery_request.php?sec=delete",
		        data: {id: id},
		        type: "POST",
                success: function(data) {                        
                    window.location.href='<?php echo WEB; ?>/gallery';
                }
		    })

		    return false;
		}

	});
    
    /* OTHER */

    // WYSIWYG EDITOR

    //$('.textarea').wysihtml5();

    // DATEPICKER

    $(".datepick").datepicker({ 
        dateFormat: 'yy-mm-dd',
        yearRange: "-50:+50",
        changeMonth: true,
        changeYear: true
    });  

    $(".datepickmy").datepicker({ 
        dateFormat: 'mmyy',
        changeMonth: true,
        changeYear: true
    });

    $(".datepickmy").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    // TIMEPICKER

    $("#store_hour1, #store_hour2").timepicker({
        showInputs: false
      });  

    // RESIZE CROP

    $('.castpix').resizecrop({
        width: 100,
        height: 100,
        vertical: "top"
    }); 

    $('.spromosqr').resizecrop({
        width: 200,
        height: 150,
        vertical: "top"
    });   

    $('.lpromosqr').resizecrop({
        width: 367,
        height: 90,
        vertical: "top"
    });    

    $('.hpromosqr').resizecrop({
        width: 367,
        height: 207,
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

    $('.logosqr').resizecrop({
        width: 100,
        height: 25,
        vertical: "top"
    }); 

    $('.picsqr2').resizecrop({
        width: 100,
        height: 100,
        vertical: "top"
    });   
    
    // LOGIN

    $("#username").on("keypress", function(e) {
        if (e.keyCode == 13) {
            username = $("#username").val();
			password = $("#password").val();

            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/login.php",
                data: {username: username, password: password},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
		        	if (data == 0) { 
                        $('.box').css({'margin-right' : '0px'}); 
		        		$('.box').effect('shake', {times: 3, distance: 20}, 420); 
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
			password = $("#password").val();
            $.ajax(
            {
                url: "<?php echo WEB; ?>/lib/requests/login.php",
                data: {username: username, password: password},
	            type: "POST",
		        complete: function(){
		        	$("#loading").hide();
		    	},
		        success: function(data) {
		        	if (data == 0) { 
                        $('.box').css({'margin-right' : '0px'}); 
		        		$('.box').effect('shake', {times: 3, distance: 20}, 420); 
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
            data: {username: username, password: password},
            type: "POST",
	        complete: function(){
	        	$("#loading").hide();
	    	},
	        success: function(data) {
	        	if (data == 0) { 
                    $('.box').css({'margin-right' : '0px'}); 
		            $('.box').effect('shake', {times: 3, distance: 20}, 420); 
	        	}
	        	else {                     
	        		window.location.href='<?php echo WEB; ?>';
	        	}
	        }
	    })
	});
    
});