<?php
//封装数据库，即所谓的DAO层

class opmysql{
	//定义私有变量，用以构造函数使用
	private $host = "localhost";
	private $name = "root";
	private $pwd = "1234";
	private $dBase = "gaga";
	private $conn = "";
	private $result = "";
	$status=false;
	private $msg = "";
	private $fileds;
	private $filedsNum = 0;
	private $rowsNum = 0;
	private $rowsRst = "";
	private $fiesArray = array();
	private $rowsArray = array();
	function __construct($host = '',$name='',$pwd = '', $dBase = '') 
	{
		//构造函数，如果不修改的话就是利用上面private定义的默认的$host,$name,$pwd,$dBase的默认值进行创建对象
		if ($host != '')
			$this->host = $host;
		if ($name!='')
			$this->name = $name;
		if ($pwd != '')
			$this->pwd = $pwd;
		if ($dBase != '')
			$this->dBase = $dBase;
		$this->init_conn();
	}
	function init_conn() 
	{
		//这里是创建连接对象并且返回给$conn这个变量生成一个对象，方便后面增删查改调用；
		$this->conn = new mysqli($this->host, $this->name, $this->pwd, $this->dBase,"3306","");
        
        $this->conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);
		if ($his->conn->connect_error) {
			die('Connect Error ('.$his->conn->connect_errno.') '
				.$his->conn->connect_error);
		}

		if (mysqli_connect_error()) {
			die('Connect Error ('.mysqli_connect_errno().') '
				.mysqli_connect_error());
		}

		echo 'Success... '.$this->conn->host_info."\n";
		echo"连接成功";
        if($this->conn->query("set names utf8"))
	     echo "设置字符成功";
	  
	   
	}
	
	function mysql_query_return_book_status($sql)
	{
		if($this->conn==''){
			$this->init_conn();
		}
		
		$result=$this->conn->query($sql);
		
		//这个为查询库中订餐的状态，如果为1即为订餐返回true，否则返回false
		while($row = $result->fetch_assoc()) 
       {

	        if($row["book_state"]==1)
	        {
		
		     $this->status=true;
		     }
			 else 
			 {
				$this->status=false;
			 }
	     }
	}
	function getRowNum($sql)
	
	{
		$this->mysql_query_rst($sql);
		if(mysqli_connect_errno()==0)
		{
			return  mysqli_affected_rows(init_conn());
		}
		else
		{
			return "";
		}
	}
	   
}
?>
