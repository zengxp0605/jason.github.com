# Ubuntu 使用心得
  ubuntu 12.04 版, 虚拟机

## 一. 入门操作

### (一) 基本命令
 [系统安装参考](http://wenku.baidu.com/link?url=blCp7GM0T2P-2IixEZwl0NUfZmlhloCCVHEdSIcFPG6BhdyXo8ihlhrcJBWbx8rDOyGqpxBpR6rR-PkoLEh9NecB1w3Ap4NuAKq0HCGTFPy&pn=51)

1. 用户管理
    - 安装新系统默认用户是当前user, root用户密码是随机的,需要给它新设置, 使用 `sudo passwd root`. 
    - 切换到root用户 `su root` || `su` || `exit` 
    - 切换到其他用户 `su xxx`  xxx 表示用户名
    - 禁用和启用 root 登录
        - 执行 `sudo passwd -l root` 即可（只是禁用root，但是root密码还保存着），再执行`su root`发现认证失败，
        - 启动root登录，执行 `sudo passwd -u root` 即可
    - 添加用户 ``
  
2. 关机 
    -  现在关机: `sudo shutdown -h now` 
 
3. 关于 update 和upgrade 

  		**摘自网上, 未确认**

		yum -y update
		
		升级所有包，改变软件设置和系统设置,系统版本内核都升级
		
		yum -y upgrade
		
		升级所有包，不改变软件设置和系统设置，系统版本升级，内核不改变

4.  查看和关闭进程
      - 查看 
 	     -  `ps -e`    
         -   `netstat -antup`
     -  关闭
         -  `pgrep firefox` , 通过这个命令查看firefox 的进程号,如返回3492, 再`kill 3492`
         -   `killall firefox` 关闭firefox
         -  `kill -9 3492` 强制关闭进程号为3492 的进程

5. 安装和卸载软件
    -  apt-get update——在修改/etc/apt/sources.list或/etc/apt/preferences之後运行该命令。此外您需要定期运行这一命令以确保您的软件包列表是最新的。
    - apt-get install packagename——安装一个新软件包（参见下文的aptitude）
    - apt-get remove packagename——卸载一个已安装的软件包（保留配置文档）
    - apt-get --purge remove packagename——卸载一个已安装的软件包（删除配置文档）

6. 更改文件属性
	
    - `chgrp -R username dirname`  // 更改文件夹所属组
    - `chgrp -R username dirname`  // 更改文件所有者
    - 
    
7. 备

9. 其他命令

    - 查看磁盘使用情况 df -h

10. 
















