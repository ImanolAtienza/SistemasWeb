<?php include "configurar.php"; 
 
    function crearFormL(){
    	echo('<form action="login.php" method="post" class="login">
    			<h2> Identificacion de Usuario </h2>
    			<div>Email<input name="mail" type="text" required></div>
    			<div>Password<input name="pass" type="password" required></div>
    			<div><input id="login" name="login" type="submit" value="login"></div>
            </form>');
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Login</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../estilos/smartphone.css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--	<script type="text/javascript" src="scripts/preg.js"></script> -->
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	    <span class="right"><a href="registrar.php">Registrarse</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	<?php
	    if(!isset($_GET['email'])) { ?>
	        <span><a href='../html/layout.html'>Inicio</a></spam>
    		<span><a href='../html/preguntas.html'>Preguntas</a></spam>
    		<span><a href='../html/creditos.html'>Creditos</a></spam>
	   <?php } else { ?>
	   	    <span><a href='layout.php?email=<?php echo $_GET['email']?>'>Inicio</a></spam>
    		<span><a href='preguntas.php?email=<?php echo $_GET['email']?>'>Preguntas</a></spam>
    		<span><a href='creditos.php?email=<?php echo $_GET['email']?>'>Creditos</a></spam>
	<?php } ?>
	</nav>
    <section class="main" id="s1">
        <div>
          <?php
                if(!isset($_GET['email'])) {
                    if(isset($_POST['mail']) && isset($_POST['pass'])) {
                            $intentos = 0;
                            $email = $_POST['mail'];
                            $password = $_POST['pass'];
                            $conn = mysqli_connect($host, $user, $pass,$bd);
                            
                            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
                    
                            $usuarios = mysqli_query($conn, "select * from usuarios where email='$email' and pass='$password'");
                            $cont = mysqli_num_rows($usuarios);
                            
                            mysqli_close($conn);
                    
                            if ($cont == 1) {
                                echo("<script> alert ('BIENVENIDO AL SISTEMA: $email');</script>");
                    
                                echo("<p>Login correcto<a href='layout.php?email=$email'>
                                    Puede acceder a las aplicaciones para usuarios registrados</a></p>");
                            } else {
                                echo("<p style='color:red;'>Parametros de login incorrectos</p>");
                                    
                                crearFormL();
                            }
                    
                    } else 
                        crearFormL();
                        
                } else 
            	    echo("<p>Ya estas loggeado.</p>
            	    <a href='layout.php?email=".$_GET['email'].">Layout</a>");
              ?>
        </div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/ImanolAtienza'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>