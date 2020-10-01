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
            $store_id = $_POST['id'];
    
            $del_store = $main->store_action(NULL, 'delete', $store_id);			
            if($del_store) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PRODUCT", $prod_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'delpic':
            $pic_id = $_POST['id'];
    
            $del_pic = $main->store_action(NULL, 'delpic', $pic_id);			
            if($del_pic) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PICPRODUCT", $pic_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;     
            
        case 'status':
            $store_id = $_POST['id'];
            $storedata['store_status'] = $_POST['status'];		
    
            $store_stat = $main->store_action($storedata, 'status', $store_id);			
            if($store_stat) :
                
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

            $(".btndeactivate").on("click", function() {		

                id = $(this).attr('attribute');
                $.ajax(
                {
                    url: "<?php echo WEB; ?>/lib/requests/store_request.php?sec=status",
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
                    url: "<?php echo WEB; ?>/lib/requests/store_request.php?sec=status",
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
            
            unset($_SESSION['sstore']);
            $sstore_sess = $_SESSION['sstore'];
            if ($_POST['sstore']) {        
                $sstore = $_POST['sstore'] ? $_POST['sstore'] : NULL;            
                $_SESSION['sstore'] = $sstore;
            }
            elseif ($sstore_sess) {
                $sstore = $sstore_sess ? $sstore_sess : NULL;
                $_POST['sstore'] = $sstore != 0 ? $sstore : NULL;
            }
            else {
                $sstore = NULL;
                $_POST['sstore'] = NULL;
            }   

            if ($id) :
                $store = $main->get_store($id);	
                $store_count = $main->get_store(0, 0, 0, NULL, 1);	
            elseif ($add) : 
                $store_count = $main->get_store(0, 0, 0, NULL, 1);	
            else :
                $store = $main->get_store(0, $start, PROD_NUM_ROWS, $sstore, 0);	
                $storecount = $main->get_store(0, 0, 0, $sstore, 1);
                $pages = $main->pagination("store", $storecount, PROD_NUM_ROWS, 9);
            endif;
            
            
            if($store) : ?>
                            <a href="<?php echo WEB; ?>/stores?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Store Location</button></a>
                              <table class="table table-bordered table-hover">
                                <thead>
                                <tr>                   
                                  <th width="5%">Store ID</th>  
                                  <th width="17%">Name</th>                       
                                  <th width="35%">Address</th>
                                  <th width="15%">Last Edited</th>  
                                  <th width="8%">Status</th>                                  
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($store as $key => $value) : ?>
                                <?php $storeuser = $main->get_user($value['store_user']); ?>  
                                <tr>
                                  <td><?php echo $value['store_id']; ?></td>
                                  <td><?php echo $value['store_name']; ?></td>
                                  <td><?php echo $value['store_address']; ?></td>
                                  <td><?php echo $value['store_update'] ? date('M j, Y | g:ia', $value['store_update']) : date('M j, Y | g:ia', $value['store_date']); ?> by <?php echo $storeuser[0]['user_firstname'].' '.$storeuser[0]['user_lastname']; ?></td>
                                  <td id="status<?php echo $value['store_id']; ?>"><button type="button" attribute="<?php echo $value['store_id']; ?>" attribute2="store" class="btn btndeactivate btn-success<?php echo $value['store_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['store_id']; ?>" attribute2="store" class="btn btnactivate btn-danger<?php echo $value['store_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/store?id=<?php echo $value['store_id']; ?>&page=<?php echo $page; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['store_id']; ?>" class="btn btndelstore btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>                   
                                  <th width="5%">Store ID</th>  
                                  <th width="17%">Name</th>                       
                                  <th width="35%">Address</th>
                                  <th width="15%">Last Edited</th>  
                                  <th width="8%">Status</th>                                  
                                  <th width="20%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="6" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign">No store has been listed</div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>