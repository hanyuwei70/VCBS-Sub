/*
导入 SQL
*/
create table sub_users(
    `id` INTEGER NOT NULL AUTO_INCREMENT, -- 用户ID
    `username` VARCHAR(50) NOT NULL, -- 用户名(登录用)
    `nickname` VARCHAR(50), -- 昵称(显示用)
    `password` VARCHAR(100), -- 密码
    `description` TEXT, -- 用户描述，实际限制1KiB
    `timezone` VARCHAR(30) NOT NULL DEFAULT "Asia/Shanghai", --  用户所在时区，按照PHP DateTimeZone 类中允许的时区字符串定义
    `lang` VARCHAR(3) NOT NULL DEFAULT "chs", --  网站界面语言
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
create table sub_privileges(
    `user_id` INTEGER NOT NULL, -- 对应用户ID
    `priv_num` INTEGER NOT NULL, -- 权限代码 具体含义请参见 model/perm.md
    UNIQUE KEY `user_id` (`user_id`),
    CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES sub_users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
create table sub_bangumis(
    `id` INTEGER NOT NULL AUTO_INCREMENT, -- 番剧ID
    `creator` INTEGER NOT NULL, -- 创建者ID
    `createtime` INTEGER NOT NULL, -- 创建时间
    `owner` INTEGER NOT NULL, -- 目前番剧所有者ID
    `description` TEXT, -- 番剧描述，实际限制2KiB
    `hit` INTEGER NOT NULL DEFAULT 0, -- 番剧热度，以番剧详情页面访问次数计算
    `cover` VARCHAR(200) DEFAULT NULL, -- 番剧封面，以 URL 字符串存储
    PRIMARY KEY (`id`),
    CONSTRAINT `creator_id` FOREIGN KEY (`creator`) REFERENCES sub_users(`id`),
    CONSTRAINT `owner_id` FOREIGN KEY (`owner`) REFERENCES sub_users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
create table sub_bangumis_name(
    `id` INTEGER NOT NULL AUTO_INCREMENT, -- 番剧名称ID
    `bangumi_id` INTEGER NOT NULL, -- 对应番剧ID
    `name` VARCHAR(200) NOT NULL, -- 名称
    `lang` VARCHAR(3) NOT NULL, -- 语种信息 TODO: 确定标准定义字符
    PRIMARY KEY (`id`),
    CONSTRAINT `bangumi_id` FOREIGN KEY (`bangumi_id`) REFERENCES sub_bangumis(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
create table sub_subtitles(
    `id` INTEGER NOT NULL AUTO_INCREMENT, -- 字幕ID
    `name` VARCHAR(100) NOT NULL, -- 字幕标题
    `uploader` INTEGER NOT NULL, -- 上传者ID
    `bangumi_id` INTEGER NOT NULL DEFAULT 0, -- 所属番剧ID, 0为不属于任何番剧
    `uploadtime` INTEGER NOT NULL, -- 上传时间
    `filename` VARCHAR(100) NOT NULL, -- 上传字幕保存的文件名
    `status` INTEGER NOT NULL, -- 字幕状态 具体含义未定
    `lang` VARCHAR(3) NOT NULL, -- 语种信息 TODO: 确定标准定义字符
    `description` TEXT, -- 字幕描述，实际限制1KiB
    PRIMARY KEY (`id`),
    UNIQUE (`name`),
    KEY `bangumi_id` (`bangumi_id`),
    CONSTRAINT `uploader_id` FOREIGN KEY (`uploader`) REFERENCES sub_users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
create table sub_settings( -- 用来存储各项设置值
    `key` VARCHAR(50),
    `value` VARCHAR(100),
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

