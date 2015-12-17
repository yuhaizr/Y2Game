<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--Head xmlns="http://www.w3.org/1999/xhtml"-->
<head>
    <meta charset="utf-8" />
    <title><?php echo ($page_title); ?></title>

    <meta name="description" content="<?php echo ($page_description); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/fundcrm/Public/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="/fundcrm/Public/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="/fundcrm/Public/css/font-awesome.min.css" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="/fundcrm/Public/css/beyond.min.css" rel="stylesheet" />
    <link href="/fundcrm/Public/css/demo.min.css" rel="stylesheet" />
    <link href="/fundcrm/Public/css/animate.min.css" rel="stylesheet" />
    <link href="/fundcrm/Public/css/load.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	var __URL = '/fundcrm/index.php/Home/Node';
	var __APP = '/fundcrm/index.php';
	var __PUBLIC = '/fundcrm/Public';

	</script>
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/fundcrm/Public/js/skins.min.js"></script>
    <script src="/fundcrm/Public/js/jquery-1.10.2.min.js"></script>
    
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
                            <!-- <img src="/fundcrm/Public/img/logo.png" alt="" /> -->
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
                                			<a href="/fundcrm/index.php/Home/Task/taskList" target="_blank">
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
                                            <li><a class="colorpick-btn" href="#" style="background-color:#5DB2FF;" rel="/fundcrm/Public/css/skins/blue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#2dc3e8;" rel="/fundcrm/Public/css/skins/azure.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#03B3B2;" rel="/fundcrm/Public/css/skins/teal.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#53a93f;" rel="/fundcrm/Public/css/skins/green.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#FF8F32;" rel="/fundcrm/Public/css/skins/orange.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#cc324b;" rel="/fundcrm/Public/css/skins/pink.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#AC193D;" rel="/fundcrm/Public/css/skins/darkred.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#8C0095;" rel="/fundcrm/Public/css/skins/purple.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#0072C6;" rel="/fundcrm/Public/css/skins/darkblue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#585858;" rel="/fundcrm/Public/css/skins/gray.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#474544;" rel="/fundcrm/Public/css/skins/black.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#001940;" rel="/fundcrm/Public/css/skins/deepblue.min.css"></a></li>
                                        </ul>
                                    </li>
                                    <!--/Theme Selector Area-->
                                    <li class="dropdown-footer">
                                        <a href="/fundcrm/index.php/Home/login/logout">
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
                        				<?php if(empty($v["childs"])): ?><a href="/fundcrm/index.php<?php echo ($v["link"]); ?>" target="_blank">
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                               
			                                </a> 
		                               	<?php else: ?>
		                               		<a href="#" class="menu-dropdown">
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                                    <i class="menu-expand"></i>
				                            </a> 
				                            <ul class="submenu">
				                                <?php if(is_array($v["childs"])): foreach($v["childs"] as $key=>$cv): ?><li>
						                                	  <a href="/fundcrm/index.php<?php echo ($cv["link"]); ?>" target="_blank">
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
	                <span class="widget-caption">录音记录列表</span>
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
	      			<div class="table-toolbar row ">
	      				<div class="col-sm-8">
		      				<div class="table-toolbar row">
			   	                <div class="search-box col-sm-6" >
				                    <div class="form-group">
				                        <div class="controls">
				                            <div class="input-group">
				                                <span class="input-group-addon">
				                                    <i class="fa fa-calendar"></i>
				                                </span>
				                                <input type="text" value="<?php echo ($searchMtimeRange); ?>" class="form-control" id="searchMtimeRange" placeholder="请选择需要统计的时间区间" />
				                            </div>
				                        </div>
				                    </div> 
			                	</div>	                    
			   	                <div class="search-box col-sm-6" >
			                		<div>
			                			<span class="input-icon">
			                				<input type="text" value="<?php echo ($searchRealName); ?>" id='searchRealName' class="form-control"  placeholder="请输入客户姓名">
			                				<i class="glyphicon glyphicon-search circular blue"></i>
			                			</span>
			                		</div>
			                	</div>	                                      
		                	</div>
		      				<div class="table-toolbar row" >
			   	                <div class="search-box col-sm-6" >
			                		<div>
			                			<span class="input-icon">
			                				<input type="text" value="<?php echo ($searchNickname); ?>" id='searchNickname' class="form-control"  placeholder="请输入对接人姓名">
			                				<i class="glyphicon glyphicon-search circular blue"></i>
			                			</span>
			                			
			                		</div>
			                	</div>	                    
			   	                <div class="search-box col-sm-6" >
			                		<div>
			                			<span class="input-icon">
			                				<input type="text" value="<?php echo ($searchMobileNo); ?>" id='searchMobileNo' class="form-control"  placeholder="请输入客户手机号">
			                				<i class="glyphicon glyphicon-search circular blue"></i>
			                			</span>
			                		</div>
			                	</div>	                                      
		                	</div>
	               	 	</div>
	                <div class="table-toolbar row">
		                <div class='col-sm-4'>
			      			<div class="table-toolbar row">                 
			      			</div>
			      			<div class="table-toolbar row">                 
			   	                <div class="search-box col-sm-12" >
			                		<div>
			                			
			               				<a class='btn btn-default' id="tapeListSearch">搜索</a>
			                	
			                		</div>
			                	</div>	                    
			                </div>
			        	 </div>
		        	 </div>
		        </div>
	                <table class="table table-striped table-hover table-bordered" id="editabledatatable">
	                    <thead>
	                        <tr role="row">
	                            <th>序号</th>
	                            <th>时间</th>
	                            <th>对接人姓名</th>
	                      
	                            <th>主叫者</th>
	                            <th>被叫者</th>	
	                            <th>客户姓名</th>	
	                            <th>呼入呼出</th>                      
	                            <th>录音</th>
	
	                        </tr>
	                    </thead>
	
	                    <tbody id="tapeListTable">
	                     <audio class="audio_class" controls="controls" src="" id = "audio_id" preload="preload"> </audio>
	                    	<?php if(is_array($tapeList)): foreach($tapeList as $key=>$vo): ?><tr>

	                            <td><?php echo ($key+1); ?></td>
	                            <td><?php echo ($vo["pc_call_time"]); ?></td>	                            
	                            <td><?php echo ($vo["pc_user_name"]); ?></td>
	                          	                          
	                            <td><?php echo ($vo["pc_caller_num"]); ?></td>
	                            <td><?php echo ($vo["pc_callee_num"]); ?></td>
	                            <td><?php echo ($vo["realname"]); ?></td>
	                            <td> <?php echo ($vo["pc_direction"]); ?> </td> 
	                          
	                            <td>
	                            <a class ="openvocfile" data-ip="<?php echo ($vo["ip"]); ?>" data-cert="<?php echo ($vo["cert"]); ?>" data-nonce="<?php echo ($vo["nonce"]); ?>" data-msg ="<?php echo ($vo["msg"]); ?>" target="__blank" href="javascript:void(0);">播放</a>
	                            </td>
	
	                        </tr><?php endforeach; endif; ?>                        
	                    </tbody>
	                </table><br/>
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
					url:"/fundcrm/index.php/Home/Task/read_task_message",
					type:"POST",
					data:data,
					dataType:'json',
					success:function(data){
						
						var random = Math.random();
						location.href = "/fundcrm/index.php"+data.url + '&random=' + random;
						
					}
				});   
	    		
	    	});    	
	    	
	    });

    </script>   
    
    
