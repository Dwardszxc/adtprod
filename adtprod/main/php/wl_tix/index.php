<!--Panel for File a leave-->
            <div role="tabpanel" class="tab-pane fade show container" id="div_nuremedy" aria-labelledby="div_nuremedy-tab">
                <br>
                <form id = 'nuremedy_form'>
                    <div class = 'form-row'>
                        <div class = 'col-md-6'>
                            <label for = 'wl_start'><span class="required-mark">*</span>Start date and time (EST):</label>
                            <input type="text" class = 'form-control' id = 'wl_start' name="wl_start" placeholder="MM/DD/YYYY HH:MM">
                        </div>
                        <div class = 'col-md-6'>
                            <label for = 'wl_end'><span class="required-mark">*</span>Completion date and time (EST):</label>
                            <input type="text" class = 'form-control' id = 'wl_end' name="wl_end" placeholder="MM/DD/YYYY HH:MM">
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <div class = 'col-md-6'>
                            <label for = 'wl_app_list'><span class="required-mark">*</span>Workload:</label>
                            <select class = 'form-control' id = 'wl_app_list' name = 'wl_app_list'>
                            </select>
                        </div>
                        <div class = 'col-md-6'>
                            <label for = 'wl_det'><span class="required-mark">*</span>Task details:</label>
                            <input type="text" class = 'form-control' id = 'wl_det' name="wl_det" rows='4'></input>
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <div class = 'col-md-6'>
                            <label for = 'wl_status'><span class="required-mark">*</span>Status list:</label>
                            <select class = 'form-control' id = 'wl_status' name = 'wl_status'>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <button id = 'submit_wl' type = 'button' class="btn btn-outline-primary btn-lg">Submit</button>
                    </div>
                </form>
                <br>
                <table class="table table-striped table-bordered" id = 'tbl_workload' width="100%">
                        <thead>
                            <tr>
                                <th style="width:10%;">Owner</th>
                                <th style="width:10%;">Details</th>
                                <th style="width:10%;">Workload</th>
                                <th style="width:10%;">Status</th>
                                <th style="width:10%;">Start</th>
                                <th style="width:10%;">End</th>
                                <th style="width:10%;">Option</th>
                            </tr>
                        </thead>
                        <tbody id = 'tb_holiday2'>
                            
                        </tbody>
                </table>
            </div>
            <!--End of Panel for File a leave-->