<?php
header("Content-type:text/html;charset=\"utf-8\"");

$previsionTiempo=""; $error="";

if(array_key_exists('ciudad',$_GET)){
    $urlContents=
file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['ciudad']."&appid=9c0a45d915de671a55b96b01773dab6b&lang=es");
$array = json_decode($urlContents,true);
$previsionTiempo = "El tiempo en ".$_GET['ciudad']." es actualmente '".$array['weather'][0]['description']."'";
$temperaturaEnCelsius=$array['main']['temp']-273;
$previsionTiempo.=".<br>La temperatura es ".intval($temperaturaEnCelsius)."&deg;C";
$tempMin = $array['main']['temp_min']-273;
$tempMax = $array['main']['temp_max']-273;
$previsionTiempo.=" oscilando entre ".intval($tempMin)."&deg;C de mínima y ".intval($tempMax)."&deg;C de máxima.";
}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>¿Qué tiempo hace?</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
    html { 
        background: url(cielo.png) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
}
    body{
        width: 100%;
        background: none;
        margin-top: 200px;
    }
    .container{
        text-align: center;
        display:block;
        align-items: center;
        justify-content: center;
        width: 400px;
    }
    #previsionTiempo{
        margin-top:30px;
        width:600px;
        text-align:center;
        display:flex;
        
    }
    </style>
    </head>
    <body>

        <form>
            <div class="container">
                <h1>¿Qué tiempo hace?</h1>
                <h5>Introduce el nombre de la ciudad</h5>
                <div class="form-group">
                <label for="ciudad"></label>
                <input name="ciudad"type="text" class="form-control" id="ciudad" placeholder="Por ejemplo: Buenos Aires">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
           
        </form>

                <div id="previsionTiempo">
                    <?php
                if($previsionTiempo){
                    echo '<div class="alert alert-primary d-flex justify-content-center" role="alert">'.$previsionTiempo.'</div>';
                
                }
                    ?>
                </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>