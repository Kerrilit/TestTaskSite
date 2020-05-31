<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div style="width: 250px; display: inline-block;">
            <a class="navbar-brand logo" href="/">Tasks</a>
            <!--<form method="POST" id="Form1" style="display: inline-block" action="">
                <input type="hidden" id="action_type_id" name="action_type" value="insert">
            <form>-->
            <a href="/index.php?form1=addTask">
            <button class="btn btn-outline-success my-2 my-sm-0" name="Form1">Add Task</button>
            </a>
        </div>
        <div id="log_form">
            <? if(isset($_SESSION["user"])){
                echo "Welcome, ".$_SESSION["user"]." <a href='/logout.php'><button class=\"btn btn-outline-danger my-2 my-sm-0\" id=\"login_btn\" type=\"button\">Logout</button></a>";
            }else{ echo $_SESSION["error"];?>
                <form method="POST" id="Form2">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Login" name="login">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Password" name="password">
                        </div>
                        <input class="btn btn-outline-success my-2 my-sm-0" name="Form2" id="login_btn" type="submit" value="Login" formaction="index.php">
                    </div>
                </form>
            <? } ?>
        </div>
    </div>
</nav>


