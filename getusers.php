<?php
$myDb = JFactory::getDbo(); 
$myDb->truncateTable('pacs_users'); // очищаем таблицу
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
$tsql = "SELECT ID,Name, FirstName, MidName FROM pList ";
$stmt = sqlsrv_query($conn, $tsql);
if ($stmt === false) {
die(print_r( sqlsrv_errors(), true));
}

if( sqlsrv_fetch( $stmt ) === false) {
die(print_r( sqlsrv_errors(), true));
}
$columns = array('date_time', 'pacs_id', 'pacs_user_name','pacs_company');
$currentTime = new JDate('now');
do{
$id=sqlsrv_get_field( $stmt, 0);
$name=sqlsrv_get_field( $stmt, 1).' '.sqlsrv_get_field( $stmt, 2).' '.sqlsrv_get_field( $stmt, 3);
try {
$myQuery = $myDb->getQuery(true);
$values = array($db->quote($currentTime),$id,$db->quote($name),1);
$myQuery
->insert($myDb->quoteName('pacs_users'))
->columns($myDb->quoteName($columns))
->values(implode(',', $values));
$myDb->setQuery($myQuery);
$result = $myDb->execute();
}catch (Exception $e) {
echo $e->getMessage();
}
}
while(sqlsrv_fetch ($stmt));

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>