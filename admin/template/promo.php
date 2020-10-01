<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$promoall) : ?>
        <?php 
        ?>

        <div id="promodata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmpromo" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="promo_title" class="col-sm-3 control-label">Promo Title *</label>
                                    <div class="col-sm-7">
                                        <input id="promo_title" type="text" name="promo_title" value="<?php echo $promo[0]['promo_title']; ?>" class="form-control" placeholder="Promo Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="promo_desc" class="col-sm-3 control-label">Description *</label>
                                    <div class="col-sm-7">
                                        <textarea id="promo_desc" rows="5" name="promo_desc" class="col-sm-12"><?php echo $promo[0]['promo_desc']; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="promo_mechanic" class="col-sm-3 control-label">Mechanics</label>
                                    <div class="col-sm-7">
                                        <textarea id="promo_mechanic" rows="8" name="promo_mechanic" class="textarea col-sm-12"><?php echo $promo[0]['promo_mechanic']; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="promo_smallimg" class="col-sm-3 control-label">Small Image</label>
                                    <div class="col-sm-3">
                                        <input id="promo_smallimg" type="file" name="promo_smallimg" /><br><i>* recommended size is 300px x 150px</i>
                                    </div>
                                </div>
                                <div class="form-group<?php if (!$promo[0]['promo_smallimg']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-7">
                                        <img id="prmsimg" name="prmsimg" src="<?php echo SROOT; ?>/uploads/promo/<?php echo $promo[0]['promo_smallimg']; ?>" class="spromosqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="promo_largeimg" class="col-sm-3 control-label">Large Image</label>
                                    <div class="col-sm-3">
                                        <input id="promo_largeimg" type="file" name="promo_largeimg" /><br><i>* recommended size is 1100px x 271px</i>
                                    </div>
                                </div>
                                <div class="form-group<?php if (!$promo[0]['promo_largeimg']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-7">
                                        <img id="prmlimg" name="prmlimg" src="<?php echo SROOT; ?>/uploads/promo/<?php echo $promo[0]['promo_largeimg']; ?>" class="lpromosqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="promo_hugeimg" class="col-sm-3 control-label">Huge Image</label>
                                    <div class="col-sm-3">
                                        <input id="promo_hugeimg" type="file" name="promo_hugeimg" /><br><i>* recommended size is 1100px x 620px</i>
                                    </div>
                                </div>
                                <div class="form-group<?php if (!$promo[0]['promo_hugeimg']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-7">
                                        <img id="prmhimg" name="prmhimg" src="<?php echo SROOT; ?>/uploads/promo/<?php echo $promo[0]['promo_hugeimg']; ?>" class="hpromosqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="promo_type" class="col-sm-3 control-label">Type *</label>
                                    <div class="col-sm-3">
                                        <select id="promo_type" type="text" name="promo_type" class="form-control">
                                            <option value="0">Choose type...</option>     
                                            <?php foreach ($promo_type as $value) : ?>
                                            <option value="<?php echo $value; ?>"<?php echo $promo[0]['promo_type'] == $value ? ' selected' : ''; ?>><?php echo $value; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <span id="promo_title2"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="promo_id" type="hidden" name="promo_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="promo_user" type="hidden" name="promo_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btnpromo" type="submit" name="btnpromo" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="promolist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="spromo" type="text" name="spromo" value="<?php echo $spromo; ?>" class="col-sm-3" placeholder="Search" style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body promolist">
                              <?php if($promo) : ?>
                              <a href="<?php echo WEB; ?>/promo?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Promo</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">Promo ID</th>
                                  <th width="30%">Title</th>
                                  <th width="20%">Type</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($promo as $key => $value) : ?>
                                <?php $promouser = $main->get_user($value['promo_user']); ?> 
                                <tr>
                                  <td><?php echo $value['promo_id']; ?></td>
                                  <td><?php echo $value['promo_title']; ?></td>
                                  <td><?php echo $value['promo_type']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['promo_update'] ? $value['promo_update'] : $value['promo_date'])); ?> by <?php echo $promouser ? $promouser[0]['user_firstname']." ".$promouser[0]['user_lastname'] : 'admin'; ?></td>    
                                  <td id="status<?php echo $value['promo_id']; ?>"><button type="button" attribute="<?php echo $value['promo_id']; ?>" attribute2="promo" class="btn btndeactivate btn-success<?php echo $value['promo_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['promo_id']; ?>" attribute2="promo" class="btn btnactivate btn-danger<?php echo $value['promo_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/promo?id=<?php echo $value['promo_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['promo_id']; ?>" class="btn btndelpromo btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Promo ID</th>
                                  <th width="30%">Title</th>
                                  <th width="20%">Type</th>
                                  <th width="10%">Last Edited</th>
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
                                <div class="centertalign margintopbot100">No promo has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Promo</button></a><?php endif; ?></div>
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