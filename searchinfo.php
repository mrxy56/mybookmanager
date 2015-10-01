<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
      if(strlen($_POST['rID'])>8){
      	 echo "<table border=1 id='result'></table>";
      }else{
      	$connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
	  	$sql = "SELECT * FROM reader WHERE(rID = '" . $_POST['rID'] . "')";
	  	$query = odbc_exec($connid, $sql);
	  	if(odbc_fetch_row($query)){
	  		$sql = "SELECT book.bID,borrowdate,bName FROM borrow,book WHERE(rID = '" . $_POST['rID'] ."' AND book.bID=borrow.bID)";
	  		$query=odbc_exec($connid, $sql);
	  		echo "<table border=1 id=result>";
	  		while(odbc_fetch_row($query)){
	  			$ID=odbc_result($query,1);
	  			$temp=odbc_result($query,2);
	  			$UnixTime=strtotime($temp);
	  			$bdate=date("Y-m-d",$UnixTime);
	  			$bookname=odbc_result($query,3);
	  			$rdate=date("Y-m-d",strtotime('+1 month',$UnixTime));
	  			$now=date("Y-m-d",time());
	  			$judge="是";
	  			if($now<=$rdate) $judge="否";
                echo "<tr><td>".$ID."</td><td>".$bookname."</td><td>".$bdate."</td><td>".$rdate."</td><td>".$judge."</td></tr>";
	  		}
	  		echo "</table>";
	  	}else{
	  		echo "<div id='result' style='display:none'>1</div>该证号不存在";
	  	}
	}
?>
<body>
</html>