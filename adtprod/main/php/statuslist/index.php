<!--Panel for Issue reported List-->
<div role = 'tabpanel' class = 'tab-pane fade show container' id = 'div_stat' aria-labelledby = 'div_stat-tab'>
	<br>
	<form id = 'stat_form'>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'stat_name'><span class = 'required-mark'>*</span>Status name:</label>
				<div class="input-group mb-3">
					<input type="text" id ='stat_name' class="form-control" placeholder="Enter status name" aria-describedby="basic-addon2">
					<div class="input-group-append">
    					<button id = 'put_stat' class="btn btn-outline-primary" type="button">Put to list</button>
    					<button id = 'remove_stat' class="btn btn-outline-danger" type="button">Remove status</button>
  					</div>
				</div>	
			</div>
		</div>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'stat_list'>Status list</label>
				<select multiple class = 'form-control' id = 'stat_list'>
					
				</select>
			</div>
		</div>
		<br>
	</form>
</div>