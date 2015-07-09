# -*- coding: utf-8 -*-
# 中文注释!!!
# My hello world!
print 'Hello World!'   

str1 =  r'''Python is created by "Guido".
It is free and easy to learn \(~_~)/ \(~_~)/.
Let's start learn Python in imooc!'''
print str1;

str2 = u'中文字符串!!';
print str2;

print u'-------------------分隔符--------------\n';

a = 'python'
print 'hello,', a or 'world'

b = ''
print 'hello,', b or 'world'

#-----------------------------------------------------------------
#list
L = ['Michael', 100, True]
print L;
print L[0],L[1],L[2]; #不可越界
print L[-1],L[-2],L[-3]; #使用倒序输出倒数第一个,....

#list 添加元素
L.append('Paul');
print L;

#指定位置insert 元素
L.insert(0, 'Jason');
print L;

#删除最后一个元素
L.pop();
print L;

#删除指定位置的元素元素
L.pop(2);
print L;

#替换元素
L[2] = 'Jacky';
print L;

#----------------------------------------------
#tuple 元组,创建后无法删除和修改!!
t = ('aa','bb',100,200);
print t,t[1]; 
#t[1]=111;  # 这里报错

t = (1);
print t;
t = (1,); #单一元素时,最后加上一个 逗号
print t;

#可以改变的元组
t = ('a','b',['A','B']);
print t;
L = t[2];
L[0] = 'X';
L[1] = 'Y';
print t;

rs = zip([10, 20, 30], ['A', 'B', 'C'])
print rs #[(10, 'A'), (20, 'B'), (30, 'C')]
rs =range(0,10)
print rs  # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

print u'--生成列表--------------';
print [x * x for x in range(1, 10)] # 1x1,2x2,3x3 .....
print [x * (x + 1) for x in range(0, 100, 2)]  #[1x2, 3x4, 5x6, 7x8, ..., 99x100]
print '----------'
print [x * x for x in range(1, 11) if x % 2 == 0]

