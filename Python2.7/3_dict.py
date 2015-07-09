# -*- coding: utf-8 -*-

#dict  key : value 
#dict内部是无序的
d = {
	'Ada' : 90,
	'Lisa' : 65,
	'Bob' : 85
}

print d,len(d)

# if key is not exists
if 'Jason' in d:
	print d['Jason']
else :
	print "The key 'Jason' is not in d"

print d.get('Bob') # 85 
print d.get('Jason') # return None

# update dict
d['Ada'] = 99
d['Jason'] = 95
print d

for key in d:
	print key + ':' + bytes(d[key]) #转换数字

print '------------------------------------';
# values 方法将dict 的值转换为 list
for v in d.values():
	print v
print '----';
# itervalues 方法不会生成 list ,会节省内存
for v in d.itervalues():
	print v


print '=====================================';

for key,value in d.items():
	print key,':',value
print '------';
for key,value in d.iteritems():
	print key,':',value


d = { 'Adam': 95, 'Lisa': 85, 'Bart': 59 }
# 完全可以通过一个复杂的列表生成式把它变成一个 HTML 表格：
tds = ['<tr><td>%s</td><td>%s</td></tr>' % (name, score) for name, score in d.iteritems()]
print '<table>'
print '<tr><th>Name</th><th>Score</th><tr>'
print '\n'.join(tds)
print '</table>'

print tds
