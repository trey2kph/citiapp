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
            $career_id = $_POST['id'];
    
            $del_career = $main->career_action(NULL, 'delete', $career_id);			
            if($del_career) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PROMO", $career_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
            
        case 'status':
            $career_id = $_POST['id'];
            $careerdata['career_status'] = $_POST['status'];		
    
            $career_stat = $main->career_action($careerdata, 'status', $career_id);			
            if($career_stat) :
                
                //AUDIT TRAIL
                //$log = $main->log_action("STATUS_PROMO", $career_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'table':
            
            ?>

            <script>

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
            
            unset($_SESSION['scareer']);

            $scareer_sess = $_SESSION['scareer'];
            if ($_POST['scareer']) {        
                $scareer = $_POST['scareer'] ? $_POST['scareer'] : NULL;            
                $_SESSION['scareer'] = $scareer;
            }
            elseif ($scareer_sess) {
                $scareer = $scareer_sess ? $scareer_sess : NULL;
                $_POST['scareer'] = $scareer != 0 ? $scareer : NULL;
            }
            else {
                $scareer = NULL;
                $_POST['scareer'] = NULL;
            }   

            if ($id) :
                $career = $main->get_career($id);	
            elseif ($add) :
                $career_count = $main->get_career(0, 0, 0, NULL, 1, 6);	
            else :
                $career = $main->get_career(0, $start, PROD_NUM_ROWS, $scareer, 0);	
                $careercount = $main->get_career(0, 0, 0, $scareer, 1);
                $pages = $main->pagination("career", $careercount, PROD_NUM_ROWS, 9);
            endif;
            
            
            if($career) : ?>
                            <a href="<?php echo WEB; ?>/career?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Jobs</button></a>
                              <table class="table table-bordered table-hover">
                                <thead>
                                <tr>           
                                  <th width="30%">Name</th>                       
                                  <th width="25%">Post Date</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>                                  
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($career as $key => $value) : ?>
                                <?php $careeruser = $main->get_user($value['career_user']); ?>  
                                <tr>
                                  <td><?php echo $value['career_name']; ?></td>
                                  <td><?php echo  date('M j, Y', $value['career_postfrom']); ?> to <?php echo  date('M j, Y', $value['career_postto']); ?></td>
                                  <td><?php echo $value['career_update'] ? date('M j, Y | g:ia', $value['career_update']) : date('M j, Y | g:ia', $value['career_date']); ?> by <?php echo $careeruser[0]['user_firstname'].' '.$careeruser[0]['user_lastname']; ?></td>
                                  <td id="status<?php echo $value['career_id']; ?>"><button type="button" attribute="<?php echo $value['career_id']; ?>" attribute2="career" class="btn btndeactivate btn-success<?php echo $value['career_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['career_id']; ?>" attribute2="career" class="btn btnactivate btn-danger<?php echo $value['career_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/career?id=<?php echo $value['career_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['career_id']; ?>" class="btn btndelcar btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Post Date</th>
                                  <th>Last Edited</th>   
                                  <th>Status</th>                                  
                                  <th>Manage</th>                      
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign">No career has been listed</div>
                              </tr>
              <?php endif; 
        break;
        
        
    }            
	
?>