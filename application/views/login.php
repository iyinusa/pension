<!-- WELCOME SECTION -->
<div class="container">
	<div class="row mt">
    	<div class="col-lg-3"></div>
        <div class="col-lg-6">
        	<div class="text-center">
                <img alt="" src="<?php echo base_url('img/logo.png'); ?>" />
            </div>
            <hr style="border:1px solid #eee;" />
            <h1>Sign In!</h1>
        	<?php echo form_open('login', array('id'=>'regform')); ?>
				<?php if(!empty($err_msg)){echo $err_msg;} ?>
                <div class="box-body padding-md">
                    <div class="form-group">
                        <?php echo form_error('username'); ?>
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('password'); ?>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" /> <small>Remember me</small>
                    </div>  
                    <div class="box-footer">                                                               
                        <button type="submit" class="btn btn-success btn-block"><h4 style="color:#fff;"><i class="fa fa-key"></i> Sign in</h4></button>  
                    </div>
                </div>
            <?php echo form_close(); ?>
    	</div>
        <div class="col-lg-3"></div>
 	</div>
</div>