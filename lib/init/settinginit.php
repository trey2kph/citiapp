<?php

    $setting = $main->get_set();

    define("ANNOUNCEMENT", $setting[0]['set_announce'] ? $setting[0]['set_announce'] : "");
    define("MAILFOOT", $setting[0]['set_mailfoot'] ? $setting[0]['set_mailfoot'] : "");
    define("NUM_ROWS", $setting[0]['set_numrows'] ? $setting[0]['set_numrows'] : 20); // the number of records on each page

?>