<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	function conectar() {
		try {
			$connection_string = 'DRIVER={SQL Server};SERVER=PICELLI;DATABASE=Scrap';	
            $user = 'Admin';
            $pass = 'jlp42566';
            $conn = odbc_connect($connection_string, $user, $pass);
			return $conn;
		} catch (Exception $e) {
			return null;
		}
	}
	
	function desconectar() {
		odbc_close_all();
	}

	function insert($table = null, $data = null) {
		$database = conectar();
		$columns = null;
		$values = null;
		foreach ($data as $key => $value) {
			$columns .= trim(str_replace("\\", "", $key),"'") . ",";
			$values .= "'$value',";
		}
		$columns = rtrim($columns, ',');
		$values = rtrim($values, ',');
		$sql = "INSERT INTO $table ($columns) VALUES ($values)";
		$result = odbc_exec($database, $sql);
		desconectar();
		if(!$result) {
			$_SESSION['msg'] = "<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error inserting the record!</div>";
		}
		return $result;
	}

	function update($table = null, $id = null, $data = null) {
		$valor = explode('|', $id);
		$database = conectar();
		$items = null;
		foreach ($data as $key => $value) {
			$value = str_replace("\\", "", $value);
			$items .= trim(str_replace("\\", "", $key), "'") . "='$value',";
		}
		$items = rtrim($items, ',');
		$sql  = "UPDATE $table SET $items WHERE ID = '$valor[0]' AND Material = '$valor[1]'";

		$result = odbc_exec($database, $sql);
		desconectar();
		if(!$result) {
			$_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error updating the record!</div>";				
		}
		return $result;
	}

	function delete($table = null, $id = null) {
		$valor = explode('|', $id);
		$database = conectar();
		$sql = "DELETE $table WHERE ID = '$valor[0]' AND Material = '$valor[1]'";
		$result = odbc_exec($database, $sql);
		desconectar();
		if(!$result) {
			$_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error deleting the record!</div>";
		}
		return $result;
	}
?>