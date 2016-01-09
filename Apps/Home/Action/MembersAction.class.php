<?php
namespace Home\Action;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MembersAction
 *
 * @author bean
 */
class MembersAction extends BaseAction{

    private $user;

    public function __construct(){
        parent::__construct();
        $this->isUserLogin();
        $this->user = session('WST_USER');
    }
    // 好友中心首页
    public function index(){

        // 获取我的推荐好友数
        $this->assign("recommend_count", M("users_member")->where("recommendId=".$this->user["userId"])->count());
        // 获取我的团队成员数
        $this->assign("team_count", M("users_member_relation")->where("puid=".$this->user["userId"])->count());

        // 获取我的推荐好友 未称为正式会员的人数
        $this->assign("unrecommend_users", $this->getUnRecommednUsers());

        // 获取我收到的未处理会员申请
        $this->assign("unsovled_apply", M("users_member_apply")->where("examine_uid = " . $this->user["userId"] . " and apply_type = 2 and status = 0")->count());

        // 获取我的等级
        $current_level = M("users_member")->where("userId = " . $this->user["userId"])->getField("level");
        $next_level = $current_level == 9 ? "已是最高等级" : $current_level + 1;

        // 判断用户是否可升级
        $if_can_update = D("UsersMemberRelation")->getUserIfCanUpdate($this->user["userId"]);

        // 获取未处理会员升级请求
        $unsolved_promote_count = M("users_member_apply")->where("examine_uid = " . $this->user["userId"] . " and apply_type = 3 and status = 0")->count();

        $this->assign("unsolved_promote_count", $unsolved_promote_count);
        $this->assign("if_can_update", $if_can_update);
        $this->assign("current_level",$current_level);
        $this->assign("next_level",$next_level);

        $this->display("default/members/index");
    }

    public function getUnRecommednUsers(){
        $data["unApply"] = array();
        $data["inApply"] = array();
        $users = M("users_member")->where("recommendId=".$this->user["userId"]." and status != 2")->select();
        foreach($users as $k=>$v){
            $apply = M("users_member_apply")->where("uid = " .$this->user["userId"] . " and apply_type = 2 and cuid = " .$v["userId"])->find();
            if(!empty($apply)){
                $data["inApply"][$v["userId"]] = $v;
            }else{
                $data["unApply"][$v["userId"]] = $v;
            }
        }
        return $data;
    }