<!--Basic Scripts-->
<script src="/fundcrm/Public/js/jquery-2.0.3.min.js"></script>
<script src="/fundcrm/Public/js/bootstrap.min.js"></script>

<!--Beyond Scripts-->
<script src="/fundcrm/Public/js/beyond.min.js"></script>
<script src="/fundcrm/Public/js/select2/select2.js"></script>  

<!--Bootstrap Date Picker-->
<script src="/fundcrm/Public/js/datetime/bootstrap-datepicker.js"></script>

<!--Bootstrap Time Picker-->
<script src="/fundcrm/Public/js/datetime/bootstrap-timepicker.js"></script>

<!--Bootstrap Date Range Picker-->
<script src="/fundcrm/Public/js/datetime/moment.js"></script>
<script src="/fundcrm/Public/js/datetime/daterangepicker.js"></script>

<script type="text/javascript">
  $(function(){
		$("#searchMtimeRange").daterangepicker({
			format:"YYYY-MM-DD",
			separator : '__',
			locale:{
				applyLabel:"确定",
				cancelLabel:"取消",
				fromLabel:"从",
				toLabel:"到"
			}
		});
  });
  

$("#tapeListSearch").click(function(e){
	
 	searchTapeList();
 	

});

function searchTapeList(){
	var searchNickname = $("#searchNickname").val();
	var searchMobileNo = $("#searchMobileNo").val();
	var searchMtimeRange = $("#searchMtimeRange").val();
	var searchRealName = $("#searchRealName").val();
	var data = {"searchMobileNo":searchMobileNo
			,"searchNickname":searchNickname
			,"searchMtimeRange":searchMtimeRange
			,"searchRealName":searchRealName
			,"type":"searchTapeList"};
	$.ajax({
		type: "POST",
		url: '/fundcrm/index.php/Home/Tape/tapeList',
		data: data,
		dataType: 'json',
		success: function(dt) {	
	
			var show = dt.show;
			$("#pageUl").html(show);
			dt = dt.tapeList;
			var html = "";
			$.each(dt,function(k,v){

				var num = k + 1;//realname
				html += "<tr><td>"+num+"</td>";
				html += "<td>"+v.pc_call_time+"</td>";
				html += "<td>"+v.pc_user_name+"</td>";
				
				html += "<td>"+v.pc_caller_num+"</td>";
				html += "<td>"+v.pc_callee_num+"</td>";
				html += "<td>"+v.realname+"</td>";
				html += "<td>"+v.pc_direction+"</td>";
				//html += "<td><a target='__blank'  href='/fundcrm/index.php"+v.pc_vocfile+".mp3'>播放</a></td></tr>";
				html +='<td><a class ="openvocfile" data-ip="'+v.ip+'" data-cert="'+v.cert+'" data-nonce="'+v.nonce+'" data-msg ="'+v.msg+'" target="__blank" href="javascript:void(0);">播放</a></td>';
			});
			
			$("#tapeListTable").html(html);
			
			
			
		}
	
	});	
}


</script>
<script type="text/javascript">
	$("body").on('click','.openvocfile',function(){
		
		var msg = $(this).attr("data-msg");
		var cert = $(this).attr("data-cert");
		var nonce = $(this).attr("data-nonce");
		var ip = $(this).attr("data-ip");
		

		var src_url = "/fundcrm/index.php/Home/Tape/openTape?type=openTape"+"&msg="+msg+"&cert="+cert+"&nonce="+nonce+"&ip="+ip;
		$("#audio_id").attr("src",src_url);
		
		
		
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