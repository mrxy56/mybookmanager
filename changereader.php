<html>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<body>
<?php
    function fff(){
		if($_POST['rSex'] === "��") return true;
		if($_POST['rSex'] === "Ů") return true;
		return false;
	}
	function check(){
		if(empty($_POST['rID'])||strlen($_POST['rID'])>8) return false;
		if(empty($_POST['rName'])||strlen($_POST['rName'])>10) return false;
		if(empty($_POST['rSex'])||fff()==false) return false;
		if(empty($_POST['rDept'])||strlen($_POST['rDept'])>10) return false;
		if(is_numeric($_POST['rGrade']) == false) return false;
		if($_POST['rGrade'] <= 0) return false;
		return true;
	}
	if(check() == true){
		$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
		$sql = "SELECT * FROM reader WHERE(rID = '" . $_POST['rID'] . "')";
		$query = odbc_exec($connid, $sql);
		if(odbc_fetch_row($query)){
			$sql = "UPDATE reader SET rID ='".$_POST['rID']."' WHERE(rID = '" . $_POST['rID'] . "')";
			odbc_exec($connid,$sql);
			$sql = "UPDATE reader SET rSex='".$_POST['rSex']."' WHERE(rID = '" . $_POST['rID'] . "')";
			odbc_exec($connid,$sql);
            $sql = "UPDATE reader SET rDept='".$_POST['rDept']."' WHERE(rID = '" . $_POST['rID'] . "')";
			odbc_exec($connid,$sql);
			$sql = "UPDATE reader SET rGrade =".$_POST['rGrade']." WHERE(rID = '" . $_POST['rID'] . "')";
			odbc_exec($connid,$sql);
			echo "<div id='result' style='display:none'>0</div>�ɹ�";
		}else{
			echo "<div id='result' style='display:none'>1</div>��֤�Ų�����";
		}
	}else{
		echo "<div id='result' style='display:none'>2</div>�ύ�Ĳ�������";
	}
?>	
</body>
</html>