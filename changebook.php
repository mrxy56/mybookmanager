<html>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<body>
<?php
    function checkDatetime($str, $format="Y-m-d"){
        $unixTime=strtotime($str);
        $checkDate= date($format, $unixTime);
        if($checkDate==$str)
           return true;
        else
           return false;
    }
	function check(){
		if(empty($_POST['bID'])||strlen($_POST['bID'])>30) return false;
		if(empty($_POST['bName'])||strlen($_POST['bID'])>30) return false;
		if(empty($_POST['bPub'])||strlen($_POST['bID'])>30) return false;
		if(empty($_POST['bDate'])) return false;
		if(empty($_POST['bAuthor'])||strlen($_POST['bID'])>20) return false;
		if(empty($_POST['bMem'])||strlen($_POST['bID'])>30) return false;
		if(checkDatetime($_POST['bDate'])==false) return false;
		return true;
	}
	if(check() == true){
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT bCnt , bRemain FROM book WHERE(bID = '" . $_POST['bID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			$sql = "UPDATE book SET bName ='".$_POST['bName']."' WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid,$sql);
			$sql = "UPDATE book SET bPub='".$_POST['bPub']."' WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid,$sql);
            $sql = "UPDATE book SET bDate='".$_POST['bDate']."' WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid,$sql);
			$sql = "UPDATE book SET bAuthor ='".$_POST['bAuthor']."' WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid,$sql);
			$sql = "UPDATE book SET bMem ='".$_POST['bMem']."' WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid,$sql);
			echo "<div id='result' style='display:none'>0</div>成功";
		}else{
			echo "<div id='result' style='display:none'>1</div>该书不存在";
		}
	}else{
		echo "<div id='result' style='display:none'>2</div>提交的参数有误。";
	}
	
?>	
</body>
</html>