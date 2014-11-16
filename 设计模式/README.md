#面向对象与设计模式

### 摘要

1. 简单定义: 在软件开发过程中,经常出现的典型场景的典型解决方案,称为设计模式.
2. 多态(Polymorphism):指某种对象实例表现出不同的表现形态, 简单实例[0-polymorphism.php](0-polymorphism.php "0-polymorphism.php")

### 主要设计模式
- 面向接口开发 [1-interface.php](1-interface.php "1-interface.php")
 	- 提供一个接口,写不同的类实现该接口,客户端调用不同的类,但是里边的方法都在接口中可以找到.
  	- 若不想让客户端知道多个类, 可以使用简单工厂方法.
- 简单工厂模式  [2-Easy_factory.php](2-Easy_factory.php "2-Easy_factory.php")
	- 此时如果增加了新的数据库类型, 则需要修改源代码才能实现,不符合开/闭原则. 可使用工厂方法模式
	
- 工厂方法模式  [3-Factory.php](3-Factory.php "3-Factory.php")

- 单例模式

- 观察者模式
- 职责链模式
- 策略模式
- 装饰模式
- 适配器模式
- 桥接模式
 