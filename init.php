<html>
<meta http-equiv="content-type" content="text/html; charset=gb2312" />
<body>
<?php
	$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
	$sql = "Drop TABLE book";
	@odbc_exec($connid, $sql);
	$sql = "Drop TABLE reader";
	@odbc_exec($connid, $sql);
	$sql = "Drop TABLE borrow";
	@odbc_exec($connid, $sql);
	$sql = "CREATE TABLE book(bID char(70) , bName char(70) , bPub char(70) , bDate date , bAuthor char(70) , bMem char(70) , bCnt integer , bRemain integer)";
	$query = @odbc_exec($connid, $sql);
	$sql = "CREATE TABLE reader(rID char(70) , rName char(70) , rSex char(70) , rDept char(70) , rGrade integer)";
	$query = @odbc_exec($connid, $sql);
	$sql = "CREATE TABLE borrow(rID char(70) , bID char(70) , borrowdate date,returndate date,overtime char(70))";
	$query = @odbc_exec($connid, $sql);

	echo "<div id='result' style='display:none'>0</div>成功";
?>	
</body>
</html>