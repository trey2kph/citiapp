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
            $user_id = $_POST['id'];
    
            $del_user = $main->user_action(NULL, 'delete', $user_id);			
            if($del_user) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PROMO", $user_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $user_id = $_POST['id'];
            $userdata['user_status'] = $_POST['status'];		
    
            $user_stat = $main->user_action($userdata, 'status', $user_id);			
            if($user_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_PROMO", $user_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'table':
            
            ?>

            <script>

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
            
            unset($_SESSION['suser']);

            $suser_sess = $_SESSION['suser'];
            if ($_POST['suser']) {        
                $suser = $_POST['suser'] ? $_POST['suser'] : NULL;            
                $_SESSION['suser'] = $suser;
            }
            elseif ($suser_sess) {
                $suser = $suser_sess ? $suser_sess : NULL;
                $_POST['suser'] = $suser != 0 ? $suser : NULL;
            }
            else {
                $suser = NULL;
                $_POST['suser'] = NULL;
            }   

            if ($id) :
                $user = $main->get_users($id);	
                $user_count = $main->get_users(0, 0, 0, NULL, 1);	
            elseif ($add) : 
                $user_count = $main->get_users(0, 0, 0, NULL, 1);	
            else :
                $user = $main->get_users(0, $start, NUM_ROWS, $sprod, 0);	
                $usercount = $main->get_users(0, 0, 0, $sprod, 1);
                $pages = $main->pagination("user", $usercount, NUM_ROWS, 9);
            endif;
            
            
            if($user) : ?>
                            <a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</button></a>
                              <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">User ID</th>
                                  <th width="25%">Fullname</th>
                                  <th width="20%">Type</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($user as $key => $value) : ?>
                                <?php $useruser = $main->get_user($value['user_user']); ?> 
                                <tr>
                                  <td><?php echo $value['user_id']; ?></td>
                                  <td><?php echo $value['user_lastname'].', '.$value['user_firstname']; ?></td>
                                  <td><?php echo $userdata[0]['user_alias']; ?></td>
                                  <td class="tdmobile"><?php echo date('M j, Y | g:ia', ($value['user_update'] ? $value['user_update'] : $value['user_date'])); ?> by <?php echo $value['user_user'] ? $useruser[0]['user_firstname']." ".$useruser[0]['user_lastname'] : 'user registration'; ?></td>  
                                  <td id="status<?php echo $value['user_id']; ?>"><button type="button" attribute="<?php echo $value['user_id']; ?>" attribute2="user" class="btn btndeactivate btn-success<?php echo $value['user_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['user_id']; ?>" attribute2="user" class="btn btnactivate btn-danger<?php echo $value['user_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/user?id=<?php echo $value['user_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['user_id']; ?>" class="btn btndeluser btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">User ID</th>
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
                                <div class="centertalign margintopbot100">No user has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add User</button></a><?php endif; ?></div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>