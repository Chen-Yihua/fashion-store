<?php  

    header("Content-Type:text/html; charset=utf-8");
    
    $link=mysqli_connect("localhost","a0231","pwd0231");
    mysqli_select_db($link,"a0231");
    Mysqli_query($link,"SET NAMES UTF8"); 

    session_start();
    if($_SESSION['MID'] != null)
    {

        $paymentType=$_POST['paymentType'];//信用卡一次付清  //超商取貨付款//取貨方式  //匯款
        $ctype=$_POST['ctype'];//銀行代碼
        $cnum=$_POST['cnum'];//信用卡號
        $bnum=$_POST['bnum'];//銀行代號
        $trans=$_POST['trans'];//匯款末四碼
        $shippingType=$_POST["shippingType"];//取貨方式
        $time=date("Y-m-d H:i:s");

        $MID= $_SESSION['MID'];
    
        $rname=$_POST['name'];
        $rcellphone=$_POST['phone'];
        $rmail=$_POST['email'];
        $rnote=$_POST['note'];//備註

        $sql="SELECT CID FROM `CART` WHERE (MID='".$MID."');";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($result);
        $CID=$row[0];
    

        //資料輸入資料庫
        //信用卡一次付清
        if($paymentType==1)
        {
            $sqlstr="INSERT INTO `TRAN` (`TID`,`trans`,`cash`,`store`, `ctype`, `cnum`, `bnum`, `ttime`, `MID`, `CID`, `rname`, `rcellphone`, `rmail`, `rnote`)
            VALUES('".$_SESSION['array'][1]."',' ','0','".$shippingType."','".$ctype."','".$cnum."','".$bnum."','".$time."','".$MID."','".$CID."','".$rname."','".$rcellphone."','".$rmail."','".$rnote."');";
        }
        
        //超商取貨付款
        if($paymentType==2)
        {
            $sqlstr="INSERT INTO `TRAN`(`TID`,`trans`,`cash`,`store`,`ctype`, `cnum`, `bnum`,`ttime`, `MID`, `CID`, `rname`, `rcellphone`, `rmail`, `rnote`) 
            VALUES ('".$_SESSION['array'][1]."',' ','1','".$shippingType."',' ',' ' ,' ','".$time."','".$MID."','".$CID."','".$rname."','".$rcellphone."','".$rmail."','".$rnote."');";
        }

        //匯款
        if($paymentType==3)
        {
            $sqlstr="INSERT INTO `TRAN` (`TID`,`trans`,`cash`, `store`,`ctype`, `cnum`, `bnum`,`ttime`, `MID`, `CID`, `rname`, `rcellphone`, `rmail`, `rnote`)
            VALUES('".$_SESSION['array'][1]."','".$trans."','0','".$shippingType."',' ',' ',' ','".$time."','".$MID."','".$CID."','".$rname."','".$rcellphone."','".$rmail."','".$rnote."');";
        }

        mysqli_query($link,$sqlstr);

        //資料傳入RECORD
        for($i=1;$i<=count($_SESSION['array']);$i=$i+4)
        {
            $sqlstr1="INSERT INTO `RECORD`(`TID`, `PID`, `totalnum`, `totalprice`) VALUES ('".$_SESSION['array'][1]."','".$_SESSION['array'][$i+1]."','".$_SESSION['array'][$i+2]."','".$_SESSION['array'][$i+3]."');";
            mysqli_query($link,$sqlstr1);
        }

        mysqli_close($link);
        echo '<meta http-equiv=REFRESH CONTENT=2;url=details1.php>';
    }
?>