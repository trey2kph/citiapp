<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {            
        case 'catsel':
            
            $catsel = "";
            $category_id = $_POST['catid'];
    
            $subcat = $main->get_subcat(0, 0, 0, $category_id, 0);
            
            
            if ($category_id) :
            if ($subcat) :
            $catsel .= '<option value="0">Choose subcategory...</option>';  
            foreach ($subcat as $key => $value) : 
            $catsel .= '<option value="'.$value['subcat_id'].'"'.($product[0]['product_subcat'] == $value['subcat_id'] ? ' selected' : '').'>'.$value['subcat_name'].'</option>';
            endforeach;
            else :
            $catsel .= '<option value="0">No subcategory found</option>';  
            endif;
            else :
            $catsel .= '<option value="0">Choose category first...</option>';  
            endif;
            
            echo $catsel;
            
        break;    
            
        case 'delete':
            $category_id = $_POST['id'];
    
            $del_category = $main->category_action(NULL, 'delete', $category_id);			
            if($del_category) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_CAT", $category_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $category_id = $_POST['id'];
            $categorydata['category_status'] = $_POST['status'];		
    
            $category_stat = $main->category_action($categorydata, 'status', $category_id);			
            if($category_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_CAT", $category_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;   
            
        case 'addsubcat':
            $subcatdata['subcat_name'] = $_POST['subcatname'];
            $subcatdata['subcat_cat'] = $_POST['catid'];
    
            $subcat_add = $main->category_action($subcatdata, 'addsub');			
            if($subcat_add) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_CAT", $category_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;   
            
        case 'upsubcat':
            $subcatdata['subcat_name'] = $_POST['subcatname'];
            $id = $_POST['subcatid'];
    
            $subcat_update = $main->category_action($subcatdata, 'updatesub', $id);			
            if($subcat_update) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_CAT", $category_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;  
            
        case 'delsubcat':
            $id = $_POST['subcatid'];
    
            $subcat_delete = $main->category_action(NULL, 'deletesub', $id);			
            if($subcat_delete) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_CAT", $category_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'subcattable':
            
            ?>

            <script>

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
                
            </script>

            <?php
            
            $id = $_POST['id'];
            $subcat = $main->get_subcat(0, 0, 0, $id, 0);
            
            if ($subcat) : ?>
                                        <?php foreach ($subcat as $key => $value) : ?>
                                           <div class="col-sm-8 marginbottom10"><span id="subcat<?php echo $value['subcat_id'] ?>" attribute="<?php echo $value['subcat_id'] ?>" class="subcat"><?php echo $value['subcat_name'] ?></span><input id="txtsubcat<?php echo $value['subcat_id'] ?>" type="text" name="txtsubcat[<?php echo $value['subcat_id'] ?>]" value="<?php echo $value['subcat_name'] ?>" attribute="<?php echo $value['subcat_id']; ?>" placeholder="Subcategory Name" class="invisible txtsubcat col-sm-10 input-sml form-control" /></div>
                                           <div class="col-sm-4 marginbottom10"><button id="btneditsubcat<?php echo $value['subcat_id']; ?>" type="button" attribute="<?php echo $value['subcat_id']; ?>" class="btn btn-xs btneditsubcat btn-primary">Edit</button> <button id="btndelsubcat<?php echo $value['subcat_id']; ?>" type="button" attribute="<?php echo $value['subcat_id']; ?>" class="btn btn-xs btndelsubcat btn-danger">Delete</button><button id="btnupsubcat<?php echo $value['subcat_id']; ?>" attribute="<?php echo $value['subcat_id']; ?>" type="button" class="invisible btnupsubcat btn btn-xs btn-success">Update</button> <button id="btncansubcat<?php echo $value['subcat_id']; ?>" attribute="<?php echo $value['subcat_id']; ?>" type="button" class="invisible btncansubcat btn btn-xs btn-danger">Cancel</button></div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="col-sm-8"><input id="txtaddsubcat" type="text" name="txtaddsubcat" placeholder="Subcategory Name" class="col-sm-10 input-sml form-control" /></div> 
                                        <div class="col-sm-4"><button type="button" class="btnaddsubcat btn btn-xs btn-success">Add</button></div> 
            <?php
        break;
            
        case 'table':
            
            ?>

            <script>

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
                            window.location.href='<?php echo WEB; ?>';
                        }
                    })

                    return false;
                }

            });

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
                
            </script>

            <?php
            
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
            $start = NUM_ROWS * ($page - 1);
            
            unset($_SESSION['scategory']);

            $scategory_sess = $_SESSION['scategory'];
            if ($_POST['scategory']) {        
                $scategory = $_POST['scategory'] ? $_POST['scategory'] : NULL;            
                $_SESSION['scategory'] = $scategory;
            }
            elseif ($scategory_sess) {
                $scategory = $scategory_sess ? $scategory_sess : NULL;
                $_POST['scategory'] = $scategory != 0 ? $scategory : NULL;
            }
            else {
                $scategory = NULL;
                $_POST['scategory'] = NULL;
            }   

            if ($id) :
                $cat = $main->get_category($id);	
                $cat_count = $main->get_category(0, 0, 0, NULL, 1);	
            elseif ($add) : 
                $cat_count = $main->get_category(0, 0, 0, NULL, 1);	
            else :
                $cat = $main->get_category(0, $start, NUM_ROWS, $scategory, 0);	
                $catcount = $main->get_category(0, 0, 0, $scategory, 1);
                $pages = $main->pagination("category", $catcount, NUM_ROWS, 9);
            endif;
            
            
            if($cat) : ?>
                            <a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</button></a>
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">Category ID</th>
                                  <th width="35%">Name</th>
                                  <th width="20%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="25%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cat as $key => $value) : ?>
                                <?php $catuser = $main->get_user($value['category_user']); ?> 
                                <tr>
                                  <td><?php echo $value['category_id']; ?></td>
                                  <td><?php echo $value['category_name']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['category_update'] ? $value['category_update'] : $value['category_date'])); ?> by <?php echo $catuser[0]['user_fullname']; ?></td>   
                                  <td id="status<?php echo $value['category_id']; ?>"><button type="button" attribute="<?php echo $value['category_id']; ?>" attribute2="cat" class="btn btndeactivate btn-success<?php echo $value['category_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['category_id']; ?>" attribute2="cat" class="btn btnactivate btn-danger<?php echo $value['category_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>?id=<?php echo $value['category_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['category_id']; ?>" class="btn btndelcategory btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Category ID</th>
                                  <th width="35%">Name</th>
                                  <th width="20%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="25%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="5" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No category has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Category</button></a><?php endif; ?></div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>