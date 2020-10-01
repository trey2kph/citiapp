<?php 

	include("../../config.php"); 
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");

    $mailfootdata = $main->get_setting(0, 0, 0, 'mailfoot');	
    $service_chargedata = $main->get_setting(0, 0, 0, 'shipping_charge');	

    $logged = $logstat;
    $profile_full = $logfname;
    $profile_name = $logname;
    $profile_id = $userid;
    $profile_email = $email;
    $profile_sex = $sex;
	
	//***************** USER MANAGEMENT - END *****************\\

    $sec = $_GET['sec'];

    switch ($sec) {    
        case 'edit':	

            echo '{"memo_id":"'.$value['MemoID'].'", "memo_title":"'.addslashes($value['MemoName']).'", "memo_date":"'.date('Y-m-d', strtotime($value['MemoDate'])).'", "memo_attach":"'.htmlentities($value['MemoAttach']).'"}';
            
        break; 
        case 'delete':
            $trans_id = $_POST['id'];
            $transdata['trans_user'] = $_POST['user'];		
    
            $del_trans = $main->trans_action($transdata, 'delete', $trans_id);			
            if($del_trans) :
        
                //AUDIT TRAIL
                //$log = $main->log_action("DELETE_PRODUCT", $prod_id, $profile_id); 
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break;    
              
            
        case 'status':
            $trans_id = $_POST['id'];
            $transdata['trans_status'] = $_POST['status'];	
            $transdata['trans_user'] = $_POST['user'];		
    
            $trans_stat = $main->trans_action($transdata, 'status', $trans_id);			
            if($trans_stat) :
                
                $item_val = '';
                $stat_val = '';
                $trans_data = $main->get_trans($trans_id);
                $tuser_data = $main->get_user($trans_data[0]['trans_uid']);
            
                //var_dump($tuser_data[0]['user_email']);
            
                $order_data = unserialize($trans_data[0]['trans_order']);
                 
                //var_dump($order_data);
            
                if ($trans_data[0]['trans_paytype'] == 1) :
                    $order_array = $order_status2;  
                    $deli_val = '';
                else :
                    $order_array = $order_status;
                    $deli_val = '<tr><td style="font-weight: bold;">Shipping Fee</td><td colspan="2" style="text-align: right;"><b>P '.number_format($service_chargedata[0]['set_val'], 2).'</b></td></tr>';
                endif;
                foreach ($order_array as $k1 => $v1) : 
                    $stat_val .= ($k1 == $trans_data[0]['trans_status'] ? $v1[0] : ''); 
                endforeach;
                
                $item_val .= '<table width="100%">';
                foreach($order_data as $v) :
                    $tprod_data = $main->get_products($v['id']);
                    $item_val .= '<tr><td width="30%" style="vertical-align: top; text-align: right;"><img id="appimg" src="'.SWEB.'/uploads/prodsimg/'.$tprod_data[0]['product_smallimg'].'" width="90" style="margin-bottom: 15px; margin-right: 20px;" /></td><td width="40%" style="vertical-align: top;"><b>'.htmlspecialchars($v['name'], ENT_QUOTES, 'UTF-8').'</b><br>P '.number_format($v['price'], 2).'<br>Quantity: '.$v['quantity'].'<br></td><td width="30%" style="vertical-align: top; text-align: right"><b>P '.number_format($v['price'] * $v['quantity'], 2).'</b></td></tr>';
                    $item_total = $item_total + ($v['price'] * $v['quantity']); 
                endforeach;
                $item_val .= $deli_val;
                $item_val .= '<tr><td style="font-weight: bold;">Total</td><td colspan="2" style="text-align: right;"><b>P '.number_format($item_total, 2).'</b></td></tr>';
                $item_val .= '<table>';
            
                $message = "<div style='display: block; border: 2px solid #F00; padding: 0px; font-size: 14px; font-family: Verdana; width: 500px;'>
                
                <div style='display: inline-block; background: #F00; width: 100%; height: 120px; text-align: center'><img src='".SWEB."/images/iaplogo.png' style='margin-bottom: 10px;' /></div>
                <div style='display: inline-block; width: 90%; padding: 5%;'>
                <span style='font-size: 24px; color: #024485; font-weight: bold;'>Your Order has been ".ucfirst($stat_val)."</span><br><br>Dear ".$tuser_data[0]['user_firstname']." ".$tuser_data[0]['user_lastname'].",<br>
                Thanks for shopping with us! We are glad to inform you that your order <b>".$trans_data[0]['trans_refnum']."</b> has been <b>".strtolower($stat_val)."</b>, please see below details for more information regarding on your order. We hope that you enjoy your purchase on Imperial Appliances and continue to shop with us as a loyal customer.<br><br><b>Details:</b><br><br>".$item_val;
            
                $message .= "<br><br>Thanks,<br>";
                $message .= SITENAME." Admin<br><hr>".$mailfootdata[0]['set_val']."</div></div>";

                $headers = "From: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "Reply-To: ".NOTIFICATION_EMAIL."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $sendmail = mail($tuser_data[0]['user_email'], "Your Order has been ".ucfirst($stat_val)."", $message, $headers); 
                
                //AUDIT TRAIL
                $logsdata['logs_item'] = $trans_id;
                $logsdata['logs_task'] = "ORDER_STATUS";
                $logsdata['logs_user'] = $_POST['user'];
                $logs_action = $main->logs_action($logsdata, 'add');	
        
                if ($sendmail) :
                    echo 1;
                else :
                    echo 0;
                endif;
            else :
                echo 0;
            endif;
        break; 
            
        case 'refnum':
            $trans_id = $_POST['id'];
            $transdata['trans_refnum'] = $_POST['refnum'];	
            $transdata['trans_user'] = $_POST['user'];		
    
            $trans_refnum = $main->trans_action($transdata, 'refnum', $trans_id);			
            if($trans_refnum) :
                
                //AUDIT TRAIL
                $logsdata['logs_item'] = $trans_id;
                $logsdata['logs_task'] = "ORDER_REFNUM";
                $logsdata['logs_user'] = $_POST['user'];
                $logs_action = $main->logs_action($logsdata, 'add');	
        
                return TRUE;
            else :
                return FALSE;
            endif;
        break; 
            
        case 'dateupdate':
            
            $trans_id = $_POST['id'];
            $order = $main->get_trans($trans_id);	
            $orderuser = $main->get_user($order[0]['trans_uid']);
            $orderuser2 = $main->get_user($order[0]['trans_user']);
            
            ?>

            <?php echo date('M j, Y | g:ia', ($order[0]['trans_update'] ? $order[0]['trans_update'] : $order[0]['trans_date'])); ?> by <?php echo $order[0]['trans_user'] ? $orderuser2[0]['user_firstname']." ".$orderuser2[0]['user_lastname'] : $orderuser[0]['user_firstname']." ".$orderuser[0]['user_lastname']; ?>

            <?php
        break;
            
        case 'rnupdate':
            
            $trans_id = $_POST['id'];
            $order = $main->get_trans($trans_id);	
            
            ?>

            <?php echo $order[0]['trans_refnum'] ? $order[0]['trans_refnum'] : 'not set (click here to set)'; ?>

            <?php
        break;
            
        case 'table':
            
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
            $start = NUM_ROWS * ($page - 1);
            $status = isset($_POST["status"]) ? $_POST["status"] : 0;
            if ($status == 3) :
                $status = 4;
                $type = 2;
                $stat = 3;
            elseif ($status == 4) :
                $status = 4;
                $type = 1;
                $stat = 4;
            else :
                $type = 0;
                $stat = $status;
            endif;
            $datefrom = $_POST["dfrom"] ? strtotime($_POST["dfrom"]) : 0;
            $dateto = $_POST["dto"] ? strtotime($_POST["dto"]) : 0;
            
            unset($_SESSION['sorder']);
            $sprod_sess = $_SESSION['sorder'];
            if ($_POST['sorder']) {        
                $sorder = $_POST['sorder'] ? $_POST['sorder'] : NULL;            
                $_SESSION['sorder'] = $sorder;
            }
            elseif ($sorder_sess) {
                $sorder = $sorder_sess ? $sorder_sess : NULL;
                $_POST['sorder'] = $sorder != 0 ? $sorder : NULL;
            }
            else {
                $sorder = NULL;
                $_POST['sorder'] = NULL;
            }   

            $order = $main->get_trans(0, $start, NUM_ROWS, $sorder, 0, $status, $type, $datefrom, $dateto);	
            $ordercount = $main->get_trans(0, 0, 0, $sorder, 1, $status, $type, $datefrom, $dateto);
            $pages = $main->pagination("order", $ordercount, NUM_ROWS, 9);  
            
            //var_dump($datefrom.' '.$dateto);
            
            
            if($order) : ?>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                  <th width="10%">Order ID</th>
                                  <th width="40%">Orders</th>
                                  <th width="30%">Customer Info</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($order as $key => $value) : ?>
                                <?php $orderuser = $main->get_user($value['trans_uid']); ?>
                                <?php $orderuser2 = $main->get_user($value['trans_user']); ?> 
                                <?php $order_data = unserialize($value['trans_order']); ?>
                                <tr>
                                  <td><?php echo $value['trans_id']; ?></td>
                                  <td class="smalltxt">
                                      <?php $item_total = 0; ?>
                                      <?php foreach($order_data as $v) : ?>
                                        <div class="fdata">
                                            <div class="fdataleft"><b><?php echo $v['quantity']; ?> x <?php echo $v['name']; ?></b><?php echo $v['quantity'] > 1 ? '<br><i>P '.number_format($v['price']).' per unit</i>' : ''; ?></div>
                                            <div class="fdataright valigntop">P <?php echo number_format($v['price'] * $v['quantity'], 2); ?></div>
                                        </div>
                                        <?php $item_total = $item_total + ($v['price'] * $v['quantity']); ?>
                                      <?php endforeach; ?>
                                      <div class="fdata topborder1">
                                        <div class="fdataleft bold">Total</div>
                                        <div class="fdataright bold">P <?php echo number_format($item_total, 2); ?></div>
                                      </div>
                                  </td>
                                  <td class="smalltxt">
                                        <div class="fdata lefttalign"><b>Customer Name:</b> <?php echo $orderuser[0]['user_firstname'].' '.$orderuser[0]['user_lastname']; ?></div>
                                        <div class="fdata lefttalign"><b>E-mail Address:</b> <?php echo $orderuser[0]['user_email']; ?></div>
                                        <div class="fdata lefttalign"><b>Will pickup/receive by:</b> <?php echo $value['trans_fname']; ?></div>
                                        <div class="fdata lefttalign"><b>Mobile No.:</b> <?php echo $value['trans_mobile']; ?></div>
                                        <div class="fdata lefttalign"><b>Address:</b> <?php echo $value['trans_address']; ?></div>
                                        <div class="fdata lefttalign"><b>Instruction/Remark:</b> <?php echo $value['trans_uremark']; ?></div>
                                        <div class="fdata lefttalign"><b>Date/Time:</b> <?php echo date('F j, Y | g:ia', $value['trans_date']); ?></div>
                                  </td>
                                  <td id="tdupdate<?php echo $value['trans_id']; ?>">
                                        <?php echo date('M j, Y | g:ia', ($value['trans_update'] ? $value['trans_update'] : $value['trans_date'])); ?> by <?php echo $value['trans_user'] ? $orderuser2[0]['user_firstname']." ".$orderuser2[0]['user_lastname'] : $orderuser[0]['user_firstname']." ".$orderuser[0]['user_lastname']; ?>
                                  </td>
                                  <td>
                                      <?php 
                                        if ($value['trans_paytype'] == 1) :
                                            $order_array = $order_status2;  
                                        else :
                                            $order_array = $order_status;
                                        endif;
                                      ?>
                                      <select id="trans_status<?php echo $value['trans_id']; ?>" name="trans_status" attribute="<?php echo $value['trans_id']; ?>" class="trans_status">
                                          <?php foreach ($order_array as $k1 => $v1) : ?>
                                          <option value="<?php echo $k1; ?>"<?php echo $k1 == $value['trans_status'] ? ' selected' : ''; ?>><?php echo $v1[0]; ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Order ID</th>
                                  <th width="40%">Orders</th>
                                  <th width="30%">Customer Info</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                </tr>
                                <tr>
                                  <td colspan="4" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No order has been made</div>
                              </tr>
                            <?php endif; ?>
                            <input id="trans_user" type="hidden" name="trans_user" value="<?php echo $profile_id; ?>" />
                            <input id="opage" type="hidden" name="opage" value="<?php echo $page; ?>" />
                            <input id="ostatus" type="hidden" name="ostatus" value="<?php echo $stat; ?>" />
                            <input id="otype" type="hidden" name="otype" value="<?php echo $type; ?>" />  
                            <input id="odfrom" type="hidden" name="odfrom" value="<?php echo $datefrom; ?>" />  
                            <input id="odto" type="hidden" name="odto" value="<?php echo $dateto; ?>" />  
                            <?php
        break;
        
        
    }            
	
?>