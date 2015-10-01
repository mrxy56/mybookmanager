<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
      $connid = odbc_connect('DBSTestAccess', '', '') or die("error!");
      $flag1=false;$flag2=false;
	  $sql = "SELECT * FROM reader WHERE(rID = '" . $_POST['rID'] . "')";
	  $query = odbc_exec($connid, $sql);
	  if(odbc_fetch_row($query)){
	  	  $flag1=true;
	  }else{
	      echo "<div id='result' style='display:none'>1</div>该证号不存在";
	  }

	  $sql = "SELECT * FROM book WHERE(bID = '" . $_POST['bID'] . "')";
	  $query = odbc_exec($connid, $sql);
	  if(odbc_fetch_row($query)){
	  	  $flag2=true;
	  }else{
	      echo "<div id='result' style='display:none'>2</div>该书号不存在";
	  }
      $flag3=true;
	  if($flag1 && $flag2){
	  	  $sql = "SELECT borrowdate FROM borrow WHERE(rID = '".$_POST['rID']."')";
	  	  $query = odbc_exec($connid, $sql);
	  	  while(odbc_fetch_row($query)){
	  	  	  $temp=odbc_result($query,1);
	          $UnixTime=strtotime($temp);
	          $rdate=date("Y-m-d",strtotime('+1 month',$UnixTime));
	          $now=date("Y-m-d",time());
	          if($now>$rdate){
	          	echo "<div id='result' style='display:none'>3</div>该读者有超期书未还";
	            $flag3=false;
	          }
	  	  }
	  	  $sql = "SELECT * FROM borrow WHERE(rID = '".$_POST['rID'] . "' AND bID = '".$_POST['bID']."')";
	  	  $query = odbc_exec($connid, $sql);
	      if(odbc_fetch_row($query)){
	      	  echo "<div id='result' style='display:none'>4</div>该读者已经借阅该书，且未归还";
	      	  $flag3=false;
	      }
          $sql = "SELECT bRemain FROM book WHERE(bID = '".$_POST['bID']."')";
          $query=odbc_exec($connid,$sql);
          if(odbc_fetch_row($query)){
          	 $temp=odbc_result($query,1);
          	 if($temp==0){
          	 	echo "<div id='result' style='display:none'>5</div>该书已经全部借出";
          	    $flag3=false;
          	 }
          }
          if($flag3==true){
          	 $sql = "SELECT bRemain FROM book WHERE(bID = '".$_POST['bID']."')";
	  	     $query = odbc_exec($connid, $sql);
	  	     if(odbc_fetch_row($query)){
	  	  	    $temp=odbc_result($query,1);
	            $temp=$temp-1;
	            $sql="UPDATE book SET bRemain=".$temp." WHERE (bID='".$_POST['bID']."')";
	            $query=odbc_exec($connid,$sql);
	  	     }
	  	     $temp=date("Y-m-d",time());
	  	     $UnixTime=strtotime($temp);
	         $rdate=strtotime('+1 month',$UnixTime);
	         $newdate=date("Y-m-d",$rdate);
	  	     $sql="INSERT INTO borrow VALUES('" . $_POST["rID"] . "','" . $_POST["bID"] . "',#" . 
	  	     	$temp."#,#".$newdate."#,'否')";
			 $query = odbc_exec($connid, $sql);
          	 echo "<div id='result' style='display:none'>0</div>成功";
          }
	  }
?>
<body>
</html>