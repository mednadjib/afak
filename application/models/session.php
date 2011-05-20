<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Model {

	var $id_agent = "";
	var $id_session = "";
	var $time = "";

	function __construct()
	{
		parent::__construct();
	}

	function CRSession() 
	{ 
		$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = '' ; 

		while ($i <= 50) { 
			$num = rand() % 33; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 

		return $pass; 
	} 
	
	function update($id_agent, $id_session)
	{
		$this->id_agent = $id_agent;
		$this->time = time();
		$this->id_session = $id_session;
		
		$this->db->where('id_agent', $id_agent);
		$this->db->update('session', $this); 
	}

	function get_id ($id_session)
	{
		$query = $this->db->query('SELECT * FROM session WHERE id_session  LIKE "'.$id_session.'" LIMIT 1');

		if ($query->num_rows() > 0) 
		{
			$row = $query->row();
			$t = $row->time;
			if (time()- $t < 900)
			{
				$res = array("state" => "1", "id_agent" => $row->id_agent);
				return $res;
			}
		}
		else {
				$res = array("state"=>"0");
				return $res;
			}
		
	}
	
	function add_agent ($id_agent)
	{
		$this->id_agent = $id_agent;
		$this->time = time();
		$this->id_session = $this->CRSession();
		
		$this->db->insert('session', $this);
	}
	
	function deco ($id_agent)
	{
		$this->id_agent = $id_agent;
		$this->time = 1234566798;
		$this->id_session = $this->CRSession();

		$this->db->where('id_agent', $id_agent);
		$this->db->update('session', $this); 
	}


}