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
	      echo "<div id='result' style='display:none'>1</div>��֤�Ų�����";
	  }
      $sql = "SELECT * FROM book WHERE(bID = '" . $_POST['bID'] . "')";
	  $query = odbc_exec($connid, $sql);
	  if(odbc_fetch_row($query)){
	  	  $flag2=true;
	  }else{
	      echo "<div id='result' style='display:none'>2</div>����Ų�����";
	  }
	  if($flag1 && $flag2){
	  	  $sql = "SELECT * FROM borrow WHERE(rID = '".$_POST['rID'] . "' AND bID = '".$_POST['bID']."')";
	  	  $query = odbc_exec($connid, $sql);
	      if(odbc_fetch_row($query)){
	      	  $sql="DELETE FROM borrow WHERE(rID = '".$_POST['rID'] . "' AND bID = '".$_POST['bID']."')";
	      	  $query=odbc_exec($connid, $sql);
	      	  $sql = "SELECT bRemain FROM book WHERE(bID = '".$_POST['bID']."')";
              $query=odbc_exec($connid,$sql);
              if(odbc_fetch_row($query)){
          	       $temp=odbc_result($query,1);
          	       $temp=$temp+1;
          	       $sql="UPDATE book SET bRemain=".$temp." WHERE (bID='".$_POST['bID']."')";
          	       $query=odbc_exec($connid, $sql);
          	       echo "<div id='result' style='display:none'>0</div>�ɹ�";
              }
          }else{
	      	  echo "<div id='result' style='display:none'>3</div>�ö��߲�δ���ĸ���";
	      }
	  }
?>
<body>
</html>