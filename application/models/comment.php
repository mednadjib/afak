<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Model {

	var $id_node = "";
	var $id_agen = "";
	var $commentaire = "";

	function __construct()
	{
		parent::__construct();
	}

	function add_com ($id_agent_m, $id_node_m, $commentaire_m)
	{
		$this->id_agen = $id_agent_m;
		$this->id_node = $id_node_m;
		$this->commentaire = $commentaire_m;

		$this->db->insert('coms', $this);
	}

}