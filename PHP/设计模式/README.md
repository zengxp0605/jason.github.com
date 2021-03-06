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

- 单例模式   [4-Sigle.php](4-Sigle.php "4-Sigle.php")

- 观察者模式 (Observer)
	- JS 实现
		- 面向过程,不使用设计模式 [5-1-observer-js-base.php](5-1-observer-js-base.php)
		- 使用观察者模式 [5-2-observer-js.php](5-2-observer-js.php)
	- php 实现 [5-3-observer.php](5-3-observer.php "5-3-observer.php")
- 职责链模式 (chain of resionbility)
	- 面向过程实现举报功能  [6-1-chain-base.php](6-1-chain-base.php)
	- 使用责任链模式完成举报功能 [6-2-chain.php](6-2-chain.php)

- 策略模式 (和工厂模式类似)
	- 和工厂模式的区别: 工厂模式返回的是不同的子类,通过调用这些子类的方法实现功能; 而策略模式是将这些子类赋值给一个父类的一个属性(类似零部件),由这个零部件去完成功能,调用者不需要去触碰这些子类.
	- 示例  [7-Strategy.php](7-Strategy.php)

- 装饰模式 (Decorator) 
	- 示例  [8-Decorator.php](8-Decorator.php "装饰器模式")

- 适配器模式 (例如不同电压转换后使用,笔记本电源适配器)
	- 示例  [9-Adaptor.php](9-Adaptor.php "适配器模式")

- 桥接模式  (通过适当的耦合,避免子类爆炸的发生)
	- 示例  [10-Bridge.php](10-Bridge.php)


 