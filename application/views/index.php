<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
	<link rel="icon" type="image/ico" href="../favicon.ico" />
	
	<!--<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans">-->
	<title>Collège Afak El Moustakbel</title>
</head>

<body>
	<div id="site">
		<div id="pre_site" >
			<div id="in_pre_site" >
			
			</div>
		</div>
		
		<div id="contener">
			<div id="banniere">
				
			</div>
			<div id="navabar">
				<a href="http://google.fr" title="Intype" target="_blank"><div id="accueil"></div></a>
				<div id="mur"></div>
				<div id="message"></div>
				<div id="profil"></div>
				<div id="compte"></div>
				<div id="stat"></div>
				<!--<img src="images/statutlight_06.jpg" width="98" height="14" alt="">-->
			</div>
			<div id="corps">
				<div id="statut">
					<?php echo '<img src="../photo/'.$id_agent.'.jpg" width="225" height="300" alt="">' ?>
					<div id="statut-space"></div>
					<img src="../images/statutlight_25.jpg" width="225" height="14" alt="">
				</div>
				<div id="murs">
					Statut : "Je vais bien El hamdoulilah !!"
						
						<?php foreach($murs as $item):?>
								<div id="mur_poste">
									<table border=0>
										<tr>
											<td valign="top"><?php echo "<img src='../vignette/".$item['avatar'].".jpg' width='50' height='50' alt='001' />";?>
											</td>
											<td valign="top">
												<?php echo "<a href='../index.php/profil/show/".$item["id_agent"]."'>"; ?><?php echo $item['nom']." ".$item['prenom'];?></a>
												<p class="para_mess">
													<?php echo $item['message'];?><br />
												</p>
												<div id="separateur"></div>
												<div id="date">
													Publié le <?php echo $item['date'];?> 
												</div>
											</td>
										</tr>
									</table>
								</div>
								<?php foreach($coms as $commentaire):?>
									<?php if ($item['id_node']==$commentaire['id_node']):?>
									<div id="comms">
									<table border=0>
										<tr>
											<td valign="top" width="50" align="right"><?php echo "<img src='../vignette/".$commentaire['id_agent'].".jpg' width='40' height='40' alt='001' />";?></td>
											<td valign = "top">
												<?php echo $commentaire["commentaire"]?>
											</td>
										</tr>
									</table>
										
									<?php endif?>
								<?php endforeach;?>
								<div id="comms">
									<table border=0>
										<tr>
											<td valign="top" width="50" align="right"><?php echo "<img src='../vignette/".$avatar.".jpg' width='40' height='40' alt='001' />";?></td>
											<td valign = "top">
												<form method="post" action="statut/Commentaire" id="test" name="test">
												<input type="hidden" name="node" value="<?php echo $item['id_node'];?>" />
												<input type="hidden" name="agent" value="<?php echo $item['id_agent'];?>" />
												<textarea name="commentaire" rows="2" >Votre Commentaire ...</textarea>
												<input type="submit" name="test" align="right"value="Commenter" />
												</form>
											</td>
										</tr>
									</table>
									
								</div>
						<?php endforeach;?>
				<!--
				<form method="post" action="[votre fichier PHP pour l'upload.php]" enctype="multipart/form-data">    
					<input type="hidden" name="MAX_FILE_SIZE" value="2097152">    
					<input type="file" name="nom_du_fichier">   
					<input type="submit" value="Envoyer">   
				</form>-->
				</div>
			</div>
		</div>
	</div>
</body>

</html>