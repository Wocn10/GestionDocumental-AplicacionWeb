<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="..\..\..\assets\css\style.css">
        <!--
-->
    <title> Login </title>
</head>

<body>
<div class= "container">
    <div class="screen">
        <div class="screen_content">

            <!--metodo verificacion -->

            
            <form action="consulta_login.php" method="post" class="login">

            <h2 id="text"> Gestion Documental </h2>
                <div class="login_field">
                    <i class="login_icon fas fa-user"></i>
                    <input type="text" id="usuario" class="login_input" placeholder=" Nombre usuario" name="usuario">
                </div>

                <div class="login_field">
                    <i class="login_icon fas fa-lock"></i>
                    <input type="password" id="password" class="login_input" placeholder="Password" name="password">
                </div>

                <!-- BOTON INGRESO LOGIN VALIDADO -->
                <input name="ingresar" type="submit" class="button login_submit" value="Ingresar" href="modulos\index\base.php" >
                <!--<i    class="button_icon fas fa-chevron-right"></i>-->
                
                
                


                <!-- REGISTRO LOGIN -->
                <br></br>
                <a href="#" class="button-submit">
                    <span > Registrate </span>
                </a>
                    
            </form>

                <div class="social-login">
                    <h3>Redes sociales</h3>
                    <div class="social-icon">
                        <a href="#" class="social-login_icon fab fa-instagram"></a>
                        <a href="#" class="social-login_icon fab fa-facebook"></a>
                        <a href="#" class="social-login_icon fab fa-twitter"></a>
                    </div>
                </div>
            </div>

                    <div class="screen_background">
                        <span class="screen_background_shape screen_background_shape4"></span>
                        <span class="screen_background_shape screen_background_shape3"></span>
                        <span class="screen_background_shape screen_background_shape2"></span>
                        <span class="screen_background_shape screen_background_shape1"></span>

                    </div>
                </div>
        </div>
</body>

</html>