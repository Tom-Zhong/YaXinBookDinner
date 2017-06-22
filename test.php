<?php

//$sql="update book_dinner_info set book_state=0,dish_name='' where name='".$book_name."'";
$compare="select createtime from book_dinner_info where name='钟贵勇'";
$conn=new mysqli("localhost", "root", "1234", "book_dinner","3306","");

$resultCom=$conn->query($compare);

     
		
	
			
		    if($row = $resultCom->fetch_assoc())
             {
				 $date=date('Y-m-d');
				if($row["createtime"]!=$date)
                echo $row["createtime"];
			
	    }
	       
	
		
		
		
		


?>