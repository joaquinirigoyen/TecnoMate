<?php

// Define que la imagen va a hacer PNG
header ("Content-type: image/png");

// usos de funciones de GD 

/* Indicar anchura y altura de la imagen a crear  */ 

// Crear una imagen de (ancho x alto) 190, 36
$imagen = imagecreatetruecolor(250, 50);
$colorTexto = imagecolorallocate ($imagen, 255, 255, 255 );
$font= "../../../Utiles/fuentes/Nabla-Regular.ttf";

// Asignar colores random 
$color1 = imagecolorallocate($imagen, random_int(150,255),random_int(0,100),random_int(0,90));
$color2 = imagecolorallocate($imagen, random_int(150,227),random_int(0,20),random_int(200,255));
$color3 = imagecolorallocate($imagen, random_int(10,88),random_int(120,239),random_int(200,255));

$negro = imagecolorallocate($imagen, 0, 0, 0);
$blanco = imagecolorallocate($imagen, 255, 255, 255);

// Dibujar tres rectángulos, cada uno color
//imagefilledrectangle($imagen, 10, 30, random_int(50,180), random_int(80,180), $color1);
//imagefilledrectangle($imagen, 20, 100, random_int(120,180), random_int(120,180), $color2);
//imagefilledrectangle($imagen, 90, 70, random_int(80,180), random_int(90,180), $color3);
imagerectangle($imagen, 80, 20, random_int(10,60), random_int(5,40), $blanco);
imagerectangle($imagen, 100, 20, random_int(45,110), random_int(5,40), $blanco);
imagerectangle($imagen, 120, 5, random_int(90,240), random_int(5,40), $blanco);
imagerectangle($imagen, 140, 5, random_int(200,240), random_int(5,40), $blanco);
imagerectangle($imagen, 20, 30, random_int(10,50), random_int(5,40), $blanco);
imagerectangle($imagen, 200, 30, random_int(10,50), random_int(5,40), $blanco);

/*Generar un codigo aleatorio para que aparezca en la imagen creando la siguiente funcion*/ 
function generaCaptcha ($caracters, $length){
    $captcha = null;
    for ($x = 0; $x < $length; $x++ ){
        $rand = rand(0, count($caracters)-1);
        $captcha .= $caracters[$rand];
    }
    return $captcha;
}

/*Se crea el captcha utilizando la funcion, definir el arreglo y la cantidad de cara caracter*/ 
$captcha =  generaCaptcha (array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "H", "m", "F", "q","r", "A", "u","b"), 5);

/*crear la cooki para almacenar el codigo captcha y enciptar con la funcion sha1() y endicarle un tiempo*/

setcookie ('captchaCrearCuenta', sha1($captcha), time()+60*1);
setcookie ('fechaCaptchaCrearCuenta', date('Y-m-d H:i:s'));

/*ingresar el texto de la imagen */ 

//imagestring($imagen , 5 , 60, 70, $captcha, $colorTexto);
imagettftext($imagen, 30, 0, 80, 40, $colorTexto, $font, $captcha );

/*Imprimir la imagen*/ 
/*imagefilter($imagen, IMG_FILTER_MEAN_REMOVAL);*/
imagepng ($imagen);

?>