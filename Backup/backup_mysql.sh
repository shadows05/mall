#!/bin/bash

# 要备份的数据库名，多个数据库用空格分开
databases=(mall) 

# 备份文件要保存的目录
basepath='/alidata/www/default/mall/Backup/mysql/'

if [ ! -d "$basepath" ]; then
  mkdir -p "$basepath"
fi

# 循环databases数组
for db in ${databases[*]}
  do
    # 备份数据库生成SQL文件
    /alidata/server/mysql/bin/mysqldump -uroot -paGQX513750a3fa $db > $basepath$db-$(date +%Y%m%d).sql
    
    # 将生成的SQL文件压缩
    tar zPcf $basepath$db-$(date +%Y%m%d%H%M%S).sql.tar.gz $basepath$db-$(date +%Y%m%d).sql
    
    # 删除7天之前的备份数据
    find $basepath -mtime +30 -name "*.sql.tar.gz" -exec rm -rf {} \;
  done

  # 删除生成的SQL文件
  rm -rf $basepath/*.sql
