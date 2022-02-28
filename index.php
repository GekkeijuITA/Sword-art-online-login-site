<?php
    $wrongPassword=FALSE;
    $wrongUser=FALSE;
    $sameUser=FALSE;
    if(!empty($_GET["logout"])){
        $logout=$_GET["logout"];
    }
    else{
        $logout=FALSE;
    } 
    if(!empty($_GET["cancellazione"])){
        $cancelled =$_GET["cancellazione"];
    }
    else{
        $cancelled = FALSE;
    }
    if(isset($_POST["login"])){
        $username=$_POST["usernameLogin"];
        $password=$_POST["passwordLogin"];
        $path="dati/dati.xml";
        if(file_exists($path)){
            $xml = simplexml_load_file($path); 
            $isThere = FALSE;
            foreach($xml->user as $user){
                $name = $user->username;
                if(strcmp($name,$username)==0){
                    $isThere=TRUE;
                    break;                              
                }
            }
            if($isThere){
                foreach($xml->user as $user){
                    $key = $user->password;
                    if(strcmp($key,$password)==0){
                        header("location: site/indexLog.php");
                    }
                    else{ 
                        $wrongPassword=TRUE;
                        //password sbagliata
                        break;
                    }
                }           
            }
            else{
                $wrongUser=TRUE;              
                //user sbagliato
            }             
        }
    }
    if(isset($_POST["register"])){
        $username=$_POST["usernameRegister"];
        $password=$_POST["passwordRegister"];    
        $path="dati/dati.xml";    
        if(file_exists($path)){ 
            $xml = simplexml_load_file($path);  
            foreach($xml->user as $user){
                $name = $user->username;
                if(strcmp($name,$username)==0){
                    $sameUser=true;
                }
            }
            $miofilexml= new DomDocument('1.0' , 'utf-8');                
            $miofilexml->formatOutput=true;
            $miofilexml->preserveWhiteSpace=false;
            $miofilexml->load($path);                                               
        }
        else{        
            $miofilexml= new DomDocument('1.0' , 'utf-8');                
            $miofilexml->formatOutput=true;
            $miofilexml->preserveWhiteSpace=false;
            $root=$miofilexml->createElement("document");
            $miofilexml->appendChild($root);
        }
        if(!$sameUser){
            $user=$miofilexml->createElement("user");
            $miofilexml->documentElement->appendChild($user);  
            $name=$miofilexml->createElement("username",$username);
            $user->appendChild($name);
            $key=$miofilexml->createElement("password",$password);
            $user->appendChild($key);
            $miofilexml->save($path);  
            header("location: site/indexLog.php");
        }        
    }
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if($is_page_refreshed) {
        $logout = FALSE;
        $cancelled = FALSE;      
    }
