


<?php
 
  echo "<p align='center'>数据库连接中..</p>";
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");
$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);

echo '<head><link href="showClientInfo.css" type="text/css" rel="stylesheet"><title>亚信订餐后台管理</title></head><body bgcolor="#1E90FF" style="color:#fffbf0;font-size:40px;">';
if(mysqli_connect_errno())
{
    echo mysqli_connect_error();
    echo "failed";
}
else
{
    echo "<p align='center'>连接成功..</p>";
}
   $results = $conn->query("select * from book_dinner_info");
   echo"<p align='center'>查询成功！！！</p>";
   echo "<script>function returnExcelFile(){
   window.location.href='excuteXls.php';
   return true;
   }</script>";
print '<input align="center" type="button" value="生成excel表并下载" id="change_dish"  onclick="return returnExcelFile()"/>';
//下面这个为穷尽表中的数据
print '<table align="center"  id="table_s"  bordercolor="#FF9933" border="1" cellspacing="0" cellpadding="0">';
print '<caption>订餐情况</caption>';
print '<tr>';

print '<th>用户名ID</th>';
print '<th>用户姓名</th>';
print '<th>想吃的菜</th>';
print '<th>创建时间</th>';
print '<th>订餐状态</th>';
print '</tr>';
while($row = $results->fetch_assoc()) 
{
	if($row["name"]=="admin")
	continue;
    print '<tr>';
	print '<td>'.$row["id"].'</td>';
    print '<td>'.$row["name"].'</td>';
    print '<td>'.$row["dish_name"].'</td>';
	print '<td>'.$row["createtime"].'</td>';
	print '<td>'.$row["book_state"].'</td>';
    
    print '</tr>';
	
}  
print '</table>';


// Frees the memory associated with a result
$results->free();

// close connection 
$conn->close();
echo "</body>";
?>






