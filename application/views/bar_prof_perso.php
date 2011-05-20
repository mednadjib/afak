<div id="bar_perso">
		<img src=<?php echo"/Afak/application/photo/".$avatar;?> width="200" height="300" />
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Messages <div id="num">0</div></a></div>
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Exercices <div id="num">0</div></a></div>
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Revisions <div id="num">0</div></a></div> 
		<br /><br /><br />
		
		<div id="bp_a"><a href="#" title="Affiches les messages recus" target="_self">Collègues <div id="num"><?php echo $prof["prof_count"];?></div></a></div>
		<table width=200>
		<?php for ($i=0; $i<$prof["taille"]; $i++):?>
			<?php if ($prof[$i]["type"] == 1) :?>
				<tr>
						<td width ="41"><img src=<?php echo '"/Afak/application/photo/'.$prof[$i]["avatar"].'"';?> width="40" height="40" alt="testing" /> </td>
						<td align="left" style="color : 3B5998;"><a href=<?php echo '"/Afak/index.php/display/agent/'.$id_session.'/'.$prof[$i]["id_agent"].'"'?> title="Intype" target="_blank"><?php echo $prof[$i]["prenom"].' '.$prof[$i]["nom"] ?> </a></td>

				</tr>
			<?php endif;?>	
		<?php endfor;?>
		</table>
	</div><!--bar_perso-->
