<!--Panel for Issue reported List-->
<div role = 'tabpanel' class = 'tab-pane fade show container' id = 'div_task' aria-labelledby = 'div_task-tab'>
	<br>
	<form id = 'app_form'>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'task_name'><span class = 'required-mark'>*</span>Task name:</label>
				<div class="input-group mb-3">
					<input type="text" id ='task_name' class="form-control" placeholder="Enter task name" aria-describedby="basic-addon2">
					<div class="input-group-append">
    					<button id = 'put_task' class="btn btn-outline-primary" type="button">Put to list</button>
    					<button id = 'remove_task' class="btn btn-outline-danger" type="button">Remove task</button>
  					</div>
				</div>	
			</div>
		</div>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'task_list'>Task list</label>
				<select multiple class = 'form-control' id = 'task_list'>
					
				</select>
			</div>
		</div>
		<br>
	</form>
</div>