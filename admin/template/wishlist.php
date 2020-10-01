<?php include(TEMP."/header.php"); ?>

        <div id="wishlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!--input id="swish" type="text" name="swish" value="<?php echo $swish; ?>" class="col-sm-3" placeholder="Search" style="width: 40%;" />&nbsp;&nbsp;&nbsp;-->
                        
                        <form role="form">
                            <div class="box-body wishlist">
                              <?php if($wish) : ?>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>
                                  <th width="10%">Wishlist ID</th>
                                  <th width="40%">Product</th>
                                  <th width="30%">Customer</th>
                                  <th width="20%"x>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($wish as $key => $value) : ?>
                                <?php $wishuser = $main->get_user($value['wish_user']); ?>
                                <?php $wishprod = $main->get_products($value['wish_product']); ?> 
                                <tr>
                                  <td><?php echo $value['wish_id']; ?></td>
                                  <td><?php echo $wishprod[0]['product_name']; ?></td>
                                  <td><?php echo $wishuser[0]['user_firstname'].' '.$wishuser[0]['user_lastname']; ?></td>
                                  <td><?php echo date('F j, Y g:ia', $value['wish_date']); ?></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th width="10%">Wishlist ID</th>
                                  <th width="40%">Product</th>
                                  <th width="30%">Customer</th>
                                  <th width="20%">Date</th>
                                </tr>
                                <tr>
                                  <td colspan="4" class="centertalign pages"><?php echo $pages; ?></td>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign margintopbot100">No wishlist has been published</div>
                              </tr>
                              <?php endif; ?>   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        
        </div>

<?php include(TEMP."/footer.php"); ?>