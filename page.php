<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php $this->title() ?>-<?php $this->options->title(); ?></title>
    <meta name="keywords" content="<?php $this->options->keywords(); ?>" />
    <meta name="description" content="<?php $this->options->description(); ?>" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/moviepage/moviepage.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/moviepage/moviepage-adaptive.css'); ?>" />
    <script type="text/javascript" src="<?php $this->options->themeUrl('static/js/query.js?v21019102'); ?>"></script>
</head>
<style>
    #banner-width {
        padding-bottom: 0;
    }
    #content-width{
        font-size: 14px;
        margin-bottom: 70px;
    }
</style>

<body>

    <div id="bg"></div>
    <div id="searchArea" style="width: 100%;height: 100%;position: fixed;top: 0;background: #181818;z-index: 999;display:none;color: white;">
        <a href="javascript:;" style="color: #f4e5b3;font-size: 40px;width: 90%;max-width: 900px;margin: auto;display: block;margin-top: 120px;text-align: right;text-decoration: none;" onclick="hidesearchArea()">×</a>
        <form action="" method="GET" target="_blank" id='mobileSearchForm' style="width: 80%;max-width: 800px; margin: auto;margin-top: calc(50vh - 260px);padding: 0;height: 50px;border-bottom: 1px solid #f4e5b3;display: flex;justify-content: space-between;align-items: center;transform: translate(0,-10px);">
            <input id="search" name="s" action="<?php $this->options->siteUrl(); ?>" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
            <input type="submit" id='search-btn' value="">
        </form>
    </div>


    <div id="banner-wrap">
        <div id="banner-width">
            <div id="header">
                <?php if ($this->options->logoUrl) { ?>
                    <a id="logo" href="/" target="_blank">
                        <img id='logo-img' src="<?php $this->options->logoUrl(); ?>" alt="<?php $this->options->title(); ?>">
                    </a>
                <?php } else { ?>
                    <a id="logo" href="/" target="_blank" style="font-size: 26px;color: #f4e5b3;text-decoration: none;margin-right: 15px;line-height: 0px;">
                        <?php $this->options->title(); ?>
                    </a>
                <?php } ?>
                <span id='mobile-search-btn' style="position:absolute;right:20px;width: 22px;height: 10px;" onclick="showsearchArea()"></span>
                <form action="" method="GET" target="_blank" id='searchForm' action="<?php $this->options->siteUrl(); ?>">
                    <input name="s" id="search" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
                    <input type="submit" id='search-btn' value="">
                </form>
            </div>
        </div>
    </div>

    <div id="content-width">
        <h1><?php $this->title() ?></h1>
        <?php $this->content(); ?>
    </div>

    <div id='bottom'>
        <div id="bottom-width">
            <div id="bottom-logo-box">
                <a href="/?bottomlogo" class='bottom-logo' target="_blank"><?php if(!$this->options->logoUrl){?><?php $this->options->title(); ?><?php }?></a>
                <div class='bottom-btn-box'>
                    <a class='bottom-btn' href='/' target="_blank">首页</a>
                    <div class='bottom-line'></div>
                    <a class='bottom-btn' href='<?= $this->options->routingTable['archive']['url'] ?>' target="_blank">往日推荐</a>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while ($pages->next()) : ?>
                        <div class='bottom-line'></div>
                        <a class='bottom-btn' href='<?php $pages->permalink(); ?>' target="_blank"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if ($this->options->friendLink) : ?>
                <div id="youqing-box">
                    <span class='youqing-title'>友情链接：</span>
                    <?php $friendlinksArr = explode('@@@', $this->options->friendLink) ?>
                    <?php foreach ($friendlinksArr as $key => $value) { ?>
                        <?php if ($key != 0) { ?><div class='bottom-line'></div><?php } ?>
                        <?php $friendlink = explode('###', $value) ?>
                        <a class='youqing-link' href='<?= $friendlink[1] ?>' target="_blank"><?= $friendlink[0] ?></a>
                    <?php } ?>
                </div>
            <?php endif; ?>
        </div>

    </div>




</body>
<style>
    #youqing-box {
        color: white;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding-bottom: 15px;
        font-size: 12px;
    }

    .youqing-link {
        opacity: .3;
        filter: alpha(opacity=30);
        padding: 0 10px;
        cursor: pointer;
        user-select: none;
        -ms-user-select: none;
        position: relative;
        transition: all .5s;
        color: white;
        text-decoration: none;
    }
    .bottom-logo{
        <?php if($this->options->logoUrl){?>
        background-image:url('<?php $this->options->logoUrl(); ?>');
        <?php }else{?>
        width:unset;
        color: #f4e5b3;
        text-decoration: none;
        <?php }?>
    }
</style>
<script>
    function showsearchArea() {
        $("#searchArea").show();
    }

    function hidesearchArea() {
        $("#searchArea").hide();
    }
    mainheight = $(document.body).height() - $("#banner-wrap").height() - $("#bottom").height() - 180;
    $("#content-width").css("min-height",mainheight+"px");
</script>

</html>