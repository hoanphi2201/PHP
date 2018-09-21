function changeStatus(url){
	$.get(url, function(data){
		//Nếu status trả về là 1 thì phải cho hiển thị icon pulish
		/**
		 * <a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
							<span class="state '.$strStatus.'"></span>
						</a>';
		 */
		var classRemove = 'publish';
		var classAdd = 'unpublish';
		if(data['status'] == 1){
			classRemove = 'unpublish';
			classAdd = 'publish'
		}
		var element = 'a#status-'+data['id']; 
		$(element + ' span').removeClass(classRemove).addClass(classAdd);
		$(element).attr('href',"javascript:changeStatus('"+data['link']+"')");
		console.log(element);
	},'json');
}

function submitForm(url){
	console.log(url);
	$('#adminForm').attr('action', url);
	$('#adminForm').submit();
}
function submit(){
	$('#adminForm').submit();
}

//Hàm này dùng để truyền 2 tham số xuống input để sort
function sortList(column, order){
	//truyền 2 tham số sort cho 2 phần input ở dưới
	$('input[name=filter_column]').val(column);
	$('input[name=filter_column_dir]').val(order);
	$('#adminForm').submit();
}


function changePage(page){
	// console.log(page);
	$('input[name=filter_page]').val(page);
	$('#adminForm').submit();
}

function changeGroupACP(url){
	$.get(url, function(data){
		
		var classRemove = 'publish';
		var classAdd = 'unpublish';
		if(data['group_acp'] == 1){
			classRemove = 'unpublish';
			classAdd = 'publish';
			
		}
		var element = 'a#group-acp-'+data['id'];
		$(element + ' span').removeClass(classRemove).addClass(classAdd);
		$(element).attr('href',"javascript:changeGroupACP('"+data['link']+"')");
		console.log(element);

	},'json');
}

$(document).ready(function(){
	$('input[name=checkall-toggle]').change(function(){
		var checkStatus = this.checked;
		$("#adminForm").find(':checkbox').each(function(){
			this.checked = checkStatus;
		})
	});
	//submit
	$('#filter-bar button[name=submit-keyword]').click(function(){
		$('#adminForm').submit();
	})
	//clear
	$('#filter-bar button[name=clear-keyword]').click(function(){
		$('#filter-bar input[name=filter_search]').val('');
		$('#adminForm').submit();
	})
	//Submit cho filter theo status	
	$('#filter-bar select[name=filter_state]').change(function(){
		$('#adminForm').submit();
	})
	//Submit cho filter theo group
	$('#filter-bar select[name=filter_group_acp]').change(function(){
		$('#adminForm').submit();
	})
	//ẩn đi errors
	$('#system-message').click(function(){
		$(this).slideUp(500);
	})

	//Submit cho filter theo group
	$('#filter-bar select[name=filter_group_id]').change(function(){
		$('#adminForm').submit();
	})
})





