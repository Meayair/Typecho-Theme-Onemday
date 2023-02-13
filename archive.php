<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
        'category'  =>  _t('分类 " %s "下的文章'),
        'search'    =>  _t('包含关键字 " %s " 的文章'),
        'tag'       =>  _t('标签 " %s " 下的文章'),
        'author'    =>  _t('" %s " 发布的文章')
    ), '', ''); ?>-<?php $this->options->title(); ?></title>
    <meta name="keywords" content="<?php $this->options->keywords(); ?>" />
    <meta name="description" content="<?php $this->options->description(); ?>" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/moviepage/moviepage.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/moviepage/moviepage-adaptive.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/list.css'); ?>" />
    <script type="text/javascript" src="<?php $this->options->themeUrl('static/js/query.js?v21019102'); ?>"></script>
</head>

<body>
    <div id="bg"></div>

    <div id='header-wrap'>
        <?php if($this->options->logoUrl){?>
        <a href="/">
            <img src='<?php $this->options->logoUrl(); ?>'>
        </a>
        <?php }else{?>
        <a id="logo" href="/" target="_blank" style="font-size: 26px;color: #f4e5b3;text-decoration: none;margin-right: 15px;line-height: 0px;">
            <?php $this->options->title(); ?>
        </a>
        <?php }?>
    </div>

    <div class= "search-title">
    <?php $this->archiveTitle(array(
        'category'  =>  _t('分类 <a class="dot">" %s "</a> 下的文章'),
        'search'    =>  _t('包含关键字 <a class="dot">" %s "</a> 的文章'),
        'tag'       =>  _t('标签 <a class="dot">" %s "</a> 下的文章'),
        'author'    =>  _t('<a class="dot">" %s "</a> 发布的文章')
    ), '', ''); ?>
    </div>
    <div id="searchArea" style="width: 100%;height: 100%;position: fixed;top: 0;background: #181818;z-index: 999;display:none;color: white;">
        <a href="javascript:;" style="color: #f4e5b3;font-size: 40px;width: 90%;max-width: 900px;margin: auto;display: block;margin-top: 120px;text-align: right;text-decoration: none;" onclick="hidesearchArea()">×</a>
        <form action="<?php $this->options->siteUrl(); ?>" method="GET" target="_blank" id='searchForm' style="width: 80%;max-width: 800px; margin: auto;margin-top: calc(50vh - 260px);">
            <input name="s" id="search" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
            <input type="submit" id='search-btn' value="">
        </form>
        <form action="<?php $this->options->siteUrl(); ?>" method="GET" target="_blank" id='mobileSearchForm' style="width: 80%;max-width: 800px; margin: auto;margin-top: calc(50vh - 260px);padding: 0;height: 50px;border-bottom: 1px solid #f4e5b3;justify-content: space-between;align-items: center;transform: translate(0,-10px);">
            <input name="s" id="search" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
            <input type="submit" id='search-btn' value="">
        </form>
    </div>

    <a id="list-search" class='today-btn' onclick="showsearchArea()" href="javascript:;">搜索</a>
    <div id='content-wrap'>
        <?php while ($this->next()) : ?>
            <div class='day-wrap'>
                <div class='left-box'>
                    <span class='day'><?php $this->date('d'); ?></span>
                    <span class='month'><?php echo mon2han(date("m", $this->created)); ?>月</span>
                    <span class='week'>星期<?php echo week2han(date("w", $this->created)) ?></span>
                </div>
                <div class='right-box'>
                    <a class='mov-img-a' target='_blank' href='<?php $this->permalink() ?>'>
                        <img class='mov-img' src='<?php $this->fields->cover(); ?>'>
                    </a>
                    <div class='mov-info-box'>
                        <a class='mov-title-box' target='_blank' href='<?php $this->permalink() ?>'>
                            <span class='mov-title'><?php $this->title() ?></span><br>
                            <span class='mov-info'><?php $this->fields->dbPoint(); ?>&nbsp;<?php $this->fields->tags(); ?>&nbsp;<?php $this->fields->year(); ?>&nbsp;<?php $this->fields->area(); ?></span>
                        </a>
                        <span class='mov-word'><?php $this->fields->soundbite(); ?></span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <div class='pageNav' style="display:none;">
        <?php $this->pageNav(); ?>
    </div>
    <div class='end-text'>
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
        <a href="javascript:;" class="today-btn moreMovies" onclick="moreMovies()">点击加载更多</a>
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
<script>

    function showsearchArea() {
        $("#searchArea").show();
    }

    function hidesearchArea() {
        $("#searchArea").hide();
    }

    function moreMovies() {
        url = $('.next a').attr('href');
        if (url == null || url == undefined || url == "") {
            $('.end-text').html('没有更多了~')
            return;
        }
        $(".sk-chase").show();
        $(".moreMovies").hide();
        $.ajax({
            url: url,
            success: function(result) {
                var pageNav = $(result).filter(".pageNav");
                $(".pageNav").html(pageNav.html());
                var movieList = $(result).filter("#content-wrap");
                $("#content-wrap").append(movieList.html());
                $(".sk-chase").hide();
                $(".moreMovies").show();
                url = $('.next a').attr('href');
                if (url == null || url == undefined || url == "") {
                    $('.end-text').html('没有更多了~')
                    return;
                }
            }
        });
    }
    $(function(){
        url = $('.next a').attr('href');
        if (url == null || url == undefined || url == "") {
            $('.end-text').html('没有更多了~')
            return;
        }
    });
    mainheight = $(document.body).height() - $("#header-wrap").height() - $("#search-title").height() - $("#list-search").height() - 180;
    $("#content-width").css("min-height",mainheight+"px");
</script>
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
</html>