<?php

/**
 * 自定义首页模板
 *
 * @package index
 */
$this->widget('Widget_Contents_Post_Recent', 'pageSize=1')->to($news);
if ($news->have()) {
    while ($news->next()) {
    }
}
function mon2han($num)
{
    $mon = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $han = ["壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖", "拾", "拾壹", "拾贰"];
    if ($num && !1 !== $i = array_search($num, $mon)) {
        //echo $i;
        return $han[$i];
    }
    return false;
}
$weekarray = array("日", "一", "二", "三", "四", "五", "六");
function year2han($year)
{
    $res = "";
    $han = ["零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖", "拾"];
    foreach (str_split($year) as $value) {
        $res .= $han[$value]; // code...
    }
    return $res;
}
?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <meta name="keywords" content="<?php $this->options->keywords(); ?>" />
    <meta name="description" content="<?php $this->options->description(); ?>" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('static/css/index.css'); ?>" />
</head>

<body>

    <!-- main-wrap -------------------------------->
    <div id="main-wrap-box">
        <div id="bgimg-wrap">
            <div id='bgimg' style="background-image: url(<?php $news->fields->cover(); ?>)">
                <div id="bg-black"></div>
            </div>
        </div>
        <div id="main-wrap">
            <div id="day-wrap">
                <div id="day-content">
                    <span id='month'><?php echo mon2han(date("m")); ?>月</span>
                    <span id='day'><?php echo date("d"); ?></span>
                    <span id='day-line'></span>
                    <div id='weekbox' class="nomin">
                        <span id='week'>星期<?php echo $weekarray[date("w")] ?></span>
                        <div id='weather'>
                            <!-- 和风天气 -->
                            <div id="he-plugin-simple"></div>
                        </div>
                    </div>
                    <div id='daytext'><?php echo year2han(date("Y")) ?> &nbsp;年</div>
                </div>
            </div>
            <div id="content-wrap">
                <form action="" method="GET" target="_blank" id='searchForm' action="<?php $this->options->siteUrl(); ?>">
                    <input name="s" id="search" type="text" placeholder="输入电影名称进行搜索..." autocomplete="off" autofocus>
                    <input type="submit" id='search-btn' value="">
                </form>


                <div id="movie-wrap">
                    <a class="nomin" id='movie-img-a' href="<?php $news->permalink() ?>" target="_blank">
                        <div id='movie-img-box'>
                            <div id='movie-img-fixed'>查看详情</div>
                            <img id='movie-img' src="<?php $news->fields->cover(); ?>" alt="">
                        </div>
                    </a>
                    <a class="nomin" id='movie-information' href="<?php $news->permalink() ?>" target="_blank"><?php $news->fields->dbPoint(); ?>分&nbsp;<?php $news->fields->tags(); ?>&nbsp;<?php $news->fields->year(); ?>&nbsp;<?php $news->fields->area(); ?></a>

                    <span id='movie-text'><?php $news->fields->soundbite(); ?></span>
                    <a id='movie-name' href="<?php $news->permalink() ?>" target="_blank">——《<?php $news->title(); ?>》</a>

                </div>
            </div>
        </div>

        <!-- bottom-wrap -------------------------------->
        <div id='bottom-wrap' class="nomin">
            <div class='logo'><?php if(!$this->options->logoUrl){?><?php $this->options->title(); ?><?php }?></div>
            <span>每天一部优秀电影</span>
            <div class='bottom-line'></div>
            <a class='bottom-btn share-movie-btn' href='<?=$this->options->routingTable['archive']['url']?>' target="_blank">往日推荐</a>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <div class='bottom-line'></div>
                <a class='bottom-btn share-movie-btn' href='<?php $pages->permalink(); ?>' target="_blank"><?php $pages->title(); ?></a>
            <?php endwhile; ?>
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

</body>
<script type="text/javascript" src="<?php $this->options->themeUrl('static/js/query.js?v21019102'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('static/js/base.js?v041e8022'); ?>"></script>
<!-- weatherjs-->
<div id="he-plugin-simple"></div>
<script>
    WIDGET = {
        "CONFIG": {
            "modules": "102",
            "background": "5",
            "tmpColor": "F4E5B3",
            "tmpSize": "16",
            "cityColor": "F4E5B3",
            "citySize": "16",
            "aqiColor": "F4E5B3",
            "aqiSize": "16",
            "weatherIconSize": "24",
            "alertIconSize": "18",
            "padding": "0px 0px 0px 0px",
            "shadow": "0",
            "language": "auto",
            "fixed": "false",
            "vertical": "center",
            "horizontal": "right",
            "key": "3d6dd52bc1024722b957ac6819140bf4"
        }
    }
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
    .logo{
        <?php if($this->options->logoUrl){?>
        background-image:url('<?php $this->options->logoUrl(); ?>');
        <?php }else{?>
        width:unset;
        color: #f4e5b3;
        text-decoration: none;
        line-height: 23px;
        <?php }?>
    }
</style>
<script src="https://widget.qweather.net/simple/static/js/he-simple-common.js?v=2.0"></script>
<!-- weatherjs end     -->

</html>