<?php 	
	if(!isset($_SESSION)) {
		session_start();
	}
	require_once('../config.php');
	require_once(DBAPI);
	include(HEADER);
	$operacao = $_GET['operacao'];
?>

<?php
	$db = conectar();
	if($db) {
?>	
    <style>
      .load {
        width: 100px;
        height: 100px;
        position: absolute;
        top: 50%;
        left: 50%;
        color: blue;
      }
    </style> 

		<div class="load"> <i class="fa fa-cog fa-spin fa-5x fa-fw"></i><span class="sr-only"></span> </div>
		
		<h2 style="text-align:center">SAP Upload</h2>
		<hr />
		<div class="row">
			<div class="col" <?php if($operacao == '0') echo 'style="display:none;"'; else echo 'style="display:block;"'; ?>>
				<a class="btn btn-primary" href="Add.php?operacao=C"><i class="fa fa-refresh"></i> Continue</a>&emsp;
				<a href="#" class="btn btn-success" href="#"><i class="fa fa-upload"></i> Upload SAP</a>&emsp;
			</div>
			<div class="col">
				<a class="btn btn-secondary" href="../index.php"><i class="fa fa-step-backward"></i> Start</a>				
			</div>
  			<div class="col">
  				<input class="form-control" type="text" name="txtPesquisa" id="txtPesquisa" placeholder="Search..." />
  				<br />
  			</div>
  		</div>

  		<div class = "row">
  			<div class="col">
	  			<div id = "msg" align="center">
		<?php 
					if(isset($_SESSION['msg'])) {
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}	
		?>  		
				</div>
			</div>	
		</div>	
  		
  		<div class="row">
  			<div class="col">
				<div class="table-responsive-md">
					<table class="table table-bordered table-hover">
		    			<thead class="thead-dark">
		   					<tr>
		       					<th>Date</th>
			       				<th>Material</th>
			       				<th>Profit Center</th>
			       				<th>Storage Location</th>
			       				<th>Program</th>
			       				<th>Qty</th>
			       				<th>Crew</th>
			       				<th>Line</th>
			       				<th>Movement</th>
			       				<th>Reason</th>
			       				<th>Scrap Code</th>
			       				<?php
			       					if ($operacao <> "0") 
			       						echo "<th colspan='2' style='text-align: center'>Actions</th>";
			       					else
			       						echo "<th>Status</th>";			       						
			       				?>

		   					</tr>
		   				</thead>
		   				<tbody id = "tabela">
						<?php	
						$sql = "SELECT SP.ID, SUBSTRING(SP.ID,1,4)+'-'+SUBSTRING(SP.ID,5,2)+'-'+SUBSTRING(SP.ID,7,2) AS Date, SP.Material, 
								ISNULL(M.ProfitCenter, '-') As ProfitCenter , ISNULL(M.StorageLocation, '-') As StorageLocation, 
								ISNULL(P.Program, '-') As Program, 
								SP.Qtdy, SP.Crew, L.Line, MO.Movement, R.Reason, SP.ScrapReasonCode, ISNULL(SP.Status, '')
								FROM SAP_Scrap SP
								INNER JOIN Material_Master MM ON MM.Part_Number = SP.Material
								LEFT JOIN Material M ON M.Material = MM.SAPId
								LEFT JOIN Program P ON P.ProfitCenter = M.ProfitCenter
								INNER JOIN Line L ON L.ID = SP.Line
								INNER JOIN Movement MO ON MO.ID = SP.Movement
								INNER JOIN Reason R ON R.ID = SP.Reason";
						if($operacao <> '0')
							$sql .= " AND SP.ID = '$operacao'";

						$result = odbc_exec($db, $sql);
						while (odbc_fetch_row($result)) {
							echo '<tr>';
							echo "<td style='width:120px'>".odbc_result($result, 'Date').'</td>';
							echo '<td>'.odbc_result($result, 'Material').'</td>';
							echo '<td>'.odbc_result($result, 'ProfitCenter').'</td>';
							echo "<td style='width:120px'>".odbc_result($result, 'StorageLocation').'</td>';
							echo '<td>'.odbc_result($result, 'Program').'</td>';
							echo '<td>'.odbc_result($result, 'Qtdy').'</td>';
							echo '<td>'.odbc_result($result, 'Crew').'</td>';
							echo '<td>'.odbc_result($result, 'Line').'</td>';
							echo '<td>'.odbc_result($result, 'Movement').'</td>';
							echo '<td>'.odbc_result($result, 'Reason').'</td>';
							echo '<td>'.odbc_result($result, 'ScrapReasonCode').'</td>';
							if ($operacao <> "0") {
								echo "<td><a href='edit.php?id=".odbc_result($result, 'ID')."|".odbc_result($result, 'Material')."' class='btn btn-warning'><i class='fa fa-pencil'></i></a></td>";
								echo "<td><a href='process.php?operacao=D&id=".odbc_result($result, 'ID')."|".odbc_result($result, 'Material')."' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>";
							}
							else {
								if(odbc_result($result, 'Status') == '1')
									echo "<td><button class='btn btn-success'><i class='fa fa-check-square-o'></i></button></td>";
								else
									echo "<td><button class='btn btn-danger'><i class='fa fa-exclamation-triangle'></i></button></td>";									
							}
							echo '</tr>';
						}
						odbc_free_result($result);
						?>
				    	</tbody>
					</table>
				</div>
			</div>
		</div>
<?php
  	}
    $db = desconectar();
 	include(FOOTER);
?>