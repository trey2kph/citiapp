<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add) : ?>

        <div id="gallerydata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmgallery" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" enctype="multipart/form-data">
                            <span id="gallery_title"></span>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="gallery_pic" class="col-sm-2 control-label">Image</label>
                                    <div class="col-sm-9">
                                        <input id="gallery_pic" type="file" name="gallery_pic" />
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-2">&nbsp;</div>
                                <div class="col-sm-8">
                                    <input id="gallery_id" type="hidden" name="gallery_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="gallery_user" type="hidden" name="gallery_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btngallery" type="submit" name="btngallery" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="gallerylist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form role="form">
                            <div class="box-body">
                              <a href="<?php echo WEB; ?>/gallery?add=1"><button type="button" class="btn btn-primary">Add Gallery</button></a>
                              <?php if($gallery) : ?>
                              <table class="table table-bordered table-hover">
                                <thead>
                                <tr>           
                                  <th width="55%">Image</th>                       
                                  <th width="15%">Last Edited</th>                                  
                                  <th width="30%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($gallery as $key => $value) : ?>
                                <?php $galuser = $main->get_user($value['gallery_user']); ?>    
                                <tr>
                                  <td><img src="<?php echo SWEB.'/upload/gallery/'.$value['gallery_pic']; ?>" width="300" /></td>
                                  <td><?php echo date('M j, Y | g:ia', $value['gallery_date']); ?> by <?php echo $galuser[0]['user_fullname']; ?></td>
                                  <td><a href="<?php echo WEB; ?>/gallery?id=<?php echo $value['gallery_id']; ?>"><button type="button" class="btn btn-primary">Replace</button></a> <button type="button" attribute="<?php echo $value['gallery_id']; ?>" class="btn btndelgal btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Image</th>
                                  <th>Last Edited</th>                                  
                                  <th>Manage</th>                      
                                </tr>
                                </tfoot>
                              </table>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign">No gallery has been listed</div>
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