?>  
<!DOCTYPE html>
<html>
    <head>
        <title>Sword Art Online</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/cssStyle.css">
        <link rel="icon" href="img/logo.png">
        <script src="js/script.js"></script> 
        <script type="text/javascript">
        </script>
    </head>
    <body class="bg-dark text-white">
    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sword Art Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active disabled" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active disabled" aria-current="page" href="site/manga.html">Manga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active disabled" aria-current="page" href="site/lightnovel.html">Light Novel</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle disabled" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Anime
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="site/seasons.html">Stagioni</a></li>
                            <li><a class="dropdown-item" href="site/films.html">Film</a></li>
                            <li><a class="dropdown-item" href="site/spinoff.html">Spin-Off</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav justify-content-end">
                    <li class="nav-item dropstart">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                <img src="img/accountLogo.png" alt="accountLogo"/>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#loginForm">Login</button>
                                </li>
                                <li>
                                    <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#registerForm">Registrati</button>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <button type="button" class="btn w-100 disabled">Cancella</button>
                                </li>
                            </ul>
                    </li>                    
                </ul>   
            </div>
        </div>
    </nav>
    <!--Account Deleted-->
    <div class="modal fade" id="cancel" tabindex="-1" aria-labelledby="cancelLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelLabel">Successo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hai cancellato con successo l'account!
                </div>
                <div class="modal-footer">                               
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
    <!--Log Out-->
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutLabel">Successo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hai effettuato il logout!
                </div>
                <div class="modal-footer">                               
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>    
    <!--Worng Something-->
    <div class="modal fade" id="wrongSomething" tabindex="-1" aria-labelledby="wrongSomethingLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wrongSomethingLabel">Attenzione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Username o password errata!
                </div>
                <div class="modal-footer">                               
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div> 
    <!--Same User-->
    <div class="modal fade" id="sameUser" tabindex="-1" aria-labelledby="sameUserLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sameUserLabel">Attenzione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Username non disponibile!
                </div>
                <div class="modal-footer">                               
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>                 
    <!--Login-->
    <div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="loginFormLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                                <h5 class="modal-title" id="loginFormLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div>
                            <input type="email" name="usernameLogin" id="username" placeholder="Username" required>
                        </div>    
                        <div>    
                            <input type="password" name="passwordLogin" id="passwordLogin" placeholder="Password" pattern=".{8,}" title="Inserisci almeno 8 caratteri" required>  
                        </div>                                      
                        <input type="checkbox" onclick="showPassword('passwordLogin')" id="checkbox">Mostra Password
                    </div>
                    <div class="modal-footer">                               
                        <input type="submit" name="login" class="btn btn-primary" value="Login">                                 
                    </div>
                </form>
            </div>
        </div>
    </div>                
    <!--Registrati-->
    <div class="modal fade" id="registerForm" tabindex="0" aria-labelledby="registerFormLabel" aria-hidden="true" style="color:black;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerFormLabel">Registrati</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div>
                            <input type="email" name="usernameRegister" id="username" placeholder="Username" required>
                        </div>    
                        <div>    
                            <input type="password" name="passwordRegister" id="passwordRegister" placeholder="Password" pattern=".{8,}" title="Inserisci almeno 8 caratteri" required>  
                        </div>                                      
                        <input type="checkbox" onclick="showPassword('passwordRegister')" id="checkbox">Mostra Password
                    </div>
                    <div class="modal-footer"> 
                        <input type="submit" name="register" class="btn btn-primary" value="Registrati"> 
                    </div>
                </form>
            </div>
        </div>
    </div>     
    <!-- Carousel -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade mt-2" style="max-width: 70rem;margin:auto;" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/thumb-1920-700049.jpg" class="d-block w-100" alt="Aincrad">                    
                </div>
                <div class="carousel-item">
                    <img src="img/u5fv4i0o00i01.png" class="d-block w-100" alt="Alfheim online">
                </div>
                <div class="carousel-item">
                    <img src="img/1622582670_preview_atmosphere.jpg" class="d-block w-100" alt="GGO">
                </div>           
            </div>
        </div>
    <!-- Intro -->
    <div class="container-fluid">
        <div class="row row-cols-2">
            <div class="col">
                <div class="card ms-1 mt-2 mb-3 ms-2 h-100  bg-secondary" style="max-width: 540px;float:right">
                    <div class="card-body">
                <div class="card-text mb-2">
                    Sword Art Online (ソードアート・オンライン) è una serie di <a href="https://it.wikipedia.org/wiki/Light_novel">light novel</a> scritta da Reki Kawahara e 
                    illustrata da abec, pubblicata da ASCII Media Works sotto l'etichetta Dengeki Bunko dal 10 
                    aprile 2009. Kawahara originariamente scrisse la serie in forma di web novel sul suo sito web 
                    dal 2002 al 2008. Dall'opera sono stati tratti i manga pubblicati da Kadokawa, due serie di 
                    light novel spin-off, un film e numerosi videogiochi.
                </div>
                    </div>
                </div>
            </div>
        <!-- Card -->
            <div class="col">
                <div class="card mb-3 mt-2 me-2 bg-secondary h-100" style="max-width: 540px;float:left">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/20190129_171251_932881DF.jpg" class="img-fluid rounded-start rounded-end" alt="Reki Kawahara">
                        </div>
                        <div class="col-md-8 ">
                            <div class="card-body">
                                <h5 class="card-title">Reki Kawahara</h5>
                                <p class="card-text">Reki Kawahara (川原 礫 Kawahara Reki Takasaki, 17 agosto 1974) è uno scrittore giapponese di light novel e manga. È noto soprattutto per le sue opere Sword Art Online e Accel World, entrambe adattate in serie televisive anime.</p>
                                <a href="https://it.wikipedia.org/wiki/Reki_Kawahara" class="btn btn-primary disabled">Leggi di più</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>   
    </body>  
    <?php
        if($wrongUser||$wrongPassword){
            echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#wrongSomething").modal("show");
			});
                  </script>';            
        }  
        if($sameUser){
            echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#sameUser").modal("show");
			});
                  </script>';            
        }
        if($logout){
            echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#logout").modal("show");
			});
                  </script>';            
        } 
        if($cancelled){
            echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#cancel").modal("show");
			});
                  </script>';            
        }         
    ?>
</html>
