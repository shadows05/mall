alter table wst_log_sms add smsIP varchar(20);
alter table wst_goods_appraises add goodsAttrId int default 0;
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('2', '�������ŷ�����֤��', 'smsVerfy', 'radio','��||��','1,0','1','',4);
INSERT INTO `wst_sys_configs`(parentId,fieldName,fieldCode,fieldType,valueRangeTxt,valueRange,fieldValue,fieldTips,fieldSort) VALUES ('2', '��������', 'smsOrg', 'text', null, null, '', null, '0');
