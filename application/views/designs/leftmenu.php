<?php
	if($page_act == 'setup'){$setup_active = 'active';}else{$setup_active = '';}
	if($page_act == 'employee'){$employee_active = 'active';}else{$employee_active = '';}
	if($page_act == 'deduct'){$deduct_active = 'active';}else{$deduct_active = '';}
	if($page_act == 'pay'){$pay_active = 'active';}else{$pay_active = '';}
	if($page_act == 'profile'){$profile_active = 'active';}else{$profile_active = '';}
	if($page_act == 'history'){$history_active = 'active';}else{$history_active = '';}
	if($page_act == 'payment'){$payment_active = 'active';}else{$payment_active = '';}
?>

<!-- wrapper -->
<div class="wrapper">
    <div class="leftside">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="title">Navigation</li>
                <?php if($this->session->userdata('itc_user_role') == 'Admin'){ ?>
                <li class="<?php echo $setup_active; ?> sub-nav">
                    <a href="javascript:;">
                        <i class="fa fa-home"></i> <span>Setup</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url(); ?>departments">Departments</a></li>
                        <li><a href="<?php echo base_url(); ?>grades">Salary Grades</a></li>
                        <li><a href="<?php echo base_url(); ?>rates">Pension Rates</a></li>
                        <li><a href="<?php echo base_url(); ?>banks">Banks</a></li>
                    </ul>
                </li>
                <li class="<?php echo $employee_active; ?>">
                    <a href="<?php echo base_url(); ?>employee">
                        <i class="fa fa-users"></i> <span>Employee Accounts</span>
                    </a>
                </li>
                <li class="<?php echo $deduct_active; ?>">
                    <a href="<?php echo base_url(); ?>deducts">
                        <i class="fa fa-book"></i> <span><?php echo date('F'); ?> Deduction</span>
                    </a>
                </li>
                <!--<li class="<?php echo $pay_active; ?>">
                    <a href="<?php echo base_url(); ?>pay">
                        <i class="fa fa-money"></i> <span><?php echo date('F'); ?> Payments</span>
                    </a>
                </li>-->
                <?php } ?>
                
                <?php if($this->session->userdata('itc_user_role') != 'Admin'){ ?>
                <li class="<?php echo $profile_active; ?>">
                    <a href="<?php echo base_url(); ?>profile">
                        <i class="fa fa-user"></i> <span>My Profile</span>
                    </a>
                </li>
                <li class="<?php echo $history_active; ?>">
                    <a href="<?php echo base_url(); ?>history">
                        <i class="fa fa-money"></i> <span>Deduction History</span>
                    </a>
                </li>
                <!--<li class="<?php echo $payment_active; ?>">
                    <a href="<?php echo base_url(); ?>payments">
                        <i class="fa fa-book"></i> <span>Payment Slips</span>
                    </a>
                </li>-->
                <?php } ?>
            </ul>
         </div>
    </div>