<?php include(TEMP."/header.php"); ?>

        <div id="orderlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-aqua">
                                <div class="inner">
                                  <h3><?php echo $product_count; ?></h3>

                                  <p>Products</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-tv"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/product" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-green">
                                <div class="inner">
                                  <h3><?php echo $brand_count; ?></h3>

                                  <p>Brands</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-star"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/brand" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-yellow">
                                <div class="inner">
                                  <h3><?php echo $cat_count; ?></h3>

                                  <p>Categories</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-th"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-red">
                                <div class="inner">
                                  <h3><?php echo $promo_count; ?></h3>

                                  <p>Promos</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-tags"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/promo" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                          </div>
                        
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-navy">
                                <div class="inner">
                                  <h3><?php echo $store_count; ?></h3>

                                  <p>Stores</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/stores" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-orange">
                                <div class="inner">
                                  <h3><?php echo $careercount; ?></h3>

                                  <p>Jobs</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-suitcase"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/career" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-purple">
                                <div class="inner">
                                  <h3><?php echo $ordercount; ?></h3>

                                  <p>Orders</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/order" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                              <div class="small-box bg-maroon">
                                <div class="inner">
                                  <h3><?php echo $usercount; ?></h3>

                                  <p>Registered Users</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-users"></i>
                                </div>
                                <a href="<?php echo WEB; ?>/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                          </div>
                        
                          <div class="row">
                              
                            <div class="col-md-8">
                              <div class="box box-info">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Latest Orders</h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <div class="table-responsive">
                                    <table class="table no-margin">
                                      <thead>
                                        <tr>
                                          <th width="10%">Order ID</th>
                                          <th width="40%">Orders</th>
                                          <th width="40%">Customer Info</th>
                                          <th width="10%">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($orderdata as $key => $value) : ?>
                                        <?php $orderuser = $main->get_user($value['trans_uid']); ?> 
                                        <?php $orderuser2 = $main->get_user($value['trans_user']); ?> 
                                        <?php $order_data = unserialize($value['trans_order']); ?>
                                        <tr>
                                          <td><?php echo $value['trans_id']; ?></td>
                                          <td class="smalltxt">
                                              <?php $item_total = 0; ?>
                                              <?php foreach($order_data as $v) : ?>
                                                <div class="fdata">
                                                    <div class="fdataleft"><b><?php echo $v['quantity']; ?> x <?php echo $v['name']; ?></b><?php echo $v['quantity'] > 1 ? '<br><i>P '.number_format($v['price']).' per unit</i>' : ''; ?></div>
                                                    <div class="fdataright valigntop">P <?php echo number_format($v['price'] * $v['quantity'], 2); ?></div>
                                                </div>
                                                <?php $item_total = $item_total + ($v['price'] * $v['quantity']); ?>
                                              <?php endforeach; ?>
                                              <div class="fdata topborder1">
                                                <div class="fdataleft bold">Total</div>
                                                <div class="fdataright bold">P <?php echo number_format($item_total, 2); ?></div>
                                              </div>
                                          </td>
                                          <td class="smalltxt">
                                                <div class="fdata lefttalign"><b>Customer Name:</b> <?php echo $orderuser[0]['user_firstname'].' '.$orderuser[0]['user_lastname']; ?></div>
                                                <div class="fdata lefttalign"><b>E-mail Address:</b> <?php echo $orderuser[0]['user_email']; ?></div>
                                                <div class="fdata lefttalign"><b>Will pickup/receive by:</b> <?php echo $value['trans_fname']; ?></div>
                                                <div class="fdata lefttalign"><b>Mobile No.:</b> <?php echo $value['trans_mobile']; ?></div>
                                                <div class="fdata lefttalign"><b>Address:</b> <?php echo $value['trans_address']; ?></div>
                                                <div class="fdata lefttalign"><b>Instruction/Remark:</b> <?php echo $value['trans_uremark']; ?></div>
                                                <div class="fdata lefttalign"><b>Date/Time:</b> <?php echo date('F j, Y | g:ia', $value['trans_date']); ?></div>
                                          </td>
                                          <td class="smalltxt">
                                              <?php 
                                                if ($value['trans_paytype'] == 1) :
                                                    $order_array = $order_status2;  
                                                else :
                                                    $order_array = $order_status;
                                                endif;
                                              ?>
                                              <div class='label <?php echo $order_array[$value['trans_status']][1]; ?>'><?php echo $order_array[$value['trans_status']][0]; ?></div>
                                          </td>
                                        </tr>
                                        <?php endforeach; ?> 
                                        </tbody>
                                    </table>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                  <a href="<?php echo WEB; ?>/order" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                </div>
                                <!-- /.box-footer -->
                              </div>
                            </div>
                            <!-- /.col -->
                              
                            <div class="col-md-4">
                              <!-- PRODUCT LIST -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Recently Product Added</h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <ul class="products-list product-list-in-box">
                                    <?php if ($latest_prod) : ?>
                                    <?php foreach ($latest_prod as $value) : ?>
                                    <?php $product_price = $main->get_price(0, 0, 0, 0, $value['product_id']); ?>  
                                    <li class="item">
                                      <div class="product-img">
                                        <img src="<?php echo SROOT; ?>/uploads/prodlimg/<?php echo $value['product_largeimg']; ?>" alt="<?php echo $value['product_name']; ?>">
                                      </div>
                                      <div class="product-info">
                                        <a href="<?php echo WEB; ?>/product?id=<?php echo $value['product_id']; ?>" class="product-title"><?php echo $value['product_name']; ?>
                                        <span class="label label-warning pull-right"><?php echo $product_price[0]['price_price'] ? 'P'.number_format($product_price[0]['price_price'], 2, '.', ',') : 'P0.00'; ?></span></a>
                                        <span class="product-description">
                                          <?php echo $value['product_model']; ?>
                                        </span>
                                      </div>
                                    </li>
                                    <!-- /.item -->
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                  </ul>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                  <a href="<?php echo WEB; ?>/product" class="uppercase">View All Products</a>
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!--/.box -->
                                
                              <!-- USERS LIST -->
                              <div class="box box-danger">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Latest Members/Subscriber</h3>

                                  <div class="box-tools pull-right">
                                    <span class="label label-danger"><?php echo $usercount < 8 ? $usercount : '8'; ?> New Members</span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                  <ul class="users-list clearfix">
                                    <?php if ($latest_user) : ?>
                                    <?php foreach ($latest_user as $value) : ?>
                                    <li>
                                      <img src="dist/img/avatar0.png" alt="User Image">
                                      <a class="users-list-name" href="<?php echo WEB; ?>/user?id=<?php echo $value['user_id']; ?>"><?php echo $value['user_firstname'].' '.$value['user_lastname']; ?></a>
                                      <span class="users-list-date"><?php echo date('m-d') == date('m-d', $value['user_date']) ? 'Today' : date('F j, Y', $value['user_date']); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                  </ul>
                                  <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                  <a href="<?php echo WEB; ?>/user" class="uppercase">View All Users</a>
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!--/.box -->
                            </div>
                            <!-- /.col -->
                          </div>
                        
                    </div>
                </div>
            </div>
        
        
        </div>

<?php include(TEMP."/footer.php"); ?>