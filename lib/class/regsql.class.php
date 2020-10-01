<?php

class regsql {
    
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
	
	# MAINSQL CLASS
	
	function check_member($username, $password)
	{		
		
		$sql = "SELECT COUNT(user_id) AS mcount FROM tbl_user WHERE user_email = '".$username."' AND user_password = '".md5($password)."' AND user_status = 2";		
		$result = $this->get_row($sql);			
		if($result[0]['mcount'] <= 0) :
			return FALSE;
		else :
			return TRUE;
		endif;
	}	
	
	function check_user($username)
	{

		$sql = "SELECT COUNT(user_id) AS mcount FROM tbl_user WHERE user_email = '".$username."'";
		$result = $this->get_row($sql);			
		if($result[0]['mcount'] <= 0) :
			return FALSE;
		else :
			return TRUE;
		endif;
	}		
    
    function get_member($username)
	{
		$sql = "SELECT * FROM tbl_user WHERE user_email = '".$username."' AND user_status = 2 LIMIT 0, 1";
		$result = $this->get_row($sql);			
		return $result;
	}
    
    function get_member_by_id($userid)
	{
		$sql = "SELECT * FROM tbl_user WHERE user_id = '".$userid."' AND user_status = 2 LIMIT 0, 1";
		$result = $this->get_row($sql);			
		return $result;
	}
    
    function get_member_by_hash($idhash)
	{
		$sql = "SELECT * FROM tbl_user WHERE MD5(CONCAT('impact', user_id)) = '".$idhash."'";
		$result = $this->get_row($sql);			
		return $result;
	}  	
    
    function check_email($email)
    {
        $sql = "SELECT * FROM tbl_user WHERE user_email = '".$email."'";
		$result = $this->get_numrow($sql);			
		return $result;
    }

	function random_password() {
	    $alphabet = array('a','b','c','d','e','f','g','h','i','j','k','m','n','p','r','s','t','u','v','x','y','z','1','2','3','4','5','6','7','8','9');
	    $pass = "";
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, count($alphabet)-1);
	        $pass .= $alphabet[$n];
	    }
	    return $pass;
	}

}
?>