    <div class="rightside">
        <div class="page-head">
            <h1>My Profile </h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>                
                <li class="active">Profile</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
            	<div class="col-lg-12">
                	<style>
						td{font-size:16px; padding:5px;}
						td:first-child{font-weight:bold;}
					</style>
                    <table width="80%">
                    	<tr>
                        	<td width="200px">Full Name</td>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                        	<td>Department</td>
                            <td><?php echo $dept; ?></td>
                        </tr>
                                                <tr>
                        	<td>Salary Grade Level (SGL)</td>
                            <td><?php echo $grade; ?></td>
                        </tr>
                                                <tr>
                        	<td>Address</td>
                            <td><?php echo $address; ?></td>
                        </tr>
                                                <tr>
                        	<td>Phone</td>
                            <td><?php echo $phone; ?></td>
                        </tr>
                                                <tr>
                        	<td>Email</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                                                <tr>
                        	<td>Employement Date</td>
                            <td><?php echo $employ_date; ?></td>
                        </tr>
                                                <tr>
                        	<td>Retirement Date</td>
                            <td><?php echo $retire_date; ?></td>
                        </tr>
                                                <tr>
                        	<td>Next of Kin</td>
                            <td><?php echo $nk_name; ?></td>
                        </tr>
                                                <tr>
                        	<td>Next of Kin: Address</td>
                            <td><?php echo $nk_address; ?></td>
                        </tr>
                                                <tr>
                        	<td>Next of Kin: Phone</td>
                            <td><?php echo $nk_phone; ?></td>
                        </tr>
                      	<tr>
                        	<td>Bank</td>
                            <td><?php echo $bank; ?></td>
                        </tr>
                                                <tr>
                        	<td>Account Number</td>
                            <td><?php echo $dept; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>