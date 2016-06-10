<?php
require_once("Tax-meta-class.php");
if (is_admin()){

  $prefix = 'bpxl_';

  $config = array(
    'id' => 'bpxl_cat_meta_box',          // meta box id, unique per meta box
    'title' => 'BloomPixel Meta Box',    // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $my_meta =  new Tax_Meta_Class($config);
  
  /*
   * Add fields to your meta box
   */
  
  // Category Primary Color
  $my_meta->addColor($prefix.'color_field_id',array('name'=> __('Category Primary Color ','tax-meta')));
  
  // Category Background Color
  $my_meta->addColor($prefix.'cat_bg_color_field_id',array('name'=> __('Background Color ','tax-meta')));
  
  // Category Cover Image
  $my_meta->addImage($prefix.'cat_cover_img',array('name'=> __('Category Cover Image ','tax-meta')));
  
  // Background Image
  $my_meta->addImage($prefix.'bg_field_id',array('name'=> __('Background Image ','tax-meta')));
  
  // Background Repeat
  $my_meta->addSelect($prefix.'category_repeat_id',array('repeat'=>'Repeat','no-repeat'=>'No Repeat'),array('name'=> __('Background Repeat ','tax-meta'), 'std'=> array('repeat')));
  
  // Background Attachment
  $my_meta->addSelect($prefix.'category_attachment_id',array('fixed'=>'Fixed','scroll'=>'Scroll'),array('name'=> __('Background Attachment ','tax-meta'), 'std'=> array('repeat')));
  
  // Background Position
  $my_meta->addSelect($prefix.'category_position_id',array('center'=>'Center','bottom'=>'Bottom','left'=>'Left','top'=>'Top'),array('name'=> __('Background Position ','tax-meta'), 'std'=> array('repeat')));
  
  // Background Size
  $my_meta->addSelect($prefix.'category_size_id',array('inherit'=>'Inherit','cover'=>'Cover','contain'=>'Contain'),array('name'=> __('Background Size ','tax-meta'), 'std'=> array('repeat')));
  
  $my_meta->Finish();
}
