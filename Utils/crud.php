<?php
class Crud
{
	private	static $query="";
		
	function __construct() {}

	function adddata($connection, $tablename, $datalist)	//adddata("member", array("name"=>$_POST['txtname'), "pass"=>$_POST['txtpass']));
	{
		$extractdata="";
		foreach($datalist as $key=>$value)
		{
			$extractdata .= " $key='$value',";   //name='$nm',mobile='$mo',
		}
		$extractdata=trim($extractdata,",");  //name='$nm',mobile='$mo' //$extractdata=substr($extractdata,0,-1);
		
		$query="INSERT INTO $tablename set $extractdata";
		
		if(mysqli_query($connection,$query))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function query($connection,$query)
	{
		return mysqli_query($connection,$query)?true:false;
	}

	function updatedata($connection,$tablename, $datalist, $condition)		//editdata("member", array("name"=>$_POST['txtname'), "pass"=>$_POST['txtpass']), " where id='$id'");
	{
		$extractdata="";
		
		foreach($datalist as $key=>$value)
		{
			$extractdata .= " $key='$value',";
		}
		
		$extractdata=trim($extractdata,",");  //$extractdata=substr($extractdata,0,-1);
		
		$query="UPDATE $tablename set $extractdata $condition";
		
		if(mysqli_query($connection,$query))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function deletedata($connection,$tablename, $condition="")		//deldata("member", " where id='$id'");
	{
		$query= "DELETE FROM $tablename $condition";
		
		if(mysqli_query($connection,$query))
		{
			return 1;
		}
		else{
			return 0;
		}	
	}

	function getdata($connection, $datalist, $tablename, $condition, $order)		//getdata("member", "id,name,email,phone", " where cit='$cit'", " orderer b phonr");
	{
		return mysqli_query($connection,"SELECT $datalist FROM $tablename $condition $order");
	}
}
?>