<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\DimensionModel;

class DimensionController extends BaseController
{
	/**
	 * 部门管理页面
	 *
	 */
	public  function dimensionList()
	{
		$name = I('name');
		$type = I('type');
		$Dimension = new DimensionModel();
		$data = $Dimension->get_dimension_list($name);
		
		if ('searchDimensionList' == $type){
			$data = json_encode($data);
			echo $data;
			exit();
		}
		$dimensioninfodata = $data['data'];
		
		$this->assign('dimensioninfodata',$dimensioninfodata);
		$this->assign('name',$name);
		$this->assign('page',$data['show']);
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
    public function dimensionadd(){

            $dimension = M('Dimension');
            $data['name'] = I('name');
            $data['percent'] = I('percent');
            $data['remark'] = I('remark');
            $type = I('type');
            
            if ('showadd' == $type){
                $this->display();
                exit();
            }
            
            $percent = $this->judge_percent();
            $percent += $data['percent'];
            
            if($percent >= 100){
                $num = 100 - $this->judge_percent();
                echoJson('1','权重总值不能大于100,剩余权重:'.$num);
            }
            $res = $dimension->add($data);
            if($res){
                   $percent = $this->judge_percent();
                   echoJson('0','添加成功,当前权重总值:'.$percent);
            }else{
                  echoJson('2', '添加失败');
          
            }

    }
    
    /**
     * 修改部门信息
     * 
     */
    public function dimensionedit(){
        $Dimension = M('Dimension');
        $type = I('type');
        $id = I('id');
        $name = I('name');
        $remark = I('remark');
        $percent = I('percent');
        if('showedit' == $type){
            
            $deptinfo = $Dimension -> where("id=$id")->find();
            $this->assign('dimensioninfo',$deptinfo);
            $this->assign('deptid',$id);
            $this->display();
            exit();
        }

       $data['name'] = $name;
       $data['percent'] = $percent;
       $data['remark'] = $remark;
       $where['Id'] = $id;
       
       $dimensionInfo = $Dimension->where($where)->select();
       if($dimensionInfo){
           $old_percent = $dimensionInfo[0]['percent'];
           $num =  $percent - $old_percent;
           $percent = $this->judge_percent();
           $percent += $num;
           if($percent > 100){
               echoJson('1', '权重总值不能大于100');
           }
       }else {
           echoJson('1', '保存失败');
       }
       
       $res = $Dimension->where($where)->save($data);
        if($res){
            $percent = $this->judge_percent();
            $num = 100 - $percent;
            echoJson('0', '保存成功,剩余权重:'.$num);
        }else {
            echoJson('1', '保存失败');
         
        }
        
        

    }
    /**
     * 删除部门
     * 
     */
    public function dimensiondelete(){
        $Dimension = M('Dimension');
        $id = I('id');
        $deleteStatus = $Dimension->where("id=$id")->delete();
        if($deleteStatus){
            $percent = $this->judge_percent();
            $this->success('删除成功,当前权重总值:'.$percent);
       }else{
            $this->error('删除失败');
        }
    }
    
    //判断权重总数是否达到100%
    private function judge_percent(){
        $dimension = M('Dimension');
        $where['is_delete'] = '0';
        $dimensionList = $dimension->where($where)->select();
        
        $percent = 0;
        if(is_array($dimensionList)){
            
            foreach ($dimensionList as $key => $value){
                $percent += $value['percent']; 
            }   
        }
        
        return $percent; 
    }
    
}