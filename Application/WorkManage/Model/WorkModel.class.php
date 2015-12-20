<?php
namespace WorkManage\Model;
use Home\Model\BaseModel;
use Think\Page;

class WorkModel extends BaseModel
{
    // 获取工作日志列表
    public function getWorklist ($workType, $synopsis, $timerange,$show)
    {
        $where = array();
        $paramer = array(
                 'workType' => $workType,
                'synopsis' => $synopsis,
                'searchTime' => $timerange,
                'show' => $show
        );
        
        if ('my' == $show){
            $userId = $_SESSION['authId'];
            $where['userId'] = $userId;
        }elseif ('member' == $show){
            $userId = $_SESSION['authId'];
            $member_id_list = $this->get_member_id_list($userId);
            $where['userId'] = array('in',$member_id_list);
        }
        
        $timerange_arr = fix_range_time($timerange);
        $start_time = $timerange_arr['start_date'];
        $end_time = $timerange_arr['end_date'];
        
        $where['isDelete'] = '0';
        if ($workType) {
            $where['workType'] = $workType;
        }

        $str = '';
        if ($timerange) {
            $str = " ctime < '" . $end_time . "' AND ctime >= '" . $start_time .
                     "' ";
        }
        if ($str){
            $where['_string'] = $str;
        }
        
        
        if ($synopsis) {
            $where['synopsis'] = array(
                    'like',
                    "%" . $synopsis . "%"
            );
        }
        
        $work = M('work');
        
        $totalNum = $work->where($where)->count('id');

        
        $page = new Page($totalNum, 20, $paramer);
        $show = $page->show();
        $list = $work->where($where)
            ->limit($page->firstRow, $page->listRows)
            ->select();
        
        $list = $this->fixWorkList($list);
        
        return array(
                'list' => $list,
                'show' => $show
        );
    }
    
    /**
     * 通过user_id 获取他的用户成员
     * @param unknown $user_id
     */
    private function get_member_id_list($user_id){
        $member_id_list = array();
        
        if ($user_id){
            $level = $this->get_level($user_id);
            if (-1 != $level){
                $level = $level + 1;
                $where['level'] = $level;
                $where['s_id'] = $user_id;
                $user = M('User');
                $member_list = $user->where($where)->select();
                if ($member_list){
                    foreach ($member_list as $k => $v){
                        $id = $v['id'];
                        $member_id_list[] = $id;
                    }
                }
            }
        }
        
        
        return $member_id_list;
        
    }
    /**
     * 通过user_id 获取他的 level
     * @param unknown $user_id
     */
    private function get_level($user_id){
        $user  = M('User');
        $where['id'] = $user_id;
        $member = $user->where($where)->select();
        if($member){
            return $member[0]['level'];
        }else {
            return -1;
        }
    }

    private function fixWorkList ($list)
    {
        return $list;
    }
    
    public function fix_workDetailData($data){
        $workDetailList = array();
        $work_id = $data['id'];
        $workType = $data['worktype'];
        $workTypeList = C('workTypeList');
        $worktype_name = $workTypeList[$workType];
        
        $where['workId'] = $work_id;
        $where['isDelete'] = '0';
        $workdetail = M('Workdetail');
        
        $workDetailList = $workdetail->where($where)->select();
        $data['workDetailList'] = $workDetailList;
        $data['worktype_name'] = $worktype_name;
        return $data;
    }
    
}

