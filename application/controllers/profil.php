<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {
	
	var $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('agent_model');
		$this->load->model('node');
		$this->load->model('prof');
		$this->load->model('amis');
		$this->load->model('session');
		$this->load->helper('url');
	}

	function index()
	{
				//$this->data["hdsection"] ='section';
				if ( isset($_POST['login_nom']) and isset($_POST['login_pass']) )
				{
					$nomprenom = htmlentities($_POST['login_nom']);
					$pass   = htmlentities($_POST['login_pass']);
					$pieces = explode(" ", $nomprenom);
					$nom = $pieces[0];
					$prenom = $pieces[1];
	
					for ( $i=2; $i < count($pieces); $i++ )
					{ 
						$prenom = $prenom.' '.$pieces[$i];
					}
	
					$res = $this->agent_model->verif_pass($nom,$prenom);
	
					if (strcmp(md5($pass),$res["pass"])==0)
					{
						$agent_type = $res["type"];
						$id_agent = $res["id_agent"];
						
						
						
						$id_session = $this->session->CRSession();
						$this->session->update($id_agent,$id_session);
						if ($agent_type == 0)
						{redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);}
						else
						{redirect('/profil/sessionprof/statutprof/'.$id_agent.'/'.$id_session);}
					} 
					else 
					{ 
						echo "fail";
					}

				}
				else
				{
					echo "Tentative de Hack d�tect�e !";
				}
	}
	
	
		
	function session ($hdsection , $id_agent, $id_session)
	{
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		//$id_session = $this->session->CRSession();
		$this->session->update($id_agent,$id_session);
		
		$this->data = $this->agent_model->who($id_agent);
		
		$this->data["id_session"] = $id_session;
		$this->data["id_agent"] = $tmp_agent["id_agent"];
		$this->data["hdsection"] = $hdsection;
		$this->data["amis"] = $this->amis->amis($id_agent);
		$this->data["c_amis"] = $this->amis->c_amis($id_agent);
		$this->data["murs"] = $this->agent_model->agent_mur($id_agent);
		
		foreach ($this->data["murs"] as $node)
		{
			$i = $node["id_node"];
			$node_com = $this->agent_model->node_coms($i);
			$this->data["coms"][$i] = $node_com;
		}
		
		
		$this->load->view('profil',$this->data);
	}
	
	function sessionprof ($hdsection , $id_agent, $id_session)
	{
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		//$id_session = $this->session->CRSession();
		$this->session->update($id_agent,$id_session);
		
		$this->data = $this->agent_model->who($id_agent);
		
		$this->data["id_session"] = $id_session;
		$this->data["id_agent"] = $tmp_agent["id_agent"];
		$this->data["hdsection"] = $hdsection;
		//$this->data["amis"] = $this->amis->amis($id_agent);
		//$this->data["c_amis"] = $this->amis->c_amis($id_agent);
		$this->data["prof"] = $this->prof->professeur();
		$this->data["parents"] = $this->prof->parents();
		$this->data["murs"] = $this->agent_model->agent_mur_adulte($id_agent);
		
		foreach ($this->data["murs"] as $node)
		{
			$i = $node["id_node"];
			$node_com = $this->agent_model->node_coms($i);
			$this->data["coms"][$i] = $node_com;
		}
		
		
		$this->load->view('profilprof',$this->data);
	}
	
	function humeur ()
	{
		$tmp_agent = $this->session->get_id($_POST["id_session"]);
		$id_agent = $tmp_agent["id_agent"];
		//$id_agent = $_POST["id_agent"];
		$humeur   = $_POST["humeur"];
		$this->agent_model->humeur($humeur, $id_agent);
		
		$this->node->add_node($id_agent, $id_agent,$humeur,1);

		redirect('/profil/session/statut/'.$id_agent.'/'.$_POST["id_session"]);
	}
	
	function humeurprof ()
	{
		$tmp_agent = $this->session->get_id($_POST["id_session"]);
		$id_agent = $tmp_agent["id_agent"];
		//$id_agent = $_POST["id_agent"];
		$humeur   = $_POST["humeur"];
		$this->agent_model->humeur($humeur, $id_agent);
		
		$this->node->add_node($id_agent, $id_agent,$humeur,1);

		redirect('/profil/sessionprof/statutprof/'.$id_agent.'/'.$_POST["id_session"]);
	}
	
	function publish_com()
	{
		
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$this->load->model('comment');
		$id_node = $_POST["id_node"]; 
		$commentaire   = $_POST["commentaire"];
		$this->comment->add_com($id_agent, $id_node, $commentaire);
		
		redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);
	}
	
	function publish_com_prof()
	{
		
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$this->load->model('comment');
		$id_node = $_POST["id_node"]; 
		$commentaire   = $_POST["commentaire"];
		$this->comment->add_com($id_agent, $id_node, $commentaire);
		
		redirect('/profil/sessionprof/statutprof/'.$id_agent.'/'.$id_session);
	}
	
	function video_send ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$youtube = htmlentities($_POST["youtube"],ENT_QUOTES,'UTF-8');
		$titre = htmlentities($_POST["titre"],ENT_QUOTES,'UTF-8');
		$this->node->add_video($id_agent, $youtube, $titre);
		redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);
	}
	
	function video_send_prof ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$youtube = htmlentities($_POST["youtube"],ENT_QUOTES,'UTF-8');
		$titre = htmlentities($_POST["titre"],ENT_QUOTES,'UTF-8');
		$this->node->add_video($id_agent, $youtube, $titre);
		redirect('/profil/sessionprof/statutprof/'.$id_agent.'/'.$id_session);
	}
	
	function photo_send ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$im_name = 0;
		
					if (basename( $_FILES['image']['name']))
					{
						$im_name = $this->node->max_node()+1;
						//$target_path = "C:/Program Files/EasyPHP-5.3.3/www/jijel/img/";
						$target_path = $_SERVER["DOCUMENT_ROOT"]."/Afak/application/user_photo/";
						$target_path = $target_path . $im_name.'.jpg'; 
						//$target_path = $target_path . basename( $_FILES['image']['name']);
						if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
							$data["contenu"] =  "L'image ".  basename( $_FILES['image']['name']). 
							" a �t� t�l�ch�rg�e. ";
						} else{
							 $data["contenu"] = "Il y a eu une erreur dans le t�l�chargement !!";
						}	
					}
		
		$titre = htmlentities($_POST["titre"],ENT_QUOTES,'UTF-8');
		$this->node->add_photo($id_agent, $im_name.".jpg", $titre);
		redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);
	}
	
	function photo_send_prof ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		
		$im_name = 0;
		
					if (basename( $_FILES['image']['name']))
					{
						$im_name = $this->node->max_node()+1;
						//$target_path = "C:/Program Files/EasyPHP-5.3.3/www/jijel/img/";
						$target_path = $_SERVER["DOCUMENT_ROOT"]."/Afak/application/user_photo/";
						$target_path = $target_path . $im_name.'.jpg'; 
						//$target_path = $target_path . basename( $_FILES['image']['name']);
						if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
							$data["contenu"] =  "L'image ".  basename( $_FILES['image']['name']). 
							" a �t� t�l�ch�rg�e. ";
						} else{
							 $data["contenu"] = "Il y a eu une erreur dans le t�l�chargement !!";
						}	
					}
		
		$titre = htmlentities($_POST["titre"],ENT_QUOTES,'UTF-8');
		$this->node->add_photo($id_agent, $im_name.".jpg", $titre);
		redirect('/profil/sessionprof/statutprof/'.$id_agent.'/'.$id_session);
	}
	
	function accepter ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		$id_2 = htmlentities($_POST["id_waiter"],ENT_QUOTES,'UTF-8');
		$this->amis->accepter_ami($id_agent,$id_2);
		redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);
	}
	
	function refuser ()
	{
		$id_session = htmlentities($_POST["id_session"],ENT_QUOTES,'UTF-8');
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		$id_2 = htmlentities($_POST["id_waiter"],ENT_QUOTES,'UTF-8');
		$this->amis->refuser_ami($id_2,$id_agent);
		redirect('/profil/session/statut/'.$id_agent.'/'.$id_session);
	}
	
	function deco ($id_session)
	{
		$tmp_agent = $this->session->get_id($id_session);
		$id_agent = $tmp_agent["id_agent"];
		$this->session->deco($id_agent);
		redirect('');
	}
}
