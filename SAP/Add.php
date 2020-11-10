<?php 	
	if(!isset($_SESSION)) {
  		session_start();
	}
	require_once('../config.php');
    require_once DBAPI;    
	include(HEADER);
    $db = conectar();
    
    if($_GET['operacao'] == 'I') {
        if(isset($_SESSION['login']))
            unset($_SESSION['login']);
        $sql = "SELECT REPLACE(CONVERT(VARCHAR, GETDATE(), 112)+CONVERT(VARCHAR, GETDATE(), 108), ':', '')";
        $result = odbc_exec($db, $sql);
        $_SESSION['login'] = odbc_result($result, 1);
        odbc_free_result($result);
    }
?>

	<h2 style="text-align:center">Release</h2>
	<hr />

        <form method="post" action="process.php?operacao=I">
            <div class="form-row">
                <div class="form-group" align="center">
                    <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                    <input type="hidden" name="SAP_Scrap['ID']" value="<?php echo $_SESSION['login'];?>"> 
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-3">
                    <label for="mat_sap">Material Number</label>
                    <input type="text" class="form-control" id="mat_sap" name="SAP_Scrap['Material']"  required="" autofocus=""/>
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
                    <input type="Number" class="form-control" id="qtdy" name="SAP_Scrap['Qtdy']" required="" />
                </div>

                <div class="form-group col-lg-1">
                    <label for="cre">Crew</label>
                    <select class="form-control" id="crew" name="SAP_Scrap['Crew']" required="">
                    <option value = ""></option>
                    <?php
                        $sql = "SELECT * FROM CREW";
                        $result = odbc_exec($db, $sql);
                        while (odbc_fetch_row($result)) {
                            echo "<option value = '".odbc_result($result, 'Crew')."'>".odbc_result($result, 'Crew')."</option>";
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="lin">Line</label>
                    <select class="form-control" id="line" name="SAP_Scrap['Line']" required="">
                    <option value = ""></option>
                    <?php
                        $sql = "SELECT * FROM LINE";
                        $result = odbc_exec($db, $sql);
                        while (odbc_fetch_row($result)) {
                            echo "<option value = '".odbc_result($result, 'ID')."'>".odbc_result($result, 'Line')."</option>";
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="mov">Reason for Movement</label>
                    <select class="form-control" id="movement" name="SAP_Scrap['Movement']" required="">
                    <option value = ""></option>
                    <?php
                        $sql = "SELECT * FROM MOVEMENT ORDER BY MOVEMENT";
                        $result = odbc_exec($db, $sql);
                        while (odbc_fetch_row($result)) {
                            echo "<option value = '".odbc_result($result, 'ID')."'>".odbc_result($result, 'Movement')."</option>";
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="zon">Zone</label>
                    <select class="form-control" id="zone" name="SAP_Scrap['Zone']" required="">
                    <option value = ""></option>
                    <?php
                        $sql = "SELECT * FROM ZONE";
                        $result = odbc_exec($db, $sql);
                        while (odbc_fetch_row($result)) {
                            echo "<option value = '".odbc_result($result, 'ID')."'>".odbc_result($result, 'Zone')."</option>";
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="rea">Reason Code</label>
                    <select class="form-control" id="reason" name="SAP_Scrap['Reason']" required="">
                    <option value = ""></option>
                    <?php
                        $sql = "SELECT * FROM REASON ORDER BY REASON";
                        $result = odbc_exec($db, $sql);
                        while (odbc_fetch_row($result)) {
                            echo "<option value = '".odbc_result($result, 'ID')."'>".odbc_result($result, 'Reason')."</option>";
                        }
                        odbc_free_result($result);
                    ?>
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="sap">Scrap Reason Code</label>
                    <input type="text" class="form-control" id="sapreasoncode" name="SAP_Scrap['ScrapReasonCode']" readonly="" />
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
                    <a href="View.php?operacao=<?php echo $_SESSION['login']; ?>" class="btn btn-success"><i class="fa fa-eye"></i> Review</a>
                </div>
            </div>
        </form> 
<?php
    $db = desconectar();
 	include(FOOTER_COMPLETE);
?>