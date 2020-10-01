    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php if ($section != 'login') : ?>
  <footer class="main-footer">
  <?php else : ?>
  <footer class="main-footer2">
  <?php endif; ?>
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo SYSTEMNAME; ?>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo WEB; ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo WEB; ?>/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo WEB; ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo WEB; ?>/dist/js/app.min.js"></script>
<!-- My JS -->
<script src="<?php echo WEB; ?>/dist/js/js.php<?php echo $store ? '?stp='.$store[0]['store_province'].'&stv='.$store[0]['store_city'] : ''; ?>"></script>
<!-- Iframe Post Form -->
<script src="<?php echo WEB; ?>/dist/js/jquery.iframe-post-form.js"></script>
<script src="<?php echo WEB; ?>/dist/js/iframe_form.php"></script>

<script src="<?php echo WEB; ?>/script/money.min.js"></script>

<!-- MY JS -->
<script src="<?php echo WEB; ?>/script/jquery.resizecrop.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script src="<?php echo WEB; ?>/plugins/iCheck/icheck.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo WEB; ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo WEB; ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo WEB; ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Lightbox -->
<script src="<?php echo WEB; ?>/plugins/lightbox/js/lightbox.js"></script>    		    				
<script type="text/javascript" src="<?php echo WEB; ?>/script/city.min.js"></script>  
    
  
<script>
  $(function () {
    $(".textarea").wysihtml5({
      toolbar: {
        "font-styles": true, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": false, // Button to change color of font
        "blockquote": false, // Blockquote
        "size": 'sm' // options are xs, sm, lg
      }
    });
    $(".datepicker").datepicker({
        autoclose: true
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });
  });
</script>
</body>
</html>