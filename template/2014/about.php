	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        <div class="maincontainer">
                        
                            <div class="titlecontainer marginbottom25 hugetext bold"><?php echo strtoupper($about_content[0]['content_title']); ?></div>
                            
                            <div class="cmaincontainer divwording lefttalign">
                            
                                <?php echo $about_content[0]['content_text']; ?>
                            
                            </div>
                            
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>