    </main> <!-- /container --> 
    
    <hr />
    
    <footer class="container">
      <p align="center"><strong>&copy;2020 - Magna Louisville</strong></p>
    </footer> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>    
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){

            $("#txtPesquisa").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#tabela tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            $(".load").hide();

        });
	</script>
  </body>
</html>        
