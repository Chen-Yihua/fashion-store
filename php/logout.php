
<?php
$link=mysqli_connect("localhost","a0231","pwd0231");
mysqli_select_db($link,"a0231");
Mysqli_query($link,"SET NAMES UTF8"); 
session_start();

//將session清空
session_destroy();
echo "<script>alert('登出中');</script>";
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';

mysqli_close($link);
?>
