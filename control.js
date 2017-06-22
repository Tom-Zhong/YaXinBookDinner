//这个变量用于下面commucation_PHP(inputValue)生成一个id为dish_name的inputbox
var showInputBox=0;
//这个函数用以监听用户名字的输入，当用户名大于或者等于3位字符时开始检测数据库中是否存在相应的用户
function check_user_book_dish_state() {
	
	if (document.getElementById('un').value.length >= 2) 
	{
		
		
		//执行ajax，获取返回值
		//commucation_PHP(document.getElementById('un').value);
		//使用一个延时函数，降低服务器的开销
		
		setTimeout("commucation_PHP(document.getElementById('un').value)",800);
		//在commucation_PHP(inputValue)的方法使用以后重置showInputBox的值
		showInputBox=0;
        
		
		
	}
	else if(document.getElementById('un').value.length <2) 
	{
		//当用户回填时，自动删除多余的行
		delrow();
		document.getElementById("book_dinner").disabled=true;
		
	}
	else(document.getElementById('un').value.length==0) 
	{
		//不输入的话就把状态设置为“这里是订餐状态”
		document.getElementById("book_state").innerHTML="这里是订餐状态";
	}
	
	return true;

}

function handle() {
	//这个函数用来处理如果用户为订餐在主页下方新增的对话框
	//document.getElementById('book_state').innerHTML =  document.getElementById('un').value+'您未订餐';
	//.length;
	var tb = document.getElementById("book_table");
	oneRow = tb.insertRow();
	oneRow.id="eat_dish";
	cell1 = oneRow.insertCell();
	cell1.innerHTML = "想吃的菜(可留空)<input type='text' name='dish_name' id='dish_name' oninput='return clearBox()'/>";

}
function delrow()
{
	var tb = document.getElementById("book_table");
	 var tr=document.getElementById("eat_dish");
    //取出行的索引，设置删除行的索引

    tb.deleteRow(tr.rowIndex);
}
function commucation_PHP(inputValue)
{
	//交互数据之前先清除用户旧的状态
	clearStatus();
	//这个函数用以跟checkBookStatus.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
		//判断php处理中返回值，情况分别有1->已订餐，0->为订餐，-1->不存在用户
		if(xmlhttp.responseText=='1')
		{
          var myDate = new Date();
		  document.getElementById("book_state").innerHTML=inputValue+"您已订餐，订餐时间为"+myDate.toLocaleDateString();
			
			document.getElementById("cancel_dinner").disabled=false;
	        document.getElementById("book_dinner").disabled=true;
			document.getElementById("change_dish").disabled=false;
			 if(showInputBox==0)
		  {
			  handle();
			  get_eat_dish_menu();
	      }
		  showInputBox++;
		  
		  
		  return true;
		}
        else if(xmlhttp.responseText=='0')
		{
			
		  document.getElementById("book_state").innerHTML=inputValue+"您还未订餐";
		  document.getElementById("cancel_dinner").disabled=true;
		  document.getElementById("book_dinner").disabled=false;
		  document.getElementById("change_dish").disabled=true;
		  //因为只生成一次，所以只用一次handle就行
		  if(showInputBox==0)
		  {
			  handle();
			  alert("你还没有订餐，请在下方输入想吃的菜式（可空）并且点\"订餐\"确定提交");
	      }
		  showInputBox++;
		  
		  return false;
		  
		  
		}
		else if(xmlhttp.responseText=='2')
		{
			
		  document.getElementById("book_state").innerHTML=inputValue+"你还未添加到数据库中，请联系管理员";
		  document.getElementById("cancel_dinner").disabled=true;
		  document.getElementById("book_dinner").disabled=true;
		  document.getElementById("change_dish").disabled=true;
		  return false;
		  
		}
		
		
    }
	
  }
  xmlhttp.open("GET","checkBookStatus.php?check_name="+inputValue,true);
  xmlhttp.send();
	
}

//判断是否中文,冗余代码
function isChinese(str){ 
var badChar ="ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
badChar += "abcdefghijklmnopqrstuvwxyz"; 
badChar += "0123456789"; 
//badChar += " "+"　";//半角与全角空格 
//badChar += "*"+"."+"-"+"+";    //不包含*或.的英文符号 
   if(""==str)
   { 
    //字符创为空时不进行校验
    return false; 
   } 
   
   for(var i=0;i<=str.length;i++)
  {
	//判断字符串中是否出现了英文，如果出现英文的话则返回false不进行校验
	var c = str.charAt(i);//字符串str中的字符 
    if(badChar.indexOf(c) > -1)
	{ 
      return false; 
    } 
   } 
return true; 
}	



