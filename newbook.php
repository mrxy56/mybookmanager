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

	function isblank(){
		if(empty($_POST['bID'])||strlen($_POST['bID'])>30) return false;
		if(empty($_POST['bName'])||strlen($_POST['bName'])>30) return false;
		if(empty($_POST['bPub'])||strlen($_POST['bPub'])>30) return false;
		if(empty($_POST['bDate'])) return false;
		if(empty($_POST['bAuthor'])||strlen($_POST['bAuthor'])>20) return false;
		if(empty($_POST['bMem'])||strlen($_POST['bMem'])>30) return false;
		if(empty($_POST['bCnt'])) return false;
		if(is_numeric($_POST['bCnt']) == false) return false;
		if($_POST['bCnt'] <= 0) return false;
		if(checkDatetime($_POST['bDate']) == false) return false;
		return true;
	}
	
	if(isblank() == false){
		echo "<div id='result' style='display:none'>2</div>提交的参数有误。";
	}else{
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT * FROM book WHERE(bID = '" . $_POST['bID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			echo "<div id='result' style='display:none'>1</div>该书已经存在";
		}else{
			$sql="INSERT INTO book VALUES('" . $_POST["bID"] . "','" . $_POST["bName"] . "','" . $_POST["bPub"] . "','" . $_POST["bDate"] . "','" . $_POST["bAuthor"] . "','" . $_POST["bMem"] . "'," . $_POST["bCnt"] . "," . $_POST["bCnt"] . ")";
			$query = odbc_exec($connid, $sql);
			echo "<div id='result' style='display:none'>0</div>成功";
		}
	}
?>	
</body>
</html>