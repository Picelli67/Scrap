<?php 
	if(!isset($_SESSION)) {
		session_start();
	}
	require_once('config.php');
	include(HEADER);	
?>
	<hr />
	<div class="row">
		<div class="col">
			<h2 style="text-align:center">Welcome to the Scrap Uploader Tool.</h2>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<p></p>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<p align="center"><strong>Select the option below:</strong></p>
		</div>
	</div>

	<div class="row">
		<div class="col">		
			<p></p>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<p></p>
		<div class="col">
	</div>
	<div class="row">
		<div class="col" align="center">
			<a class="btn btn-primary" href="SAP/Add.php?operacao=I"><i class="fa fa-plus"></i> New Register</a>&emsp;
			<a class="btn btn-info" href="SAP/View.php?operacao=0"><i class="fa fa-file-text"></i> Reports</a>
		</div>
	</div>
<?ph	
<?php
	include(FOOTER);
?>

