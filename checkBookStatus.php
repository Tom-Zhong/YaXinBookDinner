<?php
/*
这个是用来检测用户在数据库是否订餐状态
*/


$check_name=$_GET["check_name"];
$queryUserNameSql="select book_state from book_dinner_info where name='".$check_name."'";
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");
 //查询数据库中的用户，如果query不到用户的姓名，返回false，不然就会返回true
 $result=$conn->query($queryUserNameSql);
     if($result!=NUll)
		
		{
			//这个为查询库中订餐的状态，如果为1即为订餐返回true，否则返回false
		    if($row = $result->fetch_assoc())
                  {
					  if($row["book_state"]==1)
	                 {
				       //有个bug，就是订餐状态为1的时候返回一个0值，然后未订餐状态返回一个1值
		                $response=1;//1为订餐状态
		     
		             }
			         else if($row["book_state"]==0)
			        {
				$response=0;//0为未订餐状态
			        }
			
	               }
	        else
	             {
		          //账户不存在，返回错误值-1
		           $response=2;
	              }

		}
	
		
echo $response;





?>