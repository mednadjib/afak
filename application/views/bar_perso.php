<div id="bar_perso">
		<img src=<?php echo"/Afak/application/photo/".$avatar;?> width="200" height="300" />
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Messages <div id="num">0</div></a></div>
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Exercices <div id="num">0</div></a></div>
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Revisions <div id="num">0</div></a></div> 
		<br /><br /><br />
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Amis <div id="num"><?php echo $amis["amis_count"];?></div></a></div>
		<table width=200>
		<?php for ($i=0; $i<$amis["taille"]; $i++):?>
			<?php if ($amis[$i]["type"] == 0) :?>
				<tr>
						<td width ="41"><img src=<?php echo '"/Afak/application/photo/'.$amis[$i]["avatar"].'"';?> width="40" height="40" alt="testing" /> </td>
						<td align="left" style="color : 3B5998;"><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$amis[$i]["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $amis[$i]["prenom"].' '.$amis[$i]["nom"] ?> </a></td>
				</tr>
			<?php endif;?>	
		<?php endfor;?>
		</table>
<!--		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Professeurs <div id="num"><?php echo $amis["prof_count"];?></div></a></div>
		<table width=200>
		<?php for ($i=0; $i<$amis["taille"]; $i++):?>
			<?php if ($amis[$i]["type"] == 1) :?>
				<tr>
						<td width ="41"><img src=<?php echo '"/Afak/application/photo/'.$amis[$i]["avatar"].'"';?> width="40" height="40" alt="testing" /> </td>
						<td align="left" style="color : 3B5998;"><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$amis[$i]["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $amis[$i]["prenom"].' '.$amis[$i]["nom"] ?> </a></td>

				</tr>
			<?php endif;?>	
		<?php endfor;?>
		</table>-->
	</div><!--bar_perso-->
