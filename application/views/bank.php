    <div class="rightside">
        <div class="page-head">
            <h1>Banks</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Banks</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-xs-4">
                    <?php echo form_open_multipart('banks'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-upload"></i>
                                <h3>New Banks</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php if(!empty($err_msg)){echo $err_msg;} ?>
                                <div class="form-group">
                                    <input type="hidden" name="bank_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <label>Bank Name</label>
                                    <input type="text" name="name" placeholder="Bank Name" class="form-control" value="<?php if(!empty($e_name)){echo $e_name;} ?>" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Bank Address</label>
                                    <textarea name="address" class="form-control"><?php if(!empty($e_address)){echo $e_address;} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Contact Name</label>
                                    <input type="text" name="contact_name" placeholder="Contact Person" class="form-control" value="<?php if(!empty($e_contact_name)){echo $e_contact_name;} ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input type="text" name="contact_phone" placeholder="Contact Phone" class="form-control" value="<?php if(!empty($e_contact_phone)){echo $e_contact_phone;} ?>" />
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
                            <h3>Banks Report</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										$dir_list .= '
											<tr>
												<td>'.$up->name.'</td>
												<td>'.$up->contact_name.'</td>
												<td>'.$up->contact_phone.'</td>
												<td>
													<a href="'.base_url().'banks?edit='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'banks?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>BANK</th>
                                        <th>CONTACT PERSON</th>
                                        <th>PHONE</th>
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