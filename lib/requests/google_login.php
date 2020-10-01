<?php

    extract($_POST);

    // Get $id_token via HTTPS POST.
    
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
      $userid = $payload['sub'];
      // If request specified a G Suite domain:
      //$domain = $payload['hd'];
    } else {
      // Invalid ID token
    }

    var_dump($userid);

?>