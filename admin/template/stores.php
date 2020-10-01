<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$store) : ?>
        <?php $storehour = $store[0]['store_hour'] ? explode(' ', $store[0]['store_hour']) : NULL; ?>


        <div id="storedata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmstore" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            <span id="store_title"></span>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="store_name" class="col-sm-3 control-label">Store Name</label>
                                    <div class="col-sm-7">
                                        <input id="store_name" type="text" name="store_name" value="<?php echo $store[0]['store_name']; ?>" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_address" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-7">
                                        <textarea id="store_address" name="store_address" rows="5" placeholder="Address" class="col-sm-12"><?php echo $store[0]['store_address']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_province" class="col-sm-3 control-label">Province</label>
                                    <div class="col-sm-7">
                                        <select id="store_province" name="store_province" class="col-sm-9"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_city" class="col-sm-3 control-label">City</label>
                                    <div class="col-sm-7">
                                        <select id="store_city" name="store_city" class="col-sm-9"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_tel" class="col-sm-3 control-label">Store Contact Number</label>
                                    <div class="col-sm-7">
                                        <input id="store_tel" type="text" name="store_tel" value="<?php echo $store[0]['store_tel']; ?>" class="form-control" placeholder="Contact Numbers"> <i>* for multiple, separated by semicolon</i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_x" class="col-sm-3 control-label">Coordinates X</label>
                                    <div class="col-sm-7">
                                        <input id="store_x" type="text" name="store_x" value="<?php echo $store[0]['store_x']; ?>" placeholder="Latitude" class="col-sm-12" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_y" class="col-sm-3 control-label">Coordinates Y</label>
                                    <div class="col-sm-7">
                                        <input id="store_y" type="text" name="store_y" value="<?php echo $store[0]['store_y']; ?>" placeholder="Longitude" class="col-sm-12" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="store_hour1" class="col-sm-3 control-label">Store Hour</label>
                                    <div class="col-sm-7">
                                        <div class="col-sm-4 input-group bootstrap-timepicker timepick" style="display: inline-table; vertical-align: middle;">
                                          <input id="store_hour1" type="text" name="store_hour1" value="<?php echo $storehour ? $storehour[0].' '.$storehour[1] : '10:00 AM'; ?>" class="form-control input-small">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                        </div> 
                                        <div style="display: inline-table; vertical-align: middle;"> to </div>
                                        <div class="col-sm-4 input-group bootstrap-timepicker timepick" style="display: inline-table; vertical-align: middle;">
                                          <input id="store_hour2" type="text" name="store_hour2" value="<?php echo $storehour ? $storehour[2].' '.$storehour[3] : '06:00 PM'; ?>" class="form-control input-small">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-9">
                                    <input id="store_id" type="hidden" name="store_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="store_user" type="hidden" name="store_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <input id="store_page" type="hidden" name="store_page" value="<?php echo $page ? $page : 1; ?>">
                                    <button id="btnstore" type="submit" name="btnstore" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="storelist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="sstore" type="text" name="sstore" value="<?php echo $sstore; ?>" class="col-sm-3" placeholder="Search" style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body storelist">
                              <?php if($store) : ?>
                              <a href="<?php echo WEB; ?>/stores?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Store Location</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>                   
                                  <th width="5%">Store ID</th>  
                                  <th width="17%">Name</th>                       
                                  <th width="35%">Address</th>
                                  <th width="15%">Last Edited</th>  
                                  <th width="8%">Status</th>                                  
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($store as $key => $value) : ?>
                                <?php $storeuser = $main->get_user($value['store_user']); ?>  
                                <tr>
                                  <td><?php echo $value['store_id']; ?></td>
                                  <td><?php echo $value['store_name']; ?></td>
                                  <td><?php echo $value['store_address']; ?></td>
                                  <td><?php echo $value['store_update'] ? date('M j, Y | g:ia', $value['store_update']) : date('M j, Y | g:ia', $value['store_date']); ?> by <?php echo $storeuser[0]['user_firstname'].' '.$storeuser[0]['user_lastname']; ?></td>
                                  <td id="status<?php echo $value['store_id']; ?>"><button type="button" attribute="<?php echo $value['store_id']; ?>" attribute2="store" class="btn btndeactivate btn-success<?php echo $value['store_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['store_id']; ?>" attribute2="store" class="btn btnactivate btn-danger<?php echo $value['store_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/stores?id=<?php echo $value['store_id']; ?>&page=<?php echo $page; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['store_id']; ?>" class="btn btndelstore btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>                   
                                  <th width="5%">Store ID</th>  
                                  <th width="17%">Name</th>                       
                                  <th width="35%">Address</th>
                                  <th width="15%">Last Edited</th>  
                                  <th width="8%">Status</th>                                  
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
                                <div class="centertalign">No store has been listed</div>
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