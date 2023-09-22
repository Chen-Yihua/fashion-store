<?php
    if (!session_id()) session_start();
    $link=mysqli_connect("localhost","a0231","pwd0231");
    mysqli_select_db($link,"a0231");
    Mysqli_query($link,"SET NAMES UTF8"); 

    if($_SESSION['MID'] != null)
    {
        $MID= $_SESSION['MID'];
        $x=$_GET['delete'];

        $sql="SELECT * FROM `ORDER`,PRODUCT WHERE (`ORDER`.PID=PRODUCT.PID AND `ORDER`.MID='".$MID."');";
        $result=mysqli_query($link,$sql);
        $maxrow=mysqli_num_rows($result);//買了幾樣東西

        $j=1;
        for($i=1;$i<=$maxrow;$i++)
        {
            if($x==$i)
            {
                $pid=$_SESSION['array'][$j+1];
                $delete="DELETE FROM `ORDER` WHERE (MID='".$MID."' AND PID='".$pid."');";
                $result1=mysqli_query($link,$delete);
            }       
            $j=$j+4;
        }

        mysqli_close($link);

        echo"<script>alert('刪除成功');</script>";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=cart1.php>';
    }
?>