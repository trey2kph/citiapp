<?php
	
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1 ;
    $start = FEATURE_NUM_ROWS * ($page - 1);

	$page_title = "HOME";

    $gallery = $mainsql->get_promos();

    $product = $mainsql->get_products(0, $start, FEATURE_NUM_ROWS, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 1);
    $product_count = $mainsql->get_products(0, 0, 0, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1);

    $brand = $mainsql->get_brands(0, 0, 5, NULL, 0, 0, 1);

	$pages = $mainsql->pagination("index", $product_count, FEATURE_NUM_ROWS, 9);

    //var_dump($_SESSION['EMAIL']);

    /*header("Content-type: text/xml");

    // Iterate through the rows, adding XML nodes for each
    while ($row = @mysql_fetch_assoc($result)) :
        // Add to XML document node
        $node = $doc->create_element("marker");
        $newnode = $parnode->append_child($node);

        $newnode->set_attribute("id", $row['id']);
        $newnode->set_attribute("name", $row['name']);
        $newnode->set_attribute("address", $row['address']);
        $newnode->set_attribute("lat", $row['lat']);
        $newnode->set_attribute("lng", $row['lng']);
        $newnode->set_attribute("type", $row['type']);
    endwhile;

    $xmlfile = $doc->dump_mem();
    echo $xmlfile;*/


?>