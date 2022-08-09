<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <style>
            body#LoginForm{ background-image:url("<?php echo base_url();?>/assets/images/login_bk.jpg"); background-repeat:no-repeat; padding:10px;}

            .form-heading { color:#fff; font-size:23px;}
            .panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
            .panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
            .login-form .form-control {  background: #f7f7f7 none repeat scroll 0 0;  border: 1px solid #d4d4d4;  border-radius: 4px;  font-size: 14px;  height: 50px;  line-height: 50px;}
            .main-div { background: #ffffff none repeat scroll 0 0; border-radius: 2px;  padding: 50px 70px 70px 71px;}
            .login-form .form-group {  margin-bottom:10px; }
            .login-form{ text-align:center; margin-top: 30%;}
            .login-form  .btn.btn-primary {  background: #f0ad4e none repeat scroll 0 0;  border-color: #f0ad4e;  color: #ffffff;  font-size: 14px;  width: 100%;  height: 50px;  line-height: 50px;
            padding: 0;}
        </style>
          <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    </head>
    <body id="LoginForm">
        <div class="container">
            <div class="col-md-6  col-md-offset-3 ">
                <div class="login-form">
                    <div class="main-div">
                        <div class="panel">
                            <h2>Admin Login</h2>
							<?php 
								echo validation_errors('<p style="margin: 0 0 4px;color: red;">','</p>'); 
								if($this->session->flashdata('error')!=''){
									echo $this->session->flashdata('error');
								}
							?>
                        </div>
                        <?php 
							$attr = array('class' => 'admin-login', 'id' => 'admin-login');
							$usernameField = ['name'=>'username' , 'class' =>'form-control' ,'placeholder'=>'Enter your name' ,'type'=>'text' ,'value'=>set_value('username')];
							$passwordField = ['name'=>'password' , 'class' =>'form-control' ,'placeholder'=>'Enter your Password' ,'type'=>'password' ,'value'=>''];
							$submitBtn = ['name'=>'login' , 'class' =>'btn btn-primary' ,'value'=>'Login' ,'type'=>'submit'];
							echo form_open('/neet-cpanel' ,$attr); 
						?>
                        <div class="form-group"><?php echo form_input($usernameField); ?></div>
                        <div class="form-group"><?php echo form_input($passwordField); ?></div>
                        <?php echo form_input($submitBtn); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    </body>
</html>
