#项目基金会网站
  用于学校的发展基金会使用
 
先将found.sql导入到mysql数据库中，然后进行数据初始化安装。

安装时注意，将install.php下的管理员账号和密码修改成自己的，

并把$install改成true，在浏览器访问即可，最好安装完删除此文件。

之后将include/db_info.inc.php中的$DB_HOST,$DB_NAME,$DB_USER,$DB_PASS改成自己所设定的即可。