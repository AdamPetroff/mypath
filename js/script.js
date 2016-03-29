
$(function(){
	$('.saveEdit').click(saveEdit);
	$('.cancelEdit').click(cancelEdit);
	$('.edit').click(edit);
	$('#newChall').click(newChall);
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
		url: '/stranka3/snippets/ajax_operations.php',
		data: {array: array, col: col},
		success: function(data){
			if(data == 1){
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
	$(this).parent().find('.edit1').hide();
}

function newChall(){
	var name = $(this).parent().find('input[type="text"]').val(), $span = $(this).parent().find('span');
	if($(this).parent().find('input[type="checkbox"]').prop('checked')){
		$.ajax({
			method: 'POST',
			url: '/stranka3/snippets/ajax_operations.php',
			data: {chall_name:name},
			success: function(data){
				console.log(data);
				if(data == 1){
					$span.html('Current: '+name+'-- Day: 0');
				}
				else{
					flashMessage('Error!','New data were not saved!','alert-danger');
				}
			},
			error: function(){
				console.log('penisko');
			}
		});
	}
	else
		flashMessage('Alert:','Please check the promise checkbox and hit Send again','alert-warning');
}
