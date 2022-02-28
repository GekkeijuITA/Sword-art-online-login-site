<?php
    if(isset($_POST["cancel"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $path="../../dati/dati.xml";        
        $xml = simplexml_load_file($path);  
        foreach($xml->user as $user){
            $name = $user->username;
            if(strcmp($name,$username)==0){
                $isThere=TRUE;
                break;                              
            }
            else{
                $isThere=FALSE;
            }
        }
        if($isThere){
            foreach($xml->user as $user){
                $key = $user->password;
                if(strcmp($key,$password)==0){
                        $userToRemove = $username; 
                        $xml = simplexml_load_file($path, null, LIBXML_NOBLANKS);
                        $lenght=0;
                        foreach($xml->user as $user){
                            $lenght++;
                        }
                        for($i=0;$i<$lenght;$i++){
                            if($xml->user[$i]->username==$userToRemove){
                                unset($xml->user[$i]);
                                break;
                            }
                        }
                        $dom = dom_import_simplexml($xml)->ownerDocument;
                        $dom->formatOutput=true;
                        $dom->save($path);                      
                        header("location: ../../index.php?cancellazione=true");
                }
                else{        
                                        
                }
            }           
        }        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sword Art Online - manga</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/cssStyle.css">
        <link rel="icon" href="../../img/logo.png">
    </head>
    <body class="bg-dark text-white">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../indexLog.php">Sword Art Online</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../indexLog.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="manga.php">Manga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="lightnovel.php">Light Novel</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Anime
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="seasons.php">Stagioni</a></li>
                                <li><a class="dropdown-item" href="films.php">Film</a></li>
                                <li><a class="dropdown-item" href="spinoff.php">Spin-Off</a></li>
                            </ul>
                        </li>                       
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item dropstart">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                    <img src="../../img/accountLogo.png" alt="accountLogo"/>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <button type="button" class="btn w-100" data-bs-toggle="modal" data-bs-target="#cancelForm">Cancella</button>
                                    </li>
                                    <li>
                                        <a href="../../index.php?logout=true"><button type="button" class="btn w-100">Logout</button></a>
                                    </li>                                
                                </ul>
                        </li>                    
                    </ul>  
                    <!--Cancella-->
                    <div class="modal fade" id="cancelForm" tabindex="1" aria-labelledby="cancelFormLabel" aria-hidden="true" style="color:black;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelFormLabel">Cancella account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div>
                                            <input type="email" name="username" id="username" placeholder="Username" required>
                                        </div>    
                                            <div>    
                                            <input type="password" name="password" id="password" placeholder="Password" pattern=".{8,}" title="Inserisci almeno 8 caratteri" required>  
                                        </div>                                      
                                        <input type="checkbox" onclick="showPassword()" id="checkbox">Mostra Password
                                    </div>
                                    <div class="modal-footer"> 
                                        <input type="submit" name="cancel" class="btn btn-primary" value="Cancella"> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </nav>
        <h3 class="mt-3 ps-2">Manga</h3>
        <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4 ps-2 pt-3" id="groupCarousel" style="max-width: 100%;">
            <!-- Carousel 1 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>                       
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-aincrad-001.jpg" class="d-block w-100" alt="aincrad001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-aincrad-002.jpg" class="d-block w-100" alt="aincrad002">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <div class="card-body">
                  <h5 class="card-title">Sword Art Online - Aincrad</h5>
                </div>
                </div>
            </div>
            <!-- Carousel 2 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                            <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-fairy-dance-001.jpg" class="d-block w-100" alt="fairydance001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-fairy-dance-002.jpg" class="d-block w-100" alt="fairydance002">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-fairy-dance-003.jpg" class="d-block w-100" alt="fairydance003">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - Fairy Dance</h5>                     
                    </div>
                </div>
            </div>          
            <!-- Carousel 3 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators3" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="1" aria-label="Slide 2"></button>    
                            <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="2" aria-label="Slide 3"></button> 
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-phantom-bullet-001.jpg" class="d-block w-100" alt="phantombullet001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-phantom-bullet-002.jpg" class="d-block w-100" alt="phantombullet002">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-phantom-bullet-003.jpg" class="d-block w-100" alt="phantombullet003">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - Phantom Bullet</h5>                     
                    </div>
                </div>
            </div>
            <!-- Carousel 4 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators4" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-project-alicization-001.jpg" class="d-block w-100" alt="projectalicization001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-project-alicization-002.jpg" class="d-block w-100" alt="projectalicization002">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-project-alicization-003.jpg" class="d-block w-100" alt="projectalicization003">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-project-alicization-004.jpg" class="d-block w-100" alt="projectalicization004">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators4" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - Project Alicization</h5>                     
                    </div>
                </div>
            </div>
            <!-- Carousel 5 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators5" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators5" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators5" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                            <button type="button" data-bs-target="#carouselExampleIndicators5" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-mother-s-rosario-001.jpg" class="d-block w-100" alt="mothersrosario001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-mother-s-rosario-002.jpg" class="d-block w-100" alt="mothersrosario002">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-mother-s-rosario-003.jpg" class="d-block w-100" alt="mothersrosario003">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators5" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators5" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - Mother's Rosario</h5>                     
                    </div>
                </div>
            </div>
            <!-- Carousel 6 -->
            <div class="col">
                <div class="card bg-secondary h-100">
                    <div id="carouselExampleIndicators6" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="4" aria-label="Slide 5"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="5" aria-label="Slide 6"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide-to="6" aria-label="Slide 7"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/sword-art-online-progressive-001.jpg" class="d-block w-100" alt="progressive001">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-002.jpg" class="d-block w-100" alt="progressive002">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-003.jpg" class="d-block w-100" alt="progressive003">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-004.jpg" class="d-block w-100" alt="progressive004">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-005.jpg" class="d-block w-100" alt="progressive005">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-006.jpg" class="d-block w-100" alt="progressive006">
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/sword-art-online-progressive-007.jpg" class="d-block w-100" alt="progressive007">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators6" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - Progressive</h5>                     
                    </div>
                </div>
            </div>
            <div class="card bg-secondary h-100">
                <img src="../../img/sword-art-online-calibur.jpg" class="card-img-top" alt="calibur">
                <div class="card-body">
                    <h5 class="card-title">Sword Art Online - Calibur</h5> 
                </div>
            </div>
        </div>
        <div class="text-break ps-3 pt-1 text-white">
            In Italia la serie manga è edita dalla J-Pop.
            Per maggiori informazioni cliccare <a href="https://www.j-pop.it/cerca?controller=search&orderby=position&orderway=desc&search_query=sword+art+online&submit_search=">qui</a>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>       
    </body>
</html>

