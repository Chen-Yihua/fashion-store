<?php  
    
    $link=mysqli_connect("localhost","a0231","pwd0231");
    mysqli_select_db($link,"a0231");
    Mysqli_query($link,"SET NAMES UTF8"); 

    if($_SESSION['MID'] != null)
    {
        $MID= $_SESSION['MID'];
        
        $sql="SELECT * FROM `ORDER`,PRODUCT WHERE (`ORDER`.PID=PRODUCT.PID AND `ORDER`.MID='".$MID."')";
        $result=mysqli_query($link,$sql);
       
        $maxrow=mysqli_num_rows($result);//買了幾樣東西
        $total=0;

        for($i=1;$i<=$maxrow;$i++)
        {
            $row=mysqli_fetch_array($result);
            $subprice=$row[3]*$row[10];
            echo"<tr>";
            echo "<th><font size=3>$row[5]</font></th>";
            echo "<th><font size=3>$row[6]</font></th>";
            echo "<th><font size=3>$row[8]</font></th>";
            echo "<th><font size=3>$row[3]</font></th>";
            echo "<th><font size=3>$row[10]</font></th>";
            echo "<th><font size=3>$subprice</font></th>";
            $total+=$subprice;
            echo"</tr>";
        }

        //ORDER刪除資料
        $clean="DELETE FROM `ORDER` WHERE (MID='".$MID."');";
        $result1=mysqli_query($link,$clean);

        mysqli_close($link);
    }
?>
