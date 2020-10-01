<!-- FOOTER -->                   
                    
             
    
    <!-- JAVASCRIPTS -->
    <script type="text/javascript" src="<?php echo JS; ?>/jquery-ui.js"></script> 
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.flip.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.touchwipe.min.js"></script>    
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.cycle.lite.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.resizecrop.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.marquee.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.cycle.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.hoverIntent.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.resizecrop.min.js"></script>
  	<script type="text/javascript" src="<?php echo JS; ?>/lightbox.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/fullcalendar.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/DateTimePicker.min.js"></script>     				
    <script type="text/javascript" src="<?php echo JS; ?>/rating.js"></script>     		    				
    <script type="text/javascript" src="<?php echo JS; ?>/city.min.js"></script>     		
   				
    <script type="text/javascript" src="<?php echo JS; ?>/nivoslider/jquery.nivo.slider.pack.js"></script>     			

    <!-- FOR IFRAME UPLOAD -->
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.iframe-post-form.js"></script>
    <script type="text/javascript" src="<?php echo JSCRIPT; ?>/iframe-post-form.php"></script>
        
    <!-- LOCAL JAVASCRIPTS -->
    <script type="text/javascript" src="<?php echo JSCRIPT; ?>/plugins.php"></script>

    <?php if ($page_title == "PRIVACY POLICY") : ?>
        <script type="text/javascript">
            $(function() {
                $(".floatdiv").addClass("invisible");
                $("#fppolicy").addClass("invisible");
            });
        </script>

    <?php endif; ?>

    <!-- GOOGLE MAP -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1DgTV2VGjMEtwR4Mjg4rJtYqoFECmsJs&callback=initMap">
    </script>
        
  </body>
</html>