//这个为确定订餐的方法，利用ajax和php进行通讯
function book_dinner_confirm()
{
	
	//这个函数用以跟checkBookStatus.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//判断php处理中返回值，情况分别有1->订餐成功，0->订餐失败
		if(xmlhttp.responseText=='1')
		{
          alert("订餐成功");
		   var myDate = new Date();
		  document.getElementById("book_state").innerHTML=document.getElementById("un").value+"您已订餐，订餐时间为"+myDate.toLocaleDateString();
		  
		  document.getElementById("cancel_dinner").disabled=false;
	        document.getElementById("book_dinner").disabled=true;
			document.getElementById("change_dish").disabled=false;
		  //获取相应的菜式
		
		  return true;
		}
        else if(xmlhttp.responseText=='0')
		{
			
		 alert("订餐失败，请再次尝试提交");
		 documdocument.getElementById("cancel_dinner").disabled=false;
	        document.getElementById("book_dinner").disabled=true;
			document.getElementById("change_dish").disabled=false;ent.getElementById("book_state").innerHTML=document.getElementById("un").value+"您未订餐";
		  
		  return false;
		  
		}
		
		
		
    }
	
  }
  //get方法
  //xmlhttp.open("GET","confirm.php?book_name="+document.getElementById("un").value,true);
  //xmlhttp.send();
  
  
  //POST方法
  xmlhttp.open("POST","confirm.php",true);
  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
 //xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
　　xmlhttp.send("book_name="+document.getElementById("un").value+"&book_confirm=1&book_dish_name="+document.getElementById("dish_name").value);
}







//这里是提交修改的菜式的函数，但是要基于用户在数据库存在
function change_dinner_confirm()
{


		//这个函数用以跟changedinner.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//判断php处理中返回值，不为0时证明修改菜式成功
		if(xmlhttp.responseText!="0")
		{
         
		  
		  alert("修改菜式成功，您新预订的菜式是"+document.getElementById('dish_name').value);
		  
		  
		  return true;
		}
        else 
		{
			
		
		 alert("修改菜式失败");
		  
		  return false;
		  
		}
		
		
		
    }
	
  }
  
  xmlhttp.open("POST","changedinner.php",true);
  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
 
　　xmlhttp.send("book_name="+document.getElementById("un").value+"&dish_name="+document.getElementById('dish_name').value);

}
//这里是取消订餐的函数，与cancelDinner.php交互
function cancle_book_dinner_confirm()
{
	//这个函数用以跟changedinner.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//判断php处理中返回值，不为0时证明取消订餐成功
		if(xmlhttp.responseText=="1")
		{
         
		  
		  alert("取消订餐成功");
		  document.getElementById("cancel_dinner").disabled=true;
		  document.getElementById("book_dinner").disabled=false;
		  document.getElementById("change_dish").disabled=true;
		  document.getElementById("dish_name").value="";
		  document.getElementById("book_state").innerHTML="你还未订餐";
		  return true;
		}
        else 
		{
			
		
		 alert("取消订餐失败，请联系管理员查看问题");
		  
		  return false;
		  
		}
		
		
		
    }
	
  }
  
  xmlhttp.open("POST","cancelDinner.php",true);
  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
 
　　xmlhttp.send("book_name="+document.getElementById("un").value+"&cancel_confirm=0");
}








//用来获取菜式假设下定成功
function get_eat_dish_menu(){
	
	
		//这个函数用以跟getDishName.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//判断php处理中返回值，不为0时证明获取菜式成功
		if(xmlhttp.responseText!="0")
		{
         
		  document.getElementById("dish_name").value=xmlhttp.responseText;
		  alert(document.getElementById('un').value+"您预订的菜式是："+xmlhttp.responseText);
		  //获取相应的菜式
		  
		  return true;
		}
        else 
		{
			
		 document.getElementById("dish_name").value="在此填写想吃的菜";
		 alert(document.getElementById('un').value+"您并没有填写想吃的菜，可在下方填写");
		  
		  return false;
		  
		}
		
		
		
    }
	
  }
  
  xmlhttp.open("POST","getDishName.php",true);
  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
 
　　xmlhttp.send("book_name="+document.getElementById("un").value);
		
		
		
	
	
}
//使用一个clearStatus函数，每天用户登录都会重置自己在数据库的预订状态
function clearStatus()
{
	
		//这个函数用以跟getDishName.php进行ajax交互
	var xmlHttp;
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
   //生成上述浏览器的xmlhtttrequest对象，用以ajax交互
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=function()
  {
	  //获取跟服务器连接的状态，当连接状态为4时进行ajax查询；
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		//判断php处理中返回值，不为0时证明获取菜式成功
		if(xmlhttp.responseText=="1")
		{
         
		  //清楚状态成功
		 
		  return true;
		}
        else 
		{
		//清除状态失败
		  
		  return false;
		  
		}
		
		
		
    }
	
  }
  
  xmlhttp.open("POST","clearStatus.php",true);
  xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
 
　　xmlhttp.send("book_name="+document.getElementById("un").value+"&clearStatus=1");
		
		
		
}


//这个为输入框dish_name的监听，清除一次成功以后就会被清除属性
function clearBox()
{
	
	document.getElementById("dish_name").value="";
	document.getElementById("dish_name").removeAttribute("oninput");
}
	