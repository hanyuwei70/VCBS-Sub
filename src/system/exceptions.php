<?php
/*
 * 自定义异常类
 * AuthFailed
 * 用于广义权限验证失败，包括密码错误、权限不够、超时之类
 *
 * ResouceFailed
 * 广义资源失败，包括数据库连接失败，文件读写失败
 *
 * UserNotFound
 * 找不到用户
 * */
class AuthFailed extends Exception{}
class ResourceFailed extends Exception{}
class UserNotFound extends Exception{}
class BangumiNotFound extends Exception{}
?>