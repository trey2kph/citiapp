	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->

                    <div id="floatdiv" class="floatdiv invisible">          
                        <!-- ADD/EDIT USER - BEGIN --> 
                        <div id="fedit" class="fedit invisible">
                            <div class="closebutton cursorpoint"><i class="fa fa-times-circle fa-3x redtext"></i></div>
                            <div id="edit_title" class="robotobold cattext dbluetext"><span id="etitle"></span> User</div>
                            <table class="tdataform2 rightmargin margintop10 valigntop vsmalltext" width="100%" border="0" cellpadding="0" cellspacing="0">                    
                                <form name="edit_user" id="edit_user" action="?ignore-page-cache=true" method="POST" enctype="multipart/form-data" class="addform">          
                                <tr>
                                    <td width="35%">Employee ID</td>
                                    <td width="65%"><input type="text" name="user_empnum" id="user_empnum" class="txtbox width300" /></td>
                                </tr>
                                <tr>
                                    <td width="35%">Name</td>
                                    <td width="65%"><input type="text" name="user_fullname" id="user_fullname" class="txtbox width300" /></td>
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td>
                                        <select id="user_level" name="user_level" class="txtbox">
                                            <option value="0" selected>Select type...</option>
                                            <option value="1">Requestor</option>
                                            <option value="2">Approver</option>
                                            <option value="6">Report Viewer</option>
                                            <option value="7">Request Viewer</option>
                                            <option value="8">Admin Head</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td>
                                        <select id="user_dept" name="user_dept" class="txtbox width300">
                                        <?php foreach ($dept_data as $key => $value) : ?>
                                            <option value="<?php echo $value['dept_id'] ?>"><?php echo $value['dept_name'] ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="tdapp">
                                    <td>Approver</td>
                                    <td>
                                        <select id="user_approver" name="user_approver" class="txtbox">
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">Email Address</td>
                                    <td width="65%"><input type="text" name="user_email" id="user_email" class="txtbox width300" /></td>
                                </tr>
                                <tr>
                                    <td width="35%">Contact Number</td>
                                    <td width="65%"><input type="text" name="user_telno" id="user_telno" class="txtbox width300" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" name="btnusersave" id="btnusersave" value="Save" class="btn btnsave" />
                                        <input type="hidden" name="user_id" id="user_id" />
                                        <input type="hidden" name="pagenum" id="pagenum" value="<?php echo $_GET['page'] ? $_GET['page'] : 1; ?>" />
                                    </td>
                                </tr>
                                </form>
                                
                            </table>
                        </div>
                        <!-- ADD/EDIT USER - END -->                                            
                    </div>

                    <div id="addnow" att="new" class="floatmainbutton cursorpoint"><i class="fa fa-plus whitetext mediumtext"></i></div>

                    <div class="roboto bold cattext dbluetext padding20">User Management</div>

                        <?php if ($user_data) : ?>   
                        <table class="searchdiv width98per">
                            <tr>
                                <td>
                                    Search &nbsp;<input type="text" id="searchusr" name="searchusr" value="<?php echo $searchusr; ?>" placeholder="by name" class="width200 smltxtbox datepicker" />&nbsp;
                                    <input type="button" id="btnsearchusr" name="btnsearchusr" value="Search" class="btn" />                                    
                                    <input type="button" id="btnusrall" name="btnusrall" value="View All" class="btn<?php echo $_SESSION['searchusr'] ? '' : ' invisible'; ?>" />
                                    <!--input type="button" name="btnsendpasswordtoall" value="Send Password to All" class="btn btnsendpasswordtoall" /-->  

                                </td>
                            </tr>
                        </table>

                        <div id="user_table">                     
                            <div id="dashboard_desktop">
                            <table id="tuser" class="tdata width98per">
                                <tr>
                                    <th width="10%">User ID</th>
                                    <th width="25%">Name</th>
                                    <th width="20%">Department</th>
                                    <th width="20%">Email Address</th>
                                    <th width="10%">Status</th>
                                    <th width="15%" colspan="3">Manage</th>
                                </tr>
                                <?php foreach ($user_data as $key => $value) : ?>
                                <?php $dept_info = $mainsql->get_dept($value['user_dept']); ?>
                                <tr>
                                    <td><?php echo $value['user_id']; ?></td>
                                    <td><b><?php echo $value['user_fullname']; ?></b><br><?php echo $value['user_empnum']; ?></td>
                                    <td><?php echo $dept_info[0]['dept_name']; ?></td>
                                    <td><?php echo $value['user_email']; ?></td>
                                    <td class="ustatusDiv<?php echo $value['user_id']; ?> centertalign"><?php echo $value['user_status'] == 2 ? "<i class='approveUser fa fa-unlock-alt fa-lg greentext cursorpoint' attribute='".$value['user_id']."' attribute2='2'></i>" : "<i class='approveUser fa fa-lock fa-lg redtext cursorpoint' attribute='".$value['user_id']."' attribute2='1'></i>"; ?></td>
                                    <td class="centertalign"><i title="Send Password" attribute="<?php echo $value['user_id']; ?>" attribute2="<?php echo $value['user_email']; ?>" class="btnsendpassword fa fa-key cursorpoint greentext"></i></td>
                                    <td class="centertalign"><?php if ($value['user_id'] != 1 && $value['user_id'] != 5) : ?><i title="Edit" attribute="<?php echo $value['user_id']; ?>" class="btnedituser fa fa-pencil-square-o cursorpoint greentext"></i><?php endif; ?></td>
                                    <td class="centertalign"><?php if ($value['user_id'] != 1 && $value['user_id'] != 5) : ?><i title="Delete" attribute="<?php echo $value['user_id']; ?>" class="btndeluser fa fa-trash-o cursorpoint redtext"></i><?php endif; ?></td>
                                </tr>                            
                                <?php endforeach; ?>
                                <?php if ($pages) : ?>
                                <tr>
                                    <td colspan="8" class="centertalign whitebg"><?php echo $pages; ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                            </div>
                            <div id="dashboard_mobile">                        
                                <?php foreach ($user_data as $key => $value) : ?>
                                <?php $dept_info = $mainsql->get_dept($value['user_dept']); ?>
                                <div class="dashcard lgraybg centertalign">
                                    <div>
                                        <b>Name:</b> <?php echo $value['user_fullname']; ?><br>
                                        <b>Employee ID:</b> <?php echo $value['user_empnum']; ?><br>
                                        <b>Contact No.:</b> <?php echo $value['user_telno']; ?><br>        
                                        <b>Department:</b> <?php echo $dept_info[0]['dept_name']; ?><br>
                                        <button attribute="<?php echo $value['user_id']; ?>" class="btnedituser btn margintop10 centertalign">Edit</button>&nbsp;
                                        <button attribute="<?php echo $value['user_id']; ?>" class="btndeluser redbtn margintop10 centertalign">Delete</button>
                                    </div>
                                </div>                  
                                <?php endforeach; ?>
                            </div>
                        
                        </div>
                        <?php else : ?>
                            <div class="centertalign margintop100">No user has been listed</div>      
                        <?php endif; ?>
                        <input id="upage" type="hidden" name="upage" value="<?php echo $page ? $page : 1; ?>" />

    <?php include(TEMP."/footer.php"); ?>