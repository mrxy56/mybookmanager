<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
      $connid = odbc_connect('DBSTestAccess', '', '') or die("error!"); 
      function judge_overtime($tt){
			$now=date("Y-m-d",time());
			if($now > $tt){
				return true;
			}else{
				return false;
			}
		}
      $sql = "SELECT * FROM borrow";
	  $query = odbc_exec($connid, $sql);
	  while (odbc_fetch_row($query)) {
			$rID = odbc_result($query , 1);
			$bID = odbc_result($query , 2);
			$deadline = odbc_result($query, 4);
			if(judge_overtime($deadline)){
				$sql = "UPDATE borrow SET overtime = '是' WHERE(rID = '" . $rID . "' AND bID = '" . $bID . "')";
				odbc_exec($connid, $sql);
			}
	  }
	  $sql = "SELECT DISTINCT rID FROM borrow WHERE (overtime='是')";
	  $query = odbc_exec($connid, $sql);
	  echo "<table border=1 id='result'>";
	  while(odbc_fetch_row($query)){
	  	   $RID=odbc_result($query, 1);
           $sql1 = "SELECT rName,rSex,rDept,rGrade FROM reader WHERE (rID='".$RID."')";
           $query1=odbc_exec($connid,$sql1);
           if(odbc_fetch_row($query1)){
           	    $v1=odbc_result($query1, 1);
           	    $v2=odbc_result($query1, 2);
           	    $v3=odbc_result($query1, 3);
           	    $v4=odbc_result($query1, 4);
           	    echo "<tr><td>".$RID."</td><td>".$v1."</td><td>".$v2."</td><td>".$v3."</td><td>".$v4."</td></tr>";
           }
	  }
	  echo "</table>";
?>
<body>
</html>