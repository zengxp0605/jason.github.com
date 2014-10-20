# Ubuntu 使用心得
  ubuntu 12.04 版, 虚拟机

## 一. 入门操作

### (一) 基本命令
 [系统安装参考](http://wenku.baidu.com/link?url=blCp7GM0T2P-2IixEZwl0NUfZmlhloCCVHEdSIcFPG6BhdyXo8ihlhrcJBWbx8rDOyGqpxBpR6rR-PkoLEh9NecB1w3Ap4NuAKq0HCGTFPy&pn=51)

1. 用户切换
  - 安装新系统默认用户是当前user, root用户密码是随机的,需要给它新设置, 使用 `sudo passwd root`. 
  - 切换到root用户 `su root` || `su` || `exit` 
  - 切换到其他用户 `su xxx`  xxx 表示用户名
  - 禁用和启用 root 登录
     - 执行 `sudo passwd -l root` 即可（只是禁用root，但是root密码还保存着），再执行`su root`发现认证失败，
     - 启动root登录，执行 `sudo passwd -u root` 即可
  
2. 关机 
  - 现在关机: `sudo shutdown -h now` 
  
3. 关于 update 和upgrade 

  		**摘自网上, 未确认**

		yum -y update
		
		升级所有包，改变软件设置和系统设置,系统版本内核都升级
		
		yum -y upgrade
		
		升级所有包，不改变软件设置和系统设置，系统版本升级，内核不改变
