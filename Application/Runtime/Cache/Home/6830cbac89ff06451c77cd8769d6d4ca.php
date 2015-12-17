<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--Head xmlns="http://www.w3.org/1999/xhtml"-->
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
    <link href="/jjtrqgl/Public/css/load.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	var __URL = '/jjtrqgl/index.php/Home/User';
	var __APP = '/jjtrqgl/index.php';
	var __PUBLIC = '/jjtrqgl/Public';

	</script>
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/jjtrqgl/Public/js/skins.min.js"></script>
    <script src="/jjtrqgl/Public/js/jquery-1.10.2.min.js"></script>
    
    <script type="text/javascript">
    
	/* 在ajax 请求返回结果之前做些处理判断用户是否有权访问  */
	$(function(){
		var ajax = $.ajax;
	    $.ajax = function (opt) {
	        //备份opt中error和success方法
	        var fn = {
	            success: function (data, textStatus, jqXHR) {
	            }
	        }
	        if (opt.success) {
	            fn.success = opt.success;
	        }
	        //扩展增强处理
	        var _opt = $.extend(opt, {
	            success: function (data, textStatus, jqXHR) {
	                //alert('重写success事件');
	                $('.sk-circle').hide();
	                $('.mask').hide();
	                if (data.info) {
	                    alert(data.info);
	                    return;
	                }
	                fn.success(data, textStatus, jqXHR);
	            },
	        	beforeSend:function(){
	        		$('.sk-circle').show();
	        		$('.mask').show();
	        	}
	        });
	        var def = ajax.call($, _opt);                                                                                                                             // 兼容不支持异步回调的版本
	        if('done' in def){
	            var done = def.done;
	            def.done = function (func) {
	                function _done(data) {
		                $('.sk-circle').hide();
		                $('.mask').hide();
	                    if (data.info) {
	                        alert(data.info);
	                        return;
	                    }
	                    func(data);
	                }
	                done.call(def, _done);
	                return def;
	            };
	        }
	        return def;
	    };
	}); 
    </script>    
    
    
</head>
<!--Head Ends-->
<!--Body-->
<body>
<!-- ajax loading -->
	<div class='mask opacity'></div>
    <div class="sk-circle">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div>
<!-- ajax loading -->

