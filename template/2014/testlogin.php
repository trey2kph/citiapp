	<?php include(TEMP."/header2.php"); ?>

    <!-- BODY -->

                    <div class="centertalign">
                        <div id="frmlogin">
                        <table class="margintop100 centertalign vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td id="errortd"></td>
                            </tr>
                            <tr>
                                <td><div class="straightbox underborder centermargin"><input type="text" id="username" name="username" autocomplete="off" placeholder="Employee ID" /></div></td>
                            </tr>
                            <tr>
                                <td><div class="straightbox underborder centermargin"><input type="password" id="password" name="password" autocomplete="off" placeholder="Password" /></div></td>
                            </tr>
                            <tr>                            
                                <td><input type="submit" name="btnlogin" id="btnlogin" value="LOGIN" class="bigbtn" /></td>
                            </tr>
                            <tr>                            
                                <td><a href ="<?php echo WEB; ?>/forgot">Cannot Access?</a></td>
                            </tr>
                            <tr>                            
                                <td>
                                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>

    <?php include(TEMP."/footer2.php"); ?>