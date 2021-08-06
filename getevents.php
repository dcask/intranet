#!/usr/bin/php
<?php
$myDb = JFactory::getDbo(); 
$remoteServerName = "10.48.100.216\\SQLSERVER2008";
$connectionOptions = array(
  "database" => "smngbase3",
    "uid" => "admin",
    "pwd" => "270264"
);

$conn = sqlsrv_connect($remoteServerName, $connectionOptions);
if ($conn === false) {
    print_r( sqlsrv_errors(), true);
}
$tsql = "SELECT TimeVal, Mode, HozOrgan, GUID FROM dbo.pLogData WHERE timeval > DATEADD(minute, -60,  GETDATE()) AND event=28 ORDER BY timeval DESC";
$stmt = sqlsrv_query($conn, $tsql);
if ($stmt) {
    if( sqlsrv_fetch( $stmt )) {
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
	    $columns = array('date_time', 'userid', 'direction','guid','company');
	    do{
		$timeval=sqlsrv_get_field( $stmt, 0);
		$mode=sqlsrv_get_field( $stmt, 1);
		$userid=sqlsrv_get_field( $stmt, 2);
		$guid=sqlsrv_get_field( $stmt, 3);
		try {
		    $myQuery = $myDb->getQuery(true);
		    $values = array($db->quote($timeval->format('Y-m-d H:i:s')),$userid,$mode,$db->quote($guid),1);
		    $myQuery
			->insert($myDb->quoteName('pacs_events'))
			->columns($myDb->quoteName($columns))
			->values(implode(',', $values));
		    $myDb->setQuery($myQuery);
		    $result = $myDb->execute();
		}catch (Exception $e) {
		    echo $e->getMessage();
		}
	    }
	    while(sqlsrv_fetch ($stmt));
	}
    }
    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>