<!-- Loading Container -->
    <div class="loading-container">
        <div class="loading-progress">
            <div class="rotator">
                <div class="rotator">
                    <div class="rotator colored">
                        <div class="rotator">
                            <div class="rotator colored">
                                <div class="rotator colored"></div>
                                <div class="rotator"></div>
                            </div>
                            <div class="rotator colored"></div>
                        </div>
                        <div class="rotator"></div>
                    </div>
                    <div class="rotator"></div>
                </div>
                <div class="rotator"></div>
            </div>
            <div class="rotator"></div>
        </div>
    </div>
    <!--  /Loading Container -->
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand" id="nav-title">
                        <small>
                            <!-- <img src="/jjtrqgl/Public/img/logo.png" alt="" /> -->
                            <font size ='2'>
                           		 爱基金CRM
                            </font>
                        </small>
                    </a>
                </div>
                <!-- /Navbar Barnd -->

                <!-- Sidebar Collapse -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings --->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
							<li>
                                <a class="wave in dropdown-toggle" data-toggle="dropdown" title="Help" href="#">
                                    <i class="icon fa fa-envelope"></i>
                                    <span class="badge"><?php echo ($task_num); ?></span>
                                </a>

                                <!--Messages Dropdown-->
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-messages">
	                           
	                                <?php if($task_num == 0): ?><li>
	                                			<a href="#" target="_blank">
	                                				<span >
	                                					没有未读消息
	                                				</span>
	                                			</a>
	                                	  </li><?php endif; ?>                                
                                	<?php if(is_array($taskList)): foreach($taskList as $key=>$vo): ?><li data-url="<?php echo ($vo["url"]); ?>" data-id="<?php echo ($vo["id"]); ?>" class='read_message'>
	                                        <a >
	                                          
	                                            <div class="message">
	                                                <span class="message-sender">
	                                                   <?php echo ($vo["from_nickname"]); ?>
	                                                </span>
	                                                <span class="message-time">
	                                                   <?php echo ($vo["ctime"]); ?>
	                                                </span>
	                          	                	<span class="message-subject">
	                                                   <!-- <?php echo ($vo["message"]); ?>  -->
	                                                </span>
	                                                <span class="message-body">
	                                                   <?php echo ($vo["message"]); ?> 
	                                                </span>
	                                            </div>
	                                        </a>
	                                    </li><?php endforeach; endif; ?>
                                   		<li style="font-size: 0.2em;text-align: right;">
                                			<a href="/jjtrqgl/index.php/Home/Task/taskList" target="_blank">
                                				<span >
                                					显示所有消息
                                				</span>
                                			</a>
                                		</li>                                   
                               </ul>     
             				</li>      

             
                            <li>
                                <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                    <div class="avatar" title="View your public profile">
                                        <img src="">
                                    </div>
                                    <section>
                                        <h2><span class="profile"><span><?php echo ($_SESSION['loginUserName']); ?></span></span></h2>
                                    </section>
                                </a>
                                <!--Login Area Dropdown-->
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                        
                                    <!--Theme Selector Area-->
                                    <li class="theme-area">
                                        <ul class="colorpicker" id="skin-changer">
                                            <li><a class="colorpick-btn" href="#" style="background-color:#5DB2FF;" rel="/jjtrqgl/Public/css/skins/blue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#2dc3e8;" rel="/jjtrqgl/Public/css/skins/azure.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#03B3B2;" rel="/jjtrqgl/Public/css/skins/teal.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#53a93f;" rel="/jjtrqgl/Public/css/skins/green.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#FF8F32;" rel="/jjtrqgl/Public/css/skins/orange.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#cc324b;" rel="/jjtrqgl/Public/css/skins/pink.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#AC193D;" rel="/jjtrqgl/Public/css/skins/darkred.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#8C0095;" rel="/jjtrqgl/Public/css/skins/purple.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#0072C6;" rel="/jjtrqgl/Public/css/skins/darkblue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#585858;" rel="/jjtrqgl/Public/css/skins/gray.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#474544;" rel="/jjtrqgl/Public/css/skins/black.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#001940;" rel="/jjtrqgl/Public/css/skins/deepblue.min.css"></a></li>
                                        </ul>
                                    </li>
                                    <!--/Theme Selector Area-->
                                    <li class="dropdown-footer">
                                        <a href="/jjtrqgl/index.php/Home/login/logout">
                                            Sign out
                                        </a>
                                    </li>
                                </ul>
                                <!--/Login Area Dropdown-->
                            </li>
                            <!-- /Account Area -->
                            <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                            <!-- Settings -->
                        </ul><div class="setting">
                            <a id="btn-setting" title="Setting" href="#">
                                <i class="icon glyphicon glyphicon-cog"></i>
                            </a>
                        </div><div class="setting-container">
                            <label>
                                <input type="checkbox" id="checkbox_fixednavbar">
                                <span class="text">Fixed Navbar</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedsidebar">
                                <span class="text">Fixed SideBar</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedbreadcrumbs">
                                <span class="text">Fixed BreadCrumbs</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedheader">
                                <span class="text">Fixed Header</span>
                            </label>
                        </div>
                        <!-- Settings -->
                    </div>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input type="text" class="searchinput" />
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                 <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li class="active">
                        <a href="index.html">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <!--Tables-->
                    <?php if(is_array($menu)): foreach($menu as $key=>$value): ?><li  <?php if($value["link"] == $NOW_MENU): ?>class='open'<?php endif; ?>  >
                   			 <a href= "#" class="menu-dropdown">
	                            <i class="menu-icon fa fa-table"></i>
	                            <span class="menu-text"> <?php echo ($value["title"]); ?> </span>
	                            <i class="menu-expand"></i>
                        	</a>
                        	<ul class="submenu">
                        		<?php if(is_array($value["childs"])): foreach($value["childs"] as $key=>$v): ?><li   <?php if($v["link"] == $SECOND_NOW_MENU): ?>class='open'<?php endif; ?> >
                        				<?php if(empty($v["childs"])): ?><a href="/jjtrqgl/index.php<?php echo ($v["link"]); ?>" target="_blank">
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                               
			                                </a> 
		                               	<?php else: ?>
		                               		<a href="#" class="menu-dropdown">
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                                    <i class="menu-expand"></i>
				                            </a> 
				                            <ul class="submenu">
				                                <?php if(is_array($v["childs"])): foreach($v["childs"] as $key=>$cv): ?><li>
						                                	  <a href="/jjtrqgl/index.php<?php echo ($cv["link"]); ?>" target="_blank">
							                                      <span class="menu-text"><?php echo ($cv["title"]); ?></span>
							                      
						                              		  </a>
					                                	</li><?php endforeach; endif; ?> 
				                            </ul><?php endif; ?>
		                            </li><?php endforeach; endif; ?>
                        	</ul>
                    	</li><?php endforeach; endif; ?>
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                           <!--  <a href="#">Home</a> -->
                            <?php echo ($NOW_PATH); ?>
                        </li>
                      <!--   <li class="active">Dashboard</li> -->
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                 <!--        <h1>
                            Dashboard
                        </h1> -->
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
        		<!-- Page Body -->
        		<div class="page-body">
        		<?php if(!empty($_SESSION['__SYS_MESSAGE__'])): ?><div class="row">
        			<div class="col-xs-12 col-md-12">
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
                 </div></div>
                 </div><?php endif; ?>
        		

