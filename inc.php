<?php

// cantidad de acortadores
$canAcorta = 4;

$uri = $_GET['url'];
$ur = base64_decode($uri);
$key = hex2bin('E0FAC2DD2C00FFE30F27A6D14568CB4F12EB84676A3A2BFB172A444C3BBB831F');
$iv = hex2bin('5A79774BB4B326EED949E6871FC27697');
$encrypt_method = "AES-256-CBC";
$urlen = openssl_decrypt($ur, $encrypt_method, $key, 0, $iv);

$archivo = "numero.dat";

if(file_exists($archivo))
    {
        $mensaje = "El Archivo $archivo se ha modificado";

    }
 
    else
    {
        $mensaje = "El Archivo $archivo se ha creado";
        $abre = fopen($archivo, "w+b");
        fclose($abre);
        
    }
    $abre = fopen($archivo, "r");
    $total = fread($abre, filesize($archivo));
    $canAcorta = $canAcorta + 1;
    $total = ($total == $canAcorta) ? 1 : $total;
    fclose($abre);
    $abre = fopen($archivo, "w");
    $total = $total + 1;
    $total = ($total === 1) ? $total + 1 : $total;
    $grabar = fwrite($abre, $total);
    fclose($abre);

    if ($total == 2) 
    {
        $ouo_Key = "RT8uMIRV";
        $dominioOuo = "ouo.io";
        include_once("class.php");
        $acortador = new AcortadorA();
        $urlen = $acortador->ouo($urlen,$ouo_Key);
    }elseif($total == 3)
    {
        $short_Key = "de0a96d08f14a996951390df5edc38040185a456";
        $dominioShort = "fc.lc";
        include_once("class.php");
        $acortador = new AcortadorA();
        $urlen = $acortador->universal($urlen,$short_Key,$dominioShort);
    }elseif($total == 4)
    {
        $exe_Key = "7d321aca22325d8ff09ecf7a6169cf4b4e4d1f72";
        $dominioExe = "exe.io";
        include_once("class.php");
        $acortador = new AcortadorA();
        $urlen = $acortador->universal($urlen,$exe_Key,$dominioExe);
    }elseif($total == 5)
    {
        $short_Key = "f6236d9aa7aeb0a3cb29cb1d85eb08a2d17a0928";
        $dominioShort = "short.pe";
        include_once("class.php");
        $acortador = new AcortadorA();
        $urlen = $acortador->universal($urlen,$short_Key,$dominioShort);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mi pagina principal</title>

    <script language="JavaScript">
 
    /* Determinamos el tiempo total en segundos */
    var totalTiempo=5;
    var url='<?php echo $urlen;?>';
 
    function updateReloj()
    {
        document.getElementById('CuentaAtras').innerHTML = "Por favor, espera "+totalTiempo+" segundos";
 
        if(totalTiempo==0)
        {
            document.getElementById('cont1').innerHTML='<a class="btn btn-primary btn-lg" href="'+url+'" role="button">IR AL ENLACE</a>';
        }else{
            totalTiempo-=1;
            setTimeout("updateReloj()",1000);
        }
    }
 
    window.onload=updateReloj;
 
    </script>

    <style>
         /*!
 * Anti-adblock v2.0.0
 * Copyright 2019 zkreations
 * Daniel Abel M. (fb.com/danieI.abel)
 * Licensed under MIT (github.com/zkreations/plugins/blob/master/LICENSE)
 */@font-face{font-family:wgd;src:url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAbAAAsAAAAACZwAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAABCAAAA7AAAAUTWg0tF0ZGVE0AAAS4AAAAGgAAABx9jiuKR0RFRgAABNQAAAAdAAAAIAAxAARPUy8yAAAE9AAAAEcAAABgUB1etmNtYXAAAAU8AAAAQQAAAUoC2QJXaGVhZAAABYAAAAAsAAAANhJ3ybdoaGVhAAAFrAAAABsAAAAkA98CA2htdHgAAAXIAAAADAAAAAwEbgDTbWF4cAAABdQAAAAGAAAABgAEUABuYW1lAAAF3AAAANQAAAFTB9NpeHBvc3QAAAawAAAAEAAAACAAAwABeJxNU0tvHEUQnrF3ZlrWEkLECoJWsThz4coxRDnChUPEAQWIIwgWBLy2vLK89r6mX9WveezLlld2ElBQohwiEHDgxh9A4coJjty9kg+hepIgplTVpZ5SfV89OgxqtSAMw9r2Z2tBuBSEweXFpaXF6vLi9Zqqh1Bfhnrt0kpw8YMLTwH+c+rJ37C4uiijZtB6uRkE55vBzitNPKLlC0Hk09SCJFgJXgrOb7XWbm5tfLp5AxE8SBCELOShCGo+bCn8YfnNWufc4uLp5QaMZMkLUfKcZTyj2TBLs9RRm5qh7bu+HdpUE6oHpmf7JjVUM4W/8GdquGaGG2bRWmGJdNKCg6kbT4pxcWCPoIBClqIQOcfUwvGMEcct15JYFmlhwIAGo5Uhd36MjJGWG6mFkkpg5tRWJPAcmK7pmZ7uavJrAs9CNFcCyFosQEiBn0SHXEu+pK299nZ7u78J38BADfXQK7JG5s5npJYhuGMZy9E6YZFazgu0WILM0BuxnDtBHLLOWYFBFikbhjlQgMJuur8/6A46bBfI0GOoltucbM2JjKXhIIADF1KSr9YizoAZrJlGRliW0ZzltEAdsQkbswmfCvJhAgLL9SI1kMcxNkQprVHBYLnfu3vT+fH8uLwH94mf2GpDYiTHHiCWJAgnI4TzbUC3QpfPFRhaBi3YyttT0p52jnon5HQZIbRCAIRQmuQPIhyDqShgSnL2WiynMFI5OV2NHRijnI9RRv4v5o14dDI7nE/nk5PsLhA/50JmuACRBhwfEBX7ckxVB4JMfolw0rpKoYTasW3dho/h5v6t1hcbm+t7N8jt2JeDhVR1kPUEcMBVY6QBMo9lH3qqS9o+DPy4X4QhIdyGZ2HfxZNP7tx6uPGw9XjvZyDj2Cq/Y5WtVPuNU16f9wCQqz/AH0he+1vtuWKz3zr9syGmfJyWaTko+q6Xde0+7mJH7yry5PrVz3+/fuXr5P2PHsQzKId6j7zjEnqWxLKX0j6Qdehf+w0O4QDg3Z8AnjwCuILnH9GhmqmJRrFjlDLL8yLLSjdyIzNRM/0tO+7OSHe2M9py9w8md/kj8t7Z2w2gkgomKeecCc44FRQdvBBUppVQSRikkEqyCx3oAvwzgyOIHOR+PpDjhFBEjpvtn6H1L5eaVKUwJNunzYZIEIMJTITpBYIIhk518QJcpgqXnvnNkoilqGIggfyV+K7mihzEFjJEysHJSkSGUr0gfEOaGqooop1blK9CA2BxGzsfm/rKv/coYP14nGNgYGBkAIIztovOg+gbK1xiYTQAS1EGvgAAeJxjYGRgYOADYgkGEGBiYARCZiBmAfMYAARrADYAAAB4nGNgZmJgnMDAysDB6MOYxsDA4A6lvzJIMrQwMDAxsHIywAAjAxIISHNNYXBgSGRIZnzw/wGDHhOSGsa3QEIBCBkB2D8KeQB4nGNgYGBmgGAZBkYGEHAB8hjBfBYGDSDNBqQZGZiArOT//8EqEkH0/wVQ9UDAyMaA4NAKMDIx09oKSgAA3kYHLwAAAHicY2BkYGAA4n1dC5bE89t8ZeBmYgCBGytcYuF0JFDJBrA4BwOYAgAuEwmTeJxjYGRgYGIAAj0wycC4gYGRARUwAQASzADoAAIAAAACAAB6AG4AWQAAUAAABAAAeJxVjr1uwjAURk9ISFtRMTJVlYeuiZKwAOrMA3RgD6oVIaFEMiBmRgZW3oAH6Mjb8SXxUGzd63N/PwPvXAloT0DIq+cBL3x4Dvlk7TlSdPY8ZMTNc6z8XRZEb8rE3VTLA8ZS6Dnkmy/PkXpOnodMuHiOdf84UvELx0ruB6vowJYSp9BWh20pWNJQs+9epw6LoSAl07uQ9Tt6npEwlRWq5sw13NT7ZeMqa4o0MwsjJflZMk2KLFf9/wdWWu3YsekEjRa0Iqys222a2uRp9tT/AHSiKpx4nGNgZkAGjAxoAAAAjgAF) format("woff");font-weight:400;font-style:normal}[class*=" wgd-"]:before,[class^=wgd-]:before{font-family:wgd!important;font-style:normal!important;font-weight:400!important;font-variant:normal!important;text-transform:none!important;speak:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.wgd-usd:before{content:"\61"}.wgd-eur:before{content:"\62"}.wgd-btc:before{content:"\63"}@-webkit-keyframes square{0%{-webkit-transform:translateY(0) scale(1.5) rotate(0);transform:translateY(0) scale(1.5) rotate(0);opacity:1}100%{-webkit-transform:translateY(-600px) scale(1) rotate(-200deg);transform:translateY(-600px) scale(1) rotate(-200deg);opacity:0}}@keyframes square{0%{-webkit-transform:translateY(0) scale(1.5) rotate(0);transform:translateY(0) scale(1.5) rotate(0);opacity:1}100%{-webkit-transform:translateY(-600px) scale(1) rotate(-200deg);transform:translateY(-600px) scale(1) rotate(-200deg);opacity:0}}.WgD-particles i{font-size:4em;font-weight:400;position:absolute;bottom:-100px;-webkit-animation:square 10s infinite;animation:square 10s infinite;-webkit-animation-duration:16s;animation-duration:16s}.WgD-particles i:nth-child(11),.WgD-particles i:nth-child(4),.WgD-particles i:nth-child(6),.WgD-particles i:nth-child(8){font-size:3em}.WgD-particles i:nth-child(10),.WgD-particles i:nth-child(2),.WgD-particles i:nth-child(3){font-size:2em}.WgD-particles i:nth-child(1){left:15%}.WgD-particles i:nth-child(2){left:24%;-webkit-animation-duration:8s;animation-duration:8s}.WgD-particles i:nth-child(3){left:50%;-webkit-animation-delay:5s;animation-delay:5s}.WgD-particles i:nth-child(4){left:40%;-webkit-animation-delay:7s;animation-delay:7s;-webkit-animation-duration:15s;animation-duration:15s}.WgD-particles i:nth-child(5){left:36%;-webkit-animation-delay:6s;animation-delay:6s}.WgD-particles i:nth-child(6){left:44%;-webkit-animation-delay:10s;animation-delay:10s;-webkit-animation-duration:20s;animation-duration:20s}.WgD-particles i:nth-child(7){left:58%;-webkit-animation-delay:2s;animation-delay:2s;-webkit-animation-duration:18s;animation-duration:18s}.WgD-particles i:nth-child(8){left:45%;-webkit-animation-duration:14s;animation-duration:14s}.WgD-particles i:nth-child(9){left:66%;-webkit-animation-delay:3s;animation-delay:3s;-webkit-animation-duration:12s;animation-duration:12s}.WgD-particles i:nth-child(10){left:74%;-webkit-animation-duration:25s;animation-duration:25s}.WgD-particles i:nth-child(11){left:80%;-webkit-animation-delay:4s;animation-delay:4s}body.ab-is-detected{overflow:hidden!important}#WgD{display:none;position:fixed;top:0;left:0;right:0;bottom:0;font-size:14px;-webkit-animation:wgdfade .3s;animation:wgdfade .3s;z-index:99999}#WgD.is-detected{display:block}@-webkit-keyframes wgdfade{from{opacity:0}to{opacity:1}}@keyframes wgdfade{from{opacity:0}to{opacity:1}}.WgD-position{position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);z-index:900}.WgD-title{margin:0 0 .5em}.WgD-text{margin:0;font-weight:400}.WgD-reload{text-decoration:none;display:inline-block;margin-top:2em;font-weight:500;transition:-webkit-transform .3s;transition:transform .3s;transition:transform .3s,-webkit-transform .3s}.WgD-reload:hover{color:#fff;-webkit-transform:scale(1.05);transform:scale(1.05)}.WgD-container img{max-width:100%;margin-bottom:1em;-o-object-fit:cover;object-fit:cover}

/*
=> Personalizacion
*/

/* Base
-----------------------------------------*/
#WgD {
   font-family: 'Roboto', sans-serif; /*fuente*/
   background: #FF416C; /*fondo por defecto */
   background: linear-gradient(to right, #FF4B2B, #FF416C);/*degradado*/
}
.WgD-particles i {
   color: rgba(0, 0, 0, 0.2); /*color particulas*/
}

/* Animacion (daneden.github.io/animate.css/)
-----------------------------------------*/
.WgD-container {
   -webkit-animation: bounceIn 1s;
           animation: bounceIn 1s; /*nombre y duracion*/
}

/* Cuerpo
-----------------------------------------*/
.WgD-container {
   padding: 3.2em; /*naruto(relleno)*/
   max-width: 450px; /*ancho maximo*/
   background-color: #fff; /*fondo*/
   box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2), 0 10px 20px rgba(0, 0, 0, 0.1); /*sombra*/
   text-align: center; /*aliniacion del texto*/
   line-height: 1.5; /*interlineado*/
   border-radius: 10px; /*bordes redondeados*/
   color: #37474F;
}
.WgD-title {
   font-size: 1.6em; /*tamaño fuente*/
}
.WgD-text {
   font-size: 1.2em; /*tamaño fuente*/
}

/* Boton Recargar
-----------------------------------------*/
.WgD-reload {
   box-shadow: rgba(0, 0, 0, .12) 0 3px 13px 1px; /*sombra*/
   color: #fff;
   padding: 1em 1.5em; /*naruto(relleno)*/
   background: #f46b45; /*fondo*/
   border-radius: 3px; /*bordes redondeados*/
}

/* Imagen
-----------------------------------------*/
.WgD-container img {
   max-height: 200px; /*altura maxima*/
}
    </style>
</head>
<body>
    

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>
<div id="WgD">
  <div class='WgD-position'>
    <div class='WgD-container'>
    <img src="/img/ab2.jpg"></img>
      <h3 class='WgD-title'>
Adblock Detectado</h3>
<p class='WgD-text'>
Nuestro sitio se mantiene gracias a la publicidad, por favor <strong>Desactiva Adblock</strong> para seguir navegando</p>
<a class='WgD-reload' href=".">He desactivado Adblock</a>
    </div>
</div>
<div class='WgD-particles'>
    <i class="wgd-usd"></i><i class="wgd-eur"></i>
    <i class="wgd-usd"></i><i class="wgd-eur"></i>
    <i class="wgd-btc"></i><i class="wgd-usd"></i>
    <i class="wgd-usd"></i><i class="wgd-eur"></i>
    <i class="wgd-btc"></i><i class="wgd-usd"></i>
    <i class="wgd-eur"></i>
  </div>
</div>






<div class="container py-5">
   <div class="row text-center">
      <div class="col">
         <h1>Preparando la descarga</h1>
         <h2 id='CuentaAtras'></h2>
         <div id="cont1"></div>

      </div>
   </div>
   
</div>





<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>//<![CDATA[
function adBlockDetected(){document.getElementById("WgD").classList.add("is-detected"),document.body.classList.add("ab-is-detected")}if("undefined"!=typeof fuckAdBlock||"undefined"!=typeof FuckAdBlock)adBlockDetected();else{var importFAB=document.createElement("script");importFAB.onload=function(){fuckAdBlock.onDetected(adBlockDetected),fuckAdBlock.onNotDetected(adBlockNotDetected)},importFAB.onerror=function(){adBlockDetected()},importFAB.integrity="sha384-CXnSItT4vv0CF9Lrll7Wu5SofkJWovtQcEuqpH2REEeQURSJapSzBwvm1QTDwgBK",importFAB.crossOrigin="anonymous",importFAB.src="https://cdn.jsdelivr.net/npm/fuckadblock@3.2.1/fuckadblock.min.js",document.head.appendChild(importFAB)}
//]]></script>
</body>
</html>