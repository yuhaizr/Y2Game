<?php
namespace WorkManage\Controller;
use WorkManage\Model\WorkModel;
use Home\Controller\BaseController;

class WorkController extends BaseController
{

    public function workList ()
    {
        $workType = I('workType');
        $synopsis = I('synopsis');
        $timerange = I('searchTime');
        $type = I('type');
        $show = I('show');
        
        if (! $show) {
            $this->error('show 参数丢失');
            exit();
        }
        
        $workModel = new WorkModel();
        $data = $workModel->getWorklist($workType, $synopsis, $timerange, $show);
        
        if ('workList' == $type) {
            $data = json_encode($data);
            echo $data;
            exit();
        }
        
        $workTypeList = C('workTypeList');
        $workTypeSelect[$workType] = " selected='selected' ";
        
        $list = $data['list'];
        $page = $data['show'];
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('workTypeSelect', $workTypeSelect);
        $this->assign('workTypeList', $workTypeList);
        $this->assign('workType', $workType);
        $this->assign('synopsis', $synopsis);
        $this->assign('searchTime', $timerange);
        $this->assign('show', $timerange);
        
        $this->display();
    }

    public function delWork ()
    {
        $work_id = I('work_id');
        if (! $work_id) {
            echoJson('1', 'work_id丢失');
        }
        $work = M('Work');
        $data['isDelete'] = '1';
        $data['mtime'] = date('Y-m-d H:i:s');
        $where['id'] = $work_id;
        $res = $work->where($where)->save($data);
        if ($res) {
            echoJson('0', '删除成功');
        } else {
            echoJson('2', '删除失败');
        }
    }

    public function workDetail ()
    {
        $work_id = I('work_id');
        $type = I('type');
        if (! $work_id) {
            echoJson('1', 'work_id丢失');
        }
        $work = M('Work');
        $where['id'] = $work_id;
        $data = $work->where($where)->select();
        if ('workDetail' == $type) {
            if ($data) {
                $workmodel = new WorkModel();
                $data = $data[0];
                $data = $workmodel->fix_workDetailData($data);
                echoJson('0', '成功获取工作日志详情', $data);
            } else {
                echoJson('2', '获取工作日志详情失败');
            }
        }
        $this->assign('data', $data);
        $this->display();
    }
    // 添加工作日志
    public function addwork ()
    {
        $workType = I('workType');
        $synopsis = I('synopsis');
        $type = I('type');
        if (! $workType || ! $synopsis) {
            $this->error('参数缺失');
        }
        
        $work = M('Work');
        
        $data['synopsis'] = $synopsis;
        $data['workType'] = $workType;
        $data['date'] = date('Y-m-d');
        $data['ctime'] = date('Y-m-d H:i:s');
        $data['mtime'] = date('Y-m-d H:i:s');
        $data['isDelete'] = '0';
        $data['userId'] = $_SESSION['authId'];
        
        if ('addwork' == $type) {
            $res = $work->add($data);
            if ($res) {
                echoJson('0', '添加成功', $res);
            } else {
                echoJson('1', '添加失败');
            }
        }
    }
    // 保存工作日志
    public function savework ()
    {
        $workType = I('workType');
        $synopsis = I('synopsis');
        $type = I('type');
        $work_id = I('work_id');
        
        if (! $work_id || ! $synopsis) {
            $this->error('参数缺失');
        }
        if ($synopsis){
            $data['synopsis'] = $synopsis;
        }
        if ($workType){
            $data['workType'] = $workType;
        }
        
        $data['mtime'] = date('Y-m-d H:i:s');
        
        $where['id'] = $work_id;
        $work = M('Work');
        $res = $work->where($where)->save($data);
        if ($res) {
            echoJson('0', '保存成功');
        } else {
            echoJson('1', '保存失败');
        }
    }
    // 添加工作日志详情
    public function add_workdetail ()
    {
        $workdetail_userDtm = I('workdetail_userDtm');
        $workdetail_content = I('workdetail_content');
        $work_id = I('work_id');
        
        $type = I('type');
        if (! $workdetail_userDtm || ! $workdetail_content) {
            $this->error('参数缺失');
        }
        
        if ('add_workdetail' == $type) {
            $data['content'] = $workdetail_content;
            $data['userDtm'] = $workdetail_userDtm;
            $data['workId'] = $work_id;
            $workdetail = M('Workdetail');
            $res = $workdetail->add($data);
            if ($res) {
                echoJson('0', '添加成功', $res);
            } else {
                echoJson('1', '添加失败');
            }
        }
    }
    // 删除工作日志详情
    public function delWorkdetail ()
    {
        $work_detail_id = I('work_detail_id');
        if (! $work_detail_id) {
            echoJson('1', 'work_detail_id丢失');
        }
        $workdetail = M('Workdetail');
        $data['isDelete'] = '1';
        $data['mtime'] = date('Y-m-d H:i:s');
        $where['id'] = $work_detail_id;
        $res = $workdetail->where($where)->save($data);
        if ($res) {
            echoJson('0', '删除成功');
        } else {
            echoJson('2', '删除失败');
        }
    }
    // 保存工作日志详情
    public function save_workdetail ()
    {
        $workdetail_userDtm = I('workdetail_userDtm');
        $workdetail_content = I('workdetail_content');
        $work_detail_id = I('work_detail_id');
        
        $type = I('type');
        if (! $workdetail_userDtm || ! $workdetail_content || ! $work_detail_id) {
            $this->error('参数缺失');
        }
        if ('save_workdetail' == $type) {
            $data['content'] = $workdetail_content;
            $data['userDtm'] = $workdetail_userDtm;
            $where['id'] = $work_detail_id;
            $workdetail = M('Workdetail');
            $res = $workdetail->where($where)->save($data);
            if ($res) {
                echoJson('0', '添加成功', $res);
            } else {
                echoJson('1', '添加失败');
            }
        }      
        
    }
    //获取工作日志详情信息
    public function get_workdetail(){
        
        $work_detail_id = I('work_detail_id');
        
        $type = I('type');
        if (! $work_detail_id) {
            $this->error('参数缺失');
        }  

        if ('get_workdetail' == $type) {

            $where['id'] = $work_detail_id;
            $workdetail = M('Workdetail');
            $res = $workdetail->where($where)->select();
            if ($res) {
                echoJson('0', '获取成功', $res[0]);
            } else {
                echoJson('1', '获取失败');
            }
        }
    }
    
}