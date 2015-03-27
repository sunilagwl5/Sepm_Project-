<html>
<head>
</head>
<body>
<?php
session_start();

include_once 'ofc-library/open_flash_chart_object.php';
//echo $_SESSION['key'];
//header('location:chart-data5.php');
open_flash_chart_object( 500, 250, 'chart-data5.php', false );
?>
</body>
</html>