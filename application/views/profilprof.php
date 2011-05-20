<?php $this->load->model("agent_model");?>
<?php $this->load->model("amis");?>
<?php $this->load->model("session");?>

<?php $this->load->view("header");?>
<?php $this->load->view("bar_prof");?>

<div id="general">

	<?php $this->load->view("bar_prof_perso");?>
	
	<div id="espace">
		<table>
			<tr>
				<td><img src="/Afak/application/images/home_icon.png" width="25" height="25" alt="home_icon" /></td>
				<td valign="center"><span style="font-size : 15px; font-weight : bold;">Bienvenue <?php echo $prenom;?>,</span></td>
			</tr>
			<tr>
				<table width="450px" style="border-top : 1px solid #CCC;">
					<tr>
						<td height="10px"><b>Publier :</b></td>
						<td  width="30px" align="center"><img src="/Afak/application/images/statut-icon.png" width="25" height="25" alt="testing" /></td>
						<td align="center"><a href=<?php echo '"/Afak/index.php/profil/sessionprof/statutprof/'.$id_agent.'/'.$id_session.'"';?> title="Publier une photo" target="_self">Statut</a></td>
						<td  width="30px" align="center"><img src="/Afak/application/images/photo_icon.png" width="25" height="25" alt="testing" /></td>
						<td align="center"><a href=<?php echo '"/Afak/index.php/profil/sessionprof/photoprof/'.$id_agent.'/'.$id_session.'"';?> title="Publier une photo" target="_self">Photo</a></td>
						<td  width="30px" align="center"><img src="/Afak/application/images/video_icon.png" width="25" height="25" alt="testing" /></td>
						<td align="center"><a href=<?php echo '"/Afak/index.php/profil/sessionprof/videoprof/'.$id_agent.'/'.$id_session.'"';?> title="Publier une video" target="_self">Video</a></td>
						<td  width="30px" align="center"><img src="/Afak/application/images/exercice-icon.png" width="25" height="25" alt="testing" /></td>
						<td align="center"><a href=<?php echo '"/Afak/index.php/profil/sessionprof/exerciceprof/'.$id_agent.'/'.$id_session.'"';?> title="Publier un Exercice" target="_self">Exercice</a></td>
						<td  width="30px" align="center"><img src="/Afak/application/images/article_icon.png" width="25" height="25" alt="testing" /></td>
						<td width="40px" align="center"><a href=<?php echo '"/Afak/index.php/profil/sessionprof/article/'.$id_agent.'/'.$id_session.'"';?> title="Publier un article" target="_self">Article</a></td>
					</tr>
				</table>
			</tr>
		</table>
		
		
		
		<div id="humeur">
			<?php $this->load->view($hdsection);?>
		</div><!--humeur-->
		
		<table>
			<tr>
				<td><img src="/Afak/application/images/actu_icon.png" width="25" height="25" alt="home_icon" /></td>
				<td valign="center"><span style="font-size : 15px; font-weight : bold;">Actualités </span></td>
			</tr>
		</table>
		
		<div id="actu">
			<?php foreach ($murs as $node):?>
			<?php $x = $this->amis->who($node["id_agent"]);?>
			<?php if ($x["type"] == 1) :?>
				<table width="450px">
					<tr>
						<?php if ($node["type_m"]==1):?>
						<td valign="top"><img src=<?php echo '"/Afak/application/photo/'.$node["avatar"].'"';?> width="50" height="50" alt="" /> </td>
						<td valign="top">
							<table width ="400px">
								<tr><td><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$node["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $node["prenom"].' '.$node["nom"] ?> </a> a écrit </td></tr>
								<tr><td><?php echo $node["message"];?></td></tr>
								<tr><td><span style="color : #999"><i>Publié le <?php echo str_replace(' '," à ",$node["date"])?></i></td></tr>
						<?php endif;?>
						
						<?php if ($node["type_m"]==2):?>
						<td valign="top"><img src=<?php echo '"/Afak/application/photo/'.$node["avatar"].'"';?> width="50" height="50" alt="" /> </td>
						<td valign="top">
							<table width ="400px">
								<tr><td><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$node["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $node["prenom"].' '.$node["nom"] ?> </a> a publié cette image </td></tr>
								<tr><td> <img src=<?php echo '"/Afak/application/user_photo/'.$node["parametre"].'"';?> width="390" height="280" alt="" />  </td></tr>
								<tr><td><?php echo $node["message"];?></td></tr>
								<tr><td><span style="color : #999"><i>Publié le <?php echo str_replace(' '," à ",$node["date"])?></i></td></tr>
						<?php endif;?>
						
						<?php if ($node["type_m"]==3):?>
						<td valign="top"><img src=<?php echo '"/Afak/application/photo/'.$node["avatar"].'"';?> width="50" height="50" alt="" /> </td>
						<td valign="top">
							<table width ="400px">
								<tr><td><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$node["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $node["prenom"].' '.$node["nom"] ?> </a> a publié cette vidéo </td></tr>
								<tr><td><iframe title="YouTube video player" width="390" height="280" src=<?php echo '"http://www.youtube.com/embed/'.$node["parametre"].'"'?> frameborder="0" allowfullscreen></iframe>  </td></tr>
								<tr><td><?php echo $node["message"];?></td></tr>
								<tr><td><span style="color : #999"><i>Publié le <?php echo str_replace(' '," à ",$node["date"])?></i></td></tr>
						<?php endif;?>		
						
								<?php $idnode = $node["id_node"];?>
								<?php foreach ($coms[$idnode] as $comment):?>
								<?php $com_a = $this->agent_model->who($comment["id_agen"]);?>
								<tr><td style="background-color : #EEEEFF; padding:5px; ">
									<table>
										<tr>
											<td><img src=<?php echo '"/Afak/application/photo/'.$com_a["avatar"].'"';?> width="30" height="30" alt="" /></td>
											<td>
												<table>
													<tr><td><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$com_a["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $com_a["prenom"].' '.$com_a["nom"];?></a> <?php echo $comment["commentaire"];?></td></tr>
													<tr><td><span style="color : #999"><i>Publié le <?php echo str_replace(' '," à ",$comment["date"])?></i></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</tr></td>
								<?php endforeach;?>
								
								
								<tr><td style="background-color : #EEEEFF; padding:4px;">
									<form method="post" action="/Afak/index.php/profil/publish_com_prof">
										<input type="hidden" name="id_session" value=<?php echo '"'.$id_session.'"';?> />
										<input type="hidden" name="id_node" value=<?php echo '"'.$node["id_node"].'"';?> />
										<input type="text" name="commentaire" placeholder="Rediges ton com" style="width : 390px;" style="background-color : #FCFCFC;"/>
									</form> 
								</td></tr>
							</table>
						</td>
					</tr>
				</table>
				<hr />
					<?php endif;?>
			<?php endforeach;?>
		</div>
	
		</div><!--espace-->
	
	
	<?php $this->load->view("bar_droite_prof");?>
	
</div><!--general-->


<?php $this->load->view("footer");?>
