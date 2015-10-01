<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
    function fff(){
		if($_POST['rSex'] === "男") return true;
		if($_POST['rSex'] === "女") return true;
		return false;
	}
	function isblank(){
		if(empty($_POST['rID'])||strlen($_POST['rID'])>8) return false;
		if(empty($_POST['rName'])||strlen($_POST['rName'])>10) return false;
		if(empty($_POST['rSex'])||fff()==false) return false;
		if(empty($_POST['rDept'])||strlen($_POST['rDept'])>10) return false;
		if(empty($_POST['rGrade'])) return false;
		if(is_numeric($_POST['rGrade']) == false) return false;
		if($_POST['rGrade'] <= 0) return false;
		return true;
	}
	if(isblank() == false){
		echo "<div id='result' style='display:none'>2</div>提交的参数有误。";
	}else{
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT * FROM reader WHERE(rID = '" . $_POST['rID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			echo "<div id='result' style='display:none'>1</div>该证号已经存在";
		}else{
			$sql="INSERT INTO reader VALUES('" . $_POST["rID"] . "','" . $_POST["rName"] . "','" . $_POST["rSex"] . "','" . $_POST["rDept"] . "'," . $_POST["rGrade"].")";
			$query = odbc_exec($connid, $sql);
			echo "<div id='result' style='display:none'>0</div>成功";
		}
		
	}
?>
</body>
</html>
