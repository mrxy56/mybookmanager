<html>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<body>
<?php
	function check(){
		if(empty($_POST['bID'])||strlen($_POST['bID'])>30) return false;
		if(empty($_POST['bCnt'])) return false;
		if(is_numeric($_POST['bCnt']) == false) return false;
		if($_POST['bCnt'] <= 0) return false;
		return true;
	}
	if(check() == true){
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT bCnt , bRemain FROM book WHERE(bID = '" . $_POST['bID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			$cnt = odbc_result($query, 1);
			$remain = odbc_result($query, 2);
			$cnt += $_POST['bCnt'];
			$remain += $_POST['bCnt'];
			$sql = "UPDATE book SET bCnt = $cnt , bRemain = $remain WHERE(bID = '" . $_POST['bID'] . "')";
			odbc_exec($connid , $sql);
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