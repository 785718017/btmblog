<?php

namespace App;
/**
 * 专门定义常量的文件
 */
class Constants{
    /**
     * 标签级别--1级标签
     * int 1
     */
    const TAG_LEVEL_ONE = 1;

    /**
     * 标签级别--2级标签
     * int 2
     */
    const TAG_LEVEL_TWO = 2;

    /**
     * 标签级别--3级标签
     * int 3
     */
    const TAG_LEVEL_THREE = 3;
    /**
     * 顶级标签的父级id
     * int 0
     */
    const TOP_LEVEL_TAG_FATHER_ID = 0;
    /**
     * 标签状态--可用
     * int 1
     */
    const TAG_STATUS_USE = 1;
    /**
     * 标签状态--不可用
     * int 0
     */
    const TAG_STATUS_NO_USE = 0;
    /**
     * 文章状态--在线
     * int 1
     */
    const ARTICLE_ONLINE = 1;
    /**
     * 文章状态--已下线
     * int 0
     */
    const ARTICLE_OFFLINE = 0;

    /**
     * 登录方式--账号密码登录
     * int 1
     */
    const LOGIN_TYPE_ACCOUNT = 1;

    /**
     * 文章评论状态--展示
     */
    const ARTICLE_COMMENT_STATUS_SHOW = 1;
    /**
     * 文章评论状态--不展示
     */
    const ARTICLE_COMMENT_STATUS_NOT_SHOW = 2;
    /**
     * 文章评论回复状态--展示
     */
    const ARTICLE_COMMENT_REPLY_STATUS_SHOW = 1;
    /**
     * 文章评论回复状态--不展示
     */
    const ARTICLE_COMMENT_REPLY_STATUS_NOT_SHOW = 2;
}


