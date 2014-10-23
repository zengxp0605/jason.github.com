## Git 使用

 内容来源[Git教程](http://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000)

---
#### 一. 基本命令

1. 创建本地仓库

    - `mkdir learngit`   // 创建目录
	- `cd learngit`  
	- `git init`   // 初始化仓库
	- `vi readme.md` // 新建一个文件 readme.md, 输入一些内容
	- `git add readme.md`  // 将 readme.md 添加到本地仓库
	- `git commit -m "add readme.md" ` // 将文件提交到仓库,"add readme.md"是提交的说明
	

2. 查看文件修改

    - `git status`  //查看提交的结果
    - `git diff readme.md` // 查看readme.md 文件的修改内容
    - 