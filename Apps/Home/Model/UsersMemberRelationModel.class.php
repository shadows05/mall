<?php
/**
 * Created by PhpStorm.
 * User: bean
 * Date: 2015/12/26
 * Time: 20:29
 */

namespace Home\Model;


class UsersMemberRelationModel extends  BaseModel
{
    public function initMemberRelation($puid,$uid,$reaches,$check_status){
        if($puid==0) return;
        $child_uid = $uid;
        //$data_relation["uid"] = $uid;
        $j = 1;
        for($i=$reaches,$j=1;$i>0;$i--,$j++){
            $parent_id = M("users_member")->where("userId=$child_uid")->getField('parentId');
            $parent_reaches = M("users_member")->where("userId=$parent_id")->getField("reaches");

            $data["puid"] = $parent_id;
            $data["preaches"] = $parent_reaches;
            $data["cuid"] = $uid;
            $data["creaches"] = $reaches;
            $data["check_status"] = $check_status;
            M("users_member_relation")->add($data);

            $child_uid = $parent_id;
        }
    }

    public function getFiveLevelCust($uid){
        // 获取uid所有的上层用户
        $list = M("users_member_relation")->where("cuid = $uid")->order("preaches desc")->select();
        $user_info = array();
        foreach($list as $k=>$v){
            $puid = $v["puid"];
            $p_user_info = M("users_member")->where("userId = $puid")->find();
            if($p_user_info["level"] >= 5){
                $user_info =  M("users")->where("userId = $puid")->find();;
                break;
            }
        }

        return $user_info;
    }

    public function getUserIfCanUpdate($uid){
        $now_level = M("users_member")->where("userId = " . $uid)->getField("level");
        $team_active_count = M("users_member_relation")->where("puid= $uid and check_status = 2")->count();
        if($team_active_count >= 512){
            $new_level = 9;
        }elseif($team_active_count >= 256){
            $new_level = 8;
        }elseif($team_active_count >= 128){
            $new_level = 7;
        }elseif($team_active_count >= 64){
            $new_level = 6;
        }elseif($team_active_count >= 32){
            $new_level = 5;
        }elseif($team_active_count >= 16){
            $new_level = 4;
        }elseif($team_active_count >= 8){
            $new_level = 3;
        }elseif($team_active_count >= 4){
            $new_level = 2;
        }elseif($team_active_count >= 2){
            $new_level = 1;
        }
        if($new_level > $now_level){
            $if_can_update = 1;
        }else{
            $if_can_update  = 0;
        }
        return $if_can_update;
    }

}