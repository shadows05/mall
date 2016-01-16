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

    public function get_child_count($userId, $leftId, $middleId, $rightId){
        $count = array("left"=>0,"middle"=>0,"right"=>0);
        if($leftId > 0){
            $count["left"] = M("users_member_relation")->where("puid = $leftId")->count() + 1;
        }
        if($middleId > 0){
            $count["middle"] = M("users_member_relation")->where("puid = $middleId")->count() + 1;
        }
        if($rightId > 0){
            $count["right"] = M("users_member_relation")->where("puid = $rightId")->count() + 1;
        }
        return $count;

    }

    public function generateTeamStructure($uid){
        // 获取此uid的 b_left b_middle b_right
        //$structure_info = array();
        $user_ifo = M("users_member")->find($uid);
        $user_ifo["base"] =  M("users")->find($uid);
        $user_ifo["base"]["url"] = U("Admin/Index/map?userId=".$user_ifo["userId"]);
        $user_ifo["count"] = $this->get_child_count($user_ifo["userId"],$user_ifo['b_left_user_id'],$user_ifo['b_middle_user_id'],$user_ifo['b_right_user_id']);

        if($user_ifo["status"] != 2){
            $structure =    '<div class="strt-part">'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$user_ifo["base"]["url"].'">'.$user_ifo["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($user_ifo["level"]).'</th></tr><tr><td>'.$user_ifo["count"]["left"].'</td><td>'.$user_ifo["count"]["middle"].'</td><td>'.$user_ifo["count"]["right"].'</td></tr></table></div>'.
                '</div>';
        }else{
            $structure =    '<div class="strt-part">'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$user_ifo["base"]["url"].'">'.$user_ifo["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($user_ifo["level"]).'</th></tr><tr><td>'.$user_ifo["count"]["left"].'</td><td>'.$user_ifo["count"]["middle"].'</td><td>'.$user_ifo["count"]["right"].'</td></tr></table></div>'.
                '	<div class="line-v"><span></span></div>'.
                '	<div class="strt-block">'.
                $this->getChildStructure($uid).
                '	</div>'.
                '</div>';

        }

        return $structure;

    }

    private function getChildStructureNext($uid){

        $user_ifo = M("users_member")->find($uid);
        $user_ifo["base"] =  M("users")->find($uid);
        $user_ifo["base"]["url"] = U("Admin/Index/map?userId=".$user_ifo["userId"]);
        $user_ifo["count"] = $this->get_child_count($user_ifo["userId"],$user_ifo['b_left_user_id'],$user_ifo['b_middle_user_id'],$user_ifo['b_right_user_id']);
        if($user_ifo["status"] != 2){
            return "";
        }

        $left_structure = $middle_structure = $right_structure = "";
        if($user_ifo["b_left_user_id"] == 0){
            $left_structure .=  '    <div class="strt-part">'.
                '			<span class="line-h line-h-r"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=0&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=0&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $left_user_info = M("users_member")->find($user_ifo["b_left_user_id"]);
            $left_user_info["base"] =  M("users")->find($user_ifo["b_left_user_id"]);
            $left_user_info["base"]["url"] = U("Admin/Index/map?userId=".$left_user_info["userId"]);
            $left_user_info["count"] = $this->get_child_count($left_user_info["userId"],$left_user_info['b_left_user_id'],$left_user_info['b_middle_user_id'],$left_user_info['b_right_user_id']);

            $left_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-r"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$left_user_info["base"]["url"].'">'.$left_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($left_user_info["level"]).'</th></tr><tr><td>'.$left_user_info["count"]["left"].'</td><td>'.$left_user_info["count"]["middle"].'</td><td>'.$left_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div></div>';
        }


        if($user_ifo["b_middle_user_id"] == 0){
            $middle_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-c"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=1&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=1&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $middle_user_info = M("users_member")->find($user_ifo["b_middle_user_id"]);
            $middle_user_info["base"] = M("users")->find($user_ifo["b_middle_user_id"]);
            $middle_user_info["base"]["url"] = U("Admin/Index/map?userId=".$middle_user_info["userId"]);
            $middle_user_info["count"] = $this->get_child_count($middle_user_info["userId"],$middle_user_info['b_left_user_id'],$middle_user_info['b_middle_user_id'],$middle_user_info['b_right_user_id']);

            $middle_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-c"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$middle_user_info["base"]["url"].'">'.$middle_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($middle_user_info["level"]).'</th></tr><tr><td>'.$middle_user_info["count"]["left"].'</td><td>'.$middle_user_info["count"]["middle"].'</td><td>'.$middle_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div></div>';
        }


        if($user_ifo["b_right_user_id"] == 0){
            $right_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-l"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=2&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=2&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $right_user_info = M("users_member")->find($user_ifo["b_right_user_id"]);
            $right_user_info["base"] =  M("users")->find($user_ifo["b_right_user_id"]);
            $right_user_info["base"]["url"] = U("Admin/Index/map?userId=".$right_user_info["userId"]);
            $right_user_info["count"] = $this->get_child_count($right_user_info["userId"],$right_user_info['b_left_user_id'],$right_user_info['b_middle_user_id'],$right_user_info['b_right_user_id']);

            $right_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-l"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$right_user_info["base"]["url"].'">'.$right_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($right_user_info["level"]).'</th></tr><tr><td>'.$right_user_info["count"]["left"].'</td><td>'.$right_user_info["count"]["middle"].'</td><td>'.$right_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div></div>';
        }
        return $left_structure . $middle_structure . $right_structure;

    }

    private function getChildStructure($uid){



        $user_ifo = M("users_member")->find($uid);
        $user_ifo["base"] =  M("users")->find($uid);
        $user_ifo["base"]["url"] = U("Admin/Index/map?userId=".$user_ifo["userId"]);
        $user_ifo["count"] = $this->get_child_count($user_ifo["userId"],$user_ifo['b_left_user_id'],$user_ifo['b_middle_user_id'],$user_ifo['b_right_user_id']);
        if($user_ifo["status"] != 2){
            return "";
        }

        $left_structure = $middle_structure = $right_structure = "";
        if($user_ifo["b_left_user_id"] == 0){
            $left_structure .=  '    <div class="strt-part">'.
                '			<span class="line-h line-h-r"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=0&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=0&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $left_user_info = M("users_member")->find($user_ifo["b_left_user_id"]);
            $left_user_info["base"] =  M("users")->find($user_ifo["b_left_user_id"]);
            $left_user_info["base"]["url"] = U("Admin/Index/map?userId=".$left_user_info["userId"]);
            $left_user_info["count"] = $this->get_child_count($left_user_info["userId"],$left_user_info['b_left_user_id'],$left_user_info['b_middle_user_id'],$left_user_info['b_right_user_id']);

            $left_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-r"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$left_user_info["base"]["url"].'">'.$left_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($left_user_info["level"]).'</th></tr><tr><td>'.$left_user_info["count"]["left"].'</td><td>'.$left_user_info["count"]["middle"].'</td><td>'.$left_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructureNext($user_ifo["b_left_user_id"]).
                '   </div></div>';
        }


        if($user_ifo["b_middle_user_id"] == 0){
            $middle_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-c"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=1&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=1&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $middle_user_info = M("users_member")->find($user_ifo["b_middle_user_id"]);
            $middle_user_info["base"] = M("users")->find($user_ifo["b_middle_user_id"]);
            $middle_user_info["base"]["url"] = U("Admin/Index/map?userId=".$middle_user_info["userId"]);
            $middle_user_info["count"] = $this->get_child_count($middle_user_info["userId"],$middle_user_info['b_left_user_id'],$middle_user_info['b_middle_user_id'],$middle_user_info['b_right_user_id']);

            $middle_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-c"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$middle_user_info["base"]["url"].'">'.$middle_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($middle_user_info["level"]).'</th></tr><tr><td>'.$middle_user_info["count"]["left"].'</td><td>'.$middle_user_info["count"]["middle"].'</td><td>'.$middle_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructureNext($user_ifo["b_middle_user_id"]).
                '   </div></div>';
        }


        if($user_ifo["b_right_user_id"] == 0){
            $right_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-l"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '	        <div class="strt-name"><table border="1"><tr><th colspan="3">空缺</th></tr><tr><th colspan="3"><a href="'.U("Members/recommendAdd?puid=$uid&bd=2&level=0").'">推荐</a></th></tr><tr><td>0</td><td>0</td><td>0</td></tr></table></div>'.
//                '			<a href="'.U("Members/recommendAdd?puid=$uid&bd=2&level=0").'" ><span class="strt-name">推荐</span></a>'.
                '		</div>';
        }else{
            $right_user_info = M("users_member")->find($user_ifo["b_right_user_id"]);
            $right_user_info["base"] =  M("users")->find($user_ifo["b_right_user_id"]);
            $right_user_info["base"]["url"] = U("Admin/Index/map?userId=".$right_user_info["userId"]);
            $right_user_info["count"] = $this->get_child_count($right_user_info["userId"],$right_user_info['b_left_user_id'],$right_user_info['b_middle_user_id'],$right_user_info['b_right_user_id']);

            $right_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-l"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '	<div class="strt-name"><table border="1"><tr><th colspan="3"><a href="'.$right_user_info["base"]["url"].'">'.$right_user_info["base"]["loginName"].'</a></th></tr><tr><th colspan="3">'.$this->getLevelImg($right_user_info["level"]).'</th></tr><tr><td>'.$right_user_info["count"]["left"].'</td><td>'.$right_user_info["count"]["middle"].'</td><td>'.$right_user_info["count"]["right"].'</td></tr></table></div>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructureNext($user_ifo["b_right_user_id"]).
                '   </div></div>';
        }
        return $left_structure . $middle_structure . $right_structure;
    }

    private function getLevelImg($levle){
        if($levle == 0){
            return $img = '<img src="'.WSTDomain().'/Apps/Home/View/default/images/level/l0.gif" height="25" width="25">';
        }else{
            return $img = '<img src="'.WSTDomain().'/Apps/Home/View/default/images/level/l'.$levle.'.gif" height="25" width="25">';
        }
    }



}