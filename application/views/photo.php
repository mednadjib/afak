<form method="post" enctype="multipart/form-data" action="/Afak/index.php/profil/photo_send">	
		<table>
			<tr><td><input type="hidden" name="id_session" value=<?php echo '"'.$id_session.'"';?> /></td></tr>
			<tr><td>1 - Choisis ta photo :</td></tr>
			<tr><td> <input type="file" name="image" /></td></tr>
			<tr><td>2 - Ajoutes un titre à ta photo </td></tr>
			<tr><td> <input type="text" name="titre" placeholder="Titre de la photo" size=50/>.</td></tr>
			<tr><td>3 - Appuies sur entrée.</td><td></td></tr>
		</table>
</form>