    // 我的推荐列表
    public function recommendList(){
        $list = M("users_member")->where("recommendId = " . $this->user["userId"])->select();
        foreach($list as $k=>$v){
            $list[$k]["base"] = M("users")->find($v["userId"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "recommendList");
        $this->display("default/members/info/recommend_list");
    }

    // 我的团队列表
    public function teamList(){
        $list = M("users_member_relation")->where("puid = " . $this->user["userId"])->select();
        foreach($list as $k=>$v){
            $list[$k]["base"] = M("users")->find($v["cuid"]);
            $list[$k]["member"] = M("users_member")->find($v["cuid"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "teamList");
        $this->display("default/members/info/team_list");
    }

    // 推荐图谱
    public function recommendAtlas(){
        $userId = is_null($_GET['uid']) ? $this->user["userId"] : (int)$_GET['uid'];
        //$team_structure =
        $structure = D("UsersMemeber")->generateTeamStructure($userId);
        $this->assign("structure", $structure);
        $this->assign("umark", "recommendAtlas");
        $this->display("default/members/info/recommend_atlas");
    }

    // 推荐好友
    public function recommendAdd(){
        $data["parentId"] = I("puid");
        $data["bdiraction"] = I("bd");
        $data["level"] = I("level");
        $this->assign("data", $data);
        $this->assign("user", $this->user);
        $this->assign("umark", "recommendAdd");
        $this->display("default/members/info/recommend_add");
    }

    // 添加好友
    public function add(){
        $rs = array();
        $m = D('Admin/Users');
        $rs = $m->insert();
        if($rs["status"] == 1){ // 创建成功
            // 生成用户关系
            // 生成交友关系表 users_member
            $users_modle = M("users");
            $user = $users_modle->where("loginName = '" . I("loginName") . "'")->find();
            D("UsersMemeber")->insertUserMember($user);
        }
        $this->ajaxReturn($rs);
    }

    // 我发出的会员审核
    public function auditOut(){
        $list = M("users_member_apply")->where("uid = " . $this->user["userId"] . " and apply_type = 2")->select();
        foreach($list as $k=>$v){
            $list[$k]["cuser"] = M("users")->find($v["cuid"]);
            $list[$k]["puser"] = M("users")->find($v["examine_uid"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "auditOut");
        $this->display("default/members/audit/audit_out_list");
    }

    // 发出5级报单会员审核
    public function recommendNew(){
        $data["cuid"] = I("cuid");
        // 查找会员5级报单会员
        // 获取被推荐人上层5级报单会员
        $five_level_user = D("UsersMemberRelation")->getFiveLevelCust($data["cuid"]);
        if(IS_POST){
            $data["cuid"] = I("cuid");
            $data["uid"] = $this->user["userId"];
            $data["examine_uid"] = $five_level_user["userId"];
            $data["apply_type"] = 2;
            $data["apply_conten"] = "我推荐的用户申请开通正式会员，请审核";
            $data["status"] = 0;
            $data["create_time"] = date('Y-m-d H:i:s');
            $data["update_time"] = date('Y-m-d H:i:s');
            M("users_member_apply")->add($data);
            $this->success('申请成功', U("Members/index"));
        }else{
            $this->assign("five_level_user", $five_level_user);
            $this->assign("c_user", M("users")->find($data['cuid']));
            $this->assign("umark", "auditOut");
            $this->display("default/members/audit/audit_out_new");
        }
    }

    public function applySolve(){
        $apply_id = I("id");
        $apply_info = M("users_member_apply")->find($apply_id);
        // 修改申请状态
        M("users_member_apply")->save(array("id"=>$apply_id,"status"=>1,"update_time"=>date('Y-m-d H:i:s')));
        // 修改会员状态
        $userId = $apply_info["cuid"];
        M("users_member")->save(array("userId"=>$userId,"status"=>2,"lastTime"=>date('Y-m-d H:i:s')));
        // 修改memberRelation状态
        M("users_member_relation")->save(array("cuid"=>$userId,"check_status"=>2));
        // 修改用户代金券
        M("users_member_voucher_earn")->add(array(
            "uid"=>$userId,
            "voucher"=>500,
            "type"=>1,
            "status"=>1,
            "create_time"=>date('Y-m-d H:i:s'),"update_time"=>date('Y-m-d H:i:s')));
        D("users_member")->where("userId = ". $userId)->setInc('voucher',500);

        $this->success('审核成功', U("Members/auditIn"));
    }

    // 我收到的会员审核
    public function auditIn(){
        $list = M("users_member_apply")->where("examine_uid = " . $this->user["userId"]  . " and apply_type = 2")->select();
        foreach($list as $k=>$v){
            $list[$k]["cuser"] = M("users")->find($v["cuid"]);
            $list[$k]["ruser"] = M("users")->find($v["uid"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "auditIn");
        $this->display("default/members/audit/audit_in_list");
    }

    // 会员升级审核
    public function applyPromote(){
        $apply_id = I("id");
        $apply_info = M("users_member_apply")->find($apply_id);
        // 修改会员级别
        M("users_member")->where("userId = ". $apply_info["uid"])->setInc('level',1);
        // 修改升级审核状态
        D("users_member_apply")->save(array("id" => I("id"),"status" => 1, "update_time" => date('Y-m-d H:i:s')));
        $this->success("审核通过",U("Members/promoteIn"));
    }

    // 我发出的会员升级
    public function promoteOut(){
        $list = M("users_member_apply")->where("uid = " . $this->user["userId"] ." and apply_type = 3")->select();
        foreach($list as $k=>$v){
            $list[$k]["apply_user"] = M("users")->find($v["examine_uid"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "promoteOut");
        $this->display("default/members/promote/promote_out_list");
    }

    // 我收到的会员升级
    public function promoteIn(){
        $list = M("users_member_apply")->where("examine_uid = " . $this->user["userId"] ." and apply_type = 3")->select();
        foreach($list as $k=>$v){
            $list[$k]["apply_user"] = M("users")->find($v["uid"]);
        }
        $this->assign("list", $list);
        $this->assign("umark", "promoteIn");
        $this->display("default/members/promote/promote_in_list");
    }

    // 我要升级
    public function promoteNew(){
        $if_can_update = D("UsersMemberRelation")->getUserIfCanUpdate($this->user["userId"]);
        if($if_can_update == 0){
            $this->success('暂时不可升级', U("Members/index"));
            exit;
        }

        // 获取未处理升级请求
        $unsolved_apply = M("users_member_apply")->where("uid = " . $this->user["userId"] . " and apply_type = 3 and status = 0")->count();
        if($unsolved_apply > 0){
            $this->success('您还有未处理升级请求，请耐心等待', U("Members/promoteOut"));
            exit;
        }
        // 当前等级
        $current_level = M("users_member")->where("userId = " . $this->user["userId"])->getField("level");
        $next_level = $current_level == 9 ? "已是最高等级" : $current_level + 1;
        // 获取updateTips && 升级审核人
        $update_infos = $this->getUpdateUserInfo($this->user["userId"], $current_level);

        if(IS_POST){
            $apply = array(
                "uid" => $this->user["userId"],
                "examine_uid" => $update_infos["update_confirm_cust"]["userId"],
                "cuid" => $this->user["userId"],
                "apply_type" => 3,
                "apply_conten" => "申请从级别 $current_level 升级到 $next_level",
                "status" => 0,
                "create_time" => date('Y-m-d H:i:s'),
                "update_time" => date('Y-m-d H:i:s')
            );
            if(M("users_member_apply")->add($apply)){
                $this->success('申请成功！', U('Members/promoteOut'));
            }
        }else{
            $this->assign("umark", "promoteOut");
            $this->assign("current_level", $current_level);
            $this->assign("next_level" ,$next_level);
            $this->assign("update_user_info",$update_infos);
            $this->display("default/members/promote/promote_new");
        }
    }

    private function getUpdateUserInfo($userId,$level){
        $user_info = array();
        switch ($level)
        {
            case 0:
                $user_info["user_title"] = "上一层1级会员";
                $user_info["update_tips"] = "需要向上一层1级会员发600元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,1);
                break;
            case 1:
                $user_info["user_title"] = "上二层2级会员";
                $user_info["update_tips"] = "需要向上二层2级会员发600元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,2);
                break;
            case 2:
                $user_info["user_title"] = "上三层3级会员";
                $user_info["update_tips"] = "需要向上三层3级会员发600元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,3);
                break;
            case 3:
                $user_info["user_title"] = "上四层4级会员";
                $user_info["update_tips"] = "需要向上四层4级会员发600元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,4);
                break;
            case 4:
                $user_info["user_title"] = "上五层5级会员";
                $user_info["update_tips"] = "需要向上五层5级会员发1200元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,5);
                break;
            case 5:
                $user_info["user_title"] = "上六层6级会员";
                $user_info["update_tips"] = "需要向上六层6级会员发1200元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,6);
                break;
            case 6:
                $user_info["user_title"] = "上七层7级会员";
                $user_info["update_tips"] = "需要向上七层7级会员发1200元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,7);
                break;
            case 7:
                $user_info["user_title"] = "上八层8级会员";
                $user_info["update_tips"] = "需要向上八层8级会员发1200元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,8);
                break;
            case 8:
                $user_info["user_title"] = "上九层9级会员";
                $user_info["update_tips"] = "需要向上九层9级会员发1200元红包";
                $user_info["update_confirm_cust"] = $this->getUpdateConfirmUser($userId,9);
                break;
            default:
                break;
        }
        return $user_info;
    }

    // 获取用户升级的上层用户
    public function getUpdateConfirmUser($uid,$next_level){
        $start = $next_level - 1;
        $user_info = array();
        $list = M("users_member_relation")->where("cuid=$uid")->order("preaches desc")->limit("$start,100")->select();
        if(empty($list)){
            $list = M("users_member_relation")->where("cuid=$uid")->order("preaches desc")->limit("100")->select();
        }
        foreach($list as $k=>$v){
            $puid = $v["puid"];
            $p_user_info = M("users_member")->where("userId = $puid")->find();
            if($p_user_info["level"] >= $next_level){
                $user_info =  M("users")->find($puid);
                break;
            }
        }
        return $user_info;
    }



}
