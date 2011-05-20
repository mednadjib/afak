<form method="post" action="/Afak/index.php/profil/humeur">	
			<table>
				<tr>
					<td align="justify"><span style="padding : 3px; color : #555; font-size : 12px;"><b><?php echo $prenom.'</b> a dit : <i>'.$humeur?></span><br /></i></span></td>
				</tr>
					<tr>
						<td><input type="hidden" name="id_session" value=<?php echo '"'.$id_session.'"';?> /> </td>
					</tr>
					<tr>
						<td><input type="text" name="humeur" placeholder="Exprimes toi" style="width : 420px" /> </td>
					</tr>
				</table>
			</form>
