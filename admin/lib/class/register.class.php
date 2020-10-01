<?php

class register
{
	var $ccount = false;
	
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
	
	public function db_query($sql) //Get rows of a table from $sql
	{
			if(!$sql) return;
			$conn = $this->db_connect();
			$result = $conn->query($sql);
			return $result;
	}
	
	public function get_row($sql) //Get rows of a table from $sql
	{
			if(!$sql) return;
			$conn = $this->db_connect();
			$result = $conn->query($sql);
			if(!$result) return;
			$result = $this->db_result_to_array($result);
			return $result;
	}
	
	function check_user($username)
	{

		$sql = "SELECT COUNT(user_id) AS ucount FROM tbl_user WHERE user_email = '".$username."'";
		$result = $this->get_row($sql);			
		if($result[0]['ucount'] <= 0) 
		{
			return false;
		}
		else
		{
			return true;
		}	
	}		
	
	function check_member($username, $password)
	{
        $passhash = md5($password);
		
		$sql = "SELECT COUNT(user_id) AS ucount FROM tbl_user WHERE user_email = '".$username."' AND user_password = '".$passhash."' AND user_status = 2 AND (user_type = 8 OR user_type = 9) ";		
		$result = $this->get_row($sql);			
		if($result[0]['ucount']) 
		{
			return 1;
		}
		else
		{
			return 0;
		}	
	}		
	
	function get_member($username)
	{
		$sql = "SELECT user_id, user_firstname, user_lastname, user_email, user_type FROM tbl_user WHERE user_email = '".$username."' AND user_status = 2 AND (user_type = 8 OR user_type = 9) LIMIT 1";
		$result = $this->get_row($sql);			
		return $result;
	}
    
    function get_member_by_id($uid)
	{
		$sql = "SELECT user_id, user_firstname, user_lastname, user_email, user_type FROM tbl_user WHERE user_id = '".$uid."' AND user_status = 2 AND (user_type = 8 OR user_type = 9) LIMIT 1";
		$result = $this->get_row($sql);			
		return $result;
	}
    
    function change_password($newpassword, $empidnum)
    {
        $sql = "UPDATE tbl_emplist SET
            emp_password = '".md5($newpassword)."',
            emp_dateupdate = ".date("U")."
            WHERE emp_idnum = '".$empidnum."'";
        
        if($this->db_query($sql)) : 
            return TRUE;
        else :
            return FALSE;
        endif;			
        
    }  

	function mailthis($post)
	{
		if(is_array($post))
		{
			
			$input = array();
			foreach($post as $key => $value) {
				$input[$key] = mysql_escape_string($value);
			}
			
			extract($input);
		
			$to  = $email; 				
			$subject = 'Megaworld New Account Password';
		
			$message = '
			<html>
			<head>
			  <title>Megaworld New Account Password</title>
			</head>
			<body>
			  <p>Hi '.$fname.'</p>
			  <p>It seems that you have asked for us to send you your password.</p>
			  <p>Below is the information that you will need to login to the site and forums.</p>
			  <p>Username: '.$uname.'<br />Password: '.$pass.'<br />E-Mail Address: '.$email.'</p>
			</body>
			</html>
			';
		
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		
			$headers .= 'To: '.$fname.' '.$lname.' <'.$email.'>' . "\r\n";
			$headers .= 'From: Megaworld Admin <admin@megaworld.com.ph>' . "\r\n";
		
			mail($to, $subject, $message, $headers);
			
		}
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