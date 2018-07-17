<?php
namespace app\admin\controller;

class User  extends AdminBase
{
   
    public function userList()   
    {
    	
        echo "<pre>";
        $users =  model('User')->getUsers();

        print_r($users);

        exit;
        $this->assign("users",$users);
        return $this->fetch();
    }

    public function addUser(){
        // $input = input();

        $input = array(
            'user_login'  =>  'thinkphp',
            'email' =>  'thinkphp@qq.com',
            'user_phone' =>  '1226740471'
        );

        $info =  model('User')->addUser($input);
        
        print_r($info);
        exit;
        return json(['code'=>1,'msg'=>'添加成功']);

    }
    
    public function delUser(){
        
        $userId = 3;
        $info   =  model('User')->delUser($userId);
        
        print_r($info);
        exit;
        return json(['code'=>1,'msg'=>'添加成功']);
        
    }
    
    public function updateUser(){
        $input = array(
            'user_login'  =>  'admin5555',
            'email' =>  'thinkphp@qq.com',
            'user_phone' =>  '15889745718'
        );
        $userId = 4;
        $info   =  model('User')->updateUser($input,$userId);
        
        print_r($info);
        exit;
        return json(['code'=>1,'msg'=>'添加成功']);
        
    }

    public function userRole()   
    {
    	

        return $this->fetch();
    }

    public function roleAuth()   
    {
    
    
        include APP_PATH."admin/conf/menu.php";

        $this->assign("menu",$menu['admin']);	

        return $this->fetch();
    }


    public function addRoleAuth(){

        if(request()->isPost()) {

            // microtime()前部分为毫秒 后半部分为秒   用前后先加 就可以获取到当前时间
            // 精确到毫秒的时间戳 多次提交表单 时间差在1秒之内就提示
            $submit_time = explode(' ', microtime());
            $submit_time = ($submit_time[0]/1000)+$submit_time[1];

            $data     = input();
            $role_id  = $data["role_id"];
            $action   = $data['action'];

            
            // 防止表单在极短时间重复提交  （有些强迫症患者提交按钮时喜欢快速点击两次）
            if(!Session('submit_time')) {
                Session('submit_time',$submit_time);
                
               return json(['code'=>1,'msg'=>'添加成功1']);
  
            }else{

                $session_submit_time = Session('submit_time');

                if(($submit_time - $session_submit_time) < 1) 

                    return json(['code'=>2,'msg'=>'不要重复提交表单']);
                else

                    Session('submit_time',$submit_time); // 刷新session值
                    // to do

                    
                    return json(['code'=>1,'msg'=>'添加成功2']);
            }
            
        }
       
    }

}
