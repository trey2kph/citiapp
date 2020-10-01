<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$brandall) : ?>
        <?php 
        ?>

        <div id="branddata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmbrand" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="brand_name" class="col-sm-3 control-label">Brand Name</label>
                                    <div class="col-sm-7">
                                        <input id="brand_name" type="text" name="brand_name" value="<?php echo $brand[0]['brand_name']; ?>" class="form-control" placeholder="Brand Name">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="brand_logo" class="col-sm-3 control-label">Logo</label>
                                    <div class="col-sm-3">
                                        <input id="brand_logo" type="file" name="brand_logo" /><br><i>* recommended size is 100px x 25px</i>
                                    </div>
                                </div> 
                                <div class="form-group<?php if (!$brand[0]['brand_logo']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="dimlist col-sm-7">
                                        <img id="blogo" name="blogo" src="<?php echo SROOT; ?>/uploads/brand/<?php echo $brand[0]['brand_logo']; ?>" class="logosqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="brand_country" class="col-sm-3 control-label">Country</label>
                                    <div class="col-sm-3">
                                        <select id="brand_country" type="text" name="brand_country" class="form-control">
                                            <option value="0">Choose country...</option>     
                                            <?php foreach ($country as $value) : ?>
                                            <option value="<?php echo $value; ?>"<?php echo $brand[0]['brand_country'] == $value ? ' selected' : ''; ?>><?php echo $value; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <span id="brand_title"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="brand_id" type="hidden" name="brand_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="brand_user" type="hidden" name="brand_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btnbrand" type="submit" name="btnbrand" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="brandlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="sbrand" type="text" name="sbrand" value="<?php echo $sbrand; ?>" class="form-control" placeholder="Search brand..." style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body brandlist">
                              <?php if($brand) : ?>
                              <a href="<?php echo WEB; ?>/brand?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Brand</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">Brand ID</th>
                                  <th width="25%">Name</th>
                                  <th width="20%">Alias</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($brand as $key => $value) : ?>
                                <?php $branduser = $main->get_user($value['brand_user']); ?> 
                                <tr>
                                  <td><?php echo $value['brand_id']; ?></td>
                                  <td><?php echo $value['brand_name']; ?></td>
                                  <td><?php echo $value['brand_alias']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['brand_update'] ? $value['brand_update'] : $value['brand_date'])); ?> by <?php echo $branduser[0]['user_firstname']." ".$branduser[0]['user_lastname']; ?></td>    
                                  <td id="status<?php echo $value['brand_id']; ?>"><button type="button" attribute="<?php echo $value['brand_id']; ?>" attribute2="brand" class="btn btndeactivate btn-success<?php echo $value['brand_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['brand_id']; ?>" attribute2="brand" class="btn btnactivate btn-danger<?php echo $value['brand_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/brand?id=<?php echo $value['brand_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['brand_id']; ?>" class="btn btndelbrand btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Brand ID</th>
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
                                <div class="centertalign margintopbot100">No brand has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Brand</button></a><?php endif; ?></div>
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