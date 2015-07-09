# -*- coding: utf-8 -*-

# if else 
age = 18;
if age > 18 :
	print u'你是成年人了!';
elif age == 18:
	print u'你刚刚成年!';
	print 'you are so young!';
else:
	print u'未成年人禁止进入!';	

print 'End IF';


# for loop
L = ['Adam', 'Lisa', 'Bart']
for name in L:
	print name

# for loop  get index
for index,name in enumerate(L):
	print index,'--',name

print '--------------------------------';
# while loop
N = 10
x = 0
while x < N:
	x = x + 1
	if x == 5 :
		print u'while loop break at x=5'
		break
	if x == 3 : #you can't see 3 in print list
		continue
	print x

# loop in loop
for x in ['A', 'B', 'C']:
    for y in ['1', '2', '3']:
        print x + y

print '------------------------------------'
print [m + n for m in 'ABC' for n in '123']
#['A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3']

#上面的表达式可以翻译为
L = []
for m in 'ABC':
    for n in '123':
        L.append(m + n)
print L
