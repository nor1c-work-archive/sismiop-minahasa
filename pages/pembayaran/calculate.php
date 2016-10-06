<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>

	<form>
		<input type="text" id="jml" readonly="true" name="JML" value="12500" readonly="">
		<input type="text" id="diskon" name="diskon">
		<a href="#" id="btn" name="btn">Click</a>
	</form>

</body>

	<script type="text/javascript">
        $(document).ready(function() {
            $("#diskon").keyup(function(){
                var DISKON = $("#diskon").val();
                var JML = $("#jml").val();
                    $.post(
                    	'proses_calculate.php',
                    	{jml:JML, diskon:DISKON},
                        function(data) {
	                        if(data == ''){
	                            $('#jml').html("Tidak ada kalkulasi");                                    
	                        } else {
	                            document.getElementById("jml").value = data;
	                        }
	                    });
            });
        });
	</script>

</html>