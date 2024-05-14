<!--Panel for ITSM-->
            <div role="tabpanel" class="tab-pane fade show container active" id="div_itsm" aria-labelledby="div_itsm-tab">
                <br>
                <form id = 'itsm_form'>
                    <div class = 'form-row'>
                        <div class = 'col-md-6'>
                            <label for = 'tix_num'><span class="required-mark">*</span>Ticket Number:</label>
                            <input type="text" class = 'form-control' id = 'tix_num' name="tix_num">
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <div class = 'col-md-6'>
                            <label for = 'adt_app_list'><span class="required-mark">*</span>System/Application:</label>
                            <select multiple class = 'form-control' id = 'adt_app_list' name = 'adt_app_list'> <!--itsm_app_list-->
                            </select>
                        </div>
                        <div class = 'col-md-6'>
                            <label for = 'adt_task_list'><span class="required-mark">*</span>Ticket Task:</label>
                            <select multiple class = 'form-control' id = 'adt_task_list' name = 'adt_task_list' > <!--itsm_task_list-->
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <div class = 'col-md-3'>
                            <label for = 'adt_inc_date'><span class="required-mark">*</span>Date of ticket:</label>
                            <input type="text" class = 'form-control' id = 'adt_tix_date' name="adt_tix_date" placeholder="YYYY-MM-DD">
                        </div>
                        <div class = 'col-md-3'>
                            <label for = 'adt_status_list'><span class="required-mark">*</span>Status:</label>
                            <select class = 'form-control' id = 'adt_status_list' name = 'adt_status_list'>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class = 'form-row'>
                        <button id = 'submit_ticket' type = 'button' class="btn btn-outline-primary btn-lg">Submit</button>
                    </div>
                </form>
                <br>
                <table class="table table-striped table-bordered" id = 'tbl_itsm' width="100%">
                        <thead>
                            <tr>
                                <th style="width:10%;">Ticket owner</th>
                                <th style="width:10%;">INC Ticket</th>
                                <th style="width:10%;">Application</th>
                                <th style="width:10%;">Issue</th>
                                <th style="width:10%;">Date</th>
                                <th style="width:10%;">Option</th>
                            </tr>
                        </thead>
                        <tbody id = 'tb_holiday2'>
                            
                        </tbody>
                </table>
            </div>
            <!--End of Panel for File a leave-->