	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        
                        <?php if ($id) : ?>
                        
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/uploads/promo/<?php echo $promo[0]['promo_largeimg']; ?>" />
                        </div>
                        
                        <?php else : ?>
                        
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        
                        <?php endif; ?>
                        
                        <div class="maincontainer">
                        
                            <div class="titlecontainer marginbottom25 hugetext bold"><?php echo strtoupper($promo_content[0]['content_title']); ?></div>
                            
                            <?php if ($id) : ?>
                            
                                <div class="cmaincontainer">

                                    <div id="apromo" class="apromo">
                                        <div id="ainfo" class="ainfo">
                                            <div class="bold titletext margintop10"><?php echo $promo[0]['promo_title']; ?></div>
                                            <div class="margintop10"><?php echo $promo[0]['promo_desc']; ?></div>
                                        </div>
                                        <?php if ($promo[0]['promo_mechanics']) : ?>
                                        <div id="ainfoadd" class="ainfoadd margintop45">
                                            <div class="bold mediumtext marginbottom25">Mechanics</div>
                                            <div class="aspecs">
                                                <?php echo $promo[0]['promo_mechanics']; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div id="ainfo" class="ainfo">
                                            <button id="btnpback" name="btnback" class="redbtn clearboth margintop45"><i class="fa fa-arrow-left"></i> Back to Promo List</button>
                                        </div>
                                    </div>

                                </div>
                            
                            <?php else : ?>
                            
                                
                                <div id="promdata" class="cmaincontainer">
                                    
                                    <div class="marginbottom45"><?php echo $promo_content[0]['content_text']; ?></div>
                                    
                                    <?php if ($promo) : ?>
                                    
                                    <div class="promcontainer">
                                    <?php if ($sprom) : ?>
                                    <div class="marginbottom25">Search result for <button id="btndelsprod" class="smlbtn"><?php echo $sprom; ?> <i class="fa fa-times"></i></button></div>
                                    <?php endif; ?>
                                    <?php foreach ($promo as $key => $value) : ?>
                                    <div id="pitem<?php echo $value['promo_id']; ?>" class="pitem">
                                        <div class="front">
                                            <div>
                                                <img src="<?php echo WEB; ?>/uploads/promo/<?php echo $value['promo_smallimg']; ?>" class="width100per" />
                                                <div id="pinfo" class="pinfo">
                                                    <div class="bold mediumtext margintop20"><?php echo $value['promo_title']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="back">
                                            <div>
                                                <div class="margintop10"><?php echo $mainsql->truncate($value['promo_desc'], 200); ?></div>
                                                <div class="centertalign">
                                                <button attribute="<?php echo $value['promo_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['promo_title'])); ?>" class="btnpview redbtn marginlrauto"><i class="fa fa-eye"></i> View this Promo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php if ($pages) : ?>
                                    <div class="centertalign margintop25"><?php echo $pages; ?></div>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <div class="centertalign margintopbot100 cattext">No promo listed</div>
                                    <?php endif; ?>
                                </div>
                            
                            <?php endif; ?>
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>