<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amis extends CI_Model {

	var $id1 = "";
	var $id2 = "";
	var $confirm = "";

	function __construct()
	{
		parent::__construct();
		$this->load->model('session');
	}

	function list_confirm ($id_agent)
	{
		$q = mysql_query('SELECT id1 FROM amis WHERE id2 = "'.$id_agent.'" AND confirm = 0');
		$i = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = $this->who($row["id2"]);
				$i++;
		}
		$data["amis_count"] = $i;
		return $data;
	}
	
	function who ($id_agent)
	{
		$query = $this->db->query('SELECT * FROM agent WHERE id_agent  LIKE "'.$id_agent.'" LIMIT 1');

		if ($query->num_rows() > 0) 
		{
			$row = $query->row();
			$res = array("nom" => $row->nom,"prenom" => $row->prenom,"id_agent" => $row->id_agent, "type" => $row->type, "avatar" => $row->avatar, "humeur" =>$row->humeur);

			return $res;
		}
		else {

			$res = array("pass"=>"0");
			return $res;
		}

	}
	
	function c_amis ($id_agent)
	{
		$q = mysql_query('SELECT id1,confirm FROM amis WHERE id2 = "'.$id_agent.' AND id2<1000"');
		$i = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = $this->who($row["id1"]);
				$data[$i]["confirm"] = $row["confirm"];
				$i++;
		}
		$data["amis_count"] = $i;
		return $data;
	}

	
	function amis ($id_agent)
	{
		$q = mysql_query('SELECT id2 FROM amis WHERE id1 = "'.$id_agent.'" AND id2<1000 AND confirm = 1 ');
		$i = 0;
		$e = 0; $p = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = $this->who($row["id2"]);
				if ($data[$i]["type"] == 0) {$e++;}else{$p++;}
				$i++;
		}
		$data["amis_count"] = $e;
		$data["prof_count"] = $p;
		$data["taille"] = $i;
		return $data;
	}
	
	function demande($id_1,$id_2)
	{
		$query = $this->db->query('select * from amis where id1 = "'.$id_1.'" and id2 = "'.$id_2.'";'); 
		if ($query->num_rows() > 0) 
		{
			$this->db->start_cache();
			$this->id1 = $id_1;
			$this->id2 = $id_2;
			$this->confirm = 3;
	
			$this->db->where('id1', $id_1);
			$this->db->where('id2', $id_2);
			$this->db->stop_cache();
			$this->db->update('amis', $this);
			
			$this->db->flush_cache();

			$this->id1 = $id_2;
			$this->id2 = $id_1;
			$this->confirm = 0;
			$this->db->where('id1', $id_2);
			$this->db->where('id2', $id_1);
			$this->db->update('amis', $this);
		}
		else {

			$this->db->start_cache();
			$this->id1 = $id_1;
			$this->id2 = $id_2;
			$this->confirm = 3;

			$this->db->where('id1', $id_1);
			$this->db->where('id2', $id_2);
			$this->db->stop_cache();
			$this->db->insert('amis', $this);

			$this->db->flush_cache();

			$this->id1 = $id_2;
			$this->id2 = $id_1;
			$this->confirm = 0;
			$this->db->where('id1', $id_2);
			$this->db->where('id2', $id_1);
			$this->db->insert('amis', $this);
		}

	}
	
	function is_amis ($id1,$id2)
	{
		if ($id1==$id2) {return 1;}
		else
		{
			$q = mysql_query('SELECT id2 FROM amis WHERE id1 = "'.$id1.'" AND id2 = "'.$id2.'" AND confirm = 1');
			$i = 0;
			while($row=mysql_fetch_array($q,MYSQL_ASSOC))
			{ 
					$i++;
			}
			if ($i!=0) {return 1;} else {return 0;};
		}
	}
	
	function accepter_ami($id_1,$id_2)
	{
		$this->db->start_cache();
		$this->id1 = $id_1;
		$this->id2 = $id_2;
		$this->confirm = 1;

		$this->db->where('id1', $id_1);
		$this->db->where('id2', $id_2);
		$this->db->stop_cache();
		$this->db->update('amis', $this);
		
		
		$this->db->flush_cache();
	
		$this->id1 = $id_2;
		$this->id2 = $id_1;
		$this->confirm = 1;
		$this->db->where('id1', $id_2);
		$this->db->where('id2', $id_1);
		$this->db->update('amis', $this);
		
		
	}
	
	function refuser_ami($id_1,$id_2)
	{
		
		$this->id1 = $id_1;
		$this->id2 = $id_2;
		$this->confirm = 0;

		$this->db->where('id1', $id_1);
		$this->db->where('id2', $id_2);

		$this->db->update('amis', $this);

	}
	
	
	
}
