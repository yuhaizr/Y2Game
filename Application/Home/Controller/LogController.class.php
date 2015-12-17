<?php
namespace Home\Controller;

use Home\Controller\BaseController;
use Home\Model\LogModel;
class LogController extends BaseController
{
	public function logList(){
		
		$searchNickname = "";
		$searchModule = "";
		$startTime = "";
		$endTime = "";
		
		$searchNickname = I("searchNickname");
	
        $searchTime = I("searchTime");
		
		$type = I("type");
		
		if (!$searchTime){
		    $searchTime = date('Y-m-d')."__".date('Y-m-d');
		}
		
		$log = new LogModel();
		$list = $log->logList($searchNickname
								,$searchTime);
		if ("searchLog" == $type){
			$list = json_encode($list,true);
			echo $list;
			exit();
		}
		
		
		$this->assign('logList',$list['logList']);
		$this->assign('searchNickname',$searchNickname);

		$this->assign('searchTime',$searchTime);
		$this->assign('page',$list['show']);
		
		$this->display();
		
	}
}