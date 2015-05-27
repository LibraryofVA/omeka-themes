<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>
<div class="element-set">
  <h1><?php echo $collectionTitle; ?><br><?php echo metadata('collection', array('Dublin Core', 'Date')); ?></h1>
  <div class="element" id="dublin-core-description">
    <div class="element-image"><?php echo record_image('collection', 'square_thumbnail'); ?></div>
    <div class="element-text"><?php echo metadata('collection', array('Dublin Core', 'Description')); ?></div>
  </div>
</div>
<div id="browse-collection">
  <h2><?php echo link_to_items_browse(__('- Browse items in %s Collection -', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
</div>
<div id="collection-items">
    <h2>Recently added items</h2>
	<?php if (metadata('collection', 'total_items') > 0): ?>
        <?php $itemLimit = 0; ?>
		<?php foreach (loop('items') as $item): ?>
        <?php if(++$itemLimit > 4) break; ?>
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
        <div class="item hentry">
            <h3><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h3>

            <?php if (metadata('item', 'has thumbnail')): ?>
            <div class="item-img">
                <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
            </div>
            <?php endif; ?>

            <?php if ($text = metadata('item', array('Item Type Metadata', 'Context'), array('snippet'=>250))): ?>
            <div class="item-description">
                <p><?php echo $text; ?></p>
            </div>
            <?php elseif ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
</div><!-- end collection-items -->

<?php echo foot(); ?>
