<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <!-- common header -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Stylesheets -->
    <?php
    queue_css_file('style');
    echo head_css();

    echo theme_header_background();
    ?>
    <style>
        #site-title a:link, #site-title a:visited,
        #site-title a:active, #site-title a:hover {
            color: #<?php echo ($titleColor = get_theme_option('header_title_color')) ? $titleColor : "000000"; ?>;
            <?php if (get_theme_option('header_background')): ?>
            text-shadow: 0px 0px 20px #000;
            <?php endif; ?>
        }
    </style>
    <!-- JavaScripts -->
    <?php 
    queue_js_file('vendor/modernizr');
    queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)'));
    queue_js_file('vendor/respond');
    queue_js_file('globals');
    echo head_js(); 
    ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

        <header>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title">&nbsp;</div>
        </header>
            
        <div class="menu-button">Menu</div>
            
        <div id="wrap">
            <div id="exhibit-nav">
                <ul>
                    <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
                    <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                    <?php echo exhibit_builder_page_summary($exhibitPage); ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="content">
                <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
