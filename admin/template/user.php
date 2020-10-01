<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$userall) : ?>
        <?php 
        ?>

        <div id="userdata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmuser" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user_lastname" class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-7">
                                        <input id="user_lastname" type="text" name="user_lastname" value="<?php echo $user[0]['user_lastname']; ?>" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_firstname" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-7">
                                        <input id="user_firstname" type="text" name="user_firstname" value="<?php echo $user[0]['user_firstname']; ?>" class="form-control" placeholder="First Name">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_middlename" class="col-sm-3 control-label">Middle Name</label>
                                    <div class="col-sm-7">
                                        <input id="user_middlename" type="text" name="user_middlename" value="<?php echo $user[0]['user_middlename']; ?>" class="form-control" placeholder="Middle Name">
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label for="user_type" class="col-sm-3 control-label">Type</label>
                                    <div class="col-sm-7">
                                        <select id="user_type" name="user_type" class="form-control">
                                            <option value="0">Choose type...</option>
                                            <?php foreach ($user_typeval as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"<?php echo $user[0]['user_type'] == $key ? ' selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_address" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-7">
                                        <textarea id="user_address" name="user_address" rows="5" class="col-sm-12"><?php echo $user[0]['user_address']; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_city" class="col-sm-3 control-label">City</label>
                                    <div class="col-sm-7">
                                        <input id="user_city" type="text" name="user_city" value="<?php echo $user[0]['user_city']; ?>" class="form-control" placeholder="City">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_zip" class="col-sm-3 control-label">ZIP Code</label>
                                    <div class="col-sm-3">
                                        <input id="user_zip" type="text" name="user_zip" value="<?php echo $user[0]['user_zip']; ?>" class="form-control" placeholder="ZIP Code">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_nationality" class="col-sm-3 control-label">Nationality</label>
                                    <div class="col-sm-7">
                                        <select id="user_nationality" name="user_nationality" class="form-control">
                                            <option value="0">Choose nationality...</option>
                                            <?php foreach ($nationals as $value) : ?>
                                            <option value="<?php echo $value; ?>"<?php echo $user[0]['user_nationality'] == $value ? ' selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_cstatus" class="col-sm-3 control-label">Civil Status</label>
                                    <div class="col-sm-7">
                                        <select id="user_cstatus" name="user_cstatus" class="form-control">
                                            <option value="0">Choose status...</option>
                                            <?php foreach ($civil_status as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"<?php echo $user[0]['user_cstatus'] == $key ? ' selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="user_telno" class="col-sm-3 control-label">Telephone Number</label>
                                    <div class="col-sm-7">
                                        <input id="user_telno" type="text" name="user_telno" value="<?php echo $user[0]['user_telno']; ?>" class="form-control" placeholder="Telephone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_mobile" class="col-sm-3 control-label">Email Address</label>
                                    <div class="col-sm-7">
                                        <input id="user_mobile" type="text" name="user_mobile" value="<?php echo $user[0]['user_mobile']; ?>" class="form-control" placeholder="Mobile Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_password" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-7">
                                        <input id="user_password" type="text" name="user_password" value="<?php echo $user[0]['user_password']; ?>" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_subscribe" class="col-sm-3 control-label">Subscribe</label>
                                    <div class="col-sm-7">
                                        <input id="user_subscribe" type="checkbox" name="user_subscribe" value="1"<?php echo $user[0]['user_subscribe'] ? ' checked' : ''; ?> class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_refer" class="col-sm-3 control-label">Refer</label>
                                    <div class="col-sm-7">
                                        <select id="user_refer" name="user_refer" class="form-control">
                                            <option value="0">Choose refer...</option>
                                            <?php foreach ($refer_value as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"<?php echo $user[0]['user_refer'] == $key ? ' selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="user_likes" class="col-sm-3 control-label">Interests</label>
                                    <div class="col-sm-7">
                                        <textarea id="user_likes" name="user_likes" rows="6" class="col-sm-12"><?php echo $user[0]['user_likes']; ?></textarea>
                                    </div>
                                </div> 
                            </div>
                            <span id="user_title"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="user_id" type="hidden" name="user_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="user_user" type="hidden" name="user_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btnuser" type="submit" name="btnuser" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="userlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="suser" type="text" name="suser" value="<?php echo $suser; ?>" class="form-control" placeholder="Search user..." style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body userlist">
                              <?php if($user) : ?>
                              <a href="<?php echo WEB; ?>/user?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">User ID</th>
                                  <th width="25%">Fullname</th>
                                  <th width="20%">Type</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($user as $key => $value) : ?>
                                <?php $useruser = $main->get_user($value['user_user']); ?> 
                                <tr>
                                  <td><?php echo $value['user_id']; ?></td>
                                  <td><?php echo $value['user_firstname'].' '.$value['user_lastname']; ?></td>
                                  <td><?php echo $user_type[$value['user_type']]; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['user_update'] ? $value['user_update'] : $value['user_date'])); ?> by <?php echo $value['user_user'] ? $useruser[0]['user_firstname']." ".$useruser[0]['user_lastname'] : 'user registration'; ?></td>    
                                  <td id="status<?php echo $value['user_id']; ?>"><?php if ($value['user_type'] != 9) : ?><button type="button" attribute="<?php echo $value['user_id']; ?>" attribute2="user" class="btn btndeactivate btn-success<?php echo $value['user_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['user_id']; ?>" attribute2="user" class="btn btnactivate btn-danger<?php echo $value['user_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button><?php endif; ?></td>
                                  <td><?php if ($value['user_type'] != 9) : ?><a href="<?php echo WEB; ?>/user?id=<?php echo $value['user_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['user_id']; ?>" class="btn btndeluser btn-danger">Delete</button><?php endif; ?></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">User ID</th>
                                  <th width="25%">Name</th>
                                  <th width="20%">Alias</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="6" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No user has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add User</button></a><?php endif; ?></div>
                              </tr>
                              <?php endif; ?>   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        
        </div>

        <?php endif; ?>
<?php include(TEMP."/footer.php"); ?>