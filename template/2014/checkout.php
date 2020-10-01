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
                                    <div class="cobody">
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
                                        
                                    </div>
                                </div>
                            </div>
                            <div id="coform" class="cormaincontainer">
                                <form name="chkout_prod" id="chkout_prod" action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="fdata">
                                        <div class="formdataleft bold valigntop">E-mail Address</div>
                                        <div class="formdataright"><input id="txtcoemail" type="text" name="txtcoemail" value="<?php echo $profile_email; ?>" class="txtbox width70per" readonly /></div>
                                    </div>
                                    <div class="fdata">
                                        <div id="recdiv" class="formdataleft bold valigntop">Who will receive the order?</div>
                                        <div class="formdataright"><input id="txtconame" type="text" name="txtconame" value="<?php echo $profile_full; ?>" placeholder="Full Name..." class="txtbox width70per" /></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold">&nbsp;</div>
                                        <div class="formdataright"><input id="txtcomobile" type="text" name="txtcomobile" value="<?php echo $profile_mobile; ?>" placeholder="Mobile Number..." class="txtbox width70per" /></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold">&nbsp;</div>
                                        <div class="formdataright"><select id="txtprovince" name="txtprovince" class="txtbox width70per"></select></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold">&nbsp;</div>
                                        <div class="formdataright"><select id="txtcity" name="txtcity" class="txtbox width70per"></select></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold">&nbsp;</div>
                                        <div class="formdataright"><textarea id="txtcoaddress" name="txtcoaddress" rows="5" placeholder="Street Address" class="txtarea"><?php echo $profile_address; ?></textarea></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold valigntop">Instructions</div>
                                        <div class="formdataright"><textarea id="txtcoinstruct" name="txtcoinstruct" rows="10" placeholder="Instructions and Remarks" class="txtarea"></textarea></div>
                                    </div>
                                    <div class="fdata">
                                        <div class="formdataleft bold valigntop">Payment Method</div>
                                        <div class="formdataright">
                                            <select id="txtcoptype" name="txtcoptype" class="txtbox width70per">
                                                <option value="0">Select payment method...</option>
                                                <?php foreach ($payment_type as $key => $value) : ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="chkout_title" class="robotobold cattext redtext marginbottom20"></div>
                                    <div class="fdata margintop30">
                                        <button name="btncoproceed" type="submit" value="1" class="btncoproceed redbtn"><i class="fa fa-check"></i> Continue</button>
                                    </div>
                                        
                                </form>    
                            </div>
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>