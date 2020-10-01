	<?php include(TEMP."/header.php"); ?>

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
                                    <fb:login-button 
                                        scope="public_profile,email"
                                        onlogin="checkLoginState();">
                                    </fb:login-button>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>

    <?php include(TEMP."/footer.php"); ?>