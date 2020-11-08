<?php 	
	require_once('../config.php');
	require_once(DBAPI);
	$mat = $_POST['mat_sap'];
	$sql = "SELECT 
				Material_Master.Description,
				ISNULL(Material.ProfitCenter, '-') ProfitCenter, 
				ISNULL(Material.StorageLocation, '-') StorageLocation,
				ISNULL(Program.Program, '-') Program
				FROM Material_Master
				LEFT JOIN Material ON Material.Material = Material_Master.SAPId
				LEFT JOIN Program ON Program.ProfitCenter = Material.ProfitCenter
				WHERE Material_Master.Part_Number = '$mat'";
	$db = conectar();
	$result = odbc_exec($db, $sql);
	while (odbc_fetch_row($result)) {
		$retorno = odbc_result($result, 1).'|'.odbc_result($result, 2).'|'.odbc_result($result, 3).'|'.odbc_result($result, 4);
	}
	echo $retorno;
	odbc_free_result($result);
	desconectar();
?>
