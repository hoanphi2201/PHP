function deleteItem(id) {
	$("#dialog-confirm").dialog({
		resizable : false,
		height : 200,
		modal : true,
		buttons : {
			"Yes" : function() {
				$.post('index.php?controller=group&action=delete', {id : id	}, function(data) {
					$('div#item-' + id).hide(500);
				});
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});
	
}
