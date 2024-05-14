<!--Panel for Application List-->
<div role = 'tabpanel' class = 'tab-pane fade show container' id = 'div_app' aria-labelledby = 'div_app-tab'>
	<br>
	<form id = 'app_form'>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'app_name'><span class = 'required-mark'>*</span>Application Name:</label>
				<div class="input-group mb-3">
					<input type="text" id ='app_name' class="form-control" placeholder="Enter application name" aria-describedby="basic-addon2">
					<div class="input-group-append">
    					<button id = 'put_app' class="btn btn-outline-primary" type="button">Put to list</button>
    					<button id = 'remove_app' class="btn btn-outline-danger" type="button">Remove app</button>
  					</div>
				</div>	
			</div>
		</div>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'app_list'>Application list</label>
				<select multiple class = 'form-control' id = 'app_list'>
					
				</select>
			</div>
		</div>
	</form>
	<br>
</div>