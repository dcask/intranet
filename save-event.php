<?php
    $file='error-dcask.txt';
    $log='log-events.log';
    ini_set('error_reporting', E_ALL);
    
	$mysqli = new mysqli('127.0.0.1', 'intranet-user', 'St15q6mp', 'intranet');
	if ($mysqli->connect_errno) {
	    file_put_contents($file, $mysqli->connect_error."\n", FILE_APPEND | LOCK_EX);
	    exit;
	}
	$data = file_get_contents( 'php://input' );
	$event_str='';$i=0;
	foreach (explode('&', $data) as $chunk) {
	    $param = explode('=', $chunk);
	    if ($param) {
		$key=rawurldecode($param[0]);
		$val=rawurldecode($param[1]);
		if($i == 0){
		    $event_str=$val;
		}
	    }
	    $i++;
	}
	$now_stamp = date("Y-m-d H:i:s"); 
	file_put_contents($log, $now_stamp."\t".$event_str."\n", FILE_APPEND | LOCK_EX);
	$event_str=str_replace('[','',$event_str);
	$event_str=str_replace(']','',$event_str);
	$json_event=json_decode(utf8_encode($event_str), true);
	if(isset($json_event["data"]["id"])) $id=$json_event["data"]["id"]; else $id='';
	if(isset($json_event["data"]["attributes"]["meeting"]["external-meeting-id"])) $m_id=$json_event["data"]["attributes"]["meeting"]["external-meeting-id"]; else $m_id='';
	if(isset($json_event["data"]["attributes"]["meeting"]["name"])) $m_name=$json_event["data"]["attributes"]["meeting"]["name"]; else $m_name='';
	if(isset($json_event["data"]["attributes"]["user"]["internal-user-id"])) $m_user=$json_event["data"]["attributes"]["user"]["internal-user-id"]; else $m_user='';
	//if(isset($json_event["data"]["attributes"]["user"])) $m_user=json_encode($json_event["data"]["attributes"]["user"], JSON_UNESCAPED_UNICODE); else $m_user='';
	//file_put_contents($file, $id."\n", FILE_APPEND | LOCK_EX);
	$event_str = $mysqli->real_escape_string($event_str);
	$m_user=str_replace('{','',$m_user);
	$m_user=str_replace('}','',$m_user);
	$m_user = $mysqli->real_escape_string($m_user);
	try{
	    $query = 'INSERT INTO bbb_events(`event_name`,`meeting_id`,`room_name`,`user`) 
	    	values("'.$id.'","'.$m_id.'","'.$m_name.'","'.$m_user.'")';
	    $result = $mysqli->query($query);
	    if($id=="user-joined"){
			$query = 'INSERT INTO bbb_users(`id`,`name`) values("'.$m_user.'","'.utf8_decode($json_event["data"]["attributes"]["user"]["name"]).'")';
			$result = $mysqli->query($query);
	    }
	    if($id=="meeting-created"){
			$query = 'INSERT INTO bbb_rooms(`id`,`name`) values("'.$m_id.'","'.utf8_decode($m_name).'")';
			$result = $mysqli->query($query);
	    }
	}catch(Exception $e){
	    file_put_contents($file, $mysqli->error."\n", FILE_APPEND | LOCK_EX);
	}
	// $result->free();
	$mysqli->close();
?>