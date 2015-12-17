<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;

class UserController extends BaseController
{
    /**
     * 用户管理页面
     * 
     */
    public function index(){
    	
    	$role_id = I('role_id');
    	$nickname = I('nickname');
        $type = I('type');
    	
     	$user = new UserModel();
     	$data = $user->get_user_list($role_id,$nickname);
     	
     	if ('searchUserList' == $type){
     	    $data = json_encode($data);
     	    echo $data;
     	    exit();
     	}
     	$userinfodata = $data['data'];

       
        $role = M('Role');

        $show = $data['show'];
        $roleList = $role->select();
        $role_select[$role_id] = " selected = 'selected' ";
        $this->assign('role_select',$role_select);
        $this->assign('userinfolist',$userinfodata);
        $this->assign('roleList',$roleList);
        $this->assign('nickname',$nickname);
        $this->assign('role_id',$role_id);

        $this->assign('page',$show);
        $this->display();
    }
    
    /**
     * 新增用户
     * 
     */
    public function useradd(){
        if ('POST' == I('server.REQUEST_METHOD')) {
            $User = M('User');
            $data = $_POST;
            switch($data['status']){
                case '1':$data['status'] = 1;break;
                default : $data['status'] = 0;
            }
            $data['password'] = md5($_POST['password']);
            $data['create_time'] = date('Ymd H:i:s');
            $data['update_time'] = date('Ymd H:i:s');
            $data['remark'] = 'dd';
            $data['last_login_ip'] = get_client_ip();
            $data['token'] = guid();
            $data['id'] = null;
            if(!$User -> create($data)){
                $this->error($User->getError());
            }else{
                if($result = $User->add()){
                    $this->crmSuccess('添加成功', U('index'));
                }else{
                    $this->crmError('添加失败', U('useradd'));
                }
            }
            
        }else{
            $this->display();
        }   
    }
    
    /**
     * 修改用户信息
     * 
     */
    public function useredit(){
        $User = M('User');
        if ('POST' == I('server.REQUEST_METHOD')) {
            if(false === $User -> create()){
                $this->error($User -> getError());
            }
//             $password = md5(I('post.password'));
//             $checkPassword = $User -> where("id = {$_POST['id']}")->getField('password');
//             if($checkPassword != $password){
//                 $this->crmError('原密码不正确',U('index'));
//             }
            $_POST['password'] = md5($_POST['password']);
            $data = $User -> save($_POST);
            if(false !== $data){
                $this->crmSuccess('添加成功', U('index'));
            }else{
                $this->crmError('编辑失败',U('useredit'));
            }
        }else{
            $id = I('get.id');
            $userinfo = $User -> where("id=$id")->find();
            $this->assign('userinfo',$userinfo);
            $this->assign('userid',$id);
            $this->display();
        }
    }
    /**
     * 删除用户
     * 
     */
    public function userdelete(){
        $User = M('User');
        $id = I('get.id');
        $deleteStatus = $User -> where("id=$id") -> delete();
        if($deleteStatus){
            $this->success('删除成功');
       }else{
            $this->error('删除失败');
        }
    }
    /**
     * 检查帐号
     * 
     */
    public function checkAccount ()
    {
        if (! preg_match('/^[a-z]\w{4,}$/i', $_POST['account'])) {
            $this->error('用户名必须是字母，且5位以上！');
        }
        $User = M("User");
        // 检测用户名是否冲突
        $name = $_REQUEST['account'];
        $result = $User->getByAccount($name);
        if ($result) {
            $this->error('该用户名已经存在！');
        } else {
            $this->success('该用户名可以使用！');
        }
    }
    
    
    
}