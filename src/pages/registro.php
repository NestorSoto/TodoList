<?php
    include("conexion.php");
    //include("validar.php");
    //Registrar usuario
    if(isset($_POST["registrar"])){
        try{                        
            $correo = htmlentities(addslashes($_POST["correo"]));
            $usuario = htmlentities(addslashes($_POST["user"]));
            $contrasena = htmlentities(addslashes($_POST["pass"]));
            $contra_repe = htmlentities(addslashes($_POST["passr"]));
         $name ="usuario";
         $asunto="Correo de verificacion";
         $header.="reply-To: suport@todolist.com"."\r\n";
         $header.="X.Mailer: PHP/". phpversion();
        $msg="Usted se ha registrado en Todo List. "."\r\n";
        $msg="Si usted no realizó la operacion, contactese con nosotros. ";
        //mail($correo,$asunto,$msg,$header);
        //print_r($mail);
        if(mail($correo,$asunto,$msg,$header)){

            include("registro.html")
                    ?>
                    
                    <h1 class="error-registro"> enviado</h1>
                   
                    <?php
        }else{
            include("registro.html")
                    ?>
                    
                    <h1 class="error-registro"> error enviar </h1>
                   
                    <?php
        }


            if($contrasena == $contra_repe){
               



                session_start();
                $_SESSION['user']=$usuario;    
                $contrasena_encriptada = sha1($contrasena);
                $sqluser = "SELECT `iduser` FROM `usuarios` WHERE `username` = :user OR `correo` = :correo";
            
                $resultado_user = $conection->prepare($sqluser);

                $resultado_user->bindValue(":user", $usuario);
                $resultado_user->bindValue(":correo", $correo);
                $resultado_user->execute();

                $filas = $resultado_user->rowCount();
                if($filas == 0) {
                    //insertar información del usuario
                    $sqlusuario = "INSERT INTO `usuarios` (`correo`, `username`, `password`) VALUES(:correo, :user, :pass)";
                    $resultadousuario = $conection->prepare($sqlusuario);

                    $resultadousuario->bindValue(":correo", $correo);
                    $resultadousuario->bindValue(":user", $usuario);
                    $resultadousuario->bindValue(":pass", $contrasena_encriptada);
                    $resultadousuario->execute();

                    if($resultadousuario > 0){
                        header("location:NetWork.php");
                    } 
                    else{
                        header("location:registro.html");
                    }

                    $resultadousuario = null;
                   
                }else {
                    $resultado_user = null;
                    include("registro.html")
                    ?>
                    
                    <h1 class="error-registro"> YA EXISTE UNA CUENTA CON ESE CORREO O CON ESE NOMBRE DE USUARIO</h1>
                    console.log("test");
                    <?php
                }
            }
            

        }   
        catch(Exception $ex){
            die("Error al conectar:  $e->getMessage()");
        } 
    }

?>
