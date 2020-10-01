<?php

class mainsql {
    
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
    
    function get_products($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $exclude = 0, $feature = 0, $brand = 0, $cat = 0, $subcat = 0, $price = 0, $user = 0, $random = 0)
	{ 
        $brand = implode(',', $brand);
        $subcat = implode(',', $subcat);
        
		$sql="SELECT * FROM tbl_product
			WHERE product_status > 1";
        if ($id) : $sql.=" AND product_id = ".$id; endif;
        if ($exclude) : $sql.=" AND product_id != ".$exclude; endif;
        if ($feature) : $sql.=" AND product_feature = 1"; endif;
        if ($brand) : $sql.=" AND product_brand IN (".$brand.")"; endif;
        if ($cat) : $sql.=" AND product_cat = ".$cat; endif;
        if ($subcat) : $sql.=" AND product_subcat IN (".$subcat.")"; endif;
        if ($price) : $sql.=" AND product_price BETWEEN ".$price[0]." AND ".$price[1].""; endif;
		if ($search) : $sql.=" AND (product_name LIKE '%".$search."%' OR product_model LIKE '%".$search."%' OR product_tags LIKE '%".$search."%')"; endif;
        if ($user) : $sql.=" AND product_user = ".$user; endif;
        if ($random) : $sql.=" ORDER BY RAND() ";
        else : $sql.=" ORDER BY product_id DESC "; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_minmax_price($max = 1, $search = NULL, $exclude = 0, $feature = 0, $brand = 0, $cat = 0, $subcat = 0, $user = 0)
    {
        $brand = implode(',', $brand);
        $subcat = implode(',', $subcat);
        
        if ($max) : $sql = "SELECT MAX(product_price) AS price FROM tbl_product WHERE product_status > 1";
        else : $sql = "SELECT MIN(product_price) AS price FROM tbl_product WHERE product_status > 1";
        endif;
        if ($id) : $sql.=" AND product_id = ".$id; endif;
        if ($exclude) : $sql.=" AND product_id != ".$exclude; endif;
        if ($feature) : $sql.=" AND product_feature = 1"; endif;
        if ($brand) : $sql.=" AND product_brand IN (".$brand.")"; endif;
        if ($cat) : $sql.=" AND product_cat = ".$cat; endif;
        if ($subcat) : $sql.=" AND product_subcat IN (".$subcat.")"; endif;
		if ($search) : $sql.=" AND (product_name LIKE '%".$search."%' OR product_model LIKE '%".$search."%' OR product_tags LIKE '%".$search."%')"; endif;
        if ($user) : $sql.=" AND product_user = ".$user; endif;
            
        $result = $this->get_row($sql);
        return $result[0]['price'];
        
    }
    
    function get_brands($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $status = 0, $random = 0)
	{ 
		$sql="SELECT * FROM tbl_brand";
		if ($status) : $sql.=" WHERE brand_status = ".$status;
        else : $sql.=" WHERE brand_status > 1"; endif;  
        $sql .= " AND brand_logo != ''"; 
        if ($id) : $sql.=" AND brand_id = ".$id; endif;
        if ($search) : $sql.=" AND (brand_name LIKE '%".$search."%' OR brand_alias LIKE '%".$search."%')"; endif;
        if ($random) : $sql.=" ORDER BY RAND()"; 
        else : $sql.=" ORDER BY brand_name ASC"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_category($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $status = 0, $random = 0)
	{ 
		$sql="SELECT * FROM tbl_category";
		if ($status) : $sql.=" WHERE category_status = ".$status;  
        else : $sql.=" WHERE category_status > 1"; endif;
        if ($id) : $sql.=" AND category_id = ".$id; endif;
        if ($search) : $sql.=" AND category_name LIKE '%".$search."%'"; endif;
        if ($random) : $sql.=" ORDER BY RAND()"; 
        else : $sql.=" ORDER BY category_name ASC"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_subcat($id = 0, $start = 0, $limit = 0, $cat = 0, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_subcategory";
        $sql.=" WHERE subcat_status > 1";
        if ($id) : $sql.=" AND subcat_id = ".$id; endif;
        if ($cat) : $sql.=" AND subcat_cat = ".$cat; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_promos($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_promo
			WHERE promo_status > 1";
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
        $sql.=" WHERE store_status > 1";
        if ($id) : $sql.=" AND store_id = ".$id; endif;
        if ($search) : $sql.=" AND (store_name LIKE '%".$search."%' OR store_address LIKE '%".$search."%' OR store_city LIKE '%".$search."%' OR store_province LIKE '%".$search."%')"; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_store_near($lat = 0, $lng = 0)
	{ 
		$sql="SELECT *, (3959 * acos(cos(radians('%s')) * cos(radians(store_x)) * cos(radians(store_y) - radians('%s')) + sin(radians('%s')) * sin(radians(store_x)))) AS distance FROM tbl_store
        HAVING distance < '%s' WHERE store_status > 1 ORDER BY distance";
		
        $result = $this->get_row($sql);
        
		return $result;
	}
    
    function get_career($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $date = 0)
	{ 
		$sql="SELECT * FROM tbl_career";
        $sql.=" WHERE career_status > 1";
        if ($id) : $sql.=" AND career_id = ".$id; endif;
        if ($search) : $sql.=" AND (career_name LIKE '%".$search."%' OR career_requirement LIKE '%".$search."%')"; endif;
        if ($date) : $sql.=" AND career_postfrom <= ".date('U')." AND career_postto >= ".date('U')." "; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_trans($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $user = 0, $status = 0)
	{ 
		$sql="SELECT * FROM tbl_trans
			WHERE trans_status >= 1";
        if ($id) : $sql.=" AND trans_id = ".$id; endif;
        if ($search) : $sql.=" AND trans_order LIKE '%".$search."%'"; endif;
        if ($user) : $sql.=" AND trans_uid = ".$user; endif;
        if ($status) :
            if ($status == 999) :
                $sql.=" AND (trans_status = 2 OR trans_status = 3) "; 
            else :
                $sql.=" AND trans_status = ".$status; 
            endif;
        endif;
        $sql.=" ORDER BY trans_date DESC";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_transstatus($id)
	{ 
		switch($id) {
            case 0: $result = "<div class='statbar dgraybg'>Deleted</div>"; break;
            case 1: $result = "<div class='statbar redbg'>Hold</div>"; break;
            case 2: $result = "<div class='statbar orangebg'>Processing</div>"; break;
            case 3: $result = "<div class='statbar bluebg'>Shipping</div>"; break;
            case 9: $result = "<div class='statbar greenbg'>Delivered</div>"; break;
            case 8: $result = "<div class='statbar tealbg'>Invalid</div>"; break;
        }
        
		return $result;
	}
    
    function get_wish($id = 0, $start = 0, $limit = 0, $user = 0, $count = 0, $product = 0, $desc = 0)
	{ 
		$sql="SELECT * FROM tbl_wishlist
			WHERE wish_status > 1";
        if ($id) : $sql.=" AND wish_id = ".$id; endif;
        if ($user) : $sql.=" AND wish_user = ".$user; endif;
        if ($product) : $sql.=" AND wish_product = ".$product; endif;
        if ($desc) : $sql.=" ORDER BY wish_date DESC "; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_gallery($id = 0, $start = 0, $limit = 0, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_gallery
			WHERE gallery_status > 1";
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
			WHERE price_status > 1";
        if ($id) : $sql.=" AND price_id = ".$id; endif;
        if ($prod) : $sql.=" AND price_product = ".$prod; endif;
        $sql.=" ORDER BY price_date DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_pics($id = 0, $start = 0, $limit = 0, $count = 0, $prod = 0)
	{ 
		$sql="SELECT * FROM tbl_pics
			WHERE pics_status > 1";
        if ($id) : $sql.=" AND pics_id = ".$id; endif;
        if ($prod) : $sql.=" AND pics_girl = ".$prod; endif;
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_content($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $type = 0)
	{ 
		$sql="SELECT * FROM tbl_content
			WHERE content_status > 1";
        if ($id) : $sql.=" AND content_id = ".$id; endif;
        if ($type) : $sql.=" AND content_type = ".$type; endif;
		if ($search) : $sql.=" AND (content_title LIKE '%".$search."%' OR content_blurb LIKE '%".$search."%' OR content_text LIKE '%".$search."%')"; endif;
        $sql.=" ORDER BY content_update DESC ";
        if ($limit) : $sql.=" LIMIT ".$start.", ".$limit; endif;
		
        if ($count) : $result = $this->get_numrow($sql);	
        else : $result = $this->get_row($sql);
        endif;
        
		return $result;
	}
    
    function get_users($id = 0, $start = 0, $limit = 0, $search = NULL, $count = 0, $exclude = 0)
	{ 
		$sql="SELECT * FROM tbl_user
			WHERE user_status > 0
            AND user_type != 9";
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
    
    function get_visit($ip = NULL, $count = 0)
	{ 
		$sql="SELECT * FROM tbl_visit";
        if ($ip) : $sql.=" WHERE visit_ip = '".$ip."'"; endif;
		
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
                    SET product_name = '".$product_name."', 
                    product_model = '".$product_model."',
                    product_subcat = '".$product_subcat."',
                    product_specs = ".$product_specs.",
                    product_blurb = ".$product_blurb.",
                    product_brand = '".$product_brand."',
                    product_price = '".$product_price."',
                    product_smallimg = '".$product_smallimg."',
                    product_largeimg = '".$product_largeimg."',
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
                    SET product_name = '".$product_name."', 
                    product_model = '".$product_model."',
                    product_subcat = '".$product_subcat."',
                    product_specs = ".$product_specs.",
                    product_blurb = ".$product_blurb.",
                    product_brand = '".$product_brand."',
                    product_price = '".$product_price."',
                    ".$spictext."
                    ".$lpictext."
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
                    SET pics_girl = ".$pics_girl.", 
                    pics_picture = '".$pics_picture."',
                    pics_date = UNIX_TIMESTAMP(), 
                    pics_user = ".$pics_user.", 
                    pics_status = 2";               
                $addpic = $this->db_insert($sql);
                
                if($addpic) {
                    return $addpic;
                } else {
                    return FALSE;
                }
			break;
            case 'delpic':

                $sql="UPDATE tbl_pics 
                    SET pics_status = 0
                    WHERE pics_id = ".$id;               
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
    
    function trans_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_trans
                    SET trans_uid = '".$trans_uid."', 
                    trans_order = '".$trans_order."',
                    trans_fname = '".$trans_fname."',
                    trans_mobile = '".$trans_mobile."',
                    trans_address = '".$trans_address."',
                    trans_uremark = '".$trans_uremark."',
                    trans_price = '".$trans_price."',
                    trans_paytype = '".$trans_paytype."',
                    trans_approvedate = 0,
                    trans_remarks = '".$trans_remark."',
                    trans_releasedate = 0,
                    trans_date = UNIX_TIMESTAMP(), 
                    trans_status = 2";               
                $addtrans = $this->db_insert($sql);
                
                if($addtrans) {
                    return $addtrans;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_trans 
                    SET trans_status = 0
                    WHERE trans_id = ".$id;               
                $deltrans = $this->db_query($sql);
                
                if($deltrans) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
		}
	} 
    
    function wish_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_wishlist
                    SET wish_product = '".$wish_product."', 
                    wish_user = '".$wish_user."',
                    wish_date = UNIX_TIMESTAMP(), 
                    wish_status = 2";               
                $addwish = $this->db_insert($sql);
                
                if($addwish) {
                    return $addwish;
                } else {
                    return FALSE;
                }
			break;
            case 'delete':

                $sql="UPDATE tbl_wishlist 
                    SET wish_status = 0
                    WHERE wish_id = ".$id;               
                $delwish = $this->db_query($sql);
                
                if($delwish) {
                    return $id;
                } else {
                    return FALSE;
                }
			break;
            case 'delete_byuser':

                $sql="UPDATE tbl_wishlist 
                    SET wish_status = 0
                    WHERE wish_user = ".$id;               
                $delwishuser = $this->db_query($sql);
                
                if($delwishuser) {
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
                
			case 'register':	

                $sql="INSERT INTO tbl_user 
                    SET user_firstname = '".$user_firstname."',
                    user_lastname = '".$user_lastname."',
                    user_type = 1,
                    user_email = '".$user_email."',
                    user_password = '".md5($user_password)."',
                    user_gtoken = '',
                    user_subscribe = 0,
                    user_refer = 0, 
                    user_likes = NULL,
                    user_date = UNIX_TIMESTAMP(),
                    user_user = 0,
                    user_status = 1";			
                
                $lastid = $this->db_insert($sql);
                
                if($lastid) {
                    return $lastid;
                } else {
                    return FALSE;
                }
			break;
                
			case 'regauth':	

                $sql="INSERT INTO tbl_user 
                    SET user_firstname = '".$user_firstname."',
                    user_lastname = '".$user_lastname."',
                    user_type = 1,
                    user_email = '".$user_email."',
                    user_password = '".md5($user_password)."',
                    user_gtoken = '".$user_gtoken."',
                    user_subscribe = 0,
                    user_refer = 0, 
                    user_likes = NULL,
                    user_date = UNIX_TIMESTAMP(),
                    user_user = 0,
                    user_status = 2";			
                
                $lastid = $this->db_insert($sql);
                
                if($lastid) {
                    return $lastid;
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
                    user_email = '".$user_lastname."',
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
                
			case 'subscribe':

                $sql="INSERT INTO tbl_user 
                    SET user_lastname = '".$user_lastname."',
                    user_type = 4,
                    user_email = '".$user_email."',
                    user_password = '".$user_password."',
                    user_gtoken = '',
                    user_subscribe = 0,
                    user_refer = 0, 
                    user_likes = NULL,
                    user_date = UNIX_TIMESTAMP(),
                    user_user = 0,
                    user_status = 1";			
                
                $lastid = $this->db_insert($sql);
                
                if($lastid) {
                    return $lastid;
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
            case 'activate':

                $sql="UPDATE tbl_user 
                    SET user_status = 2
                    WHERE user_id = ".$id;               
                $actuser = $this->db_query($sql);
                
                if($actuser) {
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
    
    function visit_action($value, $action, $id = 0)
	{
        $value = $value ? extract($value) : NULL;

		switch ($action) {
			case 'add':

                $sql="INSERT INTO tbl_visit
                    SET visit_ip = '".$visit_ip."',
                    visit_date = UNIX_TIMESTAMP()";               
                $addvisit = $this->db_insert($sql);
                
                if($addvisit) {
                    return $addvisit;
                } else {
                    return FALSE;
                }
			break;
		}
	} 
    
    function set_update($value)
	{
		$value = extract($value);
        
        $numrow = $this->get_set(1);
        
        if ($numrow == 0)
        {
            $sql="INSERT INTO tbl_setting
                (set_announce, set_mailfoot, set_numrows, set_date)
                VALUES
                ('".$set_announce."', '".$set_mailfoot."', '".$set_numrows."', GETDATE())";
            $query = $this->get_execute($sql);        
        }
        else
        {
            $sql="UPDATE tbl_setting 
                SET set_announce = '".$set_announce."', set_mailfoot = '".$set_mailfoot."', set_numrows = '".$set_numrows."', set_date = GETDATE()";			    
            $query = $this->get_execute($sql);        
        }            

        if($query) {
            return true;
        } else {
            return false;
        }
	}
    
    function log_action($value, $action)
	{
        $val = array();        

		switch ($action) {
			case 'add':
                
                $accepted_field = array('log_userid', 'log_task', 'log_data', 'log_date');
        
                $knum = 0;
                foreach ($value as $key => $value) :        
                    if (in_array($key, $accepted_field)) :
                        $val[$knum]['field_name'] = $key;        
                        $val[$knum]['field_value'] = $value; 
                        $val[$knum]['field_type'] = SQLVARCHAR;      
                        $val[$knum]['field_isoutput'] = false;
                        $val[$knum]['field_isnull'] = false;
                        $val[$knum]['field_maxlen'] = 512;    
                        
                        $knum++;
                    endif;
                endforeach;

                $add_log = $this->get_sp_data('SP_ADD_LOG', $val);

                if($add_log) {
                    return TRUE;
                } else {
                    return FALSE;
                }

			break;
        }
    }
    
    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }
    
    # REPLACE 1900 to 1971
    
    function remove1900($datestring) {
        $newdate = str_replace("1900", "1971", $datestring);
        
        return $newdate;
    }
    
    # MISCELLEANNOUS
	
	function pagination($section, $record, $limit, $range = 9, $idnum = 0) {
        // $paged - number of the current page
        global $paged;
        $web_root = ROOT;

        $pagetxt = "";

        // How much pages do we have?
        $paged = $_GET['page'] ? $_GET['page'] : "1";
        
        $nrecord = $record ? $record/$limit : 0;
        
        $max_num_pages = ceil($nrecord);

        if (!$max_page) {
            $max_page = $max_num_pages;
        }

        // We need the pagination only if there are more than 1 page
        if($max_page > 1){
            if(!$paged) {
                $paged = 1;
            }

            // On the first page, don't put the First page link
            if($paged != 1) {
                $pagetxt .= "<a href='".$web_root."/".$section."/page/1".($idnum ? "?id=".$idnum : "")."' class='nodecor'><i class='fa fa-lg fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;</a>";
                $prev_var = $_GET['page'] ? $_GET['page'] - 1 : "0"; //previous page_num
                $pagetxt .= "<a href='".$web_root."/".$section."/page/".$prev_var."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>Previous&nbsp;&nbsp;&nbsp;</a>";
            }

            // We need the sliding effect only if there are more pages than is the sliding range
            if($max_page > $range) {
                // When closer to the beginning
                if($paged < $range) {
                    for($i = 1; $i <= ($range + 1); $i++) {
                        $pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</a>";
                    }
                }
                // When closer to the end
                elseif($paged >= ($max_page - ceil(($range/2)))) {
                    for($i = $max_page - $range; $i <= $max_page; $i++) {
                        $pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</a>";
                    }
                }
                // Somewhere in the middle
                elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
                    for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
                        $pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</a>";
                    }
                }
            }
            // Less pages than the range, no sliding effect needed
            else {
                for($i = 1; $i <= $max_page; $i++) {
                    $pagetxt .= "<a href='".$web_root."/".$section."/page/".$i."".($idnum ? "?id=".$idnum : "")."' class='nodecor'>";
                    if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                    else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                    $pagetxt .= "</a>";
                }
            }


            // On the last page, don't put the Last page link
            if($paged != $max_page) {
                $next_var= $_GET['page'] ? $_GET['page'] + 1 : "2"; //next page_num
                $pagetxt .= "<a href='".$web_root."/".$section."/page/".$next_var."".($idnum ? "?id=".$idnum : "")."' class = 'nodecor'>&nbsp;&nbsp;&nbsp;Next</a>";
                $pagetxt .= "<a href='".$web_root."/".$section."/page/".$max_page."".($idnum ? "?id=".$idnum : "")."' class = 'nodecor'>&nbsp;&nbsp;&nbsp;<i class='fa fa-lg fa-angle-double-right'></i></a>";
            }
        }

        return $pagetxt;
	}
	
	function ajax_pagination($section, $record, $limit, $range = 9, $idnum = 0) {
        // $paged - number of the current page
        global $paged;
        $web_root = ROOT;

        $pagetxt = "";

        // How much pages do we have?
        $paged = $_GET['page'] ? $_GET['page'] : "1";
        
        $nrecord = $record ? $record/$limit : 0;
        
        $max_num_pages = ceil($nrecord);

        if (!$max_page) {
            $max_page = $max_num_pages;
        }

        // We need the pagination only if there are more than 1 page
        if($max_page > 1){
            if(!$paged) {
                $paged = 1;
            }

            // On the first page, don't put the First page link
            if($paged != 1) {
                $pagetxt .= "<span attribute='1' attribute2='".$section."' class='ajaxpage nodecor'><i class='fa fa-lg fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;</span>";
                $prev_var = $_GET['page'] ? $_GET['page'] - 1 : "0"; //previous page_num
                $pagetxt .= "<span attribute='".$prev_var."' attribute2='".$section."' class='ajaxpage nodecor'>Previous&nbsp;&nbsp;&nbsp;</span>";
            }

            // We need the sliding effect only if there are more pages than is the sliding range
            if($max_page > $range) {
                // When closer to the beginning
                if($paged < $range) {
                    for($i = 1; $i <= ($range + 1); $i++) {
                        $pagetxt .= "<span attribute='".$i."' attribute2='".$section."' class='ajaxpage nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</span>";
                    }
                }
                // When closer to the end
                elseif($paged >= ($max_page - ceil(($range/2)))) {
                    for($i = $max_page - $range; $i <= $max_page; $i++) {
                        $pagetxt .= "<span attribute='".$i."' attribute2='".$section."' class='ajaxpage nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</span>";
                    }
                }
                // Somewhere in the middle
                elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
                    for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
                        $pagetxt .= "<span attribute='".$i."' attribute2='".$section."' class='ajaxpage nodecor'>";
                        if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                        else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                        $pagetxt .= "</span>";
                    }
                }
            }
            // Less pages than the range, no sliding effect needed
            else {
                for($i = 1; $i <= $max_page; $i++) {
                    $pagetxt .= "<span attribute='".$i."' attribute2='".$section."' class='ajaxpage nodecor'>";
                    if($i==$paged) $pagetxt .= "<div class = 'pageactive whitetext'>".$i."</div>";
                    else $pagetxt .= "<div class = 'pagelink'>".$i."</div>";				
                    $pagetxt .= "</span>";
                }
            }


            // On the last page, don't put the Last page link
            if($paged != $max_page) {
                $next_var= $_GET['page'] ? $_GET['page'] + 1 : "2"; //next page_num
                $pagetxt .= "<span attribute='".$next_var."' attribute2='".$section."' class = 'ajaxpage nodecor'>&nbsp;&nbsp;&nbsp;Next</span>";
                $pagetxt .= "<span attribute='".$max_page."' attribute2='".$section."' class = 'ajaxpage nodecor'>&nbsp;&nbsp;&nbsp;<i class='fa fa-lg fa-angle-double-right'></i></a>";
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
    
    function cleanstring($input) {
        $input = str_replace(' ', '-', $input);
        $input = str_replace('.', '', $input);
        $input = str_replace(',', '', $input);
        echo preg_replace('@[^0-9A-Za-z\.]+@i', '', $input);
    }
    
    function cleanstring2($input) {
        $input = str_replace(' ', '-', $input);
        $input = str_replace('.', '', $input);
        $input = str_replace(',', '', $input);
        $input = str_replace(':', '', $input);
        return $input;
    }
    
    function cleannxtline($input) {
        $input = trim(preg_replace('/\s\s+/', ' ', $input));
        return addslashes(trim(preg_replace('/\r|\n/', ' ', str_replace("'", "&rsquo;", $input))));
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
	
	function activate_directory_tab($link,$tab)
	{
		if($link == $tab)
		{
			return 'class="dir_link current"';
		}else{
			return 'class="dir_link"';
		}	
	}
	
	function truncate($string, $length)
	{
		if (strlen($string) <= $length) {
			$string = $string; //do nothing
			}
		else {
			$string = wordwrap($string, $length);
			$string = substr($string, 0, strpos($string, "\n"));
			$string .= '...';
		}
		return $string;
	}
	
	function filter_bad_comments($comment)
	{		
		
        $replace_with = "***THIS COMMENT HAS BEEN DELETED DUE TO VIOLATION OF MEGAWORLD IHR TERMS AND CONDITIONS.***";

		$badwords = array( "pokpok", " kupal ", " slut\."," kups ", "fucker"," slut ", " pucha ", " tae ", "bullshit", "shit", " shit\.", " gago ", " puta ", " tangina ", " tonto ", " tang ", " asshole ", "fuck", "pekpek", " titi ", " etits ", " tits ", " penis ", " vagina ", "pudayday", " puday ", " kepyas ", "kepkep", " dede ", "tarantado", "bitch", " hosto ", " Ass ", "Ass wipe", "Biatch", " Bitches ", "Biatches", "Beyotch", "Bulbol", "Bolbol",  " Boobs ", " Cunt ", "Callboy", "Callgirl", " Clit ", " Douche bag ", "Dumb ass", " Dodo ", " Dipshit ", " Dung face ", " Echas ", " Fag ", " Hoe ", " Hooker ", "Jakol", "Jackol", " Kunt ", "Kantot", "Putang ina", " Pussy ", " Prat ", " Prick ", " Satan ", " Shit ", " Ulol ", " puke ", " puki ", "kakantutin", "kakantuten", "makantot", " Ass "," Echas "," Tits ","Asshole","Fuck","Tang ina"," Ass wipe "," Fag ", "tarantado"," Bitch "," Gago ","Biatch"," Ulol "," Bitches "," Ulul "," Biatches "," Gagi "," Utong ","Beyotch"," Hoe ","Beeyotch"," Hooker ","bulbol", "haliparot"," Bolbol "," Jakol "," Boobs "," Jackol ","Bullshit"," Kunt ","Kantot"," Cunt "," Nigger ","Pakshit","Pokpok","Putang ina","Callboy"," Puta ","Callgirl"," Puerta "," Clit "," Pwerta ","Chimi a a"," Pussy ","Douche bag"," Prat "," Prick ","Dumb ass"," Satan "," Dodo "," Doofus "," Shit ","Dipshit"," Dung face "," ebs ","kanguso","kapangilya","p0kp0k","p0t@"," fcuk "," pwet "," pwit ","haliparot","lawlaw", "pokpok", "Pokpok", "showbizjuice", " Pwe ", "Pweh", " pwe ", "pwe\!", "pweh", "fuck ", " fuck", "Fuck ", " Fuck", " fuck ", " Fuck ", "fuck", "Fuck", " Faggot ", " faggot ", "Faggot ", "faggot ", " Faggot", " faggot", " echusera ", " Echusera ", " Ngoyngoy ", " ngoyngoy ", "Ngoyngoy ", "ngoyngoy ", " Ngoyngoy", " ngoyngoy", "Ngoyngoy", "ngoyngoy", "pwe ", "pwe.", " che ", " bitch\.", "crap");	
	
		$bw_exp = "";
		$badword_match = 0;
		foreach ($badwords as $badwords_exp) :
            $bw_exp = "/".$badwords_exp."/i";		
			if (preg_match($bw_exp, $comment)) :
				$badword_match = $badword_match + 1;
			endif;
		endforeach;	
			
		if ($badword_match > 0) :
			return $replace_with;
		else :
			return $comment;
		endif;
	
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