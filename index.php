<?php
/*
Multitaste Script Vip v2.5
Programado por KJ
Contacto: webmaster@kjanime.net
Prohibido para la venta o distribucion sin permiso previo del programador
*/
$thefile="index.php";
require_once ("pagination.php");
include ("header.php");
$domiE = 'http://localhost/toro/index.php?url=';

?><center><?php echo file_get_contents('arriba.txt');?></center><?php
if (isset($id)){
	if (isset($fila['Titulo'])) {
	  // comprobando si es vip o admin
	  if ($fila['vip'] && @!$userinfo['vip'] && !$is_admin && !$owner){ ?>
		<form><center><strong style="color:red;">Este contenido es exclusivo<br />
		Inicia sesi&oacute;n con tu cuenta vip para poder acceder al contenido.<br /><br /></strong></center></form>
		<form method=post action="login.php?return=<?php echo $_GET['v']; ?>">
		  <label for="user" class="loginlabel">Usuario:</label> <input type=text name=user id="user"></input><br />
		  <label for="pass" class="loginlabel">Contraseña:</label> <input type=password name=pass id="pass"></input><br />
		  <label class="loginlabel"></label><input type=submit Value="Iniciar Sesi&oacute;n">
			<a href=lostpw.php>Recuperar contrase&ntilde;a?</a>
		</from>
		<?php
		mysql_close($conectar);
		include("footer.php");
		exit();
	  }

		echo '<h3>'.$fila['Titulo'].'</h3>';
	  if ($use_captcha) {include('captcha.php');}
		$pass=htmlentities(@$_POST['pass']).'pss';
	  if  ( !$use_password || ($pass==$fila['pass'].'pss')) {
		$views=$fila['views']+1;
		$sql = "UPDATE paste SET views='$views' WHERE pasteID='$id'";
		mysql_query($sql, $conectar);
		echo '<ul class="tabs">';
		for ($n=1;$n<=6;$n++){
			if ($fila["Mname$n"]!=''){
				echo '<li><div href="#tab'.$n.'"><b>'.$fila["Mname$n"].'</b></div></li>';
			}
		}
		echo '</ul>';
		echo '<div class="tab_container">';

		// --------------------

		$encrypt_method = "AES-256-CBC";
		$secret_key = '1325467890';
		

		for ($n=1;$n<=6;$n++){


			$cadena_origen= $fila["Mirror$n"];
			$text = $cadena_origen;
			preg_match_all("/(?i)\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/", $text, $matches, PREG_PATTERN_ORDER);
			// var_dump($matches);

			foreach ($matches[0] as $key => $value) {
				// echo $value."<br>"; 
				
				if (!empty($value)) {
				echo $value."<br>";

				$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
				$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

				echo $iv."<br>";

				// esto funciona
				$key = hex2bin('E0FAC2DD2C00FFE30F27A6D14568CB4F12EB84676A3A2BFB172A444C3BBB831F');
				$iv = hex2bin('5A79774BB4B326EED949E6871FC27697');

				// $iv = '0000000000';
				// $encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash, 0, $iv);
				// $decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash, 0, $iv);


				$output = openssl_encrypt($value, $encrypt_method, $key, 0, $iv);
				$plain_txt = base64_encode($output);

				$host = parse_url($value);
				
				// $ss = '<a target="_blank" href="'.$domiE . $plain_txt.'">'.$host['host'].'</a>';
				$ss = $domiE . $plain_txt;
				$fila["Mirror$n"] = str_replace($value, $ss, $fila["Mirror$n"]);
				}
			}

			// var_dump($fila["Mirror$n"]);


			if ($fila["Mname$n"]!=''){
				var_dump($fila["Mirror$n"]);
				echo $n;
				echo '<div id="tab'.$n.'" class="tab_content">'.nl2br(bb_parse($fila["Mirror$n"])).'</div>';
			}
			// var_dump($fila["Mirror$n"]);
		}
		echo '<br /><strong><table style=\"border:0px; width:100%; height:10px;\">
        <tr>
            <td style=\"border:0px solid white; text-align: left;\">';
		if ($owner) {
			echo "<a href=userpanel.php?action=edit&v=".$id.">Editar</a> | ";
		}
		if ($is_admin) {
			echo "<a href=logminpanel.php?action=edit&v=".$id.">Editar</a> | ";
		}
	    echo "
		<a href=report.php?v=".$id.">Reportar Error</a></strong></td>
            <td style=\"border:0px solid white; text-align: right;\">Visitas: ".$views."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo '</td>
        </tr>
		</table></div>';
	}else{?>
		<p>Este contenido est&aacute; protegido por contrase&ntilde;a</p>
		<form method=post>
			<label class="loginlabel">Ingrese la contase&ntilde;a:</label> <input type=password name=pass></input><br />
			<label class="loginlabel"></label><input type=submit Value="Ver contenido">
		</form>
	<?php
	  }
	}else{
		exit("<b>Error: El id \"".$_GET['v']."\" no existe</b>");
	}
}else{
	if ($hidelist){
		echo '<center>'.file_get_contents('home.txt').'<center>';
	} else {
		echo "<center><table><tr><h3><strong>&Uacute;ltimos Textos:</strong><h3>";
		$pedir = mysql_query("Select * From paste ORDER BY pasteID DESC LIMIT ".$inicio.",10");
		if ($uri_mode){
			$func = 'b10tobstr';
		} else {
			$func = 'doNoThing';
		}
		while($fila = mysql_fetch_array($pedir)){
			echo "</tr><td><h4><strong><a href=./?v=".$func($fila['pasteID']).">".$fila['Titulo']. "</a></strong></h4></td><tr>";
		}
		echo "</tr></table><strong>";
		$ant=$pagina-1;
		$sig=$pagina+1;
		if (isset($_GET['p']) && $pagina>'1') {
			echo '<p><br /><a href=?p='.$ant.'>&#60;&#60;Anterior</a>';
	    $inicio = ($pagina * 10);
	    $pedir = mysql_query("Select * From paste ORDER BY pasteID DESC LIMIT ".$inicio.",1");
	    $fila = mysql_fetch_array($pedir);
			if (isset($fila['Titulo'])){
					echo'   |  <a href=?p='.$sig.'>Siguiente&#62&#62</a></p>';
			}
			} else {
			$inicio = ($pagina * 10);
	                $pedir = mysql_query("Select * From paste ORDER BY pasteID DESC LIMIT ".$inicio.",1");
	                $fila = mysql_fetch_array($pedir);
			if (isset($fila['Titulo'])){
					echo'<a href=?p='.$sig.'>Siguiente&#62&#62</a></p>';
			}
		}
		echo "</strong></center>";
	}
}
mysql_close($conectar);

include("footer.php");
?>
