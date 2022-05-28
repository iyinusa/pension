    <div class="rightside">
        <div class="page-head">
            <h1>Pension Deduction</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Pension Deduction</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php echo form_open_multipart('deducts'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-upload"></i>
                                <h3><?php echo date('F'); ?> Pension Deductions [<small><b>Today: <?php echo date('d M, Y'); ?></b></small>]</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php if(!empty($err_msg)){echo $err_msg;} ?>
                                <div class="form-group">
                                    <?php if(!empty($e_id)){$d_id = $e_id;} else {$d_id = 0;} ?>
                                    <input type="hidden" name="deduct_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <a class="pull-left btn btn-info btn-lg" href="<?php echo base_url('deducts?deduct='.$d_id.''); ?>">Prepare <?php echo date('F'); ?> Deduction <i class="fa fa-arrow-circle-right"></i></a>&nbsp;
                                    <label class="text-muted"><br/>This will perform auto deduction on selected employee salary based on salary grade level</label>
                                </div>
                                <div class="form-group">
                                	<?php 
										$emp_list = '';
										$amount = 0;
										
										if(!empty($allemployee)){
											foreach($allemployee as $emp){
												$chk = '';
												$disable = '';
												if(!empty($e_id)){
													$getdetails = $this->user->query_rec_double('deduct_id', $e_id, 'emp_id', $emp->id, 'bz_deduct_details');	
													if(!empty($getdetails)){
														foreach($getdetails as $dt){
															if($dt->month == date('F') && $dt->year == date('Y')) {
																$amount = $dt->amt;
																$chk = 'checked="checked"';
																$disable = 'disabled';
															}
														}
													}
												}
												
												$dept_name = '';
												$grade_name = '';
												$grade_rate = '';
												$salary = '';
												$gdept = $this->user->query_rec_single('id', $emp->dept_id, 'bz_department');
												if(!empty($gdept)){
													foreach($gdept as $gd){
														$dept_name = $gd->name;
													}
												}
												
												$ggrade = $this->user->query_rec_single('id', $emp->grade_id, 'bz_grade');
												if(!empty($ggrade)){
													foreach($ggrade as $gg){
														$grade_name = $gg->name;
														$salary = $gg->salary;
													}
													
													//get rate
													$grate = $this->user->query_rec_single('grade_id', $emp->grade_id, 'bz_rate');
													if(!empty($grate)){
														foreach($grate as $gr){
															$grade_rate = $gr->rate;
														}
													}
												}
												
												$emp_list .= '
													<tr>
														<td align="center"><input type="checkbox" name="emp[]" class="case" value="'.$emp->id.'" class="form-control" '.$chk.' '.$disable.' /></td>
														<td>'.$emp->name.'</td>
														<td>'.$dept_name.'</td>
														<td>'.$grade_name.' ('.number_format($grade_rate,2).'% of &#8358;'.number_format($salary,2).')</td>
														<td>&#8358;'.number_format($amount,2).'</td>
													</tr>
												';
											}
											
											echo '
												<table id="" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th><input type="checkbox" id= "selectall" class="form-control" /></th>
															<th>Employee</th>
															<th>Department</th>
															<th>Salary Grade</th>
															<th>Deduction</th>
														</tr>
													</thead>
													<tbody>
														'.$emp_list.'
													</tbody>
												</table>
												
												<script language="javascript">
													$(function(){
														// add multiple select / deselect functionality
														$("#selectall").click(function () {
															  $(".case").attr("checked", this.checked);
														});
													
														// if all checkbox are selected, check the selectall checkbox
														// and viceversa
														$(".case").click(function(){
															if($(".case").length == $(".case:checked").length) {
																$("#selectall").attr("checked", "checked");
															} else {
																$("#selectall").removeAttr("checked");
															}
													
														});
													});
												</script>
											';
										}
									?>
                                </div>
                            </div>
                            <?php if(!empty($allemployee)){ ?>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                            <?php } ?>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-upload"></i>
                            <h3>Pension Deduction Report</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										$all = $this->user->query_rec_single('deduct_id', $up->id, 'bz_deduct_details');
										
										$dir_list .= '
											<tr>
												<td>'.$up->month.'</td>
												<td>'.$up->year.'</td>
												<td>'.count($all).'</td>
												<td>
													<a href="'.base_url().'deducts?deduct='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'deducts?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>MONTH</th>
                                        <th>YEAR</th>
                                        <th>TOTAL DEDUCTION</th>
                                        <th width="150">MANAGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php echo $dir_list; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>