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
            $promo_id = $_POST['id'];
    
            $del_promo = $main->promo_action(NULL, 'delete', $promo_id);			
            if($del_promo) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PROMO", $promo_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $promo_id = $_POST['id'];
            $promodata['promo_status'] = $_POST['status'];		
    
            $promo_stat = $main->promo_action($promodata, 'status', $promo_id);			
            if($promo_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_PROMO", $promo_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'table':
            
            ?>

            <script>

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
            
            unset($_SESSION['spromo']);

            $spromo_sess = $_SESSION['spromo'];
            if ($_POST['spromo']) {        
                $spromo = $_POST['spromo'] ? $_POST['spromo'] : NULL;            
                $_SESSION['spromo'] = $spromo;
            }
            elseif ($spromo_sess) {
                $spromo = $spromo_sess ? $spromo_sess : NULL;
                $_POST['spromo'] = $spromo != 0 ? $spromo : NULL;
            }
            else {
                $spromo = NULL;
                $_POST['spromo'] = NULL;
            }   

            if ($id) :
                $promo = $main->get_promos($id);	
                $promo_count = $main->get_promos(0, 0, 0, NULL, 1);	
            elseif ($add) : 
                $promo_count = $main->get_promos(0, 0, 0, NULL, 1);	
            else :
                $promo = $main->get_promos(0, $start, NUM_ROWS, $spromo, 0);	
                $promocount = $main->get_promos(0, 0, 0, $spromo, 1);
                $pages = $main->pagination("promo", $promocount, NUM_ROWS, 9);
            endif;
            
            
            if($promo) : ?>
                            <a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Promo</button></a>
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">Promo ID</th>
                                  <th width="30%">Title</th>
                                  <th width="20%">Type</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($promo as $key => $value) : ?>
                                <?php $promouser = $main->get_user($value['promo_user']); ?> 
                                <tr>
                                  <td><?php echo $value['promo_id']; ?></td>
                                  <td><?php echo $value['promo_name']; ?></td>
                                  <td><?php echo $value['promo_type']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['promo_update'] ? $value['promo_update'] : $value['promo_date'])); ?> by <?php echo $promouser[0]['user_fullname']; ?></td>    
                                  <td id="status<?php echo $value['promo_id']; ?>"><button type="button" attribute="<?php echo $value['promo_id']; ?>" attribute2="promo" class="btn btndeactivate btn-success<?php echo $value['promo_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['promo_id']; ?>" attribute2="promo" class="btn btnactivate btn-danger<?php echo $value['promo_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>?id=<?php echo $value['promo_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['promo_id']; ?>" class="btn btndelpromo btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Promo ID</th>
                                  <th width="30%">Title</th>
                                  <th width="20%">Type</th>
                                  <th width="10%">Last Edited</th>
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
                                <div class="centertalign margintopbot100">No promo has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Promo</button></a><?php endif; ?></div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>