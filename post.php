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
                <?php if($this->options->logoUrl){?>
                <a id="logo" href="/" target="_blank">
                    <img id='logo-img' src="<?php $this->options->logoUrl(); ?>" alt="<?php $this->options->title(); ?>">
                </a>
                <?php }else{?>
                <a id="logo" href="/" target="_blank" style="font-size: 26px;color: #f4e5b3;text-decoration: none;margin-right: 15px;line-height: 0px;">
                   <?php $this->options->title(); ?>
                </a>
                <?php }?>
                <span id='mobile-search-btn' style="position:absolute;right:20px;width: 22px;height: 10px;" onclick="showsearchArea()"></span>
                <form action="" method="GET" target="_blank" id='searchForm' action="<?php $this->options->siteUrl(); ?>">
                    <input name="s" id="search" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
                    <input type="submit" id='search-btn' value="">
                </form>
            </div>
            <div id="movie-banner">
                <div id="movie-info-wrap">
                    <div id="movie-title-box">
                        <div id="movie-title"><?php $this->title() ?> </div>
                        <a id="rate-box" target="_blank">
                            <img class='db-icon' src="<?php $this->options->themeUrl('static/images/link/doubangolden.svg'); ?>" alt="">
                            <span><?php $this->fields->dbPoint(); ?></span>
                        </a>
                    </div>
                    <div id='movie-information'>
                        <?php $tags = str_replace(",", "/", $this->fields->tags);print_r($tags) ?>
                        &nbsp;&nbsp;<?php $this->fields->year(); ?>
                        &nbsp;&nbsp;<?php $this->fields->area(); ?>
                        &nbsp;&nbsp;<br>导演：<?php $this->fields->director(); ?>
                        &nbsp;&nbsp;主演：<?php foreach (explode(",", $this->fields->actor) as $key => $value) {
                            if ($key >= 5) break;
                                echo ($key ? "/" : "") . $value;
                            } ?>
                    </div>
                    <div id="movie-text">
                        <?php if ($this->fields->soundbite) : ?>“<?php $this->fields->soundbite(); ?>” <?php endif ?>
                    </div>
                    <div id="movie-intro">
                        <?php $this->fields->movdes(); ?>
                    </div>
                </div>
                <div id="movie-img-wrap">
                    <img class='movie-img' src="<?php $this->fields->cover(); ?>" alt="电影海报">
                </div>
            </div>
        </div>
    </div>

    <div id="content-width">
        <div class='area-title area-online'>
            电影观看源
        </div>
        <div class='area-link'>
            <a class='link-box' href='https://v.qq.com/x/search/?q=<?php $this->title() ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/qqvideo.svg'); ?>'><span class='link-text'>腾讯视频</span></a><a class='link-box' href='https://so.iqiyi.com/so/q_<?php $this->title() ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/iqiyi.svg'); ?>'><span class='link-text'>爱奇艺</span></a><a class='link-box' href='https://so.youku.com/search_video/q_<?php $this->title() ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/youku.svg'); ?>'><span class='link-text'>优酷</span></a><a class='link-box' href='http://meaying.com/?q=<?php $this->title() ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/pl.svg'); ?>'><span class='link-text'>
                    米影网</span></a>
        </div>

        <?php if ($this->fields->magnet || $this->fields->baidupan) { ?>

            <div class='area-title area-res'>
                电影资源
            </div>
            <div class='area-link'>
                <?php if ($this->fields->magnet) { ?>
                    <a class='link-box' href='<?php $this->fields->magnet(); ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/x10.svg'); ?>'><span class='link-text'>磁力链接</span></a>
                <?php } ?>
                <?php if ($this->fields->baidupan) {
                    $baidupanArr = explode('###', $this->fields->baidupan) ?>
                    <a class='link-box' href='<?= $baidupanArr[0] ?>' target='_blank'><img class='link-img' src='<?php $this->options->themeUrl('static/images/link/wp.svg'); ?>'><span class='link-text'>百度网盘 ( 提取码:<?= $baidupanArr[1] ?> )</span></a>
                <?php } ?>
            </div>

        <?php } ?>

        <div class='movie-info2'>
            <?php $this->content(); ?>
            <?php if ($this->fields->soundbite) : ?><p>台词金句：<?php $this->fields->soundbite(); ?>
                <p><?php endif ?>
        </div>

        <div class='area-title area-similar'>
            随机推荐
        </div>

        <div id="similar-movie-wrap">
            <?php $this->widget('Widget_Post_rand@rand', 'pageSize=8')->to($rand);
            if ($rand->have()) : ?>
                <?php while ($rand->next()) : ?>
                    <a class='similar-movie' href='<?php $rand->permalink() ?>' target='_blank'><img class='similar-movie-img' src='<?php $rand->fields->cover(); ?>'><span class='similar-movie-title'><?php $rand->title(); ?></span></a>
                <?php endwhile ?>
            <?php endif ?>
            <script>
                var similarImg = document.getElementsByClassName('similar-movie-img');
                for (var i = 0; i < similarImg.length; i++) {
                    similarImg[i].style.height = Math.round(similarImg[i].offsetWidth * 1.333) + 'px';
                }

                window.onresize = function() {
                    for (var i = 0; i < similarImg.length; i++) {
                        similarImg[i].style.height = Math.round(similarImg[i].offsetWidth * 1.5) + 'px';
                    }
                }
            </script>
        </div>




    </div>
    
    <div id='bottom'>
        <div id="bottom-width">
            <div id="bottom-logo-box">
                <a href="/?bottomlogo" class='bottom-logo' target="_blank"><?php if(!$this->options->logoUrl){?><?php $this->options->title(); ?><?php }?></a>
                <div class='bottom-btn-box'>
                    <a class='bottom-btn' href='/' target="_blank">首页</a>
                    <div class='bottom-line'></div>
                    <a class='bottom-btn' href='<?=$this->options->routingTable['archive']['url']?>' target="_blank">往日推荐</a>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <div class='bottom-line'></div>
                    <a class='bottom-btn' href='<?php $pages->permalink(); ?>' target="_blank"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if ($this->options->friendLink): ?>
            <div id="youqing-box">
               <span class='youqing-title'>友情链接：</span>
               <?php $friendlinksArr = explode('@@@',$this->options->friendLink)?>
               <?php foreach($friendlinksArr as $key=>$value){?>
               <?php if($key!=0){?><div class='bottom-line'></div><?php }?>
               <?php $friendlink = explode('###',$value)?>
               <a class='youqing-link' href='<?=$friendlink[1]?>' target="_blank"><?=$friendlink[0]?></a>
               <?php }?>
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
</script>

</html>