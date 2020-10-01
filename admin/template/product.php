<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$productall) : ?>

        <?php if ($brand && $cat) : ?>

        <div id="proddata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmprod" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="product_name" class="col-sm-3 control-label">Product Name *</label>
                                    <div class="col-sm-7">
                                        <input id="product_name" type="text" name="product_name" value="<?php echo str_replace('"', '&quot', $product[0]['product_name']); ?>" class="form-control" placeholder="Product Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_feature" class="col-sm-3 control-label">Featured</label>
                                    <div class="col-sm-7">
                                        <input id="product_feature" type="checkbox" name="product_feature" value="1"<?php echo $product[0]['product_feature'] ? ' checked' : ''; ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_model" class="col-sm-3 control-label">Model *</label>
                                    <div class="col-sm-7">
                                        <input id="product_model" type="text" name="product_model" value="<?php echo $product[0]['product_model']; ?>" class="form-control" placeholder="Model">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_modelmonth" class="col-sm-3 control-label">Model Year *</label>
                                    <div class="col-sm-3">
                                        <select id="product_modelmonth" name="product_modelmonth" class="form-control col-sm-6">
                                            <?php foreach ($model_month as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"<?php echo $productmonth == $key ? ' selected' : ''; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select id="product_modelyear" name="product_modelyear" class="form-control col-sm-6">
                                            <?php for ($y=(date('Y')-50); $y<=(date('Y')+50); $y++) : ?>
                                            <option value="<?php echo $y; ?>"<?php echo $productyear == $y ? ' selected' : ''; ?>><?php echo $y; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_sku" class="col-sm-3 control-label">SKU</label>
                                    <div class="col-sm-7">
                                        <input id="product_sku" type="text" name="product_sku" value="<?php echo $product[0]['product_sku']; ?>" class="form-control" placeholder="SKU">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_fprice" class="col-sm-3 control-label">Price *</label>
                                    <div class="col-sm-3">
                                        <input id="product_fprice" type="text" name="product_fprice" value="<?php echo $product_price[0]['price_price'] ? 'P'.number_format($product_price[0]['price_price'], 2, '.', ',') : 'P0.00'; ?>" class="form-control floatonly input-lg" placeholder="0.00">
                                        <input id="product_price" type="hidden" name="product_price" value="<?php echo $product_price[0]['price_price'] ? $product_price[0]['price_price'] : '0.00'; ?>">
                                    </div>
                                </div>
                                <?php if ($id) : ?>
                                <div class="form-group">
                                    <label for="product_fprice" class="col-sm-3 control-label">Price History</label>
                                    <div class="col-sm-7">
                                        <?php if ($product_price) : ?>
                                        <?php foreach ($product_price as $key => $value) : ?>
                                            <div class="col-sm-8 marginbottom10">P <?php echo number_format($value['price_price'], 2); ?></div>
                                            <div class="col-sm-4 marginbottom10"><?php echo date('F j, Y g:ia', $value['price_date']); ?></div>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="col-sm-12 marginbottom10"><i>No price has been set</i></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="product_brand" class="col-sm-3 control-label">Brand *</label>
                                    <div class="col-sm-3">
                                        <select id="product_brand" type="text" name="product_brand" class="form-control">
                                            <option value="0">Choose brand...</option>     
                                            <?php foreach ($brand as $key => $value) : ?>
                                            <option value="<?php echo $value['brand_id']; ?>"<?php echo $product[0]['product_brand'] == $value['brand_id'] ? ' selected' : ''; ?>><?php echo $value['brand_name']; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_cat" class="col-sm-3 control-label">Category *</label>
                                    <div class="col-sm-3">
                                        <select id="product_cat" type="text" name="product_cat" class="form-control">
                                            <option value="0">Choose category...</option>     
                                            <?php foreach ($cat as $key => $value) : ?>
                                            <option value="<?php echo $value['category_id']; ?>"<?php echo $product[0]['product_cat'] == $value['category_id'] ? ' selected' : ''; ?>><?php echo $value['category_name']; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_subcat" class="col-sm-3 control-label">Subcategory *</label>
                                    <div class="col-sm-3">
                                        <select id="product_subcat" type="text" name="product_subcat" class="form-control">
                                            <option value="0">Choose category first...</option>     
                                            <?php foreach ($subcat as $key => $value) : ?>
                                            <option value="<?php echo $value['subcat_id']; ?>"<?php echo $product[0]['product_subcat'] == $value['subcat_id'] ? ' selected' : ''; ?>><?php echo $value['subcat_name']; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="product_blurb" class="col-sm-3 control-label">Blurb</label>
                                    <div class="col-sm-7">
                                        <textarea id="product_blurb" rows="5" name="product_blurb" class="textarea col-sm-12"><?php echo $product[0]['product_blurb']; ?></textarea>
                                    </div>
                                </div>   
                                <div class="form-group">
                                    <label for="product_specs" class="col-sm-3 control-label">Specs *</label>
                                    <div class="col-sm-7">
                                        <textarea id="product_specs" rows="8" name="product_specs" class="textarea col-sm-12"><?php echo $product[0]['product_specs']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_tags" class="col-sm-3 control-label">Tags</label>
                                    <div class="col-sm-7">
                                        <input id="product_tags" type="text" name="product_tags" value="<?php echo $product[0]['product_tags']; ?>" class="form-control" placeholder="Tags (separated by comma)">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="product_smallimg" class="col-sm-3 control-label">Small Image</label>
                                    <div class="col-sm-3">
                                        <input id="product_smallimg" type="file" name="product_smallimg" />
                                    </div>
                                </div>
                                <div class="form-group<?php if (!$product[0]['product_smallimg']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-7">
                                        <img id="prosimg" name="prosimg" src="<?php echo SROOT; ?>/uploads/prodsimg/<?php echo $product[0]['product_smallimg']; ?>" class="imgsqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="product_largeimg" class="col-sm-3 control-label">Large Image</label>
                                    <div class="col-sm-3">
                                        <input id="product_largeimg" type="file" name="product_largeimg" />
                                    </div>
                                </div>
                                <div class="form-group<?php if (!$product[0]['product_largeimg']) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label">&nbsp;</label>
                                    <div class="col-sm-7">
                                        <img id="prolimg" name="prolimg" src="<?php echo SROOT; ?>/uploads/prodlimg/<?php echo $product[0]['product_largeimg']; ?>" class="imgsqr" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="product_dimension" class="col-sm-3 control-label">Product Dimension Images (front, back, side, etc.)</label>
                                    <div class="col-sm-3">
                                        <input id="product_dimension" type="file" name="product_dimension[]" multiple />
                                    </div>
                                </div>  
                                <div class="form-group<?php if (!$product_dimension) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label"><i>(Click image to delete)</i></label>
                                    <div class="dimlist col-sm-7">
                                        <?php foreach ($product_dimension as $key => $value) : ?>
                                        <img id="dims<?php echo $value['pic_id']; ?>" name="dims<?php echo $value['pic_id']; ?>" src="<?php echo SROOT; ?>/uploads/dimension/<?php echo $value['pic_file']; ?>" attribute="<?php echo $value['pic_id']; ?>" attribute2="<?php echo $id; ?>" class="dimsqr cursorpoint" />
                                        <?php endforeach; ?>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="product_pics" class="col-sm-3 control-label">Extra Images (brochure, promotions, ads, etc.)</label>
                                    <div class="col-sm-3">
                                        <input id="product_pics" type="file" name="product_pics[]" multiple />
                                    </div>
                                </div>  
                                <div class="form-group<?php if (!$product_pics) : ?> invisible<?php endif; ?>">
                                    <label class="col-sm-3 control-label"><i>(Click image to delete)</i></label>
                                    <div class="piclist col-sm-7">
                                        <?php foreach ($product_pics as $key => $value) : ?>
                                        <img id="pics<?php echo $value['pic_id']; ?>" name="pics<?php echo $value['pic_id']; ?>" src="<?php echo SROOT; ?>/uploads/broucher/<?php echo $value['pic_file']; ?>" attribute="<?php echo $value['pic_id']; ?>" attribute2="<?php echo $id; ?>" class="picsqr cursorpoint" />
                                        <?php endforeach; ?>
                                    </div>
                                </div> 
                            </div>
                            <span id="product_title"></span>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-7">
                                    <input id="product_id" type="hidden" name="product_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="product_user" type="hidden" name="product_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btnproduct" type="submit" name="btnproduct" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <?php if ($product_logs) : ?>
                            <div class="box-footer">
                                <label for="product_pics" class="col-sm-3 control-label">Logs</label>
                                <div class="col-sm-7">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                          <th width="40%">User</th>
                                          <th width="30%">Event</th>
                                          <th width="30%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($product_logs as $key => $value) : ?>
                                            <tr>
                                              <td><?php echo $value['user_firstname'].' '.$value['user_lastname']; ?></td>
                                              <td><?php echo $value['logs_task']; ?></td>
                                              <td><?php echo date('F j, Y g:ia', $value['logs_date']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="prodlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form role="form">
                            <div class="box-body productlist">
                              <tr>
                                <div class="centertalign margintopbot100">No brand nor category has been set<br><?php if (!$brand) : ?><a href="<?php echo WEB; ?>/brand?add=1"><button type="button" class="btn btn-primary">Add Brand</button></a><?php endif; ?><?php if (!$cat) : ?><a href="<?php echo WEB; ?>/category?add=1">&nbsp;<button type="button" class="btn btn-primary">Add Category</button></a><?php endif; ?></div>
                              </tr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        
        </div>

        <?php endif; ?>

        <?php else : ?>

        <div id="prodlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="sprod" type="text" name="sprod" value="<?php echo $sprod; ?>" class="col-sm-3" placeholder="Search" style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body productlist">
                              <?php if($product) : ?>
                              <a href="<?php echo WEB; ?>/product?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">Product ID</th>
                                  <th width="20%">Name</th>
                                  <th width="15%">Model</th>
                                  <th width="15%">Brand</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($product as $key => $value) : ?>
                                <?php 
                                    $productuser = $main->get_user($value['product_user']); 
                                    $branddata = $main->get_brands($value['product_brand']); 
                                ?> 
                                <tr>
                                  <td><?php echo $value['product_id']; ?></td>
                                  <td><?php echo $value['product_name']; ?></td>
                                  <td><?php echo $value['product_model']; ?></td>
                                  <td><?php echo $branddata[0]['brand_name']; ?></td>
                                  <td><?php echo date('M j, Y | g:ia', ($value['product_update'] ? $value['product_update'] : $value['product_date'])); ?> by <?php echo $productuser[0]['user_firstname']." ".$productuser[0]['user_lastname']; ?></td>    
                                  <td id="status<?php echo $value['product_id']; ?>"><button type="button" attribute="<?php echo $value['product_id']; ?>" attribute2="product" class="btn btndeactivate btn-success<?php echo $value['product_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['product_id']; ?>" attribute2="product" class="btn btnactivate btn-danger<?php echo $value['product_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/product?id=<?php echo $value['product_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['product_id']; ?>" class="btn btndelprod btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Product ID</th>
                                  <th width="20%">Name</th>
                                  <th width="15%">Model</th>
                                  <th width="15%">Brand</th>
                                  <th width="10%">Last Edited</th>
                                  <th width="10%">Status</th>
                                  <th width="20%">Manage</th>
                                </tr>
                                <tr>
                                  <td colspan="7" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No product has been listed<?php if ($logged) : ?><br><a href="<?php echo WEB; ?>?add=1"><button type="button" class="btn btn-primary">Add Product</button></a><?php endif; ?></div>
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