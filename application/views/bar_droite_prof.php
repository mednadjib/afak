<div id="bar_droite">

	<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Parents <div id="num"><?php echo $parents["parents_count"];?></div></a></div>
		<table width=200>
		<?php for ($i=0; $i<$parents["taille"]; $i++):?>
			<?php if ($parents[$i]["type"] == 3) :?>
				<tr>
						<td width ="41"><img src=<?php echo '"/Afak/application/photo/'.$parents[$i]["avatar"].'"';?> width="40" height="40" alt="testing" /> </td>
						<td align="left" style="color : 3B5998;"><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$parents[$i]["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $parents[$i]["prenom"].' '.$parents[$i]["nom"] ?> </a></td>

				</tr>
			<?php endif;?>	
		<?php endfor;?>
		</table>
	</div><!--bar_droite-->
