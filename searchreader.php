<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
    function fff(){
      if($_POST['rSex'] === "男") return true;
      if($_POST['rSex'] === "女") return true;
      return false;
    }
    function judge(){
      if(!empty($_POST['rID']) && strlen($_POST['rID'])>8) return false;
      if(!empty($_POST['rName']) && strlen($_POST['rName'])>10) return false;
      if(!empty($_POST['rSex']) && fff()==false) return false;
      if(!empty($_POST['rDept']) && strlen($_POST['rDept'])>10) return false;
      if(!empty($_POST['rGrade0']) && (is_numeric($_POST['rGrade0']) == false||$_POST['rGrade0'] <= 0)) return false;
      if(!empty($_POST['rGrade1']) && (is_numeric($_POST['rGrade1']) == false||$_POST['rGrade1'] <= 0)) return false;
      return true;
    }
    if(judge()==false){
       echo "<table border=1 id='result'></table>";
    }else{
      $connid= odbc_connect('DBSTestAccess','','') or die("error!");
      $sql="SELECT rID,rName,rSex,rDept,rGrade FROM reader";
      $temp="";
      $flag=false; 
      if(!empty($_POST['rID'])){
        if(!$flag){
           $temp.="rID LIKE '%".$_POST['rID']."%'";
           $flag=true;
        }else{
           $temp.=" AND rID LIKE '%".$_POST['rID']."%'";
        }
      }
      if(!empty($_POST['rName'])){
        if(!$flag){
           $temp.="rName LIKE '%".$_POST['rName']."%'";
           $flag=true;
        }else{
           $temp.=" AND rName LIKE '%".$_POST['rName']."%'";
        }
      }
      if(!empty($_POST['rSex'])){
        if(!$flag){
           $temp.="rSex LIKE '%".$_POST['rSex']."%'";
           $flag=true; 
        }else{
           $temp.=" AND rSex LIKE '%".$_POST['rSex']."%'";
        }
      }
      if(!empty($_POST['rDept'])){
        if(!$flag){
           $temp.="rDept LIKE '%".$_POST['rDept']."%'";
           $flag=true; 
        }else{
           $temp.=" AND rDept LIKE '%".$_POST['rDept']."%'";
        }
      }
      if(!empty($_POST['rGrade0']) && !empty($_POST['rGrade1'])){
        if(!$flag){
           $temp.="rGrade BETWEEN " . $_POST['rGrade0'] . " AND " . $_POST['rGrade1'];
           $flag=true;
        }else{
           $temp.=" AND rGrade BETWEEN ".$_POST['rGrade0']." AND ".$_POST['rGrade1']; 
        }
      }
      if($flag){
        $sql.=" WHERE(".$temp.")";
      }
      $query=odbc_exec($connid, $sql);
      echo "<table border=1 id=result>";
      while(odbc_fetch_row($query)){
    	 $ID=odbc_result($query,1);
    	 $Name=odbc_result($query,2);
    	 $Sex=odbc_result($query,3);
    	 $Dept=odbc_result($query,4);
    	 $Grade=odbc_result($query,5);
      echo "<tr><td>".$ID."</td><td>".$Name."</td><td>".$Sex."</td><td>".$Dept."</td><td>".$Grade."</td></tr>";
      }
      echo "</table>";
      odbc_close($connid);
    }
?>
<body>
</html>