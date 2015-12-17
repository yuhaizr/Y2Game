<?php
namespace Home\Model;
use Think\Model;
use Think\Page;

class UserModel extends Model
{

    public function get_user_list ($role_id,$nickname)
    {
        $paramer = array(
                'nickname' => $nickname,
                'role_id' => $role_id
        );
        $str = " 1 = 1 ";
        if ($nickname){
            $str .= " AND nickname like '%".$nickname."%' ";
        }
        $join = "";
        if ($role_id){
            $join = ' LEFT JOIN t_role_user ON t_role_user.user_id = t_user.id ';
            $str .= " AND t_role_user.role_id = ".$role_id;
        }
        
        $where['_string'] = $str;
        $User = M('User');
        $field = ' count(id) as num ';
        $num = $User->field($field)->join($join)->where($where)->select();
        $total = $num[0]['num'];
        
        $page = new Page($total, 20, $paramer);
        $show = $page->show();

        $data = $User->join($join)->where($where)->limit($page->firstRow, $page->listRows)
            ->order(' id DESC')
            ->select();
        $data = $this->fix_user_list($data);
        
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
     * 添加用户
     */
    public function addUser ()
    {
        $sql = "insert into ";
    }

    public function getUserListByRoleName ($role_name)
    {
        $sql = "select t_user.id,t_user.nickname ";
        $sql .= " ,(SELECT count(t_lost_call_customer.id)  FROM t_lost_call_customer WHERE t_lost_call_customer.user_id = t_user.id ) as lostCallNum ";
        $sql .= " FROM t_user  JOIN t_role_user ON t_role_user.user_id = t_user.id ";
        $sql .= " JOIN t_role ON t_role_user.role_id = t_role.id ";
        $sql .= " WHERE t_role.name like '" . $role_name . "'";
        
        $result = $this->query($sql);
        
        return $result;
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