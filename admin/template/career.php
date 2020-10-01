<?php include(TEMP."/header.php"); ?>

        <?php if ($id || $add || !$career) : ?>

        <div id="careerdata" class="row">
            <div>
                <div class="box box-primary">
                    <div id="frmcareer" class="box-header with-border">
                        <form action="?ignore-page-cache=true" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                            <span id="career_title"></span>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="career_name" class="col-sm-3 control-label">Career Name *</label>
                                    <div class="col-sm-7">
                                        <input id="career_name" type="text" name="career_name" value="<?php echo $career[0]['career_name']; ?>" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="career_requirement" class="col-sm-3 control-label">Requirements *</label>
                                    <div class="col-sm-7">
                                        <textarea id="career_requirement" name="career_requirement" rows="8" placeholder="Requirements" class="textarea col-sm-12"><?php echo $career[0]['career_requirement']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="career_city" class="col-sm-3 control-label">Post Date</label>
                                    <div class="col-sm-7">
                                        <input id="career_postfrom" type="text" name="career_postfrom" value="<?php echo $career[0]['career_postfrom'] ? date('m/d/Y', $career[0]['career_postfrom']) : date('m/d/Y'); ?>" class="col-sm-4 datepick"><div class="col-sm-2 centertalign"> to </div><input id="career_postto" type="text" name="career_postto" value="<?php echo $career[0]['career_postto'] ? date('m/d/Y', $career[0]['career_postto']) : date('m/d/Y', strtotime('+1 week')); ?>" class="col-sm-4 datepick">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-sm-3">&nbsp;</div>
                                <div class="col-sm-9">
                                    <input id="career_id" type="hidden" name="career_id" value="<?php echo $id ? $id : 0; ?>">
                                    <input id="career_user" type="hidden" name="career_user" value="<?php echo $profile_id ? $profile_id : 1; ?>">
                                    <button id="btncareer" type="submit" name="btncareer" value="1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div id="careerlist" class="row">
            <div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <input id="scareer" type="text" name="scareer" value="<?php echo $scareer; ?>" class="form-control" placeholder="Search jobs..." style="width: 40%;" />&nbsp;&nbsp;&nbsp;
                        <form role="form">
                            <div class="box-body">
                              <?php if($career) : ?>
                              <a href="<?php echo WEB; ?>/career?add=1"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Jobs</button></a>
                              <div class="table-responsive">
                                <table class="table no-margin">
                                <thead>
                                <tr>           
                                  <th width="30%">Name</th>                       
                                  <th width="25%">Post Date</th>
                                  <th width="15%">Last Edited</th>
                                  <th width="10%">Status</th>                                  
                                  <th width="20%">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($career as $key => $value) : ?>
                                <?php $careeruser = $main->get_user($value['career_user']); ?>  
                                <tr>
                                  <td><?php echo $value['career_name']; ?></td>
                                  <td><?php echo  date('M j, Y', $value['career_postfrom']); ?> to <?php echo  date('M j, Y', $value['career_postto']); ?></td>
                                  <td><?php echo $value['career_update'] ? date('M j, Y | g:ia', $value['career_update']) : date('M j, Y | g:ia', $value['career_date']); ?> by <?php echo $careeruser[0]['user_firstname'].' '.$careeruser[0]['user_lastname']; ?></td>
                                  <td id="status<?php echo $value['career_id']; ?>"><button type="button" attribute="<?php echo $value['career_id']; ?>" attribute2="career" class="btn btndeactivate btn-success<?php echo $value['career_status'] != 2 ? ' invisible' : ''; ?>">Active</button><button type="button" attribute="<?php echo $value['career_id']; ?>" attribute2="career" class="btn btnactivate btn-danger<?php echo $value['career_status'] != 1 ? ' invisible' : ''; ?>">Inactive</button></td>
                                  <td><a href="<?php echo WEB; ?>/career?id=<?php echo $value['career_id']; ?>"><button type="button" class="btn btn-primary">Edit</button></a> <button type="button" attribute="<?php echo $value['career_id']; ?>" class="btn btndelcar btn-danger">Delete</button></td>
                                </tr>
                                <?php endforeach; ?> 
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Post Date</th>
                                  <th>Last Edited</th>   
                                  <th>Status</th>                                  
                                  <th>Manage</th>                      
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <?php else : ?>
                              <tr>
                                <div class="centertalign">No career has been listed</div>
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