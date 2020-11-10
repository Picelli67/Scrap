<?php 	
	if(!isset($_SESSION)) {
  		session_start();
	}
	require_once('../config.php');
    require_once DBAPI;    
	include(HEADER);
    $dados = explode('|', $_GET['id']);
    $db = conectar();
    $sql = "SELECT * FROM SAP_SCRAP WHERE ID = '$dados[0]' AND Material = '$dados[1]'";
    $result = odbc_exec($db, $sql);
?>

	<h2 style="text-align:center">Release</h2>
	<hr />

        <form method="post" action="Process.php?operacao=E&id=<?php echo $dados[0].'|'.$dados[1]; ?>" >
            <div class="form-row">
                <div class="form-group" align="center">
                    <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                    <input type="hidden" name="SAP_Scrap['ID']" value="<?php echo odbc_result($result, 'ID'); ?>"> 
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-3">
                    <label for="mat_sap">Material Number</label>
                    <input type="text" class="form-control" id="mat_sap" name="SAP_Scrap['Material']"  required="" value="<?php echo odbc_result($result, 'Material'); ?>" autofocus="" />
                </div>

                <div class="form-group col-lg-5">
                    <label for="descr">Description</label>
                    <input type="text" class="form-control" id="descr" name="descr" disabled="" />
                </div>

                <div class="form-group col-lg-2">
                    <label for="pc">Profit Center</label>
                    <input type="text" class="form-control" id="pc" name="pc" disabled="" />
                </div>

                <div class="form-group col-lg-1">
                    <label for="stl">Location</label>
                    <input type="text" class="form-control" id="stl" name="stl" disabled="" />
                </div>

                <div class="form-group col-lg-1">
                    <label for="stl">Program</label>
                    <input type="text" class="form-control" id="pro" name="pro" disabled="" />
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-lg-1">
                    <label for="pc">Qty</label>
                    <input type="Number" class="form-control" id="qtdy" name="SAP_Scrap['Qtdy']" required="" value="<?php echo odbc_result($result, 'Qtdy'); ?>" />
                </div>

                <div class="form-group col-lg-1">
                    <label for="cre">Crew</label>
                    <select class="form-control" id="crew" name="SAP_Scrap['Crew']" required="">
                    <?php
                        $sql = "SELECT * FROM CREW";
                        $crew = odbc_exec($db, $sql);
                        while (odbc_fetch_row($crew)) {
                            echo "<option value = '".odbc_result($crew, 'Crew')."'";
                            if(odbc_result($result, 'Crew') == odbc_result($crew, 'Crew')) 
                                echo " selected='selected'";
                            echo '>'.odbc_result($crew, 'Crew').'</option>';
                        }
                        odbc_free_result($crew);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="lin">Line</label>
                    <select class="form-control" id="line" name="SAP_Scrap['Line']" required="">
                    <?php
                        $sql = "SELECT * FROM LINE";
                        $line = odbc_exec($db, $sql);
                        while (odbc_fetch_row($line)) {
                            echo "<option value = '".odbc_result($line, 'ID')."'";
                            if(odbc_result($result, 'Line') == odbc_result($line, 'ID')) 
                                echo " selected='selected'";
                            echo '>'.odbc_result($line, 'Line').'</option>';
                        }
                        odbc_free_result($line);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="mov">Reason for Movement</label>
                    <select class="form-control" id="movement" name="SAP_Scrap['Movement']" required="">
                    <?php
                        $sql = "SELECT * FROM MOVEMENT ORDER BY MOVEMENT";
                        $movement = odbc_exec($db, $sql);
                        while (odbc_fetch_row($movement)) {
                            echo "<option value = '".odbc_result($movement, 'ID')."'";
                            if(odbc_result($result, 'Movement') == odbc_result($movement, 'ID')) 
                                echo " selected='selected'";
                            echo '>'.odbc_result($movement, 'Movement').'</option>';
                        }
                        odbc_free_result($movement);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="zon">Zone</label>
                    <select class="form-control" id="zone" name="SAP_Scrap['Zone']" required="">
                    <?php
                        $sql = "SELECT * FROM ZONE";
                        $zone = odbc_exec($db, $sql);
                        while (odbc_fetch_row($zone)) {
                            echo "<option value = '".odbc_result($zone, 'ID')."'";
                            if(odbc_result($result, 'Zone') == odbc_result($zone, 'ID')) 
                                echo " selected='selected'";
                            echo '>'.odbc_result($zone, 'Zone').'</option>';
                        }
                        odbc_free_result($zone);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="rea">Reason Code</label>
                    <select class="form-control" id="reason" name="SAP_Scrap['Reason']" required="">
                    <?php
                        $sql = "SELECT * FROM REASON ORDER BY REASON";
                        $reason = odbc_exec($db, $sql);
                        while (odbc_fetch_row($reason)) {
                            echo "<option value = '".odbc_result($reason, 'ID')."'";
                            if(odbc_result($result, 'ID') == odbc_result($reason, 'ID')) 
                                echo " selected='selected'";
                            echo '>'.odbc_result($reason, 'Reason').'</option>';
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="sap">Scrap Reason Code</label>
                    <input type="text" class="form-control" id="sapreasoncode" name="SAP_Scrap['ScrapReasonCode']" value = "" readonly="" />
                </div>


            </div>

            <div class="form-row">
                <div class="form-group col-lg-12"></div>
            </div>

            <hr />

            <div class="form-row">
                <div class="form-group col-lg-8"></div>
                <div class="form-group col-lg-4" align="right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&emsp;
                    <a class="btn btn-info" href="javascript:history.back();"><i class="fa fa-window-close-o"></i> Cancel</a>
                </div>
            </div>
        </form> 
<?php
    $db = desconectar();
 	include(FOOTER_COMPLETE);
?>