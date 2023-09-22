<?php 
    $link=mysqli_connect("localhost","a0231","pwd0231");
    mysqli_select_db($link,"a0231");
    Mysqli_query($link,"SET NAMES UTF8"); 

    if (!session_id()) session_start();

    if($_SESSION['MID'] != null)
    {
        $MID= $_SESSION['MID'];
        
        $sql="SELECT * FROM `ORDER`,PRODUCT WHERE (`ORDER`.PID=PRODUCT.PID AND `ORDER`.MID='".$MID."')";
        $result=mysqli_query($link,$sql);
       
        $maxrow=mysqli_num_rows($result);//買了幾樣東西
        $total=0;

        $m=1;
        $j=1;

        //找TID
        $sql1="SELECT TID FROM `TRAN` WHERE 1;";
        $result1=mysqli_query($link,$sql1);
        $maxrow1=mysqli_num_rows($result1);//RECORD總比數(TID)
        $maxrow_real=$maxrow1+$m;//數字部分
        
        $t_type=array('c','0','0','0','0','0');

       $l=5;
       for($k=1;$k<=strlen($maxrow_real);$k++)
       {
            $t_type[$l]=substr($maxrow_real,-$k,1);
            $l=$l-1;
       }
        $TID = implode($t_type); 

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

            $array[$j]=$TID;
            $array[$j+1]=$row[0];
            $array[$j+2]=$row[3];
            $array[$j+3]=$subprice;
                
            $j=$j+4;
            $_SESSION['array'] = $array;
            $m++;

            echo "<form action='delete_order.php' method='get'>
                    <th class='delete' name='delete'>
                        <a href='delete_order.php'>
                            <button name='delete' value='$i' type='radio' style='width:50%;height:100%;margin:auto;float:auto;background-color:Transparent;border:none;'>
                                <img src='images/3.jpg' alt='delete'>
                            </button>
                        </a>
                    </th>
                </form>";
            echo"</tr>";
        }


        mysqli_close($link);
    }
?>