<div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="widget">
                <div class="widget-header ">
                    <span class="widget-caption">用户列表</span>
                    <div class="widget-buttons">
                        <a href="#" data-toggle="maximize">
                            <i class="fa fa-expand"></i>
                        </a>
                        <a href="#" data-toggle="collapse">
                            <i class="fa fa-minus"></i>
                        </a>
                        <a href="#" data-toggle="dispose">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="table-toolbar">
                    	 <div class="search-box col-sm-3" >
			                		<div>
			                			<span class="input-icon">
			                				<input type="text" value="<?php echo ($nickname); ?>" id='nickname' class="form-control"  placeholder="请输入用户姓名">
			                				<i class="glyphicon glyphicon-search circular blue"></i>
			                			</span>
			                		</div>
			               </div>	     
                    	   <div class="col-sm-3">
										<div class="form-group">
								
											<div class="col-lg-8">
                                            <select  id="role_id" name="role_id" style="width:100%">
                                           	    <option value=''/>请选择角色
												<?php if(is_array($roleList)): foreach($roleList as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php echo ($role_select[$vo['id']]); ?>/><?php echo ($vo["name"]); endforeach; endif; ?>
											</select>
											<span class="text"></span></div>
										</div>
						  </div>
						  <div class="col-sm-3">
						  	<a id="searchUser" href="javascript:void(0);" class="btn btn-default" >搜索</a>
						  </div>
                        
                          <div class="col-sm-3">
                            <a id="editabledatatable_new" href="javascript:void(0);" class="btn btn-default" onclick="jumpuseradd()">添加用户</a>
                          </div>
                        
                        
            
                    </div>
                    <div class="table-toolbar" style="margin-top: 10px;">
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editabledatatable">
                        <thead>
                            <tr role="row">
						        <th>编号</th>
						        <th>用户名</th>
						        <th class="numeric">昵称</th>
						        <th class="numeric">角色</th>
						        <th class="numeric">上次登录</th>
						        <th class="numeric">登录次数</th>
						        <th class="numeric">状态</th>
						        <th class="numeric">操作 </th>
        					</tr>
      </thead>
       <tbody id='userlistTable'>
       <?php if(is_array($userinfolist)): foreach($userinfolist as $key=>$value): ?><tr>
      		
      		<td><?php echo ($key + 1); ?></td>
      		<td><?php echo ($value["account"]); ?></td>
      		<td><?php echo ($value["nickname"]); ?></td>
      		<td><?php echo ($value["role_name"]); ?></td>
      		<td><?php echo ($value["last_login_time"]); ?></td>
      		<td><?php echo ($value["login_count"]); ?></td>
      		<td><?php echo ($value["status"]); ?></td>
      		
      		 <td>
             <a href="#" onclick="jumpuseredit(<?php echo ($value["id"]); ?>)" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
             <a href="#" onclick="jumpuserdelete(<?php echo ($value["id"]); ?>)" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>
            </td>
      	</tr><?php endforeach; endif; ?>
      </tbody>
      </table>
      
  
               <div class="row DTTTFooter">
					<div class="col-sm-6">
						<div class="dataTables_info" id="simpledatatable_info" role="alert" aria-live="polite" aria-relevant="all"></div>
					</div>
					<div class="col-sm-8 pull-right">
						<div class="dataTables_paginate paging_bootstrap" id="simpledatatable_paginate">
							<ul class="pagination" id="pageUl">
								<?php echo ($page); ?>
							</ul>
						</div>
					</div>				
            	</div>        
      
                </div>
            </div>
        </div>
    </div>
<script>
function jumpuseradd(){
	window.location.href=__URL+"/useradd";
}
function jumpuseredit(id){
	window.location.href=__URL+"/useredit?id="+id;
}
function jumpuserdelete(id){
	if(confirm('确定删除吗？')){
		window.location.href=__URL+"/userdelete?id="+id;
	}
}

$(function(){
	$('#searchUser').click(function(){
		var nickname = $("#nickname").val();
		var role_id = $("#role_id").val();
		data = {"role_id":role_id,"nickname":nickname,"type":"searchUserList"};
		$.ajax({
			type: "POST",
			url: '/jjtrqgl/index.php/Home/User/index',
			data: data,
			dataType: 'json',
			success: function(dt) {	
			
				var show = dt.show;
				$("#pageUl").html(show);
				dt = dt.data;
				var html = "";
				$.each(dt,function(k,v){
					html += "<tr>";
		      		var num = k + 1; 
					html += "<td>"+num+"</td>";
					html += "<td>"+v.account+"</td>";
					html += "<td>"+v.nickname+"</td>";
					html += "<td>"+v.role_name+"</td>";
					html += "<td>"+v.last_login_time+"</td>";
					html += "<td>"+v.login_count+"</td>";
					html += "<td>"+v.status+"</td>";
		      		
					html += " <td>";
					html += ' <a href="#" onclick="jumpuseredit(<?php echo ($value["id"]); ?>)" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a> ';
					html += ' <a href="#" onclick="jumpuserdelete(<?php echo ($value["id"]); ?>)" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> Delete</a>';
					html += " </td>";
					html += "</tr>	";			
					
				});
				
				$("#userlistTable").html(html);
				
				
				
			}
		
		});	
	});
	
});

</script>
 
        		</div>
				<!-- /Page Body -->
			</div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
 
     <script type="text/javascript">
	    $(function(){
	    	$(".read_message").click(function(){
	    		
	    		var url = $(this).attr('data-url');
	    		var id = $(this).attr('data-id');
	    		var random = Math.random();
	    		var data = {'url':url,'id':id,'random':random};
	    		$.ajax({
					url:"/jjtrqgl/index.php/Home/Task/read_task_message",
					type:"POST",
					data:data,
					dataType:'json',
					success:function(data){
						
						var random = Math.random();
						location.href = "/jjtrqgl/index.php"+data.url + '&random=' + random;
						
					}
				});   
	    		
	    	});    	
	    	
	    });

    </script>   
    
    
<!--Basic Scripts-->
<script src="/jjtrqgl/Public/js/jquery-2.0.3.min.js"></script>
<script src="/jjtrqgl/Public/js/bootstrap.min.js"></script>

<!--Beyond Scripts-->
<script src="/jjtrqgl/Public/js/beyond.min.js"></script>
 <!--Page Related Scripts-->
<script src="/jjtrqgl/Public/js/validation/bootstrapValidator.js"></script>
<script src="/jjtrqgl/Public/js/select2/select2.js"></script>   
<script type="text/javascript">
$(document).ready(function () {
	$('#role_id').select2();
    $("#registrationForm").bootstrapValidator();
});
</script>

      <style type="text/css">
   		th,td{
   			text-align: center;
   		}
   </style>
</body>
<!--Body Ends-->
</html>