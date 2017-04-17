<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<link rel="stylesheet" href="/lab/resources/assets/css/application.css"  media="all"  />


<title>Document</title>
</head>
<body>

<input type="text" class="span2" value="02-12-1989 12:05" id="dpt">
<script>
$(function(){
  $('#dpt').fdatepicker({
		format: 'mm-dd-yyyy hh:ii',
		disableDblClickSelection: true,
		language: 'vi',
		pickTime: true
	});
});
</script>
</body>

	<script type="text/javascript" src="/lab/resources/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/lab/resources/assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/lab/resources/assets/js/dist/foundation.js"></script>
    <script type="text/javascript" src="/lab/resources/assets/js/datepicker.js"></script>
 <script>
    $(document).foundation();

    $(document).ready(function(){

        var $switch = $('#exampleSwitch');
        $switch.bind('click',function(){
            if( $switch.is(':checked') == true){
                 $('#expanded').addClass('expanded');
                 $('#expanded_').addClass('expanded');
            }
            else{
                $('#expanded').removeClass('expanded');
                $('#expanded_').removeClass('expanded');
            }
        });

    });

    </script>

</html>