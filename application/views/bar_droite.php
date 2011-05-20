<div id="bar_droite">

			<table>
				<tr>
					<td width="30" align="center"><img src="/Afak/application/images/menu.jpg" width="18" height="18" alt="home_icon" /></td>
					<td><span style = "font-weight : bold;">Menu de la semaine </span></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="30" align="center"><img src="/Afak/application/images/cadeau.png" width="23" height="23" alt="home_icon" /></td>
					<td><span style = "font-weight : bold;">Anniversaires </span></td>
				</tr>
			</table>	
			<table>
				<tr>
					<td width="30" align="center"><img src="/Afak/application/images/social_icon.png" width="25" height="25" alt="home_icon" /></td>
					<td><span style = "font-weight : bold;">Sollicitations </span></td>
				</tr>
			</table>


			<?php for ($i=0; $i<$c_amis["amis_count"]; $i++):?>
			<?php if ($c_amis[$i]["confirm"] == 3):?>
				<div id="bd_a">


				<table width="190">
					<tr>
						<td><b><?php  echo $c_amis[$i]["prenom"].' '.$c_amis[$i]["nom"];?></b> veut être ami avec toi.</td>
					</tr>
					<tr>
					<td align="right">
					<table>
						<tr>
							<td>
								<form method="post" action="/Afak/index.php/profil/accepter">
								<input type="hidden" name="id_session" value=<?php echo $id_session;?> />
								<input type="hidden" name="id_waiter" value=<?php echo $c_amis[$i]["id_agent"];?> />
								<input type="submit" name="Accepter" value="Accepter" /></form>
							</td>
							<td>
								<form method="post" action="/Afak/index.php/profil/refuser">
								<input type="hidden" name="id_session" value=<?php echo $id_session;?> />
								<input type="hidden" name="id_waiter" value=<?php echo $c_amis[$i]["id_agent"];?> />
								<input type="submit" name="Refuser" value="Refuser" /></form>
							</td>
						</tr>
					</table>
						</td>
					</tr>
				</table>

			</div>
			<?php endif;?>	
		<?php endfor;?>


			<br />

			<table>
				<tr>
					<td width="30" align="center"><img src="/Afak/application/images/interact_icon.png" width="23" height="23" alt="home_icon" /></td>
					<td><span style = "font-weight : bold;">Inteactions </span></td>
				</tr>
			</table>
			
			

	</div><!--bar_droite-->
