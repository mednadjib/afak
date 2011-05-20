<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Agent_model extends CI_Model
{
	
	var $id_agent = "";
	var $type     = "";
	var $nom      = "";
	var $prenom   = "";
	var $pass     = "";
	var $avatar   = "";
	var $sexe     = "";
	var $email    = "";
	var $date_naissance = "";
	
	function __construct ()
	{
		parent::__construct();
		$this->load->database();
		
	}
	
	
	function verif_pass ($nom,$prenom)
	{
		$query = $this->db->query('SELECT * FROM agent WHERE nom LIKE "'.$nom.'" AND prenom LIKE "'.$prenom.'" LIMIT 1');
		
		if ($query->num_rows() > 0) 
		{
			$row = $query->row();
			$res = array("pass" => $row->pass,"nom" => $row->nom,"prenom" => $row->prenom,"id_agent" => $row->id_agent, "type" => $row->type, "avatar" => $row->avatar, "humeur" =>$row->humeur);
			
			return $res;
		}
		else {
			
			$res = array("pass"=>"0");
			return $res;
		}
		
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
	
	function agent_mur($id_agent)
	{
		//$q = mysql_query('SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent WHERE mur.id_agent LIKE "'.$id_agent.'" OR mur.id_send LIKE "'.$id_agent.'" ORDER By mur.date DESC');
		//echo 'SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent WHERE mur.id_agent LIKE "'.$id_agent.'"';
		$q = mysql_query('SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent ORDER By mur.date DESC');
		$i = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = array(
								'id_node' => $row["id_node"],
								'id_agent' => $row["id_agent"],
								'id_send' => $row["id_send"],
								'avatar' => $row["avatar"],
								'nom' => $row["nom"],
								'prenom' => $row["prenom"],
								'message' => $row["message"],
								'parametre' => $row["parametre"],
								'type' => $row["type"],
								'type_m' => $row["type_m"],
								'date' => $row["date"]
						);
				$i++;
		}
		return $data;
	}
	
	function agent_mur_adulte($id_agent)
	{
		//$q = mysql_query('SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent WHERE mur.id_agent LIKE "'.$id_agent.'" OR mur.id_send LIKE "'.$id_agent.'" ORDER By mur.date DESC');
		//echo 'SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent WHERE mur.id_agent LIKE "'.$id_agent.'"';
		$q = mysql_query('SELECT * FROM mur JOIN agent ON mur.id_agent = agent.id_agent AND (agent.type = 1 OR agent.type = 3)ORDER By mur.date DESC');
		$i = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = array(
								'id_node' => $row["id_node"],
								'id_agent' => $row["id_agent"],
								'id_send' => $row["id_send"],
								'avatar' => $row["avatar"],
								'nom' => $row["nom"],
								'prenom' => $row["prenom"],
								'message' => $row["message"],
								'parametre' => $row["parametre"],
								'type' => $row["type"],
								'type_m' => $row["type_m"],
								'date' => $row["date"]
						);
				$i++;
		}
		return $data;
	}
	
	function node_coms($id_node)
	{
		//$q = $this->db->query('SELECT * FROM coms WHERE id_node LIKE "'.$id_node.'" ORDER BY id_coms DESC');
		$q = mysql_query('SELECT * FROM coms JOIN mur ON coms.id_node = mur.id_node WHERE mur.id_node LIKE '.$id_node.' ;');
		$i = 0;
		$data = array();
		while($row=mysql_fetch_array($q,MYSQL_ASSOC))
		{ 
				$data[$i] = array(
								'id_node' => $row["id_node"],
								'id_agen' => $row["id_agen"],
								'id_com' => $row["id_com"],
								'commentaire' => $row["commentaire"],
								'rem' => $row["rem"],
								'date' => $row["date_c"]
						);
				$i++;
		}
		return $data;
	}
	
	function add_agent ($m_nom, $m_prenom, $m_pass, $m_avatar, $m_sexe, $m_email, $m_date)
	{
		//$this->id_agent = $m_agent;
		//$this->type     = $m_type;
		$this->nom      = $m_nom;
		$this->prenom   = $m_prenom;
		$this->pass     = md5($m_pass);
		$this->avatar   = $m_avatar;
		$this->sexe     = $m_sexe;
		$this->email    = $m_email;
		$this->date_naissance = $m_date;

		$this->db->insert('agent', $this);
	}
	
	function max_node ()
	{
		$this->db->select_max('id_agent');
		$query = $this->db->get('agent');
		return $query->first_row()->id_agent;
	}
	
	function humeur($humeur, $id_agent)
	{
		$data = array(
			   'humeur' => $humeur
			);
		$this->db->where('id_agent', $id_agent);
		$this->db->update('agent', $data); 
	}
	
	

}
###
