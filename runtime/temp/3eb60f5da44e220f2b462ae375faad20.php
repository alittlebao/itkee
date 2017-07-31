<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"../public/templete/AdminThemes/article\index.html";i:1498225860;s:56:"../public/templete/AdminThemes/layout\common_layout.html";i:1500275822;}*/ ?>
<!doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>ITKEE_CN 后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="__JS__/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="__ADMIN_TMPL__/font/css/font-awesome.min.css">
    <!--CSS引用-->
    
    <link rel="stylesheet" href="__ADMIN_TMPL__/css/admin.css">
    <!--[if lt IE 9]>
    <script src="__JS__/html5shiv.min.js"></script>
    <script src="__JS__/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">文章管理</li>
            <li class=""><a href="<?php echo url('admin/article/add'); ?>">添加文章</a></li>
        </ul>
        <div class="layui-tab-content">

            <form class="layui-form layui-form-pane" action="<?php echo url('admin/article/index'); ?>" method="get">
                <div class="layui-inline">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="cid">
                            <option value="">全部</option>
                            <?php if(is_array($category_level_list) || $category_level_list instanceof \think\Collection || $category_level_list instanceof \think\Paginator): if( count($category_level_list)==0 ) : echo "" ;else: foreach($category_level_list as $key=>$vo): ?>
                            <option value="<?php echo $vo['id']; ?>" <?php if($cid==$vo['id']): ?> selected="selected"<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' ----';} endif; ?> <?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">筛选条件</label>
                    <div class="layui-input-inline">
                        <select name="is_condition">
                            <option value="0" selected="selected">不限</option>
                            <option value="is_hot" >加精</option>
                            <option value="is_top" >置顶</option>
                            <option value="is_download" >推荐下载</option>
                        </select>
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="请输入关键词" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn">搜索</button>
                </div>
            </form>
            <hr>

            <form action="" method="post" class="ajax-form">
                <button type="button" class="layui-btn layui-btn-small ajax-action" data-action="<?php echo url('admin/article/toggle',['type'=>'audit']); ?>">审核</button>
                <button type="button" class="layui-btn layui-btn-warm layui-btn-small ajax-action" data-action="<?php echo url('admin/article/toggle',['type'=>'cancel_audit']); ?>">取消审核</button>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-small ajax-action" data-action="<?php echo url('admin/article/delete'); ?>">删除</button>
                <div class="layui-tab-item layui-show">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th style="width: 15px;"><input type="checkbox" class="check-all"></th>
                            <th style="width: 30px;">ID</th>
                            <th style="width: 30px;">排序</th>
                            <th>标题</th>
                            <th>栏目</th>
                            <th>作者</th>
                            <th>阅读量</th>
                            <th>状态</th>
                            <th>发布时间</th>
                            <th>置顶/加精</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($article_list) || $article_list instanceof \think\Collection || $article_list instanceof \think\Paginator): if( count($article_list)==0 ) : echo "" ;else: foreach($article_list as $key=>$vo): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                            <td><?php echo $vo['id']; ?></td>
                            <td><?php echo $vo['sort']; ?></td>
                            <td><?php echo $vo['title']; ?></td>
                            <td><?php echo $category_list[$vo['cid']]; ?></td>
                            <td><?php echo $vo['author']; ?></td>
                            <td><?php echo $vo['reading']; ?></td>
                            <td><?php echo $vo['status']==1 ? '已审核' : '未审核'; ?></td>
                            <td><?php echo $vo['publish_time']; ?></td>
                            <td>
                                <?php 
                                $url = url('admin/article/topToggle',['id'=>$vo['id']]);
                                if($vo['is_top']==1){
                                echo '<a href="'.$url.'" data-param="is_top=0" class="layui-btn layui-btn-primary layui-btn-mini ajax-post">取消置顶</a>';
                                }else{
                                echo '<a href="'.$url.'" data-param="is_top=1" class="layui-btn layui-btn-danger layui-btn-mini ajax-post">置顶</a>';
                                }
                                if($vo['is_hot']==1){
                                echo '<a href="'.$url.'" data-param="is_hot=0" class="layui-btn layui-btn-warm layui-btn-mini ajax-post">取消加精</a>';
                                }else{
                                echo '<a href="'.$url.'" data-param="is_hot=1" class="layui-btn layui-btn-danger layui-btn-mini ajax-post">加精</a>';
                                }
                                $url = url('admin/article/topToggle',['id'=>$vo['id']]);
                                if($vo['is_download']==1){
                                echo '<a href="'.$url.'" data-param="is_download=0" class="layui-btn layui-btn-normal layui-btn-mini ajax-post">取消 荐-下载</a>';
                                }else{
                                echo '<a href="'.$url.'" data-param="is_download=1" class="layui-btn layui-btn-default layui-btn-mini ajax-post">荐-下载</a>';
                                }
                                 ?>
                            </td>
                            <td>
                                <a href="<?php echo url('admin/article/edit',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>

                                <a href="<?php echo url('admin/article/delete',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <!--分页-->
                    <?php echo $article_list->render(); ?>
                </div>
            </form>
        </div>
    </div>

<!--网站主体-->
<script>
    // 定义全局JS变量
    var GV = {
        base_url: "__STATIC__"
    };
</script>
<!--JS引用-->
<script src="__JS__/jquery.js"></script>
<script src="__JS__/layui/lay/dest/layui.all.js"></script>
<script src="__JS__/common.js"></script>


<!--页面JS脚本-->

</body>
</html>