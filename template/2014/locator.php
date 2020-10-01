	<?php include(TEMP."/header.php"); ?>

    <!-- BODY -->
                    
                    <div class="bodycontainer">
                        <div class="mainsplash">
                            <img src="<?php echo WEB; ?>/images/splash2.jpg" />
                        </div>
                        <a id="mapanchor"></a>
                        <div class="maincontainer">
                            <div class="lmaincontainer">
                                <div class="filter">
                                    <div class="filterhead">Store Locator</div>
                                    <div class="filterbodym centertalign">
                                        <input id="sstore" type="search" name="sstore" value="<?php echo $sstore ? strtolower($sstore) : ''; ?>" placeholder="Type location then press ENTER" class="bigtxtbox clearboth" />
                                        <!--div class="clearboth">Or locate store...</div>
                                        <button id="btnnear" name="btnnear" class="redbtn margintop10"><i class="fa fa-compass"></i> Near Me</button-->
                                        <button id="btnmapview" name="btnmapview" class="redbtn margintop30 invisible"><i class="fa fa-map"></i> Map View</button>
                                        <button id="btnlistview" name="btnlistview" class="redbtn margintop30"><i class="fa fa-list"></i> List View</button>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="rmaincontainer">
                                <div class="amap invisible">
                                    
                                    <div id="map" class="map"></div>
                                    <script>
                                      var customLabel = {
                                        main: {
                                          label: 'M'
                                        },
                                        store: {
                                          label: 'S'
                                        }
                                      };

                                        function initMap() {
                                        <?php if ($sstore) : ?>
                                            var bounds  = new google.maps.LatLngBounds();
                                        <?php endif; ?>
                                        var markerArray  = [];
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                              zoom: 5,
                                              center: {lat: 12.4536346, lng: 121.8706998},
                                              gestureHandling: 'greedy'
                                        });
                                        var infoWindow = new google.maps.InfoWindow;
                                            
                                        /*if (navigator.geolocation) {
                                          navigator.geolocation.getCurrentPosition(function(position) {
                                            var pos = {
                                              lat: position.coords.latitude,
                                              lng: position.coords.longitude
                                            };

                                            infoWindow.setPosition(pos);
                                            infoWindow.setContent('Location found.');
                                            infoWindow.open(map);
                                            map.setCenter(pos);
                                          }, function() {
                                            handleLocationError(true, infoWindow, map.getCenter());
                                          });
                                        } else {
                                          // Browser doesn't support Geolocation
                                          handleLocationError(false, infoWindow, map.getCenter());
                                        }*/

                                          // Change this depending on the name of your PHP or XML file
                                          downloadUrl('http://imperialapplianceplaza.net/mapmarker<?php echo $sstore ? '/'.strtolower($sstore) : ''; ?>', function(data) {
                                            var xml = data.responseXML;
                                            var markers = xml.documentElement.getElementsByTagName('marker');
                                            Array.prototype.forEach.call(markers, function(markerElem) {
                                              var id = markerElem.getAttribute('id');
                                              var name = markerElem.getAttribute('name');
                                              var address = markerElem.getAttribute('address');
                                              var tel = markerElem.getAttribute('tel');
                                              var hour = markerElem.getAttribute('hour');
                                              var type = markerElem.getAttribute('type');
                                              var point = new google.maps.LatLng(
                                                  parseFloat(markerElem.getAttribute('lat')),
                                                  parseFloat(markerElem.getAttribute('lng')));

                                              var infowincontent = document.createElement('div');
                                              var strong = document.createElement('strong');
                                              strong.textContent = name
                                              infowincontent.appendChild(strong);
                                              infowincontent.appendChild(document.createElement('br'));

                                              var text = document.createElement('text');
                                              text.textContent = address;
                                              infowincontent.appendChild(text);
                                              var text2 = document.createElement('text');
                                              infowincontent.appendChild(document.createElement('br'));
                                              text2.textContent = tel;
                                              infowincontent.appendChild(text2);
                                              var text3 = document.createElement('text');
                                              infowincontent.appendChild(document.createElement('br'));
                                              text3.textContent = 'Store Hour: ' + hour;
                                              infowincontent.appendChild(text3);
                                              var icon = customLabel[type] || {};
                                              var marker = new google.maps.Marker({
                                                map: map,
                                                position: point,
                                                label: icon.label
                                              });
                                              marker.addListener('click', function() {
                                                map.setCenter(marker.getPosition()); // set map center to marker position
                                                smoothZoom(map, 16, map.getZoom()); // call smoothZoom, parameters map, final zoomLevel, and starting zoom level
                                                infoWindow.setContent(infowincontent);
                                                infoWindow.open(map, marker);
                                              });
                                                
                                              
                                              
                                              function smoothZoom (map, max, cnt) {
                                                    if (cnt >= max) {
                                                        return;
                                                    }
                                                    else {
                                                        z = google.maps.event.addListener(map, 'zoom_changed', function(event){
                                                            google.maps.event.removeListener(z);
                                                            smoothZoom(map, max, cnt + 1);
                                                        });
                                                        setTimeout(function(){map.setZoom(cnt)}, 80); // 80ms is what I found to work well on my system -- it might not work well on all systems
                                                    }
                                                }  
                                                
                                                
                                              markerArray.push(marker);  
                                              
                                              <?php if ($sstore) : ?>
                                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                                bounds.extend(loc);
                                              <?php endif; ?>
                                                
                                            }); 
                                            <?php if ($sstore) : ?>
                                            map.fitBounds(bounds);       
                                            map.panToBounds(bounds); 
                                            var listener = google.maps.event.addListener(map, "idle", function() { 
                                              if (map.getZoom() > 16) map.setZoom(16); 
                                              google.maps.event.removeListener(listener); 
                                            });
                                            <?php endif; ?>
                                                
                                              var markerCluster = new MarkerClusterer(map, markerArray, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                                              
                                          });
                                            
                                          function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                            infoWindow.setPosition(pos);
                                            infoWindow.setContent(browserHasGeolocation ?
                                                                  'Error: The Geolocation service failed.' :
                                                                  'Error: Your browser doesn\'t support geolocation.');
                                            infoWindow.open(map);
                                          }
                                            
                                          
                                        }
                                        
                                      

                                      function downloadUrl(url, callback) {
                                        var request = window.ActiveXObject ?
                                            new ActiveXObject('Microsoft.XMLHTTP') :
                                            new XMLHttpRequest;

                                        request.onreadystatechange = function() {
                                          if (request.readyState == 4) {
                                            request.onreadystatechange = doNothing;
                                            callback(request, request.status);
                                          }
                                        };

                                        request.open('GET', url, true);
                                        request.send(null);
                                      }

                                      function doNothing() {}
                                    
                                    </script>
                                    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
                                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1DgTV2VGjMEtwR4Mjg4rJtYqoFECmsJs&callback=initMap"></script>
                                    
                                </div>
                                <div class="alist invisible">
                                    <?php $cnt = 1; ?>
                                    <?php if ($storedatal) : ?>
                                    <?php foreach ($storedatal as $key => $value) : ?>
                                    <?php $modcnt = $cnt % 2; ?>
                                    <?php $telarr = explode(';', $value['store_tel']); ?>
                                    <div class="storelist<?php echo $modcnt == 1 ? ' lgraybg2' : ''; ?>">
                                        <b>Imperial <?php echo utf8_decode($value['store_name']); ?></b><br />
                                        <?php echo utf8_decode($value['store_address']).', '.utf8_decode($value['store_city']).', '.utf8_decode($value['store_province']); ?><br />
                                        Contact No.:<br />
                                        <?php foreach ($telarr as $vtel) : ?>
                                        <?php echo trim($vtel); ?><br />
                                        <?php endforeach; ?>
                                        Operating Hours: <?php echo $value['store_hour']; ?>
                                    </div>
                                    <?php $cnt++; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            
                            </div>
                        </div>
                        
                   

                    </div>

                    

    <?php include(TEMP."/footer.php"); ?>