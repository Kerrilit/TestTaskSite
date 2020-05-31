<?php //include("controller.php"); ?>
<?php 
if(isset($_GET['field'])){
    $field = "&field=".$_GET["field"];
}else{
    $field = "";
}
?>

<div class="container">
        <div class="row">
            <? echo $_SESSION["message"]; unset($_SESSION["message"]); ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" width="60 px">
                            #<a class="arrow" href="/index.php?field=id&sort=ASC">↑</a>
                        </th>
                        <th scope="col" width="85 px">
                            User<a class="arrow" href="/index.php?field=username&sort=ASC">↑</a>
                            <a class="arrow" href="/index.php?field=username&sort=DESC">↓</a>
                        </th>
                        <th scope="col">
                            Email<a class="arrow" href="/index.php?field=email&sort=ASC">↑</a>
                            <a class="arrow" href="/index.php?field=email&sort=DESC">↓</a>
                        </th>
                        <th scope="col">
                            Task text<a class="arrow" href="/index.php?field=text&sort=ASC">↑</a>
                            <a class="arrow" href="/index.php?field=text&sort=DESC">↓</a>
                        </th>
                        <th scope="col" width="140 px">
                            Stage<a class="arrow" href="/index.php?field=status&sort=ASC">↑</a>
                            <a class="arrow" href="/index.php?field=status&sort=DESC">↓</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $res => $value): ?>
                    <? $id = $value["id"]; ?>
                    <tr id="<?echo $id;?>"> 
                        <td> <? echo $value["id"];; ?> </td>
                        <td> <? echo $value["username"]; ?> </td>
                        <td> <? echo $value["email"]; ?> </td>
                        <td> <? echo $value["text"]; ?> </td>
                        <td> <? echo $value["status"]; ?> <br> <? echo $value["edited"]; ?> </td>
                        <?php if(isset($_SESSION["user"])): ?>
                            <td> <a href="index.php?action_type=edit&id=<?=$id;?>">Edit</a></td>
                        <? endif ?>
                    </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <ul class="pagination justify-content-center">
                                <? for ($i = 1; $i <= $btnNum; $i++): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="/index.php?page=<?=$i.$field;?>&sort=<?=$_GET["sort"]?>">
                                            <? echo $i; ?>
                                        </a>
                                    </li>
                                <? endfor ?>
                            </ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
</div>