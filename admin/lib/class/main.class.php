<?php

class main {
    
	public function db_connect() //connect to database
	{
        $result = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);	 //define in includes/config.php
        if(!$result) return false;
        else return $result;
	}

	private function db_result_to_array($result) //Transform query results into array
	{
        if(!$result) return false;
        $res_array = array();
        for($count = 0; $row = $result->fetch_assoc(); $count++)
        {
            $res_array[$count] = $row;
        }
        return $res_array;
	}

	private function db_result_to_num($result) //Transform query results into array
	{
        if(!$result) return false;
        $row_cnt = $result->num_rows;

        return $row_cnt;
	}

	/*
	TYPES:
	1 - article
	*/

	public function get_row($sql) //Get rows of a table from $sql
	{
        if(!$sql) return;
        $conn = $this->db_connect();
        $result = $conn->query($sql);
        if(!$result) return;
        $result = $this->db_result_to_array($result);

        return $result;
	}

	public function get_numrow($sql) //Get num rows of a table from $sql
	{
        if(!$sql) return;
        $conn = $this->db_connect();
        $result = $conn->query($sql);
        if(!$result) return;
        $result = $this->db_result_to_num($result);

        return $result;
	}

	public function db_query($sql) //Get rows of a table from $sql
	{
        if(!$sql) return;
        $conn = $this->db_connect();
        $result = $conn->query($sql);
        return $result;
	}

    public function db_insert($sql) //Get rows of a table from $sql
	{
        if(!$sql) return;
        $conn = $this->db_connect();
        $result = $conn->query($sql);
        $result = $conn->insert_id;

        return $result;
	}

	# MAIN CLASS
    
    function get_products($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $exclude = 0, $feature = 0, $user = 0)
	{ 
		$sql="SELECT * FROM tbl_product
			WHERE product_status > 0";
        if ($id) : $sql.=" AND product_id = ".$id; endif;
        if ($exclude) : $sql.=" AND product_id != ".$exclude; endif;
        if ($feature) : $sql.=" AND product_feature = 1"; endif;
		if ($search) : $sql.=" AND (product_name LIKE '%".$search."%' OR product_model LIKE '%".$search."%')"; endif;
        if ($user) : $sql.=" AND product_user = ".$user; endif;
        $sql.=" ORDER BY product_id DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_brands($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $status = 0)
	{ 
		$sql="SELECT * FROM tbl_brand";
		if ($status) : $sql.=" WHERE brand_status = ".$status;  
        else : $sql.=" WHERE brand_status > 0"; endif;
        if ($id) : $sql.=" AND brand_id = ".$id; endif;
        if ($search) : $sql.=" AND (brand_name LIKE '%".$search."%' OR brand_alias LIKE '%".$search."%')"; endif;
        $sql.=" ORDER BY brand_name ASC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_category($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $status = 0)
	{ 
		$sql="SELECT * FROM tbl_category";
		if ($status) : $sql.=" WHERE category_status = ".$status;  
        else : $sql.=" WHERE category_status > 0"; endif;
        if ($id) : $sql.=" AND category_id = ".$id; endif;
        if ($search) : $sql.=" AND category_name LIKE '%".$search."%'"; endif;
        $sql.=" ORDER BY category_name ASC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_subcat($id = 0, $start = 0, $limit = 0, $cat = 0, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_subcategory";
        $sql.=" WHERE subcat_status > 0";
        if ($id) : $sql.=" AND subcat_id = ".$id; endif;
        if ($cat) : $sql.=" AND subcat_cat = ".$cat; endif;
        $sql.=" ORDER BY subcat_name ASC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_promos($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_promo
			WHERE promo_status > 0";
        if ($id) : $sql.=" AND promo_id = ".$id; endif;
        if ($search) : $sql.=" AND promo_title LIKE '%".$search."%'"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_store($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_store";
        $sql.=" WHERE store_status > 0";
        if ($id) : $sql.=" AND store_id = ".$id; endif;
        if ($search) : $sql.=" AND (store_name LIKE '%".$search."%' OR store_city LIKE '%".$search."%')"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_career($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_career";
        $sql.=" WHERE career_status > 0";
        if ($id) : $sql.=" AND career_id = ".$id; endif;
        if ($search) : $sql.=" AND (career_name LIKE '%".$search."%' OR career_requirement LIKE '%".$search."%')"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_trans($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $status = 0, $type = 0, $datefrom = 0, $dateto = 0)
	{ 
		$sql="SELECT * FROM tbl_trans
			WHERE trans_status > 1";
        if ($id) : $sql.=" AND trans_id = ".$id; endif;
        if ($search) : $sql.=" AND trans_id LIKE '%".$search."%'"; endif;
        if ($datefrom && $dateto) : $sql.=" AND trans_date BETWEEN ".$datefrom." AND ".$dateto; endif;
        if ($status) : $sql.=" AND trans_status = ".$status; endif;
        if ($type == 1) : $sql.=" AND trans_paytype = 1"; 
        elseif ($type == 2) : $sql.=" AND trans_paytype != 1"; endif;
        $sql.=" ORDER BY trans_date DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_wish($id = 0, $start = 0, $limit = 0, $user = 0, $count = 0, $group = 0, $date = 0)
	{ 
        $datefrom = strtotime(date('Y-m-d', strtotime('-3 days')).' 00:00:00');
        $dateto = strtotime(date('Y-m-d', strtotime('-3 days')).' 23:59:59');
        
		$sql="SELECT * FROM tbl_wishlist
			WHERE wish_status > 1";
        if ($id) : $sql.=" AND wish_id = ".$id; endif;
        if ($user) : $sql.=" AND wish_user LIKE ".$user; endif;
        if ($date) : $sql.=" AND wish_date BETWEEN ".$datefrom." AND ".$dateto; endif;
        if ($group) : $sql.=" GROUP BY wish_user "; endif;
        $sql.=" ORDER BY wish_date DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_gallery($id = 0, $start = 0, $limit = 0, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_gallery
			WHERE gallery_status > 0";
        if ($id) : $sql.=" AND gallery_id = ".$id; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_price($id = 0, $start = 0, $limit = 0, $count = 0, $prod = 0)
	{ 
		$sql="SELECT * FROM tbl_price
			WHERE price_status > 0";
        if ($id) : $sql.=" AND price_id = ".$id; endif;
        if ($prod) : $sql.=" AND price_product = ".$prod; endif;
        $sql.=" ORDER BY price_date DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_pics($id = 0, $start = 0, $limit = 0, $count = 0, $prod = 0, $type = 0)
	{ 
		$sql="SELECT * FROM tbl_pics
			WHERE pic_status > 0";
        if ($id) : $sql.=" AND pic_id = ".$id; endif;
        if ($prod) : $sql.=" AND pic_data = ".$prod; endif;
        if ($type) : $sql.=" AND pic_type = ".$type; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_content($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $exclude = 0)
	{ 
		$sql="SELECT * FROM tbl_content
			WHERE content_status > 0";
        if ($id) : $sql.=" AND content_id = ".$id; endif;
        if ($exclude) : $sql.=" AND content_id != ".$exclude; endif;
		if ($search) : $sql.=" AND (content_title LIKE '%".$search."%' OR content_blurb LIKE '%".$search."%' OR content_text LIKE '%".$search."%')"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_user($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $exclude = 0, $status = 0)
	{ 
		$sql="SELECT * FROM tbl_user";
        if ($status) : $sql .= " WHERE user_status = ".$status;
        else : $sql .= " WHERE user_status > 0"; endif;
        if ($id) : $sql.=" AND user_id = ".$id; endif;
        if ($exclude) : $sql.=" AND user_id != ".$exclude; endif;
		if ($search) : $sql.=" AND (user_firstname LIKE '%".$search."%' OR user_lastname LIKE '%".$search."%' OR user_email LIKE '%".$search."%')"; endif;
        $sql.=" ORDER BY user_id DESC";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_setting($id = 0, $start = 0, $limit = 0, $var = NULL, $count = 0, $status = 0)
	{ 
		$sql="SELECT * FROM tbl_setting";
		if ($status) : $sql.=" WHERE set_status = ".$status;  
        else : $sql.=" WHERE set_status > 0"; endif;
        if ($id) : $sql.=" AND set_id = ".$id; endif;
        if ($var) : $sql.=" AND set_var = '".$var."'"; endif;
        $sql.=" ORDER BY set_id ASC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}

    # ACTIONS
    
    function product_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_product 
                    SET product_name = '".addslashes($product_name)."', 
                    product_model = '".addslashes($product_model)."', 
                    product_modelyear = '".addslashes($product_modelyear)."',
                    product_feature = ".$product_feature.",
                    product_price = '".$product_price."',
                    product_sku = '".addslashes($product_sku)."',
                    product_cat = '".$product_cat."',
                    product_subcat = '".$product_subcat."',
                    product_specs = '".addslashes($product_specs)."',
                    product_blurb = '".addslashes($product_blurb)."',
                    product_brand = '".$product_brand."',
                    product_smallimg = '".$product_smallimg."',
                    product_largeimg = '".$product_largeimg."',
                    product_tags = '".$product_tags."',
                    product_date = UNIX_TIMESTAMP(), 
                    product_user = ".$product_user.", 
                    product_status = 1";               
                $addprod = $this->db_insert($sql);
                
                if($addprod) {
                    return $addprod;
                } else {
                    return FALSE;
                }
			break;
            case 'update':
                
                if ($product_smallimg) : $spictext = "product_smallimg = '".$product_smallimg."',";
                else : $spictext = ""; endif;
                if ($product_largeimg) : $lpictext = "product_largeimg = '".$product_largeimg."',";
                else : $lpictext = ""; endif;

                $sql="UPDATE tbl_product 
                    SET product_name = '".addslashes($product_name)."', 
                    product_model = '".addslashes($product_model)."', 
                    product_modelyear = '".addslashes($product_modelyear)."',
                    product_feature = ".$product_feature.",
                    product_price = '".$product_price."',
                    product_sku = '".addslashes($product_sku)."',
                    product_cat = '".$product_cat."',
                    product_subcat = '".$product_subcat."',
                    product_specs = '".addslashes($product_specs)."',
                    product_blurb = '".addslashes($product_blurb)."',
                    product_brand = '".$product_brand."',
                    ".$spictext."
                    ".$lpictext."
                    product_tags = '".$product_tags."',
                    product_update = UNIX_TIMESTAMP(), 
                    product_user = ".$product_user."                                   
                    WHERE product_id = ".$id;               
                $editprod = $this->db_query($sql);
                
                if($editprod) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_product 
                    SET product_status = 0
                    WHERE product_id = ".$id;               
                $delgprod = $this->db_query($sql);
                
                if($delgprod) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_product 
                    SET product_status = ".$product_status."
                    WHERE product_id = ".$id;               
                $statprod = $this->db_query($sql);
                
                if($statprod) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
			case 'addpic':

                $sql="INSERT INTO tbl_pics 
                    SET pic_data = ".$pic_data.", 
                    pic_file = '".$pic_file."',
                    pic_type = ".$pic_type.",
                    pic_date = UNIX_TIMESTAMP(), 
                    pic_user = ".$pic_user.", 
                    pic_status = 2";               
                $addpic = $this->db_insert($sql);
                
                if($addpic) {
                    return $addpic;
                } else {
                    return FALSE;
                }
			break;
            case 'delpic':

                $sql="UPDATE tbl_pics 
                    SET pic_status = 0
                    WHERE pic_id = ".$id;               
                $delpic = $this->db_query($sql);
                
                if($delpic) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
			case 'addprice':

                $sql="INSERT INTO tbl_price 
                    SET price_price = '".$price_price."', 
                    price_product = ".$price_product.",
                    price_date = UNIX_TIMESTAMP(), 
                    price_user = ".$price_user.", 
                    price_status = 2";               
                $addprice = $this->db_insert($sql);
                
                if($addprice) {
                    return $addprice;
                } else {
                    return FALSE;
                }
			break;
		}
	} 
    
    function brand_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_brand 
                    SET brand_name = '".$brand_name."',
                    brand_alias = '".$brand_alias."',
                    brand_logo = '".$brand_logo."',
                    brand_country = '".$brand_country."',
                    brand_date = UNIX_TIMESTAMP(), 
                    brand_user = ".$brand_user.", 
                    brand_status = 1";               
                $addbrand = $this->db_insert($sql);
                
                if($addbrand) {
                    return $addbrand;
                } else {
                    return FALSE;
                }
			break;
            case 'update':
                
                if ($brand_logo) : $blogo = "brand_logo = '".$brand_logo."',";
                else : $blogo = ""; endif;

                $sql="UPDATE tbl_brand 
                    SET brand_name = '".$brand_name."',
                    brand_alias = '".$brand_alias."',
                    ".$blogo."
                    brand_country = '".$brand_country."',
                    brand_update = UNIX_TIMESTAMP(), 
                    brand_user = ".$brand_user."            
                    WHERE brand_id = ".$id;               
                $editbrand = $this->db_query($sql);
                
                if($editbrand) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_brand 
                    SET brand_status = 0
                    WHERE brand_id = ".$id;               
                $delbrand = $this->db_query($sql);
                
                if($delbrand) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_brand 
                    SET brand_status = ".$brand_status."
                    WHERE brand_id = ".$id;               
                $statbrand = $this->db_query($sql);
                
                if($statbrand) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function category_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_category 
                    SET category_name = '".$category_name."',
                    category_date = UNIX_TIMESTAMP(), 
                    category_user = ".$category_user.", 
                    category_status = 1";               
                $addcategory = $this->db_insert($sql);
                
                if($addcategory) {
                    return $addcategory;
                } else {
                    return FALSE;
                }
			break;
            case 'update':

                $sql="UPDATE tbl_category 
                    SET category_name = '".$category_name."',
                    category_update = UNIX_TIMESTAMP(), 
                    category_user = ".$category_user."            
                    WHERE category_id = ".$id;               
                $editcategory = $this->db_query($sql);
                
                if($editcategory) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_category 
                    SET category_status = 0
                    WHERE category_id = ".$id;               
                $delcategory = $this->db_query($sql);
                
                if($delcategory) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_category 
                    SET category_status = ".$category_status."
                    WHERE category_id = ".$id;               
                $statcategory = $this->db_query($sql);
                
                if($statcategory) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'addsub':

                $sql="INSERT INTO tbl_subcategory 
                    SET subcat_name = '".$subcat_name."',
                    subcat_cat = '".$subcat_cat."',
                    subcat_date = UNIX_TIMESTAMP(), 
                    subcat_status = 2";               
                $addsubcat = $this->db_insert($sql);
                
                if($addsubcat) {
                    return $addsubcat;
                } else {
                    return FALSE;
                }
			break;
            case 'updatesub':

                $sql="UPDATE tbl_subcategory 
                    SET subcat_name = '".$subcat_name."',
                    subcat_update = UNIX_TIMESTAMP()            
                    WHERE subcat_id = ".$id;               
                $editsubcat = $this->db_query($sql);
                
                if($editsubcat) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'deletesub':

                $sql="UPDATE tbl_subcategory 
                    SET subcat_status = 0
                    WHERE subcat_id = ".$id;               
                $delsubcat = $this->db_query($sql);
                
                if($delsubcat) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function promo_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_promo 
                    SET promo_title = '".$promo_title."',
                    promo_desc = '".$promo_desc."', 
                    promo_mechanic = '".$promo_mechanic."', 
                    promo_smallimg = '".$promo_smallimg."', 
                    promo_largeimg = '".$promo_largeimg."', 
                    promo_hugeimg = '".$promo_hugeimg."', 
                    promo_type = '".$promo_type."', 
                    promo_date = UNIX_TIMESTAMP(), 
                    promo_user = ".$promo_user.", 
                    promo_status = 1";               
                $addpromo = $this->db_insert($sql);
                
                if($addpromo) {
                    return $addpromo;
                } else {
                    return FALSE;
                }
			break;
            case 'update':
                
                if ($promo_smallimg) : $spromo = "promo_smallimg = '".$promo_smallimg."',";
                else : $spromo = ""; endif;
                if ($promo_largeimg) : $lpromo = "promo_largeimg = '".$promo_largeimg."',";
                else : $lpromo = ""; endif;
                if ($promo_hugeimg) : $hpromo = "promo_hugeimg = '".$promo_hugeimg."',";
                else : $hpromo = ""; endif;

                $sql="UPDATE tbl_promo 
                    SET promo_title = '".$promo_title."',
                    promo_desc = '".$promo_desc."',  
                    promo_mechanic = '".$promo_mechanic."', 
                    ".$spromo." 
                    ".$lpromo." 
                    ".$hpromo." 
                    promo_type = '".$promo_type."', 
                    promo_update = UNIX_TIMESTAMP(), 
                    promo_user = ".$promo_user."         
                    WHERE promo_id = ".$id;               
                $editpromo = $this->db_query($sql);
                
                if($editpromo) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_promo 
                    SET promo_status = 0
                    WHERE promo_id = ".$id;               
                $delpromo = $this->db_query($sql);
                
                if($delpromo) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_promo 
                    SET promo_status = ".$promo_status."
                    WHERE promo_id = ".$id;               
                $statpromo = $this->db_query($sql);
                
                if($statpromo) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function content_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_content 
                    SET content_type = '".$content_type."', 
                    content_title = '".$content_title."',
                    content_blurb = '".$content_blurb."', 
                    content_text = '".$content_text."',
                    content_date = UNIX_TIMESTAMP(), 
                    content_update = UNIX_TIMESTAMP(), 
                    content_user = ".$content_user.", 
                    content_status = 2";               
                $addcontent = $this->db_insert($sql);
                
                if($addcontent) {
                    return $addcontent;
                } else {
                    return FALSE;
                }
			break;
            case 'update':

                $sql="UPDATE tbl_content 
                    SET content_type = '".$content_type."', 
                    content_title = '".$content_title."',
                    content_blurb = '".$content_blurb."', 
                    content_text = '".$content_text."',
                    content_update = UNIX_TIMESTAMP(), 
                    content_user = ".$content_user.", 
                    content_status = 2        
                    WHERE content_id = ".$id;               
                $editcontent = $this->db_query($sql);
                
                if($editcontent) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_content 
                    SET content_status = 0
                    WHERE content_id = ".$id;               
                $delcontent = $this->db_query($sql);
                
                if($delcontent) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_content 
                    SET content_status = ".$content_status."
                    WHERE content_id = ".$id;               
                $statcontent = $this->db_query($sql);
                
                if($statcontent) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function career_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_career 
                    SET career_name = '".$career_name."', 
                    career_requirement = '".$career_requirement."',
                    career_postfrom = '".$career_postfrom."', 
                    career_postto = '".$career_postto."',
                    career_date = UNIX_TIMESTAMP(), 
                    career_user = ".$career_user.", 
                    career_status = 2";               
                $addcareer = $this->db_insert($sql);
                
                if($addcareer) {
                    return $addcareer;
                } else {
                    return FALSE;
                }
			break;
            case 'update':

                $sql="UPDATE tbl_career 
                    SET career_name = '".$career_name."', 
                    career_requirement = '".$career_requirement."',
                    career_postfrom = '".$career_postfrom."', 
                    career_postto = '".$career_postto."',
                    career_user = ".$career_user.", 
                    career_status = 2
                    WHERE career_id = ".$id;               
                $editcareer = $this->db_query($sql);
                
                if($editcareer) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_career 
                    SET career_status = 0
                    WHERE career_id = ".$id;               
                $delcareer = $this->db_query($sql);
                
                if($delcareer) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_career 
                    SET career_status = ".$career_status."
                    WHERE career_id = ".$id;               
                $statcareer = $this->db_query($sql);
                
                if($statcareer) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function store_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_store 
                    SET store_name = '".$store_name."', 
                    store_address = '".$store_address."',
                    store_city = '".$store_city."',
                    store_province = '".$store_province."',
                    store_tel = '".$store_tel."',
                    store_x = '".$store_x."', 
                    store_y = '".$store_y."',
                    store_hour = '".$store_hour."',
                    store_type = 'store',
                    store_date = UNIX_TIMESTAMP(), 
                    store_user = ".$store_user.", 
                    store_status = 2";               
                $addstore = $this->db_insert($sql);
                
                if($addstore) {
                    return $addstore;
                } else {
                    return FALSE;
                }
			break;
            case 'update':

                $sql="UPDATE tbl_store 
                    SET store_name = '".$store_name."', 
                    store_address = '".$store_address."',
                    store_city = '".$store_city."',
                    store_province = '".$store_province."',
                    store_tel = '".$store_tel."',
                    store_x = '".$store_x."', 
                    store_y = '".$store_y."',
                    store_hour = '".$store_hour."',
                    store_date = UNIX_TIMESTAMP(), 
                    store_user = ".$store_user.", 
                    store_status = 2
                    WHERE store_id = ".$id;               
                $editstore = $this->db_query($sql);
                
                if($editstore) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_store 
                    SET store_status = 0
                    WHERE store_id = ".$id;               
                $delstore = $this->db_query($sql);
                
                if($delstore) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_store 
                    SET store_status = ".$store_status."
                    WHERE store_id = ".$id;               
                $statstore = $this->db_query($sql);
                
                if($statstore) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function trans_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
            case 'delete':

                $sql="UPDATE tbl_trans 
                    SET trans_status = 0,
                    trans_date = UNIX_TIMESTAMP(),
                    trans_user = ".$trans_user."
                    WHERE trans_id = ".$id;               
                $deltrans = $this->db_query($sql);
                
                if($deltrans) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_trans 
                    SET trans_status = ".$trans_status.",
                    trans_date = UNIX_TIMESTAMP(),
                    trans_user = ".$trans_user."
                    WHERE trans_id = ".$id;               
                $stattrans = $this->db_query($sql);
                
                if($stattrans) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'refnum':

                $sql="UPDATE tbl_trans 
                    SET trans_refnum = '".$trans_refnum."',
                    trans_date = UNIX_TIMESTAMP(),
                    trans_user = ".$trans_user."
                    WHERE trans_id = ".$id;               
                $rntrans = $this->db_query($sql);
                
                if($rntrans) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	} 

    function user_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
                
			case 'add':	

                $sql="INSERT INTO tbl_user 
                    SET user_firstname = '".$user_firstname."',
                    user_middlename = '".$user_middlename."',
                    user_lastname = '".$user_lastname."',
                    user_type = ".$user_type.",
                    user_address = '".$user_address."',
                    user_city = '".$user_city."',
                    user_zip = '".$user_zip."',
                    user_nationality = '".$user_nationality."',
                    user_cstatus = '".$user_cstatus."',
                    user_telno = '".$user_telno."',
                    user_mobile = '".$user_mobile."',
                    user_email = '".$user_email."',
                    user_password = '".md5($user_password)."',
                    user_subscribe = '".$user_subscribe."',
                    user_refer = '".$user_refer."', 
                    user_likes = '".$user_likes."',
                    user_date = UNIX_TIMESTAMP(),
                    user_user = '".$user_user."',
                    user_status = 1";			
                
                $lastid = $this->db_insert($sql);
                
                if($sql) {
                    return $sql;
                } else {
                    return FALSE;
                }
			break;
            case 'update':	

                $sql="UPDATE tbl_user  
                    SET user_firstname = '".$user_firstname."',
                    user_middlename = '".$user_middlename."',
                    user_lastname = '".$user_lastname."',
                    user_type = ".$user_type.",
                    user_address = '".$user_address."',
                    user_city = '".$user_city."',
                    user_zip = '".$user_zip."',
                    user_nationality = '".$user_nationality."',
                    user_cstatus = '".$user_cstatus."',
                    user_telno = '".$user_telno."',
                    user_mobile = '".$user_mobile."',
                    user_email = '".$user_email."',
                    user_subscribe = '".$user_subscribe."',
                    user_refer = '".$user_refer."', 
                    user_likes = '".$user_likes."',
                    user_update = UNIX_TIMESTAMP(),
                    user_user = '".$user_user."'
                    WHERE user_id = ".$id;				

                $update_user = $this->db_query($sql);

                if($update_user) {
                    return TRUE;
                } else {
                    return FALSE;
                }
			break;
            case 'password':	

                $sql="UPDATE tbl_user 
                    SET user_password = '".md5($user_password)."'
                    WHERE user_id = ".$id;				

                $update_pass = $this->db_query($sql);

                if($update_pass) {
                    return TRUE;
                } else {
                    return FALSE;
                }
			break;
            case 'status':

                $sql="UPDATE tbl_user 
                    SET user_status = ".$user_status."
                    WHERE user_id = ".$id;               
                $statuser = $this->db_query($sql);
                
                if($statuser) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':	

                $sql="UPDATE tbl_user 
                    SET user_status = 0
                    WHERE user_id = ".$id;				
                
                $delete_user = $this->db_query($sql);
                
                if($delete_user) {
                    return TRUE;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function setting_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
            case 'update':

                $sql="UPDATE tbl_setting 
                    SET set_val = '".$set_val."'
                    WHERE set_id = ".$id;               
                $editset = $this->db_query($sql);
                
                if($editset) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	}
    
    function logs_action($value, $action)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
            case 'add':	

                $sql="INSERT INTO tbl_logs 
                    SET logs_item = '".$logs_item."',
                    logs_task = '".$logs_task."',
                    logs_date = UNIX_TIMESTAMP(),
                    logs_user = '".$logs_user."',
                    logs_status = 1";			
                
                $lastid = $this->db_insert($sql);
                
                if($sql) {
                    return $sql;
                } else {
                    return FALSE;
                }
			break;
		}
	} 

	# MISCELLEANNOUS

	function pagination($section, $record, $limit, $range = 9, $idnum = 0){
	  // $paged - number of the current page

	    global $paged;
		$web_root = ROOT;

		$pagetxt = "";
	  // How much pages do we have?
		$paged = $_GET['page'] ? $_GET['page'] : "1";
        
		$max_num_pages = ceil($record/$limit);
        
		if (!$max_page) {
			$max_page = $max_num_pages;
		}
        
	  // We need the pagination only if there are more than 1 page

	  if($max_page > 1){
		if(!$paged){
		  $paged = 1;
		}

		// On the first page, don't put the First page link

		if($paged != 1){
		  $pagetxt .= "<a href='".$web_root."/".$section."/page/1".($idnum ? "?id=".$idnum : "")."' class='blacktext nodecor'><i class='fa fa-lg fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;</a>";
		  $prev_var = $_GET['page'] ? $_GET['page'] - 1 : "0"; //previous page_num
		  $pagetxt .= "<a href='".$web_root."/".$section."/page/".$prev_var."".($idnum ? "?id=".$idnum : "")."' class='blacktext nodecor'>Previous&nbsp;&nbsp;&nbsp;</a>";
		}

		// We need the sliding effect only if there are more pages than is the sliding range

		if($max_page > $range){

		  // When closer to the beginning

		  if($paged < $range){
				for($i = 1; $i <= ($range + 1); $i++){
					$pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
					if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
					else $pagetxt .= "<div class = 'pagelink blacktext'>".$i."</div>";				
					$pagetxt .= "</a>";
				}
		  }

		  // When closer to the end

		  elseif($paged >= ($max_page - ceil(($range/2)))){
				for($i = $max_page - $range; $i <= $max_page; $i++){
					$pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
					if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
					else $pagetxt .= "<div class = 'pagelink blacktext'>".$i."</div>";				
					$pagetxt .= "</a>";
				}
		  }

		  // Somewhere in the middle

		  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
					$pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
					if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
					else $pagetxt .= "<div class = 'pagelink blacktext'>".$i."</div>";				
					$pagetxt .= "</a>";
				}
		  }
		}

		// Less pages than the range, no sliding effect needed

		else{
		  for($i = 1; $i <= $max_page; $i++) {
				$pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
				if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
				else $pagetxt .= "<div class = 'pagelink blacktext'>".$i."</div>";				
				$pagetxt .= "</a>";
		  }
		}

		// On the last page, don't put the Last page link

		if($paged != $max_page){
			$next_var= $_GET['page'] ? $_GET['page'] + 1 : "2"; //next page_num
			$pagetxt .= "<a href='".$web_root."/".$section."/page/".$next_var."".($idnum ? "?id=".$idnum : "")."' class = 'blacktext nodecor'>&nbsp;&nbsp;&nbsp;Next</a>";
			$pagetxt .= "<a href='".$web_root."/".$section."/page/".$max_page."".($idnum ? "?id=".$idnum : "")."' class = 'blacktext nodecor'>&nbsp;&nbsp;&nbsp;<i class='fa fa-lg fa-angle-double-right'></i></a>";

		}
	  }
		return $pagetxt;
	}

	function curPageURL() 
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

		$pageURL .= "://";

		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	function cleanuserinput($input)
	{
		if (get_magic_quotes_gpc()) {
			$clean = mysqli_real_escape_string(stripslashes($input));
		}
		else
		{
			$clean = mysqli_real_escape_string($input);
		}
		return $clean;
	}

	function cleanpostvar($getvar)
	{		
		$conn = $this->db_connect();
		$str = $conn->real_escape_string($getvar);
		return $str;
	}
    
	function cleanpostname($input, $reverse=false)
	{
		if($reverse==true) {
			$str = $input;		
			$str = str_replace("ï¿½", "&rsquo;", $str);
			$str = str_replace("ÃƒÂ©", "&eacute;", $str);
			$str = str_replace("â€¦ ï¿½", "&nbsp;", $str);
			$str = str_replace("â€¦", "&nbsp;", $str);
			$str = str_replace("&amp;", "&", $str);
			$str = str_replace("&quot;", "\"", $str);
			$str = str_replace("&rsquo;", "'", $str);
			$str = str_replace("ï¿½", "&ntilde;", $str);
			$str = str_replace("ï¿½", "&eacute;", $str);
			$str = str_replace("ï¿½", "&Eacute;", $str);
			$str = str_replace("ï¿½", "&hellip;", $str);
			$str = str_replace("ï¿½", "&nbsp;", $str);
			$str = str_replace("Ã©", "&eacute;", $str);
			$str = str_replace("Ã±", "&ntilde;", $str);		
			$str = str_replace("Ã'", "&Ntilde;", $str);		
			$str = str_replace("ï¿½", "&Ntilde;", $str);
			$str = str_replace("&nbsp;", " ", $str);
			$str = str_replace("â€™", "'", $str);			
			$str = stripslashes($str);
		} else {
			$str = stripslashes($input);
			$str = str_replace("&amp;", "&", $str);
			$str = str_replace("&quot;", "\"", $str);
			$str = str_replace("&rsquo;", "'", $str);
			$str = str_replace(" ", "-", $str);
			$str = str_replace("&ntilde;", "n", $str);
			$str = str_replace("&eacute;", "ï¿½", $str);
			$str = str_replace("&hellip;", "", $str);
			$str = stripslashes(urldecode(html_entity_decode($str)));
			$str = preg_replace("/[^a-zA-Z0-9-]/", "", urldecode($str));
		}

		return $str;
	}

	function get_logs($artid)
	{		
		$sql = "SELECT a.logs_item, a.logs_task, a.logs_date, b.user_firstname, b. user_lastname
			 FROM tbl_logs a, tbl_user b
			 WHERE b.user_id = a.logs_user
			 AND a.logs_item = ".$artid."
			 AND a.logs_status = 1";

		$result = $this->get_row($sql);
        
		return $result;
	}

	function activate_directory_tab($link,$tab)
	{
		if($link == $tab) {
			return 'class="dir_link current"';
		} else {
			return 'class="dir_link"';
		}	
	}

	function truncate($string, $length)
	{
		if (strlen($string) <= $length) {
			$string = $string; //do nothing
        } else {
			$string = wordwrap($string, $length);
			$string = substr($string, 0, strpos($string, "\n"));
			$string .= '...';
		}
		return $string;
	}

	function filter_bad_comments($comment, $username=false)
	{

		if ($username == false) {
			$replace_with = "***THIS COMMENT HAS BEEN DELETED DUE TO VIOLATION OF SPOT.PH'S TERMS AND CONDITIONS.***";
		} else {
			$replace_with = "***";
		}
        
		$badwords = array( "pokpok", " kupal ", " slut\."," kups ", "fucker"," slut ", " pucha ", " tae ", "bullshit", "shit", " shit\.", " gago ", " puta ", " tangina ", " tonto ", " tang ", " asshole ", "fuck", "pekpek", " titi ", " etits ", " tits ", " penis ", " vagina ", "pudayday", " puday ", " kepyas ", "kepkep", " dede ", "tarantado", "bitch", " hosto ", " Ass ", "Ass wipe", "Biatch", " Bitches ", "Biatches", "Beyotch", "Bulbol", "Bolbol",  " Boobs ", " Cunt ", "Callboy", "Callgirl", " Clit ", " Douche bag ", "Dumb ass", " Dodo ", " Dipshit ", " Dung face ", " Echas ", " Fag ", " Hoe ", " Hooker ", "Jakol", "Jackol", " Kunt ", "Kantot", "Putang ina", " Pussy ", " Prat ", " Prick ", " Satan ", " Shit ", " Ulol ", " puke ", " puki ", "kakantutin", "kakantuten", "makantot", " Ass "," Echas "," Tits ","Asshole","Fuck","Tang ina"," Ass wipe "," Fag ","Tarantado"," Bitch "," Gago ","Biatch"," Ulol "," Bitches "," Ulul "," Biatches "," Gagi "," Utong ","Beyotch"," Hoe ","Beeyotch"," Hooker ","Bulbol","Haliparot"," Bolbol "," Jakol "," Boobs "," Jackol ","Bullshit"," Kunt ","Kantot"," Cunt "," Nigger ","Pakshit","Pokpok","Putang ina","Callboy"," Puta ","Callgirl"," Puerta "," Clit "," Pwerta ","Chimi a a"," Pussy ","Douche bag"," Prat "," Prick ","Dumb ass"," Satan "," Dodo "," Doofus "," Shit ","Dipshit"," Dung face "," ebs ","kanguso","kapangilya","p0kp0k","p0t@"," fcuk "," pwet "," pwit ","haliparot","lawlaw", "pokpok", "Pokpok", "showbizjuice", " Pwe ", "Pweh", " pwe ", "pwe\!", "pweh", "fuck ", " fuck", "Fuck ", " Fuck", " fuck ", " Fuck ", "fuck", "Fuck", " Faggot ", " faggot ", "Faggot ", "faggot ", " Faggot", " faggot", " echusera ", " Echusera ", " Ngoyngoy ", " ngoyngoy ", "Ngoyngoy ", "ngoyngoy ", " Ngoyngoy", " ngoyngoy", "Ngoyngoy", "ngoyngoy", "pwe ", "pwe.", " che ", " bitch\.", "crap");	

		$bw_exp = "";
		$badword_match = 0;

		foreach ($badwords as $badwords_exp) {
		    $bw_exp="/" . $badwords_exp ."/i";
			if (preg_match($bw_exp, $comment)) {
				$badword_match = $badword_match + 1;
			}
		}	

		if($badword_match > 0) {
			return $replace_with;
		} else {
			return $comment;
		}

	}

	function clean_variable($var, $type = 0)
	{
		if (get_magic_quotes_gpc())
		{
			$newvar = stripslashes($var);
		}
		else
		{
			$newvar = $var;
		}           

		if ($type == 1) //numeric (such as ID)
		{                 
			$conn = $this->db_connect(1);
			$newvar = $conn->real_escape_string($newvar);
			$newvar = (int)$newvar;
			return $newvar;
		}

		elseif ($type == 2) //alphanum with dash (such as postname or slug)
		{
			$newvar = preg_replace("/[^a-zA-Z0-9-_]/", "", $newvar);          
			$newvar = strtolower($newvar);
			$conn = $this->db_connect(1);            
			$newvar = $conn->real_escape_string($newvar);

			return $newvar;
		}

		elseif ($type == 3) // block some MySQL parameter
		{
			$sqlword = array("/scheme/i","/delete/i", "/update/i","/union/i","/insert/i","/drop/i","/http/i","/--/i");
			$newvar = preg_replace($sqlword, "", $newvar);
			$conn = $this->db_connect(1);            
			$newvar = $conn->real_escape_string($newvar);
            
			return $newvar;
		}

		else // simple... MySQL Real Escape String only
		{                 
			$conn = $this->db_connect(1);            
			$newvar = $conn->real_escape_string($newvar);
            
			return $newvar;
		}
	}

}

?>