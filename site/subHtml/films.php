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
<html>
    <head>
        <title>Sword Art Online - film</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/cssStyle.css">
        <link rel="icon" href="../../img/logo.png">
    </head>
    <body class="bg-dark text-white">
        <!-- Nav bar -->
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
        <h3 class="mt-3 ps-2">Film</h3>
        <!-- Card Group -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 pt-3 ps-2 text-center" style="position:absolute;left:25%;right:25%;margin:0 auto;">
            <div class="col" style="max-width:350px;">
                <div class="card h-100 bg-secondary" >
                    <img src="../../img/ordinalscale.jpg" class="card-img-top" alt="ordinalscale">
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online - The Movie: Ordinal Scale</h5>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sword Art Online - The Movie: Ordinal Scale</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Nel 2026, al dispositivo di realtà virtuale AmuSphere viene 
                                        affiancato un nuovo apparecchio, l'Augma, che consente 
                                        l'utilizzo della realtà aumentata mentre il giocatore è 
                                        cosciente e, quindi, che supera la funzione di FullDive del 
                                        precedente. Dopo poco tempo dal lancio, praticamente ogni 
                                        cittadino giapponese è in possesso di questo terminale, grazie 
                                        anche alla sua praticità nello svolgere attività quotidiane, e
                                        viene inoltre concesso gratuitamente a tutti gli studenti nella
                                        scuola per sopravvissuti di SAO, compresi Kirito e Asuna.
                                        Mentre la ragazza, con le amiche Lisbeth e Silica, è entusiasta
                                        delle funzionalità messe a disposizione, tra cui il gioco 
                                        ARMMORPG esclusivo "Ordinal Scale" (aka: OS), Kirito esita 
                                        ad usare l'Augma, soprattutto nei veri e propri scontri che 
                                        si possono effettuare. È proprio in uno di questi, in cui 
                                        appare il primo dei molti boss di Aincrad che iniziano a
                                        manifestarsi in città, che i protagonisti fanno la conoscenza 
                                        della virtual idol Yuna, una IA dal passato incerto, e del 
                                        giocatore noto come Eiji, il secondo nella classifica del 
                                        gioco. Da lì in poi inizieranno a succedere una serie di 
                                        incidenti e infortuni durante i combattimenti, dietro ai 
                                        quali ci sarà non solo l'inquietante top player, desideroso 
                                        di vendicarsi dei sopravvissuti di SAO, ma anche una persona 
                                        con un piano ben più articolato, che metterà a dura prova i 
                                        protagonisti della serie.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="col" style="max-width:350px;">
                <div class="card h-100 bg-secondary">
                    <img src="../../img/progressive.jpg" class="card-img-top" alt="progressive">
                    <div class="card-body">
                        <h5 class="card-title">Sword Art Online Progressive: Aria of a Starless Night</h5>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Sword Art Online Progressive: Aria of a Starless Night</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Durante una partita a un gioco di realtà virtuale, la giovane Asuna Yuuki resta 
                                        intrappolata suo malgrado nel mondo videoludico di Sword Art Online, insieme a migliaia di
                                        altri giocatori.Armata delle sue brillanti doti di studentessa, la ragazza dovrà imparare
                                        il più in fretta possibile la meccanica del gioco, per riuscire a terminarlo…o la sua 
                                        permanenza in SAO non avrà mai fine.Con l’aiuto di Kirito, un giocatore navigato che la 
                                        invita nel suo gruppo di utenti esperti, Asuna lotterà per diventare una campionessa di 
                                        SAO, per fare ritorno al più presto nel mondo reale.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
          </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>         
    </body>
</html>

