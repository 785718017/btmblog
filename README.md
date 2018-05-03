# btmblog
半透明的个人博客

这是我的个人博客项目，主要是用于学习和分享经验。该博客已经上线，地址是 http://www.btmblog.com ,欢迎访问交流！

目前GitHub上的版本不是最新版，因为后面偷懒，有些代码直接在linux上修改了...（等有时间一定要更新上来）

该项目主要分为2个部分：前台、后台管理

  前台(home模块)：
      1.标签化管理文章，给文章设置标签属性，方便分类，标签信息使用redis做了缓存
      2.文章列表，展示文章的标题、作者、时间、内容简介、标签、点赞数量、评论数量等
      3.热门文章推荐和最新文章推荐，推荐的文章使用redis做了缓存
      4.文章展示，采用了ueditor插件美化了页面，文章内容部分做了静态化处理
      5.文章评论和回复，动态处理回复输入框，输入框也是采用了自定义的ueditor插件，保留了表情的功能，回复和评论会采用消息队列的方式，发邮件通知管理员
      6.留言功能
     
  后台(admin模块)：
      1.文章管理
      2.标签管理
      3.权限管理，将站内所有的路由设置为一个权限，然后将用户分为游客、普通用户、管理员三个组，管理员可以针对每个用户组动态赋予不同权限，然后用中间件
        在每个请求开始前，验证权限，然后根据验证结果进行处理
 
      大致的结构就是这么多，写博客的目的是为了给自己一个记录的平台，所以暂时只包含了这些必要的功能。这个博客是我第一个独立上线运维的项目，也是开源的，
  如果您恰好觉得这些功能符合您的需求，可以参考或免费使用我的这些代码。