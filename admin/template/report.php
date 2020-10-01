<?php
    $xlstext = '<table>';
    $xlstext .= '<tr valign="top"><th colspan="5">Order List from '.date("F j, Y", $datefrom).' to '.date("F j, Y", $dateto).'</th></tr>';
    $xlstext .= '<tr valign="top"><th>Order ID</th><th>Orders</th><th>Customer Info</th><th>Last Edited</th><th>Status</th></tr>';

    foreach ($report as $key => $value) :
        $item_total = 0;
        $item_val = '';
        $stat_val = '';
        $orderuser = $main->get_user($value['trans_uid']); 
        $orderuser2 = $main->get_user($value['trans_user']); 
        $order_data = unserialize($value['trans_order']);
        foreach($order_data as $v) : 
            $item_val .= $v['quantity'].' x '.$v['name'].''.($v['quantity'] > 1 ? '<br style="mso-data-placement:same-cell;" />P '.number_format($v['price']).' per unit' : '').'&nbsp;P '.number_format($v['price'] * $v['quantity'], 2).'<br style="mso-data-placement:same-cell;" />';
            $item_total = $item_total + ($v['price'] * $v['quantity']); 
        endforeach;
        $item_val .= 'Total: P '.number_format($item_total, 2);
        if ($value['trans_paytype'] == 1) :
            $order_array = $order_status2;  
        else :
            $order_array = $order_status;
        endif;
        foreach ($order_array as $k1 => $v1) : 
            $stat_val .= ($k1 == $value['trans_status'] ? $v1[0] : ''); 
        endforeach;

        $xlstext .= '<tr valign="top"><td>'.$value['trans_id'].'</td><td>Reference Number: '.($value['trans_refnum'] ? $value['trans_refnum'] : 'not set').'<br style="mso-data-placement:same-cell;" />'.$item_val.'</td><td>Customer Name: '.$orderuser[0]['user_firstname'].' '.$orderuser[0]['user_lastname'].'<br style="mso-data-placement:same-cell;" />E-mail Address: '.$orderuser[0]['user_email'].'<br style="mso-data-placement:same-cell;" />Will pickup/receive by: '.$value['trans_fname'].'<br style="mso-data-placement:same-cell;" />Mobile No.: '.$value['trans_mobile'].'<br style="mso-data-placement:same-cell;" />Address: '.$value['trans_address'].'<br style="mso-data-placement:same-cell;" />Instruction/Remark: '.$value['trans_uremark'].'<br style="mso-data-placement:same-cell;" />Date/Time: '.date('F j, Y | g:ia', $value['trans_date']).'</td><td>'.date('M j, Y | g:ia', ($value['trans_update'] ? $value['trans_update'] : $value['trans_date'])).' by '.($value['trans_user'] ? $orderuser2[0]['user_firstname']." ".$orderuser2[0]['user_lastname'] : $orderuser[0]['user_firstname']." ".$orderuser[0]['user_lastname']).'</td><td>'.$stat_val.'</td></tr>';
    endforeach;
    $xlstext .= '</table>';
    echo $xlstext;
?>