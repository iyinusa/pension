    <div class="rightside">
        <div class="page-head">
            <h1>Pension Deduction/Contribution History</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Deduction</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-upload"></i>
                            <h3>Pension Deduction/Contribution History</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										$salary = 0;
										$rate = 0;
										$query = $this->user->query_rec_single('id', $up->emp_id, 'bz_employee');
										if(!empty($query)){
											foreach($query as $item){
												$ggrade = $this->user->query_rec_single('id', $item->grade_id, 'bz_grade');
												if(!empty($ggrade)){
													foreach($ggrade as $gg){
														$salary = $gg->salary;
														
														$grate = $this->user->query_rec_single('grade_id', $gg->id, 'bz_rate');
														if(!empty($grate)){
															foreach($grate as $gr){
																$rate = $gr->rate;	
															}
														}
													}
												}
											}
										}
										
										$dir_list .= '
											<tr>
												<td>'.$up->day.' '.$up->month.', '.$up->year.'</td>
												<td>'.number_format($rate,2).'% of &#8358;'.number_format($salary,2).'</td>
												<td>
													&#8358;'.number_format($up->amt,2).'
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>% OF SALARY</th>
                                        <th>DEDUCTION AMOUNT</th>
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