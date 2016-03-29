<?php
$page_title = 'Home | MyPath';
require_once 'snippets/load.php';
require_once 'layout/header.php';
if(!empty($_GET))
    if($_GET['action'] === 'logout')
        $user->logout();
if($login){
    if($user_data = $db->select('user_data','*',"user_id='{$login->user_id}'")){
        $quote = $db -> select('quotes','quote,author','id_q='.mt_rand(1,4));
        $quote_quote = $quote->quote;
        $quote_author = $quote->author;
?>
<main>
    <div class="row">
        <div id="weekTasks" class="col-md-5">
            <h2>To be done this week</h2>
            <table class="table table-hover">
            <?php
                $tasks = explode(',',$user_data->weekly_plan);
                $i = 1;
                foreach($tasks as $task){
             ?>
                <tr>
                    <th><?php echo $i ?>.</th>
                    <td>
                        <?php echo $task ?>
                    </td>
                </tr>
            <?php
                $i++;
                }
            ?>
            </table>
        </div>
        <div id="challenge" class="col-md-3">
            <h2 class="specialEdit">30-day <span><?php echo($user_data->chall_name); ?></span> challenge</h2>
            <table class="table table-bordered text-center">
            <?php 
            $chall_int = 1;
            if(!empty($_POST)){
                $user_data->chall_day ++;
                if($user_data->chall_day >= 28){
                    $db ->update("user_data","chall_name=NULL, chall_day=NULL","user_id='{$user_data->user_id}'");
                    echo '<script>alert("Congratulations on completing your challenge!")</script>';
                    $user_data->chall_day = 0;
                }
                else
                    $db-> update("user_data","chall_day='{$user_data->chall_day}'","user_id='{$user_data->user_id}'");
            }
            for ($i=0; $i < 4; $i++) { 
                echo "<tr>";
                for ($j=0; $j < 7; $j++) {
                    if($user_data->chall_day>=$chall_int)    
                        echo "<td class=\"success\">{$chall_int}</td>";
                    else
                        echo "<td>{$chall_int}</td>";
                    $chall_int++;
                }
                echo "</tr>";
            }
            ?>
            </table>
            <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
                <input type="submit" class="btn btn-success" name="daydone" value="Check off today!">
            </form>
            </div>
        <aside class="col-md-3 col-md-push-1" id="motivation">
            <blockquote><p><?php echo $quote_quote ?></p><footer><?php echo $quote_author ?></footer></blockquote>
        </aside>
    </div>
</main>
<?php
    }
}
else
    require_once 'snippets/_welcome.php';
require_once 'layout/footer.php';
?>