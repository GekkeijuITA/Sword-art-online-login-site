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
        <title>Sword Art Online - spin-off</title>
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
        <h3 class="mt-3 ps-2 text-white">Spin-off</h3>
        <div class="card ms-2 mt-2 bg-secondary" style="max-width: 25rem;">
            <img src="../../img/alternative.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Sword Art Online Alternative - Gun Gale Online</h5>
                <!-- Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Trama
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-black">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sword Art Online Alternative - Gun Gale Online</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                La storia si svolge all'interno dell'MMORPG Gun Gale Online.
                                Una ragazza, Karen Kohiruimaki, si è creata un profilo, denominato Llenn, 
                                in questo videogame per provare a sentirsi più bassa di statura. Infatti, nella vita reale,
                                è molto alta e non le piace essere presa in giro per la sua statura. All'interno del gioco
                                conoscerà Pitohui, un'altra giocatrice che la convincerà a partecipare al torneo a squadre
                                Squad Jam.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>                               
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>  
    </body>
</html>

