<?php

require 'db_conn.php';
session_start();

if(empty($_SESSION['login'])){
	header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOLIST V2</title>
    <link rel="stylesheet" href="../dashboard/CSS/style.css">
    <!-- LINKCSS BS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- LINKCSS TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="snowflakes" aria-hidden="true">
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
  ❄
  </div>
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
  ❄
  </div>
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
  ❄
  </div>
</div>
    <div class="main-section">
        
        <div class="add-section">
            <h2 style="color:white; text-align: center;">ADD LIST IN HERE <i class="bi bi-arrow-down"></i></h2>
            <form action="App/add.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                    <input style="border: red 2px solid;"  type="text" name="title" placeholder="List Masih Kosong!!">
                    <button>ADD &nbsp; <span>&#43;</span></button>
                <?php }else{ ?>
                    <input type="text" name="title" placeholder="Masukin List Disini!!">
                    <button>ADD &nbsp; <i class="bi bi-plus-circle"></i></button>
                <?php  } ?>

            </form>
        </div>

        <?php
        $todos = $conn->query ("SELECT * FROM todos ORDER BY id DESC")
        ?>
        <div class="show-todo-section">

            <?php
            if ($todos->rowCount() <= 0) {
            ?>
            <div class="todo-item">
                <div class="empty">
                    <img src="/PROJECT_TODOLISTV2/2002.i515.001_modern_students_flat_icons-13.jpg" width="100%">
                    <img  src="/PROJECT_TODOLISTV2/Rolling-1s-200px.gif" style="border-radius: 50%; margin-left:auto; margin-right: auto; margin-top: 10px;" width="80px">
                </div>
            </div>
            <?php }?>
            

            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) {            
            ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" style="color: black;" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>


                    </span>
                    <?php if($todo['checked']) { ?>
                        <h2 class="checked"><?php echo $todo['title']; ?></h2>
                    <?php } else { ?>
                        <h2><?php echo $todo['title']; ?></h2>
                    <?php }?>
                        <br>
                        <small><?php echo $todo['data_time']; ?></small>
                </div>
            <?php }?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                $.post("App/remove.php",
                {
                    id : id
                },
                (data) =>{
                    if(data){
                        $(this).parent().hide(600);
                    }
                }
                );
            })
        })
    </script>
        <div class="spinner">
    <svg viewBox="25 25 50 50" class="circular">
        <circle stroke-miterlimit="10" stroke-width="3" fill="none" r="20" cy="50" cx="50" class="path"></circle>
    </svg>
    </div>
    <script>
        $(window).on("load",function(){
            $(".spinner").fadeOut(2100);
        });
    </script>
</body>
</body>
</html>