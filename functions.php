<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function mon2han($num){
    $mon = [1,2,3,4,5,6,7,8,9,10,11,12];
    $han=["壹","贰","叁","肆","伍","陆","柒","捌","玖","拾","拾壹","拾贰"];
    if($num && !1 !== $i = array_search($num, $mon)){
        //echo $i;
        return $han[$i];
    }
    return false;
}
function week2han($week){
    $weekarray=array("日","一","二","三","四","五","六");
    return $weekarray[$week];
};

Typecho_Plugin::factory('admin/write-post.php')->bottom = array('editor', 'reset');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('editor', 'reset');
class editor
{
    public static function reset()
    {
        
?>
    <link rel="stylesheet" href="<?php Helper::options()->themeUrl('static/css/write-post.css') ?>">
    <script>
        var themeUrl = '<?php Helper::options()->themeUrl() ?>';
    </script>
    <script src="<?php Helper::options()->themeUrl('static/js/write-post.js') ?>"></script>
         <?php 
    }
}
function themeFields($layout) {
    ?>
    <?php

    $magnet = new Typecho_Widget_Helper_Form_Element_Text('magnet', NULL, NULL, _t('磁力链接'), _t('填写磁力链接'));
    $layout->addItem($magnet);

    $baidupan = new Typecho_Widget_Helper_Form_Element_Text('baidupan', NULL, NULL, _t('百度网盘链接###密码'), _t('按照格式填写百度网盘链接和密码'));
    $layout->addItem($baidupan);

    $dbPoint = new Typecho_Widget_Helper_Form_Element_Text('dbPoint', NULL, NULL, _t('豆瓣评分'), _t('填写豆瓣评分或空'));
    $layout->addItem($dbPoint);
    
    $tags = new Typecho_Widget_Helper_Form_Element_Text('tags', NULL, NULL, _t('分类'), _t('填写类别（请用,分割）'));
    $layout->addItem($tags);
    
    $area = new Typecho_Widget_Helper_Form_Element_Text('area', NULL, NULL, _t('地区'), _t('填写地区'));
    $layout->addItem($area);
    
    $year = new Typecho_Widget_Helper_Form_Element_Text('year', NULL, NULL, _t('年份'), _t('填写年份'));
    $layout->addItem($year);
    
    $director = new Typecho_Widget_Helper_Form_Element_Text('director', NULL, NULL, _t('导演'), _t('填写导演'));
    $layout->addItem($director);
    
    $actor = new Typecho_Widget_Helper_Form_Element_Text('actor', NULL, NULL, _t('演员'), _t('填写演员（请用,分割）'));
    $layout->addItem($actor);
    
    $cover = new Typecho_Widget_Helper_Form_Element_Text('cover', NULL, NULL, _t('电影图片'), _t('填写电影图片'));
    $layout->addItem($cover);
    
    $soundbite = new Typecho_Widget_Helper_Form_Element_Text('soundbite', NULL, NULL, _t('金句'), _t('填写金句'));
    $layout->addItem($soundbite);
    
    $movdes = new Typecho_Widget_Helper_Form_Element_Textarea('movdes', NULL, NULL, _t('描述'), _t('填写电影描述'));
    $layout->addItem($movdes);
}

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);

    $friendLink = new Typecho_Widget_Helper_Form_Element_Text('friendLink', NULL, NULL, _t('友情链接（网站名称1###网站地址1@@@网站名称2###网站地址2@@@网站名称3###网站地址3）'), _t('按照格式填写友情链接'));
    $form->addInput($friendLink);
}
class Widget_Post_rand extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => $this->options->commentsListSize, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $select  = $this->select()->from('table.contents')
            ->where("table.contents.password IS NULL OR table.contents.password = ''")
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created <= ?', time())
            ->where('table.contents.type = ?', 'post')
            ->limit($this->parameter->pageSize)
            ->order('RAND()');
        $this->db->fetchAll($select, array($this, 'push'));
    }
}