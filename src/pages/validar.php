<?php
 if(isset($_POST["registrar"])){
     if(!empty($_POST['correo'])){
         $correo=$_POST['correo'];
         $name ="usuario";
         $asunto="Correo de verificacion";
         $header.="reply-To: suport@todolist.com"."\r\n";
         $header.="X.Mailer: PHP/". phpversion();
        $msg="Usted se ha registrado en Todo List. "."\r\n";
        $msg="Si usted no realizó la operacion, contactese con nosotros. ";
        $mail= mail($correo,$asunto,$msg,$header);
        
        if(isset($mail)){
            echo"<h4>enviado</h4>";
        }else{
            echo"<h4>error</h4>";
        }

     }
 }
 ?> 