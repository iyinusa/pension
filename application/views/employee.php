    <div class="rightside">
        <div class="page-head">
            <h1>Employees</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Employees</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo form_open_multipart('employee'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-upload"></i>
                                <h3>New Employee</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            
                            <?php
								$all_grade = '';
								$all_bank = '';
								$all_department = '';
								
								//get all grade
								if(!empty($allgrade)){
									foreach($allgrade as $grade){
										if(!empty($e_grade_id)){
											if($e_grade_id == $grade->id){
												$g_sel = 'selected="selected"';	
											} else {$g_sel = '';}
										} else {$g_sel = '';}
										
										$all_grade .= '<option value="'.$grade->id.'" '.$g_sel.'>'.$grade->name.'</option>';
									}
								}
								
								//get all bnak
								if(!empty($allbank)){
									foreach($allbank as $bank){
										if(!empty($e_bank_id)){
											if($e_bank_id == $bank->id){
												$b_sel = 'selected="selected"';	
											} else {$b_sel = '';}
										} else {$b_sel = '';}
										
										$all_bank .= '<option value="'.$bank->id.'" '.$b_sel.'>'.$bank->name.'</option>';
									}
								}
								
								//get all department
								if(!empty($alldepartment)){
									foreach($alldepartment as $department){
										if(!empty($e_dept_id)){
											if($e_dept_id == $department->id){
												$d_sel = 'selected="selected"';	
											} else {$d_sel = '';}
										} else {$d_sel = '';}
										
										$all_department .= '<option value="'.$department->id.'" '.$d_sel.'>'.$department->name.'</option>';
									}
								}
							?>
                            
                            <div class="box-body" style="overflow:auto;">
                                <?php if(!empty($err_msg)){echo $err_msg;} ?>
                                <div class="col-lg-12">
                                	<div class="col-lg-12">
                                    	<div class="form-inline">
                                        	<div class="form-group">
                                            	<label>Department</label>
                                                <select name="dept_id" class="form-control" required>
                                                    <option>...Select Department</option>
                                                    <?php echo $all_department; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            	<label>Salary Grade</label>
                                                <select name="grade_id" class="form-control" required>
                                                    <option>...Select Grade</option>
                                                    <?php echo $all_grade; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            	<label>Bank</label>
                                                <select name="bank_id" class="form-control" required>
                                                    <option>...Select Bank</option>
                                                    <?php echo $all_bank; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                    	<hr />
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="hidden" name="employee_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                            <label>Pension Code</label>
                                            <input type="text" name="pension_code" placeholder="LPC-10001" class="form-control" value="<?php if(!empty($e_pension_code)){echo $e_pension_code;} else {echo $new_code;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" placeholder="Full Name" class="form-control" value="<?php if(!empty($e_name)){echo $e_name;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control"><?php if(!empty($e_address)){echo $e_address;} ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" placeholder="Phone Number" class="form-control" value="<?php if(!empty($e_phone)){echo $e_phone;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" placeholder="Email Address" class="form-control" value="<?php if(!empty($e_email)){echo $e_email;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Employment Date</label>
                                            <input type="text" name="employ_date" placeholder="dd/mm/yyyy" class="form-control" value="<?php if(!empty($e_employ_date)){echo $e_employ_date;} ?>" required="required" />
                                        </div>
                                  	</div>
                                    
                                    <div class="col-lg-6">
                                    	<div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text" name="acc_no" placeholder="Account Number" class="form-control" value="<?php if(!empty($e_acc_no)){echo $e_acc_no;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Retirement Date</label>
                                            <input type="text" name="retire_date" placeholder="dd/mm/yyyy" class="form-control" value="<?php if(!empty($e_retire_date)){echo $e_retire_date;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Death Date (<i>if any</i>)</label>
                                            <input type="text" name="death_date" placeholder="dd/mm/yyyy" class="form-control" value="<?php if(!empty($e_death_date)){echo $e_death_date;} ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Next of Kin: Full Name</label>
                                            <input type="text" name="nk_name" placeholder="Full Name" class="form-control" value="<?php if(!empty($e_nk_name)){echo $e_nk_name;} ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Next of Kin: Address</label>
                                            <textarea name="nk_address" class="form-control"><?php if(!empty($e_nk_address)){echo $e_nk_address;} ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Next of Kin: Phone</label>
                                            <input type="text" name="nk_phone" placeholder="Phone Number" class="form-control" value="<?php if(!empty($e_nk_phone)){echo $e_nk_phone;} ?>" required="required" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                    	<hr />
                                        <div class="form-inline">
                                        	<div class="form-group">
                                            	<label>Username</label>
                                                <input type="text" name="username" placeholder="Username" class="form-control" value="<?php if(!empty($e_username)){echo $e_username;} ?>" required="required" />
                                            </div>
                                            <div class="form-group">
                                            	<label>Password</label>
                                                <input type="text" name="password" placeholder="Supply only when to create/change" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-upload"></i>
                            <h3>Employee Report</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										$dept_name = '';
										$grade_name = '';
										$gdept = $this->user->query_rec_single('id', $up->dept_id, 'bz_department');
										if(!empty($gdept)){
											foreach($gdept as $gd){
												$dept_name = $gd->name;
											}
										}
										
										$ggrade = $this->user->query_rec_single('id', $up->grade_id, 'bz_grade');
										if(!empty($ggrade)){
											foreach($ggrade as $gg){
												$grade_name = $gg->name;
											}
										}
										
										$dir_list .= '
											<tr>
												<td>'.$up->pension_code.'</td>
												<td>'.$up->name.'</td>
												<td>'.$dept_name.'</td>
												<td>'.$grade_name.'</td>
												<td>'.$up->employ_date.'</td>
												<td>'.$up->retire_date.'</td>
												<td>
													<a href="'.base_url().'employee?edit='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'employee?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>FULL NAME</th>
                                        <th>DEPT.</th>
                                        <th>SALARY GRADE</th>
                                        <th>EMP. DATE</th>
                                        <th>RETIRE DATE</th>
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