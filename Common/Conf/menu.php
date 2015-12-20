<?php
return array(

	array(
			'title' => '工作日志管理',
			'link' => '/WorkManage/Work',
			'icon' => '',
			'childs' => array(
					array(
							'title' => '我的日志',
							'link' => '/WorkManage/Work/worklist?type=menu&show=my'
					),
					array(
							'title' => '部员日志',
							'link' => '/WorkManage/Work/worklist?type=menu&show=member'
					),
			
			)
	),		
	array(
			'title' => '系统设置',
			'link' => '/Home/System',
			'icon' => '',
			'childs' => array(
                array(
                    'title' => '角色列表',
                    'link' => '/Home/Role/roleList?type=menu'
                ),
		        array(
		                'title' => '用户列表',
		                'link' => '/Home/User/index?type=menu'
		        ),
		        array(
		                'title' => '日志列表',
		                'link' => '/Home/Log/logList?type=menu'
		        ),
		        array(
		                'title' => '权重列表',
		                'link' => '/Home/Dimension/dimensionList?type=menu'
		        ),
			)
	),		

		
)
?>