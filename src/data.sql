/*
SQL表设计
for mysql
*/
create table sub_users(
    id INTEGER IDENTITY(1,1) NOT NULL PRIMARY KEY, --用户ID
    username VARCHAR(50) NOT NULL UNIQUE, --用户名(登录用)
    nickname VARCHAR(50) UNIQUE, --昵称(显示用)
    password VARCHAR(100), --密码
    description TEXT --用户描述，实际限制1KiB
);
create table sub_privileges(
    user_id INTEGER NOT NULL REFERENCES sub_users(id), --对应用户ID
    priv_num INTEGER NOT NULL --权限代码 具体含义请参见 model/perm.md
);
create table sub_bangumis(
    id INTEGER IDENTITY(1,1) NOT NULL PRIMARY KEY, --番剧ID
    creator INTEGER NOT NULL REFERENCES sub_users(id), --创建者ID
    createtime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, --创建时间
    owner INTEGER NOT NULL REFERENCES sub_users(id), --目前番剧所有者ID
    description TEXT --番剧描述，实际限制2KiB
);
create table sub_bangumis_name(
    id INTEGER IDENTITY(1,1) NOT NULL PRIMARY KEY, --番剧名称ID
    bangumi_id INTEGER NOT NULL REFERENCES sub_bangumis(id), --对应番剧ID
    name VARCHAR(200) NOT NULL, --名称
    lang VARCHAR(3) NOT NULL --语种信息 TODO: 确定标准定义字符
);
create table sub_subtitles(
    id INTEGER IDENTITY(1,1) NOT NULL PRIMARY KEY, --字幕ID
    name VARCHAR(50) NOT NULL UNIQUE, --字幕标题
    uploader INTEGER NOT NULL REFERENCES sub_users(id), --上传者ID
    bangumi INTEGER NOT NULL DEFAULT 0, --所属番剧ID, 0为不属于任何番剧
    uploadtime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, --上传时间
    filename VARCHAR(50) NOT NULL --上传字幕保存的文件名
    status INTEGER NOT NULL --字幕状态 具体含义未定
    description TEXT --字幕描述，实际限制1KiB
);
create table sub_settings( --用来存储各项设置值
    key VARCHAR(50) PRIMARY KEY,
    value VARCHAR(100)
);

