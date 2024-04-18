<?php 
    session_start();

    if (isset($_SESSION['username'])) {
        
        include 'app/db.conn.php';

        include 'app/helpers/user.php';
        include 'app/helpers/conversations.php';
        include 'app/helpers/timeAgo.php';
        include 'app/helpers/last_chat.php';

        
        $user = getUser($_SESSION['username'], $conn);

        
        $conversations = getConversation($user['user_id'], $conn);

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat App - Home</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Orbitron:wght@400;700&family=Bebas+Neue&display=swap">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" 
            href="css/style.css">
        <link rel="icon" href="img/logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body background="img/retro.jpg" class="d-flex
                justify-content-center
                align-items-center
                vh-100">
        <div class="p-2 w-400
                    rounded shadow">
            <div style=" color:#00FFFF;">
            <div class="d-flex mb-3 p-3 justify-content-between align-items-center" style="border: 2px solid #00FFFF; background-color: #d300e7; border-radius: 10px;">                            <div class="d-flex align-items-center">
                            <img src="uploads/<?=$user['p_p']?>" class="w-25 rounded-circle" style="width: 70px; height: 70px;"> 
                            <h3 class="fs-6 m-2"><?=$user['name']?></h3> 
                            </div>
                    <a href="logout.php"
                    class="btn btn-dark">Salir</a>
                </div>

                <div style="  border: 2px solid #FF00FF;   border-radius: 10px;" class="input-group mb-3">

                    <input style="background-color:#00FFFF ; color:#d300e7;" type="text"
                        placeholder="Buscar..."
                        id="searchText"
                        class="form-control">
                    <button class="btn btn-primary" 
                            id="serachBtn">
                            <i class="fa fa-search"></i>	
                    </button>       
                </div>
                <ul id="chatList"
                    class="list-group mvh-50 overflow-auto">
                    <?php if (!empty($conversations)) { ?>
                        <?php 

                        foreach ($conversations as $conversation){ ?>
                        <li style="  border: 2px solid #FF00FF; background-color:#00FFFF; border-radius: 10px;" class="list-group-item">
                            <a  href="chat.php?user=<?=$conversation['username']?>"
                            class="d-flex
                                    justify-content-between
                                    align-items-center p-2">
                                <div class="d-flex
                                            align-items-center">
                                    <img src="uploads/<?=$conversation['p_p']?>"
                                        class="w-10 rounded-circle" style="width: 70px; height: 70px;">
                                    <h3 class="fs-xs m-2">
                                        <?=$conversation['name']?><br>
                        <small >
                            <?php 
                            echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn);
                            ?>
                        </small>
                                    </h3>            	
                                </div>
                                <?php if (last_seen($conversation['last_seen']) == "Active") { ?>
                                    <div title="online">
                                        <div class="online"></div>
                                    </div>
                                <?php } ?>
                            </a>
                        </li>
                        <?php } ?>
                    <?php }else{ ?>
                        <div class="alert alert-info 
                                    text-center">
                        <i class="fa fa-comments d-block fs-big"></i>
                        Aún no hay mensajes, inicia la conversación.
                        </div>
                    <?php } ?>
                </ul>
            </div>
        </div>
        

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
        
        
        $("#searchText").on("input", function(){
            var searchText = $(this).val();
            if(searchText == "") return;
            $.post('app/ajax/search.php', 
                    {
                        key: searchText
                    },
                function(data, status){
                    $("#chatList").html(data);
                });
        });

        
        $("#serachBtn").on("click", function(){
            var searchText = $("#searchText").val();
            if(searchText == "") return;
            $.post('app/ajax/search.php', 
                    {
                        key: searchText
                    },
                function(data, status){
                    $("#chatList").html(data);
                });
        });


        let lastSeenUpdate = function(){
            $.get("app/ajax/update_last_seen.php");
        }
        lastSeenUpdate();
       
        setInterval(lastSeenUpdate, 10000);

        });
    </script>
    </body>
    </html>
    <?php
    }else{
        header("Location: index.php");
        exit;
    }
?>
