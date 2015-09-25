# 技术细节文档

##页面显示方面

* 模板全部直接写入php语句

##用户逻辑处理

###SESSION

* **userid** :用户的ID
* **expiretime** : _使用Unix时间戳_ 用户SESSION过期时间，只要是验证过SESSION有效期都会自动续期5min
* **absexpiretime** : _使用Unix时间戳_ 绝对SESSION过期时间，无论如何超过这个时间SESSION都会失效
* **vaildip** : _不一定会加入_ SESSION有效IP