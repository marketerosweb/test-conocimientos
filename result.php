<?php
session_start();
@$horaInicio = $_POST['horadeinicio'];
@$categoria = $_POST['category'];
$horaFinal = date("H:i:s");
 $tiemposegundos= strtotime($horaFinal) - strtotime($horaInicio) ;
$minutos = (int)$tiemposegundos/60; 

$horaini = $horaInicio;
$horafin = $horaFinal;
function RestarHoras($horaini,$horafin)
{
  $horai=substr($horaini,0,2);
  $mini=substr($horaini,3,2);
  $segi=substr($horaini,6,2);
 
  $horaf=substr($horafin,0,2);
  $minf=substr($horafin,3,2);
  $segf=substr($horafin,6,2);
 
  $ini=((($horai*60)*60)+($mini*60)+$segi);
  $fin=((($horaf*60)*60)+($minf*60)+$segf);
 
  $dif=$fin-$ini;
 
  $difh=floor($dif/3600);
  $difm=floor(($dif-($difh*3600))/60);
  $difs=$dif-($difm*60)-($difh*3600);
  return date("H-i-s",mktime($difh,$difm,$difs));
}
function candidato($categoria){
  if ($categoria == '1')
  {
    $categoria = 'Ingeniero Senior';

  }
  elseif ($categoria == '2') 
  {
    $categoria = 'Ingeniero Junior';
  }
  return $categoria;
}
?>

<?php 
require 'config.php';

if(!empty($_SESSION['name'])){

    $right_answer=0;
    $wrong_answer=0;
    $unanswered=0; 

   $keys=array_keys($_POST);
   $order=join(",",$keys);

  //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
  // echo $query;exit;

   $response=mysql_query("select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());

   while($result=mysql_fetch_array($response)){
       if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }
   $name=$_SESSION['name']; 

   mysql_query("update users set score='$right_answer' where user_name='$name'");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Test de conocimientos, pruebas marketerosweb</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <header>
            <p class="text-center">
                Hola <?php 
                if(!empty($_SESSION['name'])){
                    echo $_SESSION['name'].'<br />'.$_SESSION['emailCandidato'];
                 
                }?>

            </p>
        </header>
        <div class="container result">
            <div class="row"> 
                    <div class='result-logo'>
                          <!--  <img src="image/Quiz_result.png" class="img-responsive"/>-->
                    </div>    
           </div>  
           <hr>   
           <div class="row"> 
                  <div class="col-xs-18 col-sm-9 col-lg-9" style="width: 50%"> 
                    <div class='result-logo1'>
                            <img src="http://www.marketerosweb.co/wp-content/uploads/2015/01/marketerosweb.png" class="img-responsive"/>
                    </div>
                  </div>

                  <div class="col-xs-6 col-sm-3 col-lg-3"> 
                     <a href="<?php echo BASE_PATH;?>" class='btn btn-success'>Empezar una nueva prueba</a>                   
                     <a href="<?php echo BASE_PATH.'logout.php';?>" class='btn btn-success'>Salir</a>

                       <div style="margin-top: 30%">
                       <p> Hora de inicio: <?php echo $horaInicio; ?></p>
                       <p> Hora Final: <?php echo $horaFinal; ?></p>
                       <p> Tiempo: <?php echo RestarHoras($horaInicio,$horaFinal);?></p>
                        <p>Total respuestas correctas : <span class="answer"><?php echo $right_answer;?></span></p>
                        <p>Total respuestas incorrectas : <span class="answer"><?php echo $wrong_answer;?></span></p>
                        <p>Total de preguntas no contestadas : <span class="answer"><?php echo $unanswered;?></span></p>
                        <p> Gracias por participar en nuestras convocatorias, hemos envíado un correo a los administradores de marketeros.</p>
                        <?php
                        //envio correo normal 
                        $email = 'oscarflm9@gmail.com';
  $para = $email.', eserna@marketerosweb.com';
  //$para  = $emailrecibido.','.$email; // A este email llegara el correo
  $titulo = 'Resultados prueba conocimientos php';
 
  //cuerpo mensaje
  $mensaje =  

  '<html>'.
  '<head><title> Resultados</title></head>'.
  '<body><div style="width:80%; border: 3px solid #000; margin:0 auto; text-align:center">'.
  '<div style="background:#000">
  </div>'.
  '<strong>Resultados de: </strong> '.$_SESSION['name'].
  '<br><br>'.$_SESSION['emailCandidato'].
  '<br><br>Cargo del aspirante: '.candidato($categoria).
  '
          <p>Hora de inicio:'.$horaInicio.' </p>
          <p>Hora Final:'.$horaFinal.' </p>
          <p>Tiempo de la prueba:'.RestarHoras($horaInicio,$horaFinal).' </p>
          <p>Total respuestas correctas : <span class="answer">'.$right_answer.'</span></p>
          <p>Total respuestas incorrectas : <span class="answer">'.$wrong_answer.'</span></p>
          <p>Total de preguntas no contestadas : <span class="answer">'.$unanswered.'</span></p>

  '.
  '<br></div></body>';
  

  $cabeceras = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $cabeceras .= 'From: oleguizamon@marketerosweb.com' .
    ' [Resultados prueba conocimientos]' ;

    mail($para, $titulo, $mensaje, $cabeceras)
                        ?>                   
                       </div> 

                   </div>

            </div>    
            <div class="row">    

            </div>
        </div>
        <footer>
            
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/jquery.validate.min.js"></script>

    </body>
</html>
<?php }else{

 header( 'Location: http://marketerosweb.website/test/' ) ;

}?>