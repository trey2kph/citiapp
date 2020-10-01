<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$catall) : ?>
        <?php 
        ?>

        <div id="categorydata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmcategory" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="category_name" class="col-sm-3 control-label">Category Name</label>
                                    <div class="col-sm-7">
                                        <input id="category_name" type="text" name="category_name" value="<?php echo $cat[0]['category_name']; ?>" class="form-control" placeholder="Category Name">
                                    </div>
                                </div>  
                                <?php if ($id) : ?>
                                <div class="form-group">
                                    <label for="category_name" class="col-sm-3 control-label">Subcategories</label>
                                    <div class="datasubcat col-sm-7">
                                        <?php if ($subcat) : ?>
                                        <?php foreach ($subcat as $key => $value) : ?>
                                           <div class="col-sm-8 marginbottom10"><span id="subcat<?php echo $value['subcat_id'] ?>" attribute="<?php echo $value['subcat_id'] ?>" class="subcat"><?php echo $value['subcat_name'] ?></span><input id="txtsubcat<?php echo $value['subcat_id'] ?>" type="text" name="txtsubcat[<?php echo $value['subcat_id'] ?>]" value="<?php echo $value['subcat_name'] ?>" attribute="<?php echo $value['subcat_id']; ?>" placeholder="Subcategory Name" class="invisible txtsubcat col-sm-10 input-sml form-control" /></div>
                                           <div class="col-sm-4 marginbottom10"><button id="btneditsubcat<?php echo $value['subcat_id']; ?>" type="button" attribute="<?php echo $value['subcat_id']; ?>" class="btn btn-xs btneditsubcat btn-primary">Edit</button> <button id="btndelsubcat<?php echo $value['subcat_id']; ?>" type="button" attribute="<?php echo $value['subcat_id']; ?>" class="btn btn-xs btndelsubcat btn-danger">Delete</button><button id="btnupsubcat<?php echo $value['subcat_id']; ?>" attribute="<?php echo $value['subcat_id']; ?>" type="button" class="invisible btnupsubcat btn btn-xs btn-success">Update</button> <button id="btncansubcat<?php echo $value['subcat_id']; ?>" attribute="<?php echo $value['subcat_id']; ?>" type="button" class="invisible btncansubcat btn btn-xs btn-danger">Cancel</button></div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="col-sm-8"><input id="txtaddsubcat" type="text" name="txtaddsubcat" placeholder="Subcategory Name" class="col-sm-10 input-sml form-control" /></div> 
                                        <div class="col-sm-4"><button type="button" class="btnaddsubcat btn btn-xs btn-success">Add</button></div> 
                                    </div>
                                </div> 
                                <?php endif; ?>
                            </div>
                            <span id="category_title"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="category_id" type="hidden" name="category_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="category_user" type="hidden" name="category_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btncategory" type="submit" name="btncategory" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="categorylist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="scategory" type="text" name="scategory" value="<?php echo $scategory; ?>" class="form-control" placeholder="Search category..." style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body categorylist">
                              <?php if($cat) : ?>
                              <a href="<?php echo WEB; ?>/category?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">Category ID</th>
                                  <th width="35%">Name</th>
                                  <th width="20%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="25%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cat as $key => $value) : ?>
                                <?php $catuser = $main->get_user($value['category_user']); ?> 
                                <tr>
                                  <td><?php echo $value['category_id']; ?></td>
                                  <td><?php echo $value['category_name']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['category_update'] ? $value['category_update'] : $value['category_date'])); ?> by <?php echo $catuser[0]['user_firstname']." ".$catuser[0]['user_lastname']; ?></td>   
                                  <td id="status<?php echo $value['category_id']; ?>"><button type="button" attribute="<?php echo $value['category_id']; ?>" attribute2="category" class="btn btndeactivate btn-success<?php echo $value['category_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['category_id']; ?>" attribute2="category" class="btn btnactivate btn-danger<?php echo $value['category_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/category?id=<?php echo $value['category_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['category_id']; ?>" class="btn btndelcategory btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Category ID</th>
                                  <th width="35%">Name</th>
                                  <th width="20%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="25%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="5" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No category has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Category</button></a><?php endif; ?></div>
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