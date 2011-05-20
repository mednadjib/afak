
<?php $this->load->view("header");?>

<div id="login_area">
	<div id="menu_login">
		<form method="post" action="/Afak/index.php/profil">
			<table>
				<tr>
					<td>Nom et Prénoms :</td><td>Mot de passe :</td>
				</tr>
				<tr>
					<td><input type="text" name="login_nom" value="" /></td>
					<td><input type="password" name="login_pass" value="" /> </td>
					<td></td><td><input type="submit" name="test" value="Connexion" /></td>
				</tr>
			</table>
		</form>
	</div>
</div><!--login_area-->

<div id="general">

		<div id="register_area">
			<form method="post" enctype="multipart/form-data" action="/Afak/index.php/register/register_student">
				<table>
					<tr><td><input type="hidden" name="MAX_FILE_SIZE" value="500000" /></td></tr>
					<tr><td align="right">Nom :</td><td><input type="text" name="nom" value="" size="40"/></td></tr>
					<tr><td align="right">Prénoms :</td><td><input type="text" name="prenom" value="" size="40"/></td></tr>
					<tr><td align="right">Date de naissance :</td><td><input type="text" name="date" value="AAAA-MM-JJ" size="40"/></td></tr>
					<tr><td align="right">Photo :</td><td><input type="file" name="image" size="60"/></td></tr>
					<tr><td align="right">Sexe :</td><td><input type="text" name="sexe" value="" size="40"/></td></tr>
					<tr><td align="right">email :</td><td><input type="text" name="email" value="" size="40"/></td></tr>
					<tr><td align="right">Mot de passe :</td><td><input type="password" name="pass" value="" size="40"/></td></tr>
					<tr><td align="right">Confirmer le passe :</td><td><input type="password" name="c_pass" value="" size="40"/></td></tr>
					<tr><td></td><td align="right"><input type="submit" name="sub" value="Enregistrer" /></td></tr>
				</table>
			</form>
		</div><!--register_area-->

</div><!--general-->
	
<?php $this->load->view("footer");?>
