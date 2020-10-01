	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        <div class="maincontainer">
                        
                            <div class="titlecontainer marginbottom25 hugetext bold"><?php echo $page_title; ?></div>
                            
                            <div class="colmaincontainer">
                                <div class="filter">
                                    <div class="filterhead">Order Summary</div>
                                    <div id="divodetail" class="cobody">
                                        <div class="fdata marginbottom30"><b>Order ID:</b> <?php echo $order_data[0]['trans_id']; ?></div>
                                        <?php
                                            $item_total = 0;
            
                                            foreach ($cart_data as $value) : ?>
                                                <div class="fdata">
                                                    <div attribute="<?php echo $value['id']; ?>" attribute2="<?php echo urlencode(strtolower($value['name'])); ?>" class="btnview cursorpoint fdataleft"><b><?php echo $value['quantity']; ?> x <?php echo $value['name']; ?></b><?php echo $value['quantity'] > 1 ? '<br><i>P '.number_format($value['price']).' per unit</i>' : ''; ?></div>
                                                    <div class="fdataright valigntop">P <?php echo number_format($value['price'] * $value['quantity'], 2); ?></div>
                                                </div>
                                                <?php $item_total = $item_total + ($value['price'] * $value['quantity']); ?>
                                            <?php endforeach; ?>

                                            <div class="fdata topborder1">
                                                <div class="fdataleft bold">Total</div>
                                                <div class="fdataright bold">P <?php echo number_format($item_total, 2); ?></div>
                                            </div>
                                        <div class="fdata lefttalign margintop30"><b>Will pickup/receive by:</b> <?php echo $order_data[0]['trans_fname']; ?></div>
                                        <div class="fdata lefttalign"><b>Mobile No.:</b> <?php echo $order_data[0]['trans_mobile']; ?></div>
                                        <div class="fdata lefttalign"><b>Address:</b> <?php echo $order_data[0]['trans_address']; ?></div>
                                        <div class="fdata lefttalign"><b>Instruction/Remark:</b> <?php echo $order_data[0]['trans_uremark']; ?></div>
                                        <div class="fdata lefttalign"><b>Date/Time:</b> <?php echo date('F j, Y | g:ia', $order_data[0]['trans_date']); ?></div>
                                        <div class="fdata lefttalign"><b>Payment Type:</b> <?php echo $payment_type[$order_data[0]['trans_paytype']]; ?></div>
                                        <?php 
                                        if ($order_data[0]['trans_paytype'] == 1) :
                                            $order_array = $order_status2;  
                                        else :
                                            $order_array = $order_status;
                                        endif;
                                        ?>
                                        <div class="fdata valigntop centertalign"><div class='statbarbig <?php echo $order_array[$order_data[0]['trans_status']][1]; ?>'><?php echo $order_array[$order_data[0]['trans_status']][0]; ?></div></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div id="divorder" class="cormaincontainer">
                                
                                <?php if ($order_data) : ?>
                                    <div class="fdata bottomborder1">
                                        <div class="fdata20 centertalign valigntop bold">Order ID</div>
                                        <div class="fdata20 centertalign valigntop bold">Price</div>
                                        <div class="fdata20 centertalign valigntop bold">Date</div>
                                        <div class="fdata20 centertalign valigntop bold">Status</div>
                                        <div class="fdata16 centertalign valigntop bold">View</div>
                                    </div>

                                    <?php foreach ($order_data as $key => $value) : ?>
                                        <div class="fdata">
                                            <div class="fdata20 valigntop lefttalign"><?php echo $value['trans_id']; ?></div>
                                            <div class="fdata20 valigntop lefttalign">P <?php echo number_format($value['trans_price'], 2); ?></div>
                                            <div class="fdata20 valigntop lefttalign"><?php echo date('F j, Y', $value['trans_date']); ?></div>
                                            <?php 
                                            if ($value['trans_paytype'] == 1) :
                                                $order_array = $order_status2;  
                                            else :
                                                $order_array = $order_status;
                                            endif;
                                            ?>
                                            <div class="fdata20 valigntop centertalign"><div class='statbar <?php echo $order_array[$value['trans_status']][1]; ?>'><?php echo $order_array[$value['trans_status']][0]; ?></div></div>
                                            <div class="fdata16 valigntop centertalign"><i attribute="<?php echo $value['trans_id']; ?>" class="btnvieworder fa fa-eye cursorpoint"></i></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                            </div>
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>