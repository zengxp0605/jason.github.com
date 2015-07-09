# -*- coding: utf-8 -*-

#set  set 持有一系列元素，这一点和 list 很像，但是set的元素没有重复，
#而且是无序的，这点和 dict 的 key很像。
#重复的值会被自动过滤掉
#无法通过索引来访问
s = set(['A','a','b','c','A'])
print s,len(s)

print 'a' in s  #true
print 'B' in s  #false ,区分大小写

for name in s:
	print name

s.add(4)
s.add('A') #添加存在的元素不会报错
print s

s.remove('A')
# s.remove(999) #keyError 报错
print s;


