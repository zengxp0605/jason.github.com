# -*- coding: utf-8 -*-

# 函数

def my_abs(val):
	if val >= 0 :
		return val
	else:
		return -val


print my_abs(100),my_abs(-200.34)


import math
def move(x, y, step, angle):
    nx = x + step * math.cos(angle)
    ny = y - step * math.sin(angle)
    return nx, ny

x, y = move(100, 100, 60, math.pi / 6)
print x, y
#下面的才是真实返回结果  tuple
r = move(100, 100, 60, math.pi / 6);
print r

# 计算阶乘的递归方法
def fact(n):
    if n==1:
        return 1
    return n * fact(n - 1)

print fact(10)

#参数默认值
def power(x, n=2):
    s = 1
    while n > 0:
        n = n - 1
        s = s * x
    return s

print power(5),power(2,3)


#定义可变参数数量
def foo(*args):
	return args

print foo(),foo(1,2),foo(['a','b','c'])