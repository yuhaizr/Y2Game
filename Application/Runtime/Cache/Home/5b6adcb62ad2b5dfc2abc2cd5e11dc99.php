<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title><?php echo ($page_title); ?></title>

    <meta name="description" content="<?php echo ($page_description); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/jjtrqgl/Public/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="/jjtrqgl/Public/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="/jjtrqgl/Public/css/font-awesome.min.css" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="/jjtrqgl/Public/css/beyond.min.css" rel="stylesheet" />
    <link href="/jjtrqgl/Public/css/demo.min.css" rel="stylesheet" />
    <link href="/jjtrqgl/Public/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	var __URL = '/jjtrqgl/index.php/Home/Login';
	var __APP = '/jjtrqgl/index.php';
	var __PUBLIC = '/jjtrqgl/Public';
	</script>
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/jjtrqgl/Public/js/skins.min.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
	<div class="login-container animated fadeInDown">
	    <div class="loginbox bg-white">
	        <div class="loginbox-title">SIGN IN</div>
	        <form action="/jjtrqgl/index.php/Home/Login/checkLogin" method="post" id="loginform">
	        <div class="loginbox-textbox">
	            <input type="text" class="form-control" name="account" placeholder="Username" id="username"/>
	        </div>
	        <div class="loginbox-textbox">
	            <input type="text" class="form-control" name="password" placeholder="Password" id="password"/>
	        </div>
	        <div class="loginbox-forgot">
	            <a href="">Forgot Password?</a>
	        </div>
	        <div class="loginbox-submit">
	            <input type="button" class="btn btn-primary btn-block" onclick="dologin()" value="Login">
	        </div>  
	        </form>   
	        <?php if(!empty($_SESSION['__SYS_MESSAGE__'])): ?><div class="row">
       			<div class="loginbox-textbox">
	        		<?php if($_SESSION['__SYS_MESSAGE_TYPE__'] == 'error'): ?><div class="alert alert-danger fade in">
	        		<?php else: ?>
	        		<div class="alert alert-<?php echo (strtolower($_SESSION['__SYS_MESSAGE_TYPE__'])); ?> fade in"><?php endif; ?>
                     <button class="close" data-dismiss="alert">
                         ×
                     </button>
                     <?php if($_SESSION['__SYS_MESSAGE_TYPE__'] == 'success'): ?><i class="fa-fw fa fa-check"></i>
                     <?php elseif($_SESSION['__SYS_MESSAGE_TYPE__'] == 'error'): ?>
                     <i class="fa-fw fa fa-times"></i>
                     <?php else: ?>
                     <i class="fa-fw fa fa-<?php echo (strtolower($_SESSION['__SYS_MESSAGE_TYPE__'])); ?>"></i><?php endif; ?>
                     <strong><?php echo (ucfirst($_SESSION['__SYS_MESSAGE_TYPE__'])); ?></strong> <?php echo ($_SESSION['__SYS_MESSAGE__']); ?>
                	</div>
                </div>
           </div><?php endif; ?>
	    </div>
	    
	</div>
	<!--Basic Scripts-->
    <script src="/jjtrqgl/Public/js/jquery-2.0.3.min.js"></script>
    <script src="/jjtrqgl/Public/js/bootstrap.min.js"></script>

    <!--Beyond Scripts-->
    <script src="/jjtrqgl/Public/js/beyond.min.js"></script>
    <script>
    	function dologin(){
    		$("#loginform").submit();
		
    	}
    </script>
</body>
<!--Body Ends-->
</html>