<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
    $profile_sex = $sex;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {       
        case 'delete':
            $prod_id = $_POST['id'];
    
            $del_prod = $main->product_action(NULL, 'delete', $prod_id);			
            if($del_prod) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PRODUCT", $prod_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'delpic':
            $pic_id = $_POST['id'];
    
            $del_pic = $main->product_action(NULL, 'delpic', $pic_id);			
            if($del_pic) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PICPRODUCT", $pic_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;     
            
        case 'status':
            $prod_id = $_POST['id'];
            $proddata['product_status'] = $_POST['status'];		
    
            $prod_stat = $main->product_action($proddata, 'status', $prod_id);			
            if($prod_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_PRODUCT", $prod_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'table':
            
            ?>

            <script>

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

            $(".picsqr").on("click", function() {		

                var r = confirm("Are you sure you want to delete this picture?");
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

            $(".btndeactivate").on("click", function() {		

                id = $(this).attr('attribute');
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=status",
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
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/product_request.php?sec=status",
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
            $start = PROD_NUM_ROWS * ($page - 1);
            
            unset($_SESSION['sprod']);
            $sprod_sess = $_SESSION['sprod'];
            if ($_POST['sprod']) {        
                $sprod = $_POST['sprod'] ? $_POST['sprod'] : NULL;            
                $_SESSION['sprod'] = $sprod;
            }
            elseif ($sprod_sess) {
                $sprod = $sprod_sess ? $sprod_sess : NULL;
                $_POST['sprod'] = $sprod != 0 ? $sprod : NULL;
            }
            else {
                $sprod = NULL;
                $_POST['sprod'] = NULL;
            }   

            if ($id) :
                $product = $main->get_products($id);	
                $product_count = $main->get_products(0, 0, 0, NULL, 1);	
                $product_pics = $main->get_pics(0, 0, 0, 0, $id);	    
            elseif ($add) : 
                $product_count = $main->get_products(0, 0, 0, NULL, 1);	
            else :
                $product = $main->get_products(0, $start, PROD_NUM_ROWS, $sprod, 0);	
                $productcount = $main->get_products(0, 0, 0, $sprod, 1);
                $pages = $main->pagination("product", $productcount, PROD_NUM_ROWS, 9);
            endif;
            
            
            if($product) : ?>
                            <a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</button></a>
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">Product ID</th>
                                  <th width="20%">Name</th>
                                  <th width="15%">Model</th>
                                  <th width="15%">Brand</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($product as $key => $value) : ?>
                                <?php $productuser = $main->get_user($value['product_user']); ?> 
                                <tr>
                                  <td><?php echo $value['product_id']; ?></td>
                                  <td><?php echo $value['product_name']; ?></td>
                                  <td><?php echo $modeldata[0]['model_name']; ?></td>
                                  <td><?php echo $branddata[0]['brand_name']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['product_update'] ? $value['product_update'] : $value['product_date'])); ?> by <?php echo $productuser[0]['user_fullname']; ?></td>    
                                  <td id="status<?php echo $value['product_id']; ?>"><button type="button" attribute="<?php echo $value['product_id']; ?>" class="btn btndeactivate btn-success<?php echo $value['product_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['product_id']; ?>" class="btn btnactivate btn-danger<?php echo $value['product_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/product?id=<?php echo $value['product_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['product_id']; ?>" class="btn btndelprod btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Product ID</th>
                                  <th width="20%">Name</th>
                                  <th width="15%">Model</th>
                                  <th width="15%">Brand</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="7" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No product has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Product</button></a><?php endif; ?></div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>