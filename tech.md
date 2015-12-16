# 技术细节文档

_注：各个项目文件里面可能包含一些具体定义_

##页面显示方面

* 模板全部直接写入php语句

##用户逻辑处理

###SESSION

* **userid** :用户的ID
* **expiretime** : _使用Unix时间戳_ 用户SESSION过期时间，只要是验证过SESSION有效期都会自动续期5min
* **absexpiretime** : _使用Unix时间戳_ 绝对SESSION过期时间，无论如何超过这个时间SESSION都会失效
* **vaildip** : _不一定会加入_ SESSION有效IP

##类结构

* 所有的Model,Controller,View类全部继承Base_Model,Base_Controller,Base_View类，三个Base做基础性工作

##代码细节约定

* 访问全局变量（主要是 lang 和 config 中的变量）统一使用 $GLOBALS 超全局变量来访问
