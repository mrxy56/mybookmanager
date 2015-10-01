<html>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<body>
<?php
	if(strlen($_POST['rID'])>8){
		echo "<div id='result' style='display:none'>1</div>该证号不存在";
	}else{
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT * FROM reader WHERE(rID = '" . $_POST['rID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			$RID = odbc_result($query, 1);
			$sql = "SELECT * FROM borrow WHERE(rID = '" .$RID. "')";
			$query = odbc_exec($connid, $sql);
			if(odbc_fetch_row($query)){
			    echo "<div id='result' style='display:none'>2</div>该读者尚有书籍未归还";
			}else{
				$sql="DELETE FROM reader WHERE (rID ='" . $RID ."')";
				odbc_exec($connid, $sql);
				echo "<div id='result' style='display:none'>0</div>成功";
			}
		}else{
			echo "<div id='result' style='display:none'>1</div>该证号不存在";
		}
    }
?>	
</body>
</html>