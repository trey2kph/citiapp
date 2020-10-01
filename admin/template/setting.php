<?php include(TEMP."/header.php"); ?>

        <?php if ($id) : ?>

        <div id="settingdata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmsetting" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="setting_name" class="col-sm-3 control-label">Variable</label>
                                    <div class="col-sm-7">
                                        <?php echo $setting[0]['set_var']; ?>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="setting_logo" class="col-sm-3 control-label">Value</label>
                                    <div class="col-sm-3">
                                        <textarea id="set_val" name="set_val" cols="200" rows="5" class="form-control" placeholder="Value"><?php echo $setting[0]['set_val']; ?></textarea>
                                    </div>
                                </div> 
                            </div>
                            <span id="setting_title"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="set_id" type="hidden" name="set_id" value="<?php echo $id; ?>">
                                    <button id="btnsetting" type="submit" name="btnsetting" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="settinglist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form role="form">
                            <div class="box-body settinglist">
                              <?php if($setting) : ?>
                              
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">ID</th>
                                  <th width="35%">Variable</th>
                                  <th width="35%">Value</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($setting as $key => $value) : ?>
                                <tr>
                                  <td><?php echo $value['set_id']; ?></td>
                                  <td><?php echo $value['set_var']; ?></td>
                                  <td><?php echo $value['set_val']; ?></td>
                                  <td><a href="<?php echo WEB; ?>/setting?id=<?php echo $value['set_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">ID</th>
                                  <th width="35%">Variable</th>
                                  <th width="35%">Value</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No setting has been listed</div>
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