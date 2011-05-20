<?php $this->load->view("header");?>
<?php $this->load->model("agent_model");?>
<?php $this->load->model("amis");?>

<?php $this->load->view("bar");?>

<div id="general">

		<?php $this->load->view("bar_perso");?>

	<div id="espace">
		<table>
			<tr>
				<td><img src="/Afak/application/images/home_icon.png" width="25" height="25" alt="home_icon" /></td>
				<td valign="center"><span style="font-size : 15px; font-weight : bold;">Espace de <?php echo $prenom.' '.$nom;?>,</span></td>
				
				<?php if ($isami == 0):?>
				
				<td align="right"><form method="post" action="/Afak/index.php/display/demande/">
					<input type="hidden" name="viewer" value=<?php echo '"'.$id_session.'"'?> />
					<input type="hidden" name="viewed" value=<?php echo '"'.$viewed["id_agent"].'"'?> />
					<input type="submit" name="test" value="Envoyer une demande d'amitié" />
				</form></td>
				
				<?php endif;?>
			</tr>
		</table>
		
		<?php if ($isami == 1):?>
			<table>
			<tr>
				<td><img src="/Afak/application/images/actu_icon.png" width="25" height="25" alt="home_icon" /></td>
				<td valign="center"><span style="font-size : 15px; font-weight : bold;">Actualités des élèves</span></td>
			</tr>
		</table>

		<div id="actu">
			<?php foreach ($murs as $node):?>
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
													<tr><td><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$com_a["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $com_a["prenom"];?></a> <?php echo $comment["commentaire"];?></td></tr>
													<tr><td><span style="color : #999"><i>Publié le <?php echo str_replace(' '," à ",$comment["date"])?></i></td></tr>
												</table>
											</td>
										</tr>
									</table>
								</tr></td>
								<?php endforeach;?>

								<?php if ($this->amis->is_amis($node["id_agent"],$viewer["id_agent"])==1):?>
								<tr>
								<td style="background-color : #EEEEFF; padding:4px;">
									<form method="post" action="/Afak/index.php/display/publish_com">
										<input type="hidden" name="id_session" value=<?php echo '"'.$id_session.'"';?> />
										<input type="hidden" name="id_viewed" value=<?php echo '"'.$viewed["id_agent"].'"';?> />
										<input type="hidden" name="id_node" value=<?php echo '"'.$node["id_node"].'"';?> />
										<input type="text" name="commentaire" placeholder="Rediges ton com" size="73" style="background-color : #FCFCFC;"/>
									</form> 
								</td></tr>
								<?php endif;?>
							</table>
						</td>
					</tr>
				</table>
				<hr />
			<?php endforeach;?>
		</div>

			
		<?php endif;?>

		</div><!--espace-->


		<?php $this->load->view("bar_droite");?>

</div><!--general-->


<?php $this->load->view("footer");?>