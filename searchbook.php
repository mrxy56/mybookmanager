<html>
<meta http-equiv="content-type" content="text/html;charset=gb2312" />
<body>
<?php
    $connid= odbc_connect('DBSTestAccess','','') or die("error!");
    $sql="SELECT bID,bName,bCnt,bRemain,bPub,bDate,bAuthor,bMem FROM book";
    $temp="";
    $flag=false; 
    if(!empty($_POST['bID'])){
        if(!$flag){
           $temp.="bID LIKE '%".$_POST['bID']."%'";
           $flag=true;
        }else{
           $temp.=" AND bID LIKE '%".$_POST['bID']."%'";
        }
    }
    if(!empty($_POST['bName'])){
        if(!$flag){
           $temp.="bName LIKE '%".$_POST['bName']."%'";
           $flag=true;
        }else{
           $temp.=" AND bName LIKE '%".$_POST['bName']."%'";
        }
    }
    if(!empty($_POST['bPub'])){
        if(!$flag){
           $temp.="bPub LIKE '%".$_POST['bPub']."%'";
           $flag=true; 
        }else{
           $temp.=" AND bPub LIKE '%".$_POST['bPub']."%'";
        }
    }
    if(!empty($_POST['bAuthor'])){
        if(!$flag){
           $temp.="bAuthor LIKE '%".$_POST['bAuthor']."%'";
           $flag=true; 
        }else{
           $temp.=" AND bAuthor LIKE '%".$_POST['bAuthor']."%'";
        }
    }
    if(!empty($_POST['bMem'])){
        if(!$flag){
           $temp.="bMem LIKE '%".$_POST['bMem']."%'";
           $flag=true;
        }else{
           $temp.=" AND bMem LIKE '%".$_POST['bMem']."%'"; 
        }
    }
    if(!empty($_POST['bDate0']) && !empty($_POST['bDate1'])){
        if(!$flag){
           $temp.="bDate BETWEEN #" . $_POST['bDate0'] . "# AND #" . $_POST['bDate1']."#";
           $flag=true;
        }else{
           $temp.=" AND bDate BETWEEN #" . $_POST['bDate0'] . "# AND #" . $_POST['bDate1']."#"; 
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
    	 $Cnt=odbc_result($query,3);
    	 $Remain=odbc_result($query,4);
    	 $Pub=odbc_result($query,5);
    	 $Date=odbc_result($query,6);
         $unixTime=strtotime($Date);
         $Date= date("Y-m-d", $unixTime);
    	 $Author=odbc_result($query,7);
    	 $Mem=odbc_result($query,8);
         echo "<tr><td>".$ID."</td><td>".$Name."</td><td>".$Cnt."</td><td>".$Remain."</td><td>".$Pub."</td><td>".$Date."</td><td>".$Author."</td><td>".$Mem."</td></tr>";
    }
    echo "</table>";
?>
<body>
</html>