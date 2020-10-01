	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
    
            <div class="roboto bold cattext dbluetext padding20">Forgot Password</div>
            <div id="forgot">                    
                <div id="forgot_title"></div>
                <form name="formforget" method="post" enctype="multipart/form-data" class="margintop50">
                    <input type="text" name="empidnum" id="empidnum" class="txtbox width250" placeholder="Employee ID" />&nbsp;
                    <input type="submit" name="btnforgot" id="btnforgot" value="Reset and Send My New Password" class="btn" />&nbsp;
                    <a href="<?php echo WEB; ?>"><input type="button" name="btnforgotcancel" value="Cancel" class="redbtn" /></a>
                </form>   

            </div>

    <?php include(TEMP."/footer.php"); ?>