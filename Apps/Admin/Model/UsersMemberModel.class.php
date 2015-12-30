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

    public function generateTeamStructure($uid){
        // 获取此uid的 b_left b_middle b_right
        //$structure_info = array();
        $user_ifo = M("users_member")->find($uid);
        $user_ifo["base"] =  M("users")->find($uid);

        if($user_ifo["status"] != 2){
            $structure =    '<div class="strt-part">'.
                '	<span class="strt-name">'.$user_ifo["base"]["loginName"].'<span class="badge">'.$this->getLevelImg($user_ifo["level"]).'</span></span>'.
                '</div>';
        }else{
            $structure =    '<div class="strt-part">'.
                '	<span class="strt-name">'.$user_ifo["base"]["loginName"].'<span class="badge">'.$this->getLevelImg($user_ifo["level"]).'</span></span>'.
                '	<div class="line-v"><span></span></div>'.
                '	<div class="strt-block">'.
                $this->getChildStructure($uid).
                '	</div>'.
                '</div>';

        }

        return $structure;

    }

    private function getChildStructure($uid){
        $user_ifo = M("users_member")->find($uid);
        $user_ifo["base"] =  M("users")->find($uid);

        if($user_ifo["status"] != 2){
            return "";
        }

        $left_structure = $middle_structure = $right_structure = "";
        if($user_ifo["b_left_user_id"] == 0){
            $left_structure .=  '    <div class="strt-part">'.
                '			<span class="line-h line-h-r"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '			<a href="" ><span class="strt-name">未推荐</span></a>'.
                '		</div>';
        }else{
            $left_user_info = M("users_member")->find($user_ifo["b_left_user_id"]);
            $left_user_info["base"] =  M("users")->find($user_ifo["b_left_user_id"]);
            $left_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-r"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '    <span class="strt-name">'.$left_user_info["base"]["loginName"].'<span class="badge">'.$this->getLevelImg($left_user_info["level"]).'</span></span>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructure($user_ifo["b_left_user_id"]).
                '   </div></div>';
        }


        if($user_ifo["b_middle_user_id"] == 0){
            $middle_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-c"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '			<a href="" ><span class="strt-name">未推荐</span></a>'.
                '		</div>';
        }else{
            $middle_user_info = M("users_member")->find($user_ifo["b_middle_user_id"]);
            $middle_user_info["base"] = M("users")->find($user_ifo["b_middle_user_id"]);
            $middle_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-c"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '    <span class="strt-name user-strt-name">'.$middle_user_info["base"]["loginName"].'<span class="badge">'.$this->getLevelImg($middle_user_info["level"]).'</span></span>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructure($user_ifo["b_middle_user_id"]).
                '   </div></div>';
        }


        if($user_ifo["b_right_user_id"] == 0){
            $right_structure .=   '    <div class="strt-part">'.
                '			<span class="line-h line-h-l"></span>'.
                '			<div class="line-v"><span></span></div>'.
                '			<a href="" ><span class="strt-name">未推荐</span></a>'.
                '		</div>';
        }else{
            $right_user_info = M("users_member")->find($user_ifo["b_right_user_id"]);
            $right_user_info["base"] =  M("users")->find($user_ifo["b_right_user_id"]);
            $right_structure .=   '<div class="strt-part">'.
                '    <span class="line-h line-h-l"></span>'.
                '    <div class="line-v"><span></span></div>'.
                '    <span class="strt-name">'.$right_user_info["base"]["loginName"].'<span class="badge">'.$this->getLevelImg($right_user_info["level"]).'</span></span>'.
                '    <div class="line-v"><span></span></div>'.
                '       <div class="strt-block">'.
                $this->getChildStructure($user_ifo["b_right_user_id"]).
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