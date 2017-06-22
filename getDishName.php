<?php
//得到来自control.js的ajax申请
$book_name=$_POST['book_name'];

//准备sql语句

$sql="select dish_name from book_dinner_info where name='".$book_name."'";
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");
$result=$conn->query($sql);

     if($result!=NUll)
		
		{
			//这个为查询库中订餐名，如果为不为空返回，为空的话返回空
		    if($row = $result->fetch_assoc())
                  {
					  if($row["dish_name"]!=null)
	                 {
				      //不为空时返回菜单名
		                $response=$row["dish_name"];
		     
		             }
			         else 
			        {
				     $response=0;
					 //菜单为空
			        }
			
	               }
	       
		}
	
		
echo $response;


?>