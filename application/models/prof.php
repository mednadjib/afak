<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prof extends CI_Model {

	var $id1 = "";
	var $id2 = "";
	var $confirm = "";

	function __construct()
	{
		parent::__construct();
		$this->load->model('session');
		$this->load->model('amis');
	}
	
	function professeur()
	{
		$q = mysql_query('SELECT id_agent FROM agent WHERE type = 1 ');
		$i = 0;
		$e = 0; $p = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = $this->amis->who($row["id_agent"]);
				//if ($data[$i]["type"] == 0) {$e++;}else{$p++;}
				$i++;
		}
		//$data["amis_count"] = $e;
		$data["prof_count"] = $i;
		$data["taille"] = $i;
		return $data;
	}
	
	function parents()
	{
		$q = mysql_query('SELECT id_agent FROM agent WHERE type = 3 ');
		$i = 0;
		$e = 0; $p = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = $this->amis->who($row["id_agent"]);
				//if ($data[$i]["type"] == 0) {$e++;}else{$p++;}
				$i++;
		}
		//$data["amis_count"] = $e;
		$data["parents_count"] = $i;
		$data["taille"] = $i;
		return $data;
	}
}
