<form method="post" action="/Afak/index.php/profil/video_send_prof">	
		<table>
			<tr>
						<td><input type="hidden" name="id_session" value=<?php echo '"'.$id_session.'"';?> /> </td>
					</tr>
			<tr><td>1 - Vas sur la page Youtube de la video que tu veux partager.</td></tr>
			<tr><td>2 - Copies le code de la video comme tu le vois ici (dans l'exemple c'est <b>RF45ej8Vglw</b>):</td></tr>
			<tr><td><img src="/Afak/application/images/video_exemple.jpg" width="440" height="90" alt="video_exemple" /></td></tr>
			<tr><td>3 - Colles le code ici <input type="text" name="youtube" placeholder="Code Youtube" />.</td></tr>
			<tr><td>4 - Ajoutes un titre  <input type="text" name="titre" placeholder="Titre de la vidéo" size="50"/>.</td>
			<tr><td>5 - Appuies sur envoyer Entrée <input type="submit" name="sub" value="Envoyer" />.</td>
		</table>
</form>
