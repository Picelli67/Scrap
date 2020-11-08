<?php 
    if(!isset($_SESSION)) {
      session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta charset="utf-8">
		<title>Scrap SAP - Magna Seating</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	</head>
	<body>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <div class="container-fluid">

          <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php">Magna Seating</a>
          </div>
         
        </div>
    </nav>      

    <main class="container">