# 单元测试
此文件夹为单元测试文件夹，使用 [PHPUnit](https://phpunit.de/) 测试 Model 部分的功能是否如预期。

PHPUnit 帮助文档 https://phpunit.de/manual/5.1/zh_cn/index.html

## 文件说明

+ base.php
  测试基类，Dateset类，数据库测试初值，index.php 内的初始化工作
+ data.sql
  MySQL 格式的数据库结构文件，可以直接导入 MySQL 用于测试。
+ phpunit.xml
  PHPUnit 的一些设置参数

## 运行方法

```bash
$ phpunit xxxTest.php
# 测试相应的 model，xxx 为 Model 前缀，如 BangumiTest 用于测试 Bangumi_Model
```

##进度

+ BangumiTest 已完成
