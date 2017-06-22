<?php
//得到来自control.js的ajax申请
$clearStatus=$_POST['clearStatus'];
$book_name=$_POST['book_name'];

//准备sql语句

$sql="update book_dinner_info set book_state=0,dish_name='' where name='".$book_name."'";
$compare="select createtime from book_dinner_info where name='".$book_name."'";
$conn=new mysqli("sqld.duapp.com", "2a2570e56cb7473ea4e47cb279ac4f1e", "8f4d491abce64b99b875e20206b67ad4", "KsynAxSvqqPHhRRHuuDe","4050","");
//$conn=new mysqli("localhost","root","1234","book_dinner","3306","");

$resultCom=$conn->query($compare);

     if($resultCom!=NUll)
		
		{
			$date=date('Y-m-d');
			$row = $resultCom->fetch_assoc();
			//这个判断逻辑，如果时间跟当前时间有区别就会清除用户的状态
		    if($row["createtime"]!=$date&&$clearStatus==1)
             {
				
                         $result=$conn->query($sql);
						 if($result==true)
						 {
							 $response=1;
						 }
                      
                          else
                         {
	                      
	                      $response=0;
                          }
					
		    }
			         
	        else 
			 {
			  $response=0;
			//菜单为空
			    }
			
	    }
	       
	
		
		
		
		

echo $response;
?>