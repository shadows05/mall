<?php
/**
 * Created by PhpStorm.
 * User: bean
 * Date: 2015/12/26
 * Time: 12:53
 */

namespace Admin\Model;


use Think\Model;

class UsersMemberModel extends  BaseModel
{

    public function insertTopMember($user){
        $data["userId"] = $user["userId"];
        $data["parentId"] = 0;
        $data["recommendId"] = 0;
        $data["reaches"] = 0;
        $data["level"] = 9;
        $data["bdiraction"] = 1;
        $data["status"] = 2;
        $data["createTime"] = date('Y-m-d H:i:s');
        $data["lastTime"] = date('Y-m-d H:i:s');
        M('users_member')->add($data);
    }
}