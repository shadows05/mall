#!/bin/bash


# 备份文件要保存的目录
basepath='/alidata/www/default/mall/Backup/pic/'

if [ ! -d "$basepath" ]; then
  mkdir -p "$basepath"
fi


tar zPcf $basepath"pic"-$(date +%Y%m%d%H%M%S).upload.tar.gz  /alidata/www/default/mall/Upload/*

# 删除30天之前的备份数据
find $basepath -mtime +30 -name "*.sql.tar.gz" -exec rm -rf {} \;
