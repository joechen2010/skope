<?php 
        require_once("data.php");
        $mydm = new Myphp();
		$name = $_REQUEST['name'];
		$addr = $_REQUEST['addr'];
		$mobile = $_REQUEST['mobile'];
		$city = $_REQUEST['city'];
		$street = $_REQUEST['street'];
		$latitude = $_REQUEST['latitude'];
		$longitude = $_REQUEST['longitude'];

		$action = $_REQUEST['action'];
		$limit = $_REQUEST['limit'];
		$offset = $_REQUEST['offset'];
		
		$email = $_REQUEST['email'];
		$password1 = $_REQUEST['password1'];
		$password2 = $_REQUEST['password2'];
		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$date_of_birth = $_REQUEST['date_of_birth'];
		$gender = $_REQUEST['gender'];
		$id = $_REQUEST['id'];


		$relationship_status = $_REQUEST['relationship_status'];
		$home_town = $_REQUEST['home_town'];
		$work_job_title = $_REQUEST['work_job_title'];
		$work_company = $_REQUEST['work_company'];
		$education_study = $_REQUEST['education_study'];
		$education_college = $_REQUEST['education_college'];
		$is_gender_public = $_REQUEST['is_gender_public'];
		$is_date_of_birth_public = $_REQUEST['is_date_of_birth_public'];
		$description = $_REQUEST['description'];

		$mUsername = $_REQUEST['mUsername'];
		$mPassword = $_REQUEST['mPassword'];
		$version_code = $_REQUEST['version_code'];

		$sql = "";
		
		if($action == 'LOCATION'){
			$sql = "INSERT INTO a0626094354.gpsinfo (name ,mobile,address,city,street,latitude,longitude )VALUES ('".$name."', '".$mobile."','".$addr."','".$city."','".$street."','".$latitude."','".$longitude."')";
			$result = $mydm->inserts($sql);
		}else if($action == 'SIGNUP'){
			$sql = "INSERT INTO a0626094354.path_user (id, name,mobile,email,password,first_name,last_name )VALUES ('".$id."','".$first_name.$last_name."', '".$mobile."','".$email."','".$password1."','".$first_name."','".$last_name."','".$date_of_birth."','".$gender."')";
			$result = $mydm->inserts($sql);
		}else if($action == 'LOGIN'){
			// 430 upgrade 
			$sql = "SELECT * FROM a0626094354.path_user WHERE name = '".$mUsername."' and password= '".$mPassword."' limit 0,1";
			var $rows = $mydm->SELECT($sql);
			if(empty($rows)){
				echo 431;
			}else{
				echo json_encode($rows);
			}
		}else if($action == 'LOGOUT'){
			
		}else if($action == 'INFO'){
			// 430 upgrade 
			$sql = "update a0626094354.path_user set first_name='".$first_name."',last_name='".$last_name."',date_of_birth='".$date_of_birth."',gender='".$gender."',relationship_status='".$relationship_status."',home_town='".$home_town."',work_job_title='".$work_job_title."',work_company='".$work_company."',education_study='".$education_study."',education_college='".$education_college."',is_gender_public='".$is_gender_public."',is_date_of_birth_public='".$is_date_of_birth_public."' where id = '".$id."'";
			var $effectRows = $mydm->inserts($sql);
			if($effectRows>0){
				 $sql = "SELECT * FROM a0626094354.path_user WHERE name = '".$mUsername."' limit 0,1";
				 var $rows = $mydm->SELECT($sql);
				 echo json_encode($rows);
			}else{
				//echo json_encode($effectRows);
			}
		}else{
			$sql = "SELECT name ,mobile,address,city,street,latitude,longitude,timestamp FROM a0626094354.gpsinfo WHERE name = '".$name."' order by timestamp desc limit 0,20 ";
			if($limit != null && $offset != null)
				$sql = $sql.' limit '.$offset.','.$limit;
			var $rows = $mydm->SELECT($sql);
			echo json_encode($rows);
		}
		
		
		
		
		
function log_action($msg) {
	$today = date("d.m.Y");
	$filename = "log/$today.txt";
	if (!file_exists($filename)) {
		chmod($filename, 0777);
	}
	$fd = fopen($filename, "a");
	$str = "[" . date("d/m/Y h:i:s", mktime()) . "] " . $msg;
	fwrite($fd, $str . PHP_EOL);
	fclose($fd);
	chmod($filename, 0644);
}
 
	
?>