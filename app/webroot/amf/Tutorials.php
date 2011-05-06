<?php
class Tutorials
{
	public function __construct()
	{
		mysql_connect("72.47.193.128", "klickabletv", "kl1ck4bl3tv");
		mysql_select_db("klickabletv");
	}
	
	public function getTutorials($i)
	{
	
		$result = mysql_query("SELECT * FROM hotspots WHERE video_id = " . $i);
		$t = array();
		
		while($row = mysql_fetch_assoc($result))
		{
			array_push($t, $row);
		}	
		return $t;
	}
	
	public function getTutorials2($j)
	{
		$list=implode(',', $j);
		$result = mysql_query("SELECT * FROM frames WHERE hotspot_id IN (" . $list .")");
		$t = array();
	
	
		while($row = mysql_fetch_assoc($result))
		{
			array_push($t, $row);
		}
		
		return $t;
	}
}