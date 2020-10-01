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
        case 'delete':
            $brand_id = $_POST['id'];
    
            $del_brand = $main->brand_action(NULL, 'delete', $brand_id);			
            if($del_brand) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_BRAND", $brand_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $brand_id = $_POST['id'];
            $branddata['brand_status'] = $_POST['status'];		
    
            $brand_stat = $main->brand_action($branddata, 'status', $brand_id);			
            if($brand_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_BRAND", $brand_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'table':
            
            ?>

            <script>

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
            
            unset($_SESSION['sbrand']);
            $sbrand_sess = $_SESSION['sbrand'];
            if ($_POST['sbrand']) {        
                $sbrand = $_POST['sbrand'] ? $_POST['sbrand'] : NULL;            
                $_SESSION['sbrand'] = $sbrand;
            }
            elseif ($sbrand_sess) {
                $sbrand = $sbrand_sess ? $sbrand_sess : NULL;
                $_POST['sbrand'] = $sbrand != 0 ? $sbrand : NULL;
            }
            else {
                $sbrand = NULL;
                $_POST['sbrand'] = NULL;
            }   

            if ($id) :
                $brand = $main->get_brands($id);	
                $brand_count = $main->get_brands(0, 0, 0, NULL, 1);	
                $brand_pics = $main->get_pics(0, 0, 0, 0, $id);	    
            elseif ($add) : 
                $brand_count = $main->get_brands(0, 0, 0, NULL, 1);	
            else :
                $brand = $main->get_brands(0, $start, NUM_ROWS, $sbrand, 0);	
                $brandcount = $main->get_brands(0, 0, 0, $sbrand, 1);
                $pages = $main->pagination("brand", $brandcount, NUM_ROWS, 9);
            endif;
            
            
            if($brand) : ?>
                            <a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Brand</button></a>
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">Brand ID</th>
                                  <th width="25%">Name</th>
                                  <th width="20%">Alias</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($brand as $key => $value) : ?>
                                <?php $branduser = $main->get_user($value['brand_user']); ?> 
                                <tr>
                                  <td><?php echo $value['brand_id']; ?></td>
                                  <td><?php echo $value['brand_name']; ?></td>
                                  <td><?php echo $value['brand_alias']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['brand_update'] ? $value['brand_update'] : $value['brand_date'])); ?> by <?php echo $branduser[0]['user_firstname']; ?></td>    
                                  <td id="status<?php echo $value['brand_id']; ?>"><button type="button" attribute="<?php echo $value['brand_id']; ?>" attribute2="brand" class="btn btndeactivate btn-success<?php echo $value['brand_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['brand_id']; ?>" attribute2="brand" class="btn btnactivate btn-danger<?php echo $value['brand_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/brand?id=<?php echo $value['brand_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['brand_id']; ?>" class="btn btndelbrand btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Brand ID</th>
                                  <th width="25%">Name</th>
                                  <th width="20%">Alias</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="6" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No brand has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Brand</button></a><?php endif; ?></div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>