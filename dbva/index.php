<?php echo head(array('bodyid'=>'home')); ?>

<?php if (get_theme_option('Homepage Text')): ?>
<div id="homepageText"><?php echo get_theme_option('Homepage Text'); ?></div>
<?php endif; ?>

<div id="erabox">
<h2>Looking for a specific historic era?</h2>
<?php
$collections = get_records('Collection');
set_loop_records('collections', $collections);
?>
<?php foreach (loop('collections') as $collection): ?>
    <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
		<div class="era">
	        <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
    	    <?php echo link_to_collection(); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div><!-- end erabox -->

<?php if (get_theme_option('Display Featured Item') !== '0'): ?>
<!-- Featured Item -->
<div id="featured-item">
    <h2><?php echo __('Document Spotlight'); ?></h2>
    <?php echo random_featured_items(1); ?>
</div><!--end featured-item-->
<?php endif; ?>

<div id="themebox">
<h2>Browse Documents by Theme</h2>
<?php
$tagsArray = get_recent_tags(10);
foreach ($tagsArray as $tag):
	echo "<div class=\"theme\">";
	$items = get_records('Item', array('tags'=>$tag,'sort_field'=>'random'), 1); 
	set_loop_records('items', $items);
	foreach (loop('items') as $item):
		if (metadata('items', 'has thumbnail')):
			echo "<a class=\"image\" href=\"/dbva/items/browse?tags=" . str_replace(" ","+",$tag) . "\">" . item_image('square_thumbnail') . "</a>";
		endif;
	endforeach;
	echo "<a href=\"/dbva/items/browse?tags=" . str_replace(" ","+",$tag) . "\">" . $tag . "</a>";
	echo "</div>";
endforeach
?>
</div>

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>

<?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
<!-- Featured Collection -->
<div id="featured-collection">
    <h2><?php echo __('Featured Collection'); ?></h2>
    <?php echo random_featured_collection(); ?>
</div><!-- end featured collection -->
<?php endif; ?>

<?php if ((get_theme_option('Display Featured Exhibit') !== '0')
        && plugin_is_active('ExhibitBuilder')
        && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
<!-- Featured Exhibit -->
<?php echo exhibit_builder_display_random_featured_exhibit(); ?>
<?php endif; ?>

<?php
$recentItems = get_theme_option('Homepage Recent Items');
if ($recentItems === null || $recentItems === ''):
    $recentItems = 3;
else:
    $recentItems = (int) $recentItems;
endif;
if ($recentItems):
?>
<div id="recent-items">
    <h2><?php echo __('Recently Added Items'); ?></h2>
    <?php echo recent_items($recentItems); ?>
    <p class="view-items-link"><a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>
</div><!--end recent-items -->
<?php endif; ?>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
