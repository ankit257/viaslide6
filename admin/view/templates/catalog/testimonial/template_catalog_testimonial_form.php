<?php echo $header; echo $menu; ?>
<div id="content">
  <div class="breadcrumb">
        <a href="index.php?route=common/home">Home</a>
         :: <a href="index.php?route=catalog/testimonial">Testimonial</a>
      </div>
    
    <?php if(!empty($notification)) : ?>  
    <div class="warning"><?php echo $notification; ?></div>  
    <?php endif; ?>
      
    <div class="box">
    <div class="heading">
      <h1><img alt="" src="view/image/testimonial.png"> Testimonial</h1>
      <div class="buttons"><a class="button" onclick="$('#form').submit();">Save</a><a class="button" href="index.php?route=catalog/testimonial">Cancel</a></div>
    </div>
    <div class="content">
      <div class="htabs" id="tabs"><a href="#tab-general" style="display: inline;" class="selected">General</a><a href="#tab-data" style="display: inline;" class="">Data</a></div>
      <form id="form" enctype="multipart/form-data" method="post" action="">
        <div id="tab-general" style="display: block;">
          <div class="htabs" id="languages">
                        <a href="#language1" style="display: inline;" class="selected"><img title="English" src="view/image/flags/gb.png"> English</a>
                      </div>
                    <div id="language1" style="display: block;">
            <table class="form">
              <tbody><tr>
                <td><span class="required">*</span> Testimonial Title:</td>
                <td><input type="text" value="<?php echo $title; ?>" size="100" name="info[title]">
                	<?php if(!empty($testimonial_name_error)) : ?>
                	<span class="error"><?php echo $testimonial_name_error; ?></span>
                    <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td>Description:</td>
                <td><textarea class="ckeditor" id="description1" name="info[content]" style="visibility: hidden; display: none;"><?php echo $content; ?></textarea></td>
              </tr>
            
              <tr>
               <td>Posted By:</td>
               <td><input type="text" value="<?php echo $posted_by; ?>" name="info[posted_by]"></td>
             </tr>

              <tr>
               <td>Email:</td>
               <td><input type="text" value="<?php echo $posted_by_email; ?>" name="info[posted_by_email]"></td>
             </tr>

            
            </tbody></table>
          </div>
                  </div>
        <div id="tab-data" style="display: none;">
          <table class="form">
            <tbody>
            <tr>
              <td>Image:</td>
              <td valign="top"><div class="image"><img id="thumb" alt="" src="http://localhost/opencart/image/cache/no_image-100x100.jpg">
                  <input type="hidden" id="image" value="<?php echo $image; ?>" name="info[image]">
                  <br>
                  <a onclick="image_upload('image', 'thumb');">Browse</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', 'http://localhost/opencart/image/cache/no_image-100x100.jpg'); $('#image').attr('value', '');">Clear</a></div></td>
            </tr>
            <tr>
              <td>Sort Order:</td>
              <td><input type="text" size="1" value="<?php echo $sort_order; ?>" name="info[sort_order]"></td>
            </tr>
            <tr>
              <td>Status:</td>
              <td><select name="info[status]">
                                    <option <?php echo $status == 1 ? 'selected="selected"' : ''; ?> value="1">Enabled</option>
                  <option <?php echo $status == 0 ? 'selected="selected"' : ''; ?> value="0">Disabled</option>
                                  </select></td>
            </tr>
          </tbody></table>
        </div>
        <!--<div id="tab-design" style="display: none;">
          <table class="list">
            <thead>
              <tr>
                <td class="left">Stores:</td>
                <td class="left">Layout Override:</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left">Default</td>
                <td class="left"><select name="testimonial_layout[0][layout_id]">
                    <option value=""></option>
                                                            <option value="6">Account</option>
                                                                                <option value="10">Affiliate</option>
                                                                                <option value="3">testimonial</option>
                                                                                <option value="7">Checkout</option>
                                                                                <option value="8">Contact</option>
                                                                                <option value="4">Default</option>
                                                                                <option value="1">Home</option>
                                                                                <option value="11">Testimonial</option>
                                                                                <option value="5">Manufacturer</option>
                                                                                <option value="2">Product</option>
                                                                                <option value="9">Sitemap</option>
                                                          </select></td>
              </tr>
            </tbody>
                      </table>
        </div>-->
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'Image Manager',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
	delay: 500,
	source: function(request, response) {		
		$.ajax({
			url: 'index.php?route=catalog/testimonial/autocomplete&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					'testimonial_id':  0,
					'name':  ' --- None --- '
				});
				
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.testimonial_id
					}
				}));
			}
		});
	},
	select: function(event, ui) {
		$('input[name=\'path\']').val(ui.item.label);
		$('input[name=\'parent_id\']').val(ui.item.value);
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 
<script type="text/javascript"><!--
// Filter
$('input[name=\'filter\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.filter_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#testimonial-filter' + ui.item.value).remove();
		
		$('#testimonial-filter').append('<div id="testimonial-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="testimonial_filter[]" value="' + ui.item.value + '" /></div>');

		$('#testimonial-filter div:odd').attr('class', 'odd');
		$('#testimonial-filter div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});

$('#testimonial-filter div img').live('click', function() {
	$(this).parent().remove();
	
	$('#testimonial-filter div:odd').attr('class', 'odd');
	$('#testimonial-filter div:even').attr('class', 'even');	
});
//--></script> 

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--

$('#tabs a').tabs(); 

$('#languages a').tabs(); 

//--></script> 

<?php echo $footer; ?>