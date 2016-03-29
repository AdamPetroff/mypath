
$(function(){
	$('.saveEdit').click(saveEdit);
	$('.cancelEdit').click(cancelEdit);
	$('.edit').click(edit);
	$('#newChall').click(newChall);
	$('#incrementChallDay').click(incrementChallDay);
});

function flashMessage(title, content, type){
	$('#flashMessage').children('strong').html(title);
	$('#flashMessage').children('span').html(content);
	$('#flashMessage').addClass(type).show(1000).delay(5000).hide(1000).queue(function(){
		$(this).removeClass(type).dequeue();
	});
}

function edit(){
	$(this).parent().find('.edit0').hide();
	$(this).parent().find('.edit1').show();
}

function cancelEdit(){
	$(this).parent().find('.edit0').show();
	$(this).parent().find('.edit1').hide();
}
function saveEdit(){
	var array = [], col = $(this).parent().attr('id'), $parent = $(this).parent();
	$(this).parent().find('input[type=text]').each(function(){
		array.push($(this).val());
	});
	$.ajax({
		method: 'POST',
		url: '/mypath/snippets/ajax_operations.php',
		data: {array: array, col: col},
		success: function(data){
			if(data == true){
				$parent.find('span').each(function(i){
					$(this).html(array[i]);
				});
			}
			else{
				flashMessage('Error!','New data were not saved!','alert-danger');
			}
		} 
	});
	$(this).parent().find('.edit0').show();
	$(this).parent().find('.edittrue').hide();
}

function newChall(){
	var name = $(this).parent().find('input[type="text"]').val(), $span = $(this).parent().find('span');
	if($(this).parent().find('input[type="checkbox"]').prop('checked')){
		$.ajax({
			method: 'POST',
			url: '/mypath/snippets/ajax_operations.php',
			data: {chall_name:name},
			success: function(data){
				console.log(data);
				if(data == true){
					$span.html('<b>Current:</b> '+name+'-- Day: 0');
				}
				else{
					flashMessage('Error!','New data were not saved!','alert-danger');
				}
			}
		});
	}
	else
		flashMessage('Alert:','Please check the promise checkbox and hit Send again','alert-warning');
}
function incrementChallDay(){
	var $nodes = $('#challenge').find('td'), number = $nodes.filter('.success').length + 1, $target = $nodes.filter('#'+ number);
	$.ajax({
		method: 'POST',
		url: '/mypath/snippets/ajax_operations.php',
		data: {chall_day:number},
		success: function(data){
			if(data == true){
				$target.addClass('success');
				if(number == 28)
					flashMessage('Congratulations!','You have completed your challenge! You deserve a cookie.','alert-success');
			}
			else
				flashMessage('Error!','New data were not saved!','alert-danger');
		}
	});
}