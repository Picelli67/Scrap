<?php 	
	require_once('../config.php');
	require_once(DBAPI);
	$operacao = $_GET['operacao'];
	$sap = $_POST['SAP_Scrap'];
	if ($operacao == 'I') {
		insert('SAP_Scrap', $sap);
		header('Location: Add.php');
	}
	else if ($operacao == 'E') { 
		update('SAP_Scrap', $_GET['id'], $sap);
		header('Location: View.php?operacao='.$_SESSION['login'].'');
	}
	else {
		delete('SAP_Scrap', $_GET['id']);
		header('Location: View.php?operacao='.$_SESSION['login'].'');
	}
?>