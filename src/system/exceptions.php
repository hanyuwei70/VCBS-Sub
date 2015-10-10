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
 *
 * BangumiNotFound
 * 删除番剧时找不到ID所对应的番剧
 *
 * SubtitleNotFound
 * 找不到ID对应的字幕
 * */
class AuthFailed extends Exception{}
class ResourceFailed extends Exception{}
class UserNotFound extends Exception{}
class BangumiNotFound extends Exception{}
class SubtitleNotFound extends Exception{}
?>