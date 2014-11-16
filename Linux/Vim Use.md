##Vim使用入门：

1. vim 分为三种模式: Normal, Insert , Command,

	- 启动Vim后，进入Normal模式
	- 按下i a o r 键，进入Insert模式
	- 返回Normal模式，按ESC键
	- x键，删除当前光标所在的一个字符（Normal模式）
	- ：wq，存盘+退出（:w+文件名，存盘；:q退出）
	- dd,删除当前行，删除的当前行存在剪切板中
	- p，粘贴剪切板
	- hjkl，移动光标或使用光标键
    - VIM的Normal模式下，所有的键都是功能键
    
2. 删除，复制，粘贴
    - x,X  : 在一行中，x为向后删除一个字符（相当于del键），X为向前删除一个字符（相当于backspace键）。
    - dd   : 删除光标所在的那一整行。
    - ndd  : n 为数字。从光标开始，删除向下n列。
    - yy   : 复制光标所在的那一行。   
    - nyy  : n为数字。复制光标所在的向下n行。
    -  p,P  : p 为将已复制的数据粘贴到光标的下一行，P则为贴在光标的上一行。
    - u    : 复原前一个操作
    - CTRL + r : 重做上一个操作。
    - 小数点'.': 重复前一个动作。
    
3. 其他
	- P，粘贴
    - yy，拷贝当前行 
    - U，撤销
    - ：e<path/to/file>，打开一个文件
    - ：w，存盘
    - ：saveas<path/to/file>，另存为路径
    - q！,退出不保存
    - set number / set nu   显示行号
    
4. 备 

-------------------------------
####待整理
vi 常用命令行

1.vi 模式
 　　a) 一般模式： vi 处理文件时，一进入该文件，就是一般模式了.
 　　b) 编辑模式：在一般模式下可以进行删除，复制，粘贴等操作，却无法进行编辑操作。等按下‘i,I,o,O,a,A,r,R’等
          字母之后才能进入编辑模式.通常在linux中，按下上述字母时，左下方会出现'INSERT'或者‘REPLACE’字样,才可以
          输入任何文字到文件中.要回到一般模式，按下[ESC]键即可.
 　　c) 命令行模式：在一般模式中，输入“: 或者/或者?”,即可将光标移动到最下面一行，在该模式下，您可以搜索数据，而且读取，
   　　 存盘，大量删除字符，离开vi，显示行号等操作.
2.vi 常用命令汇总:
 2.1 一般模式
  　　a) 移动光标： 
    　　--> 上下左右方向键 ↑↓← →
    　　--> 翻页 pagedown / pageup 按键
    　　--> 数字 0 : 将光标移动到当前行首
   　　 --> $ :　　　将光标移动到当前行尾
   　　 --> G :       移动到这个文件的最后一行  nG :  n 为数字，移动到这个文件的第n行.
    　　--> gg:      移动到这个文件的第一行 相当于 1G
    
  　　b)  搜索与替换
    　　--> /word :  从光标开始，向下查询一个名为word的字符串。
    　　--> :n1、n2s/word1/word2/g : n1 与n2 为数字.在第n1与n2行之间寻找word1这个字符串,
            　　并将该字符串替换为word2。
   　　 --> :1、$s/word1/word2/g : 从第一行到最后一行寻找word1字符串，并将该字符串替换为word2
    　　--> :1、$s/word1/word2/gc: 从第一行到最后一行寻找word1字符串，并将该字符串替换为word2。
          　　并且在替换之前显示提示符给用户确认（conform）是否需要替换。
 　　 c) 删除，复制，粘贴
   　　 --> x,X  : 在一行中，x为向后删除一个字符（相当于del键），X为向前删除一个字符（相当于backspace键）。
    　　--> dd   : 删除光标所在的那一整行。
    　　--> ndd  : n 为数字。从光标开始，删除向下n列。
   　　 --> yy   : 复制光标所在的那一行。   
   　　 --> nyy  : n为数字。复制光标所在的向下n行。
   　　 --> p,P  : p 为将已复制的数据粘贴到光标的下一行，P则为贴在光标的上一行。
    　　--> u    : 复原前一个操作
   　　 --> CTRL + r : 重做上一个操作。
    　　--> 小数点'.': 重复前一个动作。
 2.2  编辑模式：
  　　a) i, I : 在光标所在处插入输入文字，已存在的文字向后退。i 为‘从当前光标所在处插入’，I 为‘在当前所在行的一个非空格符处开始插入’。
 　　 b) a, A : a 为‘从当前光标所在处的下一个字符开始插入’。A 为‘从光标所在行的最后一个字符处开始插入’。
  　　c) o,O  : 这是英文o的大小写。o为‘在当前光标所在行的下一行处插入新的一行’。O表示‘在当前光标所在行的上一行插入新的一行’。
  　　d) r,R  : 替换：r 会替换光标所在的那一个字符。 R ： 会一直替换光标所在的字符，直到按下esc 键为止。
  　　e) ESC  : 进入一般模式。
 2.3 命令模式：
  　　a) :w   : 将编辑的数据写入硬盘
 　　 b) :q   : 离开vi
 　　 c) :q!  : 强制离开，不存储
  　　d) :wq  : 存储后离开
  　　e) :wq! : 强制存储后离开

3. vim 附加命令行
 3.1 块选择（visual block)
  　　v  字符选择，将光标经过的地方反白显示
  　　V  行选择，会将光标经过的行反白选择
  　　ctrl + v 块选择，可以用长方形的方式选择数据
  　　y  复制反白的地方
   　 d  将反白的地方删除掉
 3.2 多文件编辑
 　 :n  编辑下一个文件
     :N  编辑上一个文件
　  :files  列出当前vim 打开的所有文件
 3.3 多窗口功能
     :sp 【filename】打开一个新窗口，如果加filename，表示在新窗口打开一个新文件
    　　 否则表示两个窗口为同一个文件内容
     ctrl+wj  先按下ctrl ，再按下w后，放开所有按键，然后按下j，则光标可移动到下方的窗口
     ctrl+wk  同上，不过光标移动到上面的窗口
     ctrl+wq  其实就是:q结束离开。

