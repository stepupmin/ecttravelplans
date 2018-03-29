 <?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-type: application/json;charset=utf-8');
require("config/connectionDB.php");
pg_set_client_encoding($dbconn, "UTF8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// get post body content
		$content = file_get_contents('php://input');
		
		// parse JSON
		$users = json_decode($content, true);
	
		$action = $users['action'];
		$fbid = $users['$fbid'];
		
		// check action
		if(strcmp($action, 'register') == 0){
			//check duplicate $email
			$sql_search     = "SELECT FB_USERS_ID FROM USERS WHERE FB_USERS_ID = '$fbid';";
			$rearch_result  = pg_query($dbconn, $sql_search);
			$rowcount = pg_num_rows($rearch_result);
			if ($rowcount == 1) {
				echo json_encode(['status' => 'error','message' => "ไม่สามารถลงทะเบียนได้ อีเมลนี้มีผู้ใช้แล้ว"], JSON_FORCE_OBJECT);
			exit;
			}

			//insert data
			$sql    = "INSERT INTO USERS (FB_USERS_ID) VALUES ('$fbid');";
			$result = pg_query($dbconn, $sql);

			if ($result) {
				echo json_encode(['status' => 'ok','message' => "บันทึกข้อมูลเรียบร้อย"], JSON_FORCE_OBJECT);
			} else {
				echo json_encode(['status' => 'error', $fbid => "เกิดข้อผิดพลาดในการบันทึกข้อมูล"], JSON_FORCE_OBJECT);
			}
		}
}
pg_close($dbconn);
?>
