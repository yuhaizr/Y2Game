<?php
return array(
     array(
        'title' => '角色管理',
        'link' => '/Home/Role',
        'icon' => '',
        'childs' => array(
                array(
                    'title' => '角色列表',
                    'link' => '/Home/Role/roleList'
                )
        )
        
    ),
    array(
        'title' => '用户管理',
        'link' => '/Home/User',
        'icon' => '',
        'childs' => array(
            array(
                'title' => '用户列表',
                'link' => '/Home/User/index'
            )
        )
   ),
	
		
	array(
			'title' => '日志管理',
			'link' => '/Home/Log',
			'icon' => '',
			'childs' => array(
					array(
							'title' => '日志列表',
							'link' => '/Home/Log/logList'
					),
			)
	),		
	array(
			'title' => '行政区管理',
			'link' => '/TRQGL/District',
			'icon' => '',
			'childs' => array(
					array(
							'title' => '行政区列表',
							'link' => '/TRQGL/District/districtList'
					),
					array(
							'title' => '添加行政区',
							'link' => '/TRQGL/District/addDistrict'
					),
			)
	),		

		
)
?>