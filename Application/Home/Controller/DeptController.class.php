<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\DeptModel;

class DeptController extends BaseController
{
	/**
	 * 部门管理页面
	 *
	 */
	public  function deptList()
	{
		$dName = I('name');
		$type = I('type');
		$dept = new DeptModel();
		$data = $dept->get_dept_list($dName);
		
		if ('searchDeptList' == $type){
			$data = json_encode($data);
			echo $data;
			exit();
		}
		$deptinfodata = $data['data'];
		
		 
		 
		$this->assign('deptinfolist',$deptinfodata);
		$this->assign('dName',$dName);
		$this->assign('page',$show);
		$this->display();
	}
	
	
    /**
     * 部门管理页面
     * 
     */
    public function index(){
    	
    	//$role_id = I('role_id');
    	$dName = I('dName');
        $type = I('type');
    	
     	$dept = new DeptModel();
     	$data = $dept->get_dept_list($dName);
     	
     	if ('searchDeptList' == $type){
     	    $data = json_encode($data);
     	    echo $data;
     	    exit();
     	}
     	$deptinfodata = $data['data'];

       
       
        $this->assign('deptinfolist',$deptinfodata);
        $this->assign('dName',$dName);
        $this->assign('page',$show);
        $this->display();
    }
    
    /**
     * 新增部门
     * 
     */
    public function deptadd(){
        
            $Dept = M('Dept');

            $data['dName'] = I('dName');
            $data['remark'] = I('remark');
            $type = I('type');
            if('show' == $type){
            	$this->display();
            }
              else{  if($result = $Dept->add($data))
                {
                    $this->crmSuccess('添加成功', U('deptList'));
                }
                else
                {
                    $this->crmError('添加失败', U('deptadd'));
                }
            
         
            $this->display();
              }
        
    }
    
    /**
     * 修改部门信息
     * 
     */
    public function deptedit(){
        $Dept = M('Dept');
        //$data = $_POST;
         
        $id = I('id');
        $where['id'] = $id;
        $dept  = M('Dept');
        $deptinfo = $dept->where($where)->select();
        if (!$deptinfo){
            $this->error('获取部门信息失败');
        }else {
            $deptinfo = $deptinfo[0];
        }

        $this->assign('deptinfo',$deptinfo);

        $this->display();
   
           
    }
    
    public function edit(){
    	$Dept = M('Dept');
    	//$data = $_POST;
    	
    	$where['id'] = I('id');
    	$data['dName'] = I('dName');
    	$data['remark'] = I('remark');
    	
    	
    	 
    	$data = $Dept->where($where)->save($data);
    	if($data)
    	{
    		$this->crmSuccess('修改成功', U('deptList'));
    	}else
    	{
    		$this->crmError('编辑失败',U('deptedit'));
    	}
    }
    /**
     * 删除部门
     * 
     */
    public function deptdelete(){
        $Dept = M('Dept');
        $id = I('get.id');
        $deleteStatus = $Dept -> where("id=$id") -> delete();
        if($deleteStatus){
            $this->success('删除成功');
       }else{
            $this->error('删除失败');
        }
    }
}