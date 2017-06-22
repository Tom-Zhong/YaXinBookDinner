<?php



//这个php的作用是生成一个excel文件方便查看
ini_set("display_errors",1);

//使用str_replace函数将服务器根目录的'/'转换成'\'
//服务器根目录的常量是：$_SERVER['DOCUMENT_ROOT'];
//下面这个是windows下面将斜杠调整成'\'
$strDocument_root=str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);
//$strDocument_root=$_SERVER['DOCUMENT_ROOT'];
//将服务器目录转换后加入PHPExcel的目录
//$strDocument_root=$strDocument_root.'book__dinner/PHPExcel_1.8.0_doc/Classes';



//这里需要用到dirname(_FILE_),因为测试过后根目录$_SERVER['Doucment_Root']是不可行的，百度设置了权限不让从根目录往里访问
$strDocument_root=dirname(__FILE__).'/PHPExcel_1.8.0_doc/Classes';
//临时设置ini_set临时设置php的include库目录
ini_set('include_path',$strDocument_root);

//导入PHPExcel的入口文件
include "PHPExcel.php";
include $strDocument_root."/PHPExcel/Writer/Excel5.php";
include $strDocument_root."/PHPExcel/Writer/Excel2007.php";

//获取Excel入口对象
$objPHPExcel = new PHPExcel();

//获取Excel5的Write5对象进行下一步操作
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);

//设置文档的基本属性
$objProps = $objPHPExcel->getProperties();
$objProps->setCreator("Zhonggy"); //设置作者
$objProps->setLastModifiedBy("Zhonggy"); //设置最后修改人
$titleName=date('y-m-d',time())."Asiainfo_MNVO_bookdinner";//设置标题名为时间+文件作用
$objProps->setTitle($titleName);  //设置标题名
$objProps->setSubject("Book_dinner"); //设置主题
$objProps->setDescription("Book_dinner app for Asiainfo MVNO"); //设置备注
$objProps->setKeywords("office excel PHPExcel"); //设置标记
$objProps->setCategory("Excel");  //设置文件类型




//操作文件并且写入
//设置活动表
$objPHPExcel->setActiveSheetIndex(0); 
$objActSheet = $objPHPExcel->getActiveSheet(); 
 $objActSheet->setTitle('订餐人数统计'); //设置活动表的表标题
//由PHPExcel根据传入内容自动判断单元格内容类型 
     
     //设置第一行单元格标题后合并单元格，下面先设置基本信息
    $objActSheet->setCellValue('A1','订餐情况一览表');
    $objActSheet->mergeCells('A1:E1');
    $objActSheet->setCellValue('A2', '用户ID'); // 用户ID
    $objActSheet->setCellValue('B2', '姓名');            // 用户姓名
    $objActSheet->setCellValue('C2', '预定菜式');          // 预定菜式 
    $objActSheet->setCellValue('D2', '预定时间');     //预定时间
    $objActSheet->setCellValue('E2', '订餐状态');    // 预定状态



//以下就是从数据库获取数据写入到excel表中


//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);
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

//定义一个变量，使得表中表格指针不停往下移动
   $varInt=3;   
//下面这个为穷尽表中的数据,向Excel表中写入数据
while($row = $results->fetch_assoc()) 
{
	
	if($row["name"]=="admin")
	continue;

    $objActSheet->setCellValue('A'.$varInt, $row["id"]);
    $objActSheet->setCellValue('B'.$varInt, $row["name"]);
    $objActSheet->setCellValue('C'.$varInt, $row["dish_name"]);
    $objActSheet->setCellValue('D'.$varInt, $row["createtime"]);
    $objActSheet->setCellValue('D'.$varInt, $row["book_state"]);
	$varInt++;
	


}  










// Frees the memory associated with a result
$results->free();

// close connection 
$conn->close();

$filename=iconv("utf-8","GBK","亚信MVNO加班餐预定情况表.xls");
//生成文件
$excelLocation=str_replace('/','\\',$_SERVER['DOCUMENT_ROOT'])."\\book__dinner\\".date('y-m-d',time()).$filename;

//写入到文件
//$objWriter->save($excelLocation);




//输出到浏览器
//关键点：输出文件到缓冲区是需要清理缓存，使用ob_end_clean();
ob_end_clean();
     header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="'.date('y-m-d',time()).$filename.'"');  
    header('Cache-Control: max-age=0');  
   $objWriter->save('php://output'); 
?>