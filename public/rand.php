<?php
//	require('./wp-config.php');
	
	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or
		die("Could not connect: " . mysql_error());
	mysql_select_db(DB_NAME);

	$result = mysql_query("select post_id from (select post_id from wp_postmeta where meta_key = 'vtlink' ORDER BY rand()) as tblrand limit 2");

	$randi = 0;
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$postid = $row[0];
	
		$result2 = mysql_query("select * from wp_postmeta where post_id = ".$postid);
		
		
		while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) {
			if ($row2[2] == "vtlink") { $vtitem[$randi][0] = $row2[3]; }
			if ($row2[2] == "vttitulo") { $vtitem[$randi][1] = $row2[3]; }
			if ($row2[2] == "vttexto") { $vtitem[$randi][2] = $row2[3]; }
			if ($row2[2] == "vtimagem") { $vtitem[$randi][3] = $row2[3]; } 
		}
		mysql_free_result($result2);
		$randi++;
	}

	mysql_free_result($result);
?>

		<!-- Veja tambem -->	
		
		<div style="float: left; width: 100%; display: none;">
			<div style="float: left; width: 100%;border-top: 1px dotted #DDDDDD;margin-top: 10px;margin-bottom: 10px;"></div>
			
			<div style="margin-bottom: 10px; margin-left: 5px;"><h2 class="home-cat-title2 " style="margin: 0px; padding: 0; border: 0px; margin-top: 10px;">Veja tamb&eacute;m</h2></div>
			
			<!-- VT1 -->
			<div style="float:left;border-right: 1px solid #DDDDDD; width: 150px; margin-left: 5px; margin-right: 5px;">
				<?php
					$vtnumero = 0;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
			
			<!-- VT2 -->
			<div style="float:left;border-right: 1px solid #DDDDDD; width: 150px; margin-left: 5px; margin-right: 5px;">
				<?php
					$vtnumero = 1;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
			
			<!-- VT3 -->
			<div style="float:left;border-right: 1px solid #DDDDDD; width: 150px; margin-left: 5px; margin-right: 5px;">
				<?php
					$vtnumero = 2;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
			
			<!-- VT4 -->
			<div style="float:left;border-right: 1px solid #DDDDDD; width: 150px; margin-left: 5px; margin-right: 5px;">
				<?php
					$vtnumero = 3;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
			
			<!-- VT5 -->
			<div style="float:left;border-right: 1px solid #DDDDDD; width: 150px; margin-left: 5px; margin-right: 5px;">
				<?php
					$vtnumero = 4;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
			
			<!-- VT6 -->
			<div style="float:left; width: 150px; margin-left: 5px;">
				<?php
					$vtnumero = 5;
					if($vtitem[$vtnumero][3] != '') {
						//mostra imagem
						echo '<a href=""><img src="'.$vtitem[$vtnumero][3].'" width="140" height="105" /></a>';
						
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
					}
					else {
						//mostra titulo
						echo '<div class="saibamais-title"><a class="saibamais-title" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][1].'</a></div>';
						
						//mostra texto
						echo '<div class="saibamais-texto"><a class="saibamais-texto" href="'.$vtitem[$vtnumero][0].'">'.$vtitem[$vtnumero][2].'</a></div>';
					}
				?>
			</div>
		</div>