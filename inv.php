<?php
$remoteServerName = "10.48.11.44";
$connectionOptions = array(
  "database" => "itinvent",
	"uid" => "itinvent",
	"pwd" => "~Zaznaika22"
);
$conn = sqlsrv_connect($remoteServerName, $connectionOptions);
if ($conn === false) {
	print_r( sqlsrv_errors(), true);
}
$tsql = "SELECT type_name,dbo.ITEMS.inv_no, dbo.ITEMS.inv_no_buh, dbo.CI_MODELS.model_name, dbo.ITEMS.part_no, cast(CI_MODELS.addinfo as varchar(255)) as addinfo  FROM dbo.ITEMS 
INNER JOIN dbo.OWNERS ON dbo.ITEMS.empl_no=dbo.OWNERS.owner_no 
inner join dbo.CI_TYPES on dbo.ITEMS.ci_type=dbo.CI_TYPES.ci_type and dbo.ITEMS.type_no=dbo.CI_TYPES.type_no  
INNER JOIN dbo.CI_MODELS ON dbo.ITEMS.model_no=dbo.CI_MODELS.model_no AND dbo.ITEMS.ci_type=dbo.CI_MODELS.ci_type and dbo.ITEMS.type_no=dbo.CI_MODELS.type_no
WHERE CONCAT(dbo.OWNERS.owner_lname,' ',dbo.OWNERS.owner_fname,' ',dbo.OWNERS.owner_mname)='".$_GET['host_owner']."'";
$stmt = sqlsrv_query($conn, $tsql);
if ($stmt) {
	if( sqlsrv_fetch( $stmt )) {
		$rows = sqlsrv_has_rows( $stmt );
		if ($rows === true){
			echo "<table border=1><th>Тип</th><th>Инв.Номер</th><th>Инв. Бугалтерия</th><th>Описание</th><th>Номер партии</th><th>Комментарий</th>";
			do{
              echo "<tr>";
              for($i=0;$i<6;$i++)	echo "<td>".sqlsrv_get_field( $stmt, $i)."</td>";
              echo "</tr>";
			}
			while(sqlsrv_fetch ($stmt));
          echo "</table>";
		}
	}
	sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>
