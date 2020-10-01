<?php include(TEMP."/header.php"); ?>

        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $process_count; ?></h3>

                  <p>Processing</p>
                </div>
                <div class="icon">
                  <i class="fas fa-sync-alt"></i>
                </div>
                <a href="<?php echo WEB; ?>/order/2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $ship_count; ?></h3>

                  <p>Shipping</p>
                </div>
                <div class="icon">
                  <i class="fas fa-ship"></i>
                </div>
                <a href="<?php echo WEB; ?>/order/3" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $pickup_count; ?></h3>

                  <p>For Pickup</p>
                </div>
                <div class="icon">
                  <i class="fas fa-people-carry"></i>  
                </div>
                <a href="<?php echo WEB; ?>/order/4" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $done_count; ?></h3>

                  <p>Done</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check"></i>
                </div>
                <a href="<?php echo WEB; ?>/order/9" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div>

        <div id="orderlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="sorder" type="text" name="sorder" value="<?php echo $sorder; ?>" class="col-sm-3" placeholder="Search" style="width: 30%;" />&nbsp;&nbsp;&nbsp;<input id="datefrom" type="text" name="datefrom" value="01/01/2018" class="col-sm-3 datepick" style="width: 20%;" />&nbsp;<input id="dateto" type="text" name="dateto" value="<?php echo date('m/d/Y'); ?>" class="col-sm-3 datepick" style="width: 20%;" />&nbsp;<button id="btnprintorder" type="submit" name="btnprintorder" value="1" class="btn btn-primary">Print</button>
                            <div class="box-body orderlist">
                              <?php if($order) : ?>
                              <div class="table-responsive">
                                <table class="table no-margin">
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
                                      <b>Reference Number: </b><span id="orefnum<?php echo $value['trans_id']; ?>" attribute="<?php echo $value['trans_id']; ?>" class="orefnum cursorpoint"><?php echo $value['trans_refnum'] ? $value['trans_refnum'] : 'not set (click here to set)'; ?></span><input id="txtorefnum<?php echo $value['trans_id']; ?>" type="text" attribute="<?php echo $value['trans_id']; ?>" class="txtorefnum form-control input-sm invisible" />
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
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No order has been made</div>
                              </tr>
                              <?php endif; ?> 
                              <input id="trans_user" type="hidden" name="trans_user" value="<?php echo $profile_id; ?>" />
                              <input id="opage" type="hidden" name="opage" value="<?php echo $page; ?>" />
                              <input id="ostatus" type="hidden" name="ostatus" value="<?php echo $status; ?>" />
                              <input id="otype" type="hidden" name="otype" value="<?php echo $type; ?>" />  
                              <input id="odfrom" type="hidden" name="odfrom" value="0" />  
                              <input id="odto" type="hidden" name="odto" value="0" />  
                            </div>
                    </div>
                </div>
            </div>
        
        
        </div>

<?php include(TEMP."/footer.php"); ?>