<?php
namespace Home\Model;
use Think\Model;
use Think\Page;

class DeptModel extends BaseModel
{

    public function get_dept_list ($dName)
    {
        $paramer = array(
                'dName' => $dName
        );
        $str = " 1 = 1 ";
        if ($dName){
            $str .= " AND dName like '%".$dName."%' ";
        }
        
        $where['_string'] = $str;
        
        $Dept = M('Dept');
        $field = ' count(id) as num ';
        $num = $Dept->field($field)->where($where)->select();
        $total = $num[0]['num'];
        
        $page = new Page($total, 20, $paramer);
        $show = $page->show();

        $data = $Dept->where($where)->limit($page->firstRow, $page->listRows)
            ->order(' id DESC')
            ->select();
        //$data = $this->fix_user_list($data);
        
        return array(
                'show' => $show,
                'data' => $data
        );
    }
    /**
     * 
     * @param unknown $data
     */
    public function fix_user_list($data){
        if (is_array($data)){
            foreach ($data as $key => &$value){
                $value['role_name'] = '';
                if (isset($value['role_id'])){
                    $role_id = $value['role_id'];
                    $role = M('Role');
                    $where = array('id'=> $role_id);
                    $res = $role->where($where)->select();
                    if ($res){
                        $value['role_name'] = $res[0]['name'];
                    }
                }else{
                    $user_id  = $value['id'];
                    $role = M('Role');
                    $where = array('user_id'=> $user_id);
                    $join = ' LEFT JOIN t_role_user ON t_role_user.role_id = t_role.id ';
                    $res = $role->join($join)->where($where)->select();
                    if ($res){
                        $value['role_name'] = $res[0]['name'];
                    }
                }
                
                 
            }
        }
        
        return $data;
    }
    /**
     * 添加部门
     */
    public function addDept ()
    {
        $sql = "insert into ";
    }

    /**
     * 修改部门
     */
    public function editDept ($dName,$remark)
    {
    	$sql = "update t_dept set dName= ".$dName."remark=".$remark;
    }
    

    /**
     * 获取指定的角色下的用户列表
     * $roleIds 格式为 (1,2)
     *
     * @param unknown $roleIds            
     */
    public function getUserListByRoleId ($roleIds)
    {
        $SQL = " SELECT t_user.id,t_user.nickname FROM t_user ";
        $SQL .= " JOIN t_role_user ON t_role_user.user_id = t_user.id ";
        $SQL .= " WHERE t_role_user.role_id in $roleIds ";
        
        $result = $this->query($SQL);
        
        return $result;
    }
}
?>