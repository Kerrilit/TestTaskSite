<?php 
//taking data for `edit` action from controller
$id = $result_task["id"];
$username = $result_task["username"];
$email = $result_task["email"];
$orig_text = $result_task["text"];
$text = $result_task["text"];
$status = $result_task["status"];
switch($status){
    case "Completed": $check1="selected"; $check2=""; break;
    case "Not completed":  $check1=""; $check2="selected"; break;
}
if($id!=""){
    $act="update";
}else{
    $act="save";
}
?>
    <div class="container">
        <div class="row">
            <form action="/index.php" method="POST" id="Form3">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" width="60 px">
                            #
                        </th>
                        <th scope="col" width="85 px">
                            User
                        </th>
                        <th scope="col">
                            Email
                        </th>
                        <th scope="col">
                            Task text
                        </th>
                        <th scope="col" width="140 px">
                            Stage
                        </th>
                        <th scope="col">Save</th>
                    </tr>
                </thead>    
                <tr> 
                    <td><input type="hidden" name="action_type" value="<?=$act;?>">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="orig_text" value="<?=$orig_text;?>"></td>
                    <td id="input_td_username"><input type="text" name="username" value="<?=$username;?>" required></td>
                    <td id="input_td_email"><input type="text" name="email" oninput="validateEmail()" value="<?=$email;?>" required></td>
                    <td id="input_td_text"><textarea name="text" row=5 id="input_text" required><?=$text;?></textarea> </td>
                    <td id="input_td_status"> 
                        <select name="status" id="input_status">
                            <option <?=$check1;?> value=Completed>Completed</option>
                            <option <?=$check2;?> value="Not completed">Not completed</option>
                        </select> 
                    </td>
                        <td><input type="submit" value="Save" id="btn_save"></td>
                    </tr>
                </table>
            </form>
            <div id="form_row"></div>
        </div>
    </div>