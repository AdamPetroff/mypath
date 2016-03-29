<?php
$page_title = "My Plan | MyPath";
require_once 'snippets/load.php';
require_once 'layout/header.php';
if($login && $user_data = $db->select('user_data','*',"user_id='{$login->user_id}'")){
?>
<main>
	<div class="row">
		<h2 class="col-md-offset-1">My new challenge</h2>
		<div id="setChallenge" class="col-md-8 col-md-offset-2">
			<span><b>Current:</b> The <?php echo $user_data->chall_name ?> challenge -- <b>Day:</b> <?php echo $user_data->chall_day ?></span>
			<label>Challenge name:</label><input class="form-control" type="text"><br/>
			<label>I will do my best to complete this challenge</label> <input type="checkbox"><br/>
			<button type="submit" class="btn btn-default" id="newChall">
		</div>
	</div>

	<div class="row">
		<h2 class="col-md-offset-1">My todo list</h2>
		<div class="col-md-8 col-md-offset-2">
			<ul id="mainPlan">
				<?php $plan_array = [
					'To do this week'=>'weekly_plan',
					'To do this month'=>'monthly_plan',
					'To do in three months'=>'quarterly_plan',
					'To do this year'=>'yearly_plan'
				];
				foreach ($plan_array as $label => $plan) {
					echo "<li id=\"$plan\"><b>$label :</b><br/><ol>";
					$plan_items = explode(',',$user_data->$plan);
					for($i = 0; $i < 5; $i++) {
					?>
					<li>
						<span class="edit0"><?php echo(isset($plan_items[$i]) ? $plan_items[$i] : '') ?></span>
						<input type="text" class="edit1 form-control" value="<?php echo(isset($plan_items[$i]) ? $plan_items[$i] : '') ?>"><br/>
					</li>
					<?php
					}
					echo '</ol>';
					?>
					<input type="button" value="Save" class="btn btn-primary edit1 saveEdit">
					<input type="button" value="Cancel" class="btn btn-default edit1 cancelEdit">
					<input type="button" value="Edit" class="btn btn-default edit0 edit">
					<?php
					echo '</li><br/>';
				}
				?>
			</ul>
		</div>
	</div>
	
</main>
<?php 
}
else
	require_once 'snippets/_welcome.php';
require_once 'layout/footer.php';
?>