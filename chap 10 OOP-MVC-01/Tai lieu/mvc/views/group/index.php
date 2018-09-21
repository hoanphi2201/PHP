<?php
	$xhtml = '';
	if(!empty($this->items)){
		foreach($this->items as $key => $value){
			$id		= $value['id'];
			$status	= ($value['status']==1) ? 'Active' : 'Inactive';
			$xhtml .= '<div class="row" id="item-'.$id.'">
							<p class="w-10"><input type="checkbox" name="checkbox[]" value="'.$id.'"/></p>
							<p>'.$value['name'].'</p>
							<p class="w-10">'.$id.'</p>
							<p class="w-10">'.$status.'</p>
							<p class="w-10">'.$value['ordering'].'</p>
							<p class="w-10">'.$value['total'].'</p>
							<p class="w-10 action">
								<a href="#">Edit</a> |
								<a href="javascript:deleteItem('.$id.')">Delete</a> 
							</p>
						</div>';
		}
	} 
?>

<div class="content">
	<h3>Group :: List</h3>
	
	<div id="dialog-confirm" title="Thông báo!" style="display: none;">
  		<p>Bạn có chắc muốn xóa phần tử này hay không?</p>
	</div>

	<div class="list">
		<div class="row head">
			<p class="w-10"><input type="checkbox" name="check-all" id="check-all"/></p>
			<p>Group Name</p>
			<p class="w-10">ID</p>
			<p class="w-10">Status</p>
			<p class="w-10">Ordering</p>
			<p class="w-10">Member</p>
			<p class="w-10 action">Action</p>
		</div>
		<?php echo $xhtml;?>
	</div>
</div>