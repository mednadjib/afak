<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('agent_model');
		$this->load->model('node');
		$this->load->model('amis');
		$this->load->model('session');
		$this->load->helper('url');
	}
	
	function index ()
	{
		# code...
	}

	function agent($session, $id_viewed)
	{
		
		$this->session($session, $id_viewed);
	}

	function session ($id_session, $id_viewed)
	{
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
	
		$this->data = $this->agent_model->who($id_viewed);

		$this->data["amis"] = $this->amis->amis($id_viewed);
		$this->data["murs"] = $this->agent_model->agent_mur($id_agent);
		foreach ($this->data["murs"] as $node)
		{
			$i = $node["id_node"];
			$node_com = $this->agent_model->node_coms($i);
			$this->data["coms"][$i] = $node_com;
		}
		
		$this->data["id_session"] = $id_session;
		$this->data["viewed"] = $this->agent_model->who($id_viewed);
		$this->data["viewer"] = $this->agent_model->who($id_agent);
		$this->data["isami"] = $this->amis->is_amis($id_agent,$id_viewed);
		$this->load->view('display',$this->data);
	}

	
	function publish_com()
	{
		$this->load->model('comment');
		$id_session = $_POST["id_session"];
		
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$id_node = $_POST["id_node"]; 
		$commentaire   = $_POST["commentaire"];
		$this->comment->add_com($id_agent, $id_node, $commentaire);
		
		$id_viewed = $_POST["id_viewed"];

		redirect('/display/agent/'.$id_session.'/'.$id_viewed);
	}

	function demande ()
	{
		$id_session = htmlentities($_POST["viewer"],ENT_QUOTES,'UTF-8');
		$v = htmlentities($_POST["viewed"],ENT_QUOTES,'UTF-8');
		
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		echo $id_session.' '.$tmp_agent["id_agent"];
		$this->amis->demande($id_agent, $v);
		redirect('/display/agent/'.$id_session.'/'.$v);
	}
}
