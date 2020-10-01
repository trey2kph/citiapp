	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
    
            <div class="roboto bold cattext dbluetext padding20">Change Password</div>
            
            <div id="fpass">                    
                <div id="fpass_title" class="robotobold cattext dbluetext"></div>
                <i>* To update your password, please fill up textbox below</i>
                <form name="formupass" method="post" enctype="multipart/form-data">
                    <div class="divpass">
                        <input type="hidden" name="empnum" value="<?php echo $profile_idnum; ?>" />
                        <input type="password" name="opassword" size="20" id="opassword" placeholder="Old Password" class="txtbox width250" />
                    </div>
                    <div class="divpass">
                        <input type="password" name="npassword" size="20" id="npassword" placeholder="New Password" class="txtbox width250" />
                    </div>
                    <div class="divpass">
                        <input type="password" name="cpassword" size="20" id="cpassword" placeholder="Confirm New Password" class="txtbox width250" />
                    </div>
                    <div align="center">
                        <br><input type="submit" class="btn" value="Update My Password">
                    </div>
                </form>

            </div>

    <?php include(TEMP."/footer.php"); ?>