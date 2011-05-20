<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		$this->load->view('register');
	}
	
	function register_student ()
	{
			
			if (($_POST["nom"]!="")&&($_POST["prenom"]!="")&&($_POST["date"]!="")&&($_POST["sexe"]!="")&&($_POST["email"]!="")&&($_POST["pass"]!="")&&($_POST["c_pass"]!=""))
			{
				if ($_POST["pass"]==$_POST["c_pass"])
				{
					$nom    = htmlentities($_POST["nom"]);
					$prenom = htmlentities($_POST["prenom"]);
					$date   = htmlentities($_POST["date"]);
					$sexe   = htmlentities($_POST["sexe"]);
					$email  = htmlentities($_POST["email"]);
					$pass   = htmlentities($_POST["pass"]);
					$c_pass = htmlentities($_POST["c_pass"]);
	
					$this->load->model("Agent_model");
					$this->load->model("Session");
					$im_name = 0;
					if (basename( $_FILES['image']['name']))
					{
						$im_name = $this->Agent_model->max_node()+1;
						//$target_path = "C:/Program Files/EasyPHP-5.3.3/www/jijel/img/";
						$target_path = $_SERVER["DOCUMENT_ROOT"]."/Afak/application/photo/";
						$target_path = $target_path . $im_name.'.jpg'; 
						//$target_path = $target_path . basename( $_FILES['image']['name']);
						if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
							$data["contenu"] =  "L'image ".  basename( $_FILES['image']['name']). 
							" a été téléchérgée. ";
						} else{
							 $data["contenu"] = "Il y a eu une erreur dans le téléchargement !!";
						}	
					}
	
					$this->Agent_model->add_agent($nom, $prenom, $pass, $im_name.'.jpg', $sexe, $email, $date);
					$this->Session->add_agent($im_name);
					$data["contenu"] = $data["contenu"] . "<br />L'élève a été ajouté avec succés !";
					$this->load->view('register',$data);
					//redirect('/profil');
				}
				else
				{
					$data["contenu"] = "<br />Les deux mots de passe ne sont pas identiques !";
					$this->load->view('register',$data);
				}
			}
			else
			{
				$data["contenu"] = "<br />Tous les champs doivent être remplis !";
				$this->load->view('register',$data);
			}
	}
}
