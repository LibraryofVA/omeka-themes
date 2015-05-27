<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<div id="primary">

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
    <?php endif; ?>
    <?php /*
    <div class="element-set">
      <div class="element" id="dublin-core-title">
        <h3>Title</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></div>
      </div><!-- end element -->
    </div>
	*/ ?>
    <div class="element-set">
      <div class="element" id="lesson-plan-item-type-metadata-context">
        <h3>Context</h3>
        <div class="element-text"><?php echo metadata('item', array('Item Type Metadata', 'Context')); ?></div>
      </div><!-- end element -->
      <div class="element" id="lesson-plan-item-type-metadata-suggested-questions">
        <h3>Suggested Questions</h3>
        <div class="element-text"><?php echo metadata('item', array('Item Type Metadata', 'Suggested Questions')); ?></div>
      </div><!-- end element -->
    </div>
    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</div><!-- end primary -->

<aside id="sidebar">

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Era'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Themes'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</aside>

<?php echo foot(); ?>
