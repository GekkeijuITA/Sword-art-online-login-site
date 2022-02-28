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
        <title>Sword Art Online - stagioni</title>
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
        <h3 class="mt-3 ps-2">Stagioni</h3>
        <!-- Card Group -->
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4 ps-2 text-center " style="max-width: 100%">
            <div class="col">
                <div class="card h-100 bg-secondary">
                    <img src="../../img/aincrad.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Stagione 1</h5>
                        <p class="card-text">La stagione 1 comprende l'arco narrativo di <i>Aincrad</i> e <i>Fairy Dance</i></p>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Stagione 1</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Kazuto "Kirito" Kirigaya, un genio della programmazione, entra in una realtà virtuale
                                        interattiva con pluralità di giocatori (una realtà "massively multi-player online" o "MMO")
                                        denominata "Sword Art Online". Il problema sta nel fatto che, una volta entrati, se ne può
                                        uscire solo vincitori, completando il gioco, perché il game over equivale a morte certa del
                                        giocatore.
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
            <div class="col">
                <div class="card h-100 bg-secondary">
                    <img src="../../img/ggo.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Stagione 2</h5>
                        <p class="card-text">La stagione 2 è incentrata sull'arco narrativo di <i>Phantom Bullet</i>, <i>Calibur</i> e <i>Mother's Rosario</i></p>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Stagione 2</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Dopo aver messo fine all'incidente di SAO nel 2024 e aver salvato Asuna in Alfheim Online (ALO),
                                        Kazuto Kirigaya ritorna finalmente nel mondo reale per riprendere la sua vita normale con i 
                                        suoi amici. Tuttavia, quando una serie di morti inizia a colpire un VRMMORPG chiamato "Gun Gale 
                                        Online" (GGO), Seijirō Kikuoka del Ministero degli Affari Interni convince Kazuto a tornare a 
                                        impersonare il suo personaggio virtuale "Kirito" anche in questo gioco, per investigare sul 
                                        caso riguardante un giocatore noto come Death Gun, che pare possa assassinare una persona nel 
                                        mondo reale semplicemente uccidendo il suo avatar nel gioco.
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
            <div class="col">
                <div class="card h-100 bg-secondary">
                    <img src="../../img/alicization.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Stagione 3</h5>
                        <p class="card-text">La stagione 3 è incentrata sull'arco narrativo di <i>Alicization</i></p>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel3">Stagione 3</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Kirito si risveglia in una vasta foresta piena di alberi imponenti. Mentre cerca indizi che 
                                        gli facciano capire dove si trova, incontra un giovane ragazzo che sembra conoscerlo. Dovrebbe 
                                        trattarsi di un semplice NPC, ma la profondità delle sue emozioni non sembra essere diversa da 
                                        quella umana. Mentre cercano i genitori del ragazzo, un ricordo particolare torna alla mente di 
                                        Kirito; un ricordo della sua infanzia, su un ragazzo e una ragazza dai capelli dorati, e un nome
                                        che non avrebbe mai dimenticato: Alice.
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
            <div class="col">
                <div class="card h-100 bg-secondary">
                    <img src="../../img/warofunderworld.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Stagione 4</h5>
                        <p class="card-text">La stagione 4 è incentrata sull'arco narrativo di <i>War of Underworld</i></p>
                        <!-- Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4">
                            Trama
                        </button>
                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-black">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel4">Stagione 4</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Dopo una lunga scalata all'interno della Central Cathedral, Kirito, Eugeo ed Alice sono riusciti
                                        a giungere al cospetto di Quinella, ovvero l'Administrator che governa tutto il mondo di 
                                        Underworld. Nonostante la vittoria conseguita alla fine sulla despota, che è comunque costata 
                                        la vita di Eugeo e di Cardinal, la situazione non è migliorata per Kirito: l'Ocean Turtle, il 
                                        complesso marino che ospita le apparecchiature su cui gira il mondo di Underworld è sotto attacco
                                        da parte di soldati di provenienza ignota. Per uscire dalla crisi, Kirito è chiamato a compiere
                                        una nuova missione in cui Alice sembra essere l'elemento chiave. Ma al tempo stesso sul mondo di 
                                        Underworld incombe la profetizzata invasione da parte delle forze del Dark World...
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>         
    </body>
</html>

