<?php
//得到来自control.js的ajax申请
$book_name=$_POST['book_name'];
$dish_name=$_POST['dish_name'];
//准备sql语句

$sql="update book_dinner_info set dish_name='".$dish_name."' where name='".$book_name."' and book_state=1";
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");
$result=$conn->query($sql);

     if($result==true)
   {
	// 如果$result的值为true，则证明修改订餐状态为订餐成功
	$response=1;
     }
    else
   {
	//如果$result的值为false，则证明修改订餐状态为订餐成功，则证明修改订餐状态为订餐成功
	$response=0;
}
echo $response;


?>