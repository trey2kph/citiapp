<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$contents) : ?>

        <div id="contentdata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmcontent" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            <span id="content_title"></span>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="contents_title" class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-7">
                                        <input id="contents_title" type="text" name="contents_title" value="<?php echo $contents[0]['content_title']; ?>" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contents_type" class="col-sm-3 control-label">Type</label>
                                    <div class="col-sm-3">
                                        <select id="contents_type" type="text" name="contents_type" class="form-control">
                                            <?php foreach ($content_type as $key => $value) : ?>
                                            <option value="<?php echo $key; ?>"<?php echo $contents[0]['content_type'] == $key ? ' selected' : ''; ?>><?php echo $value; ?></option>     
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content_blurb" class="col-sm-3 control-label">Blurb</label>
                                    <div class="col-sm-7">
                                        <textarea id="content_blurb" name="content_bxlurb" rows="5" placeholder="Blurb" class="col-sm-12"><?php echo $contents[0]['content_blurb']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content_text" class="col-sm-3 control-label">Content</label>
                                    <div class="col-sm-7">
                                        <textarea id="contents_text" name="contents_text" rows="8" placeholder="Content" class="textarea col-sm-12"><?php echo $contents[0]['content_text']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-9">
                                    <input id="contents_id" type="hidden" name="contents_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="contents_user" type="hidden" name="contents_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btncontent" type="submit" name="btncontent" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="contentlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!--input id="scontent" type="text" name="scontent" value="<?php echo $scontent; ?>" class="form-control" placeholder="Search content..." style="width: 40%;" /-->&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body contentlist">
                              <?php if($contents) : ?>
                              <a href="<?php echo WEB; ?>/content?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Content</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>           
                                  <th width="30%">Title</th>                       
                                  <th width="25%">Type</th>
                                  <th width="15%">Last Edited</th>                                  
                                  <th width="30%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($contents as $key => $value) : ?>
                                <?php $conuser = $main->get_user($value['content_user']); ?>
                                <tr>
                                  <td><?php echo $value['content_title']; ?></td>
                                  <td><?php echo $content_type[$value['content_type']]; ?></td>
                                  <td><?php echo $value['content_update'] ? date('M j, Y | g:ia', $value['content_update']) : date('M j, Y | g:ia', $value['content_date']); ?> by <?php echo $conuser[0]['user_firstname'].' '.$conuser[0]['user_firstname']; ?></td>
                                  <td><a href="<?php echo WEB; ?>/content?id=<?php echo $value['content_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Title</th>
                                  <th>Type</th>
                                  <th>Last Edited</th>                                  
                                  <th>Manage</th>                      
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign">No contents has been listed</div>
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