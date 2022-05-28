    <div class="rightside">
        <div class="page-head">
            <h1>Pension Percentage Rate</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Pension Percentage Rate</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-xs-4">
                    <?php
						$all_grades = '';
						if(!empty($allgrade)){
							foreach($allgrade as $grade){
								if(!empty($e_grade_id)){
									if($e_grade_id == $grade->id){
										$g_sel = 'selected="selected"';
									} else {$g_sel = '';}
								} else {$g_sel = '';}
								
								$all_grades .= '<option value="'.$grade->id.'" '.$g_sel.'>'.$grade->name.'</optionn>';	
							}
						}
					?>
					
					<?php echo form_open_multipart('rates'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-upload"></i>
                                <h3>New Pension Rate</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php if(!empty($err_msg)){echo $err_msg;} ?>
                                <div class="form-group">
                                    <input type="hidden" name="rate_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <label>Salary Grade</label>
                                    <select name="grade_id" class="form-control">
                                        <option>...Select Grade</option>
                                        <?php echo $all_grades; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pension Rate (<i>% of Basic Salary</i>)</label>
                                    <input type="text" name="rate" placeholder="12" class="form-control" value="<?php if(!empty($e_rate)){echo $e_rate;} ?>" required="required" />
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-xs-8">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-upload"></i>
                            <h3>Pension Rate Report</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										//get grade name
										$grade_name = '';
										$ggrade = $this->user->query_rec_single('id', $up->grade_id, 'bz_grade');
										if(!empty($ggrade)){
											foreach($ggrade as $gg){
												$grade_name = $gg->name;
											}
										}
										
										$dir_list .= '
											<tr>
												<td>'.$grade_name.'</td>
												<td>'.number_format($up->rate, 2).'%</td>
												<td>
													<a href="'.base_url().'rates?edit='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'rates?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SALARY GRADE</th>
                                        <th>PENSION RATE</th>
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