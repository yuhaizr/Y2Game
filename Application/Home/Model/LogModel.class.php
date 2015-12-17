<?php
namespace Home\Model;
use Think\Page;

class LogModel extends BaseModel
{

    /**
     * 添加日志，记录操作记录信息
     * 
     * @param unknown $data            
     */
    public function addLog ($data)
    {
        $log = M('Log');
        $log->add($data);
    }

    public function logList ($searchNickname, $searchTime)
    {
        
 
        $searchTime = fix_range_time($searchTime);

            
        $startTime = $searchTime['start_date'];
        $endTime = $searchTime['end_date'];
       
        $paramer = array(
                "searchNickname" => $searchNickname,
                "searchTime" => $searchTime
        );
        $numberPerPage = 20;
        $totalNum = 0;
        $where = array();
        $str = ' 1 = 1 ';
        if ($searchNickname) {
        $str .= " AND nickname like '%" . $searchNickname . "%' ";
        }
        
        $str .= " AND ctime < '" . $endTime . "' AND ctime >= '" . $startTime .
                     "' ";
        
        $where['_string'] = $str;
        $log = M('Log');
        $num = $log->field('count(id) as num ')
            ->where($where)
            ->select();
        $totalNum = $num[0]['num'];
        
        $page = new Page($totalNum, 1, $paramer);
        $show = $page->show();
        $logList = $log->where($where)
            ->limit($page->firstRow, $page->listRows)
            ->select();
        
        return array(
                "logList" => $logList,
                "show" => $show
        );
    }

    private function getSearchModuleList ($searchModule)
    {
        $SQL = " SELECT name FROM t_node WHERE  title LIKE '%" . $searchModule .
                 "%'";
        $searchModuleList = $this->query($SQL);
        if (is_array($searchModuleList)) {
            $searchModule = "";
            foreach ($searchModuleList as $k => $val) {
                if ($k == 0) {
                    $searchModule .= "'" . $val['name'] . "'";
                } else {
                    $searchModule .= ",'" . $val['name'] . "'";
                }
            }
        }
        
        return $searchModule;
    }

    /**
     * 获取module,action,function的中文名称
     *
     * @param unknown $logList            
     */
    private function fixLogList ($logList)
    {
        foreach ($logList as $key => $val) {
            $module = $val['module'];
            $action = $val['action'];
            $function = $val['function'];
            
            $moduleData = $this->getModuleActionFunction($module, 0, 1);
            $actionData = $this->getModuleActionFunction($action, 
                    $moduleData['id'], 2);
            $functionData = $this->getModuleActionFunction($function, 
                    $actionData['id'], 3);
            
            $logList[$key]['module'] = $moduleData['title'];
            $logList[$key]['action'] = $actionData['title'];
            $logList[$key]['function'] = $functionData['title'];
        }
        
        return $logList;
    }

    private function getModuleActionFunction ($name, $pid, $level)
    {
        $name = trim($name);
        $data = array();
        if ($pid) {
            $SQL = " SELECT id,title FROM t_node WHERE name LIKE '" . $name . "'" . "
		    AND pid = {$pid}
		    AND level = {$level} ";
            
            // echo $SQL."</br>";
            $data = $this->query($SQL);
        }
        
        if ($data) {
            return $data[0];
        } else {
            return array(
                    'id' => '',
                    'title' => ''
            );
        }
    }
}