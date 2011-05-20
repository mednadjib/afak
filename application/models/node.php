<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Model {

	var $id_agent = "";
	var $id_send = "";
	var $message = "";
	var $type_m = "";
	var $parametre ="";

	function __construct()
	{
		parent::__construct();
	}
	
	function add_node ($id_agent_m, $id_send_m, $message_m, $type_n)
	{
		$this->id_agent = $id_agent_m;
		$this->id_send = $id_send_m;
		$this->message = $message_m;
		$this->type_m = $type_n;
		
		$this->db->insert('mur', $this);
	}
	
	function add_video ($id_agent_m, $id_video_m, $titre_m)
	{
		$this->id_agent = $id_agent_m;
		$this->parametre = $id_video_m;
		$this->message = $titre_m;
		$this->type_m = 3;
		
		$this->db->insert('mur', $this);
	}
	
	function add_photo ($id_agent_m, $id_photo_m, $titre_m)
	{
		$this->id_agent = $id_agent_m;
		$this->parametre = $id_photo_m;
		$this->message = $titre_m;
		$this->type_m = 2;

		$this->db->insert('mur', $this);
	}
	
	function max_node ()
	{
		$this->db->select_max('id_node');
		$query = $this->db->get('mur');
		return $query->first_row()->id_node;
	}
}