	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        <div class="maincontainer">
                        
                            <div class="titlecontainer marginbottom25 hugetext bold"><?php echo strtoupper($career_content[0]['content_title']); ?></div>
                            
                            <?php if ($id) : ?>
                            
                                <div class="cmaincontainer">

                                    <div id="acareer" class="acareer lefttalign">
                                        <form>
                                        <div id="ainfo" class="ainfo">
                                            <div class="margintop10">You're applying for <b><?php echo $career[0]['career_name']; ?></b></div>
                                            <div class="margintop10 width500">
                                                <table class="tdataform width100per">
                                                    <tr>
                                                        <td><input id="txtcname" type="text" name="txtcname" value="<?php echo $_POST['txtcname']; ?>" placeholder="Name" class="txtbox width300" /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input id="txtcemail" type="text" name="txtcemail" value="<?php echo $_POST['txtcemail']; ?>" placeholder="E-mail Address" class="txtbox width300" /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea id="txtcmsg" name="txtcmsg" rows="8" placeholder="Message" class="txtarea"><?php echo $_POST['txtcmsg']; ?></textarea> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Porfolio, if any? <input id="txtcfile" type="file" name="txtcfile" class="txtbox" /></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="ainfo" class="ainfo">
                                            <button id="btnjsub" type="submit" name="btnjsub" class="redbtn clearboth margintop20"><i class="fa fa-send"></i> Submit</button>
                                            <button id="btnjback" name="btnback" class="redbtn clearboth margintop20"><i class="fa fa-arrow-left"></i> Back to Career List</button>
                                        </div>
                                        </form>
                                    </div>

                                </div>
                            
                            <?php else : ?>
                            
                                <div class="cmaincontainer">

                                    <?php if ($career_data) : ?>
                                        <?php foreach ($career_data as $key => $value) : ?>
                                        <div id="jitem<?php echo $value['career_id']; ?>" class="jitem">
                                            <div class="front">
                                                <div>
                                                    <span class="cattext2 bold"><?php echo $value['career_name']; ?></span>
                                                </div>
                                            </div>
                                            <div class="back">
                                                <div class="jreq"><?php echo $value['career_requirement']; ?></div>
                                                <div class="centertalign">
                                                    <button attribute="<?php echo $value['career_id']; ?>" attribute2="<?php echo urlencode(strtolower($value['career_name'])); ?>" class="btnjview redbtn marginlrauto"><i class="fa fa-pencil"></i> Apply NOW</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="centertalign margintopbot100 cattext">No jobs has been posted</div>
                                    <?php endif; ?>

                                    <?php echo $career_content[0]['content_text']; ?>

                                </div>

                            <?php endif; ?>
                            
                            
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>