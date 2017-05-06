<?php defined('BASEPATH') OR exit('No direct script access allowed');
$id     = !empty($data['id']) ? $data['id'] : '';
// $data['cat_ids'] = '1,2,5';
// $data['cat_ids'] = explode(',',$data['cat_ids']);
$cat_ids = @$data['cat_ids'];
$publish = isset($data['publish']) ? $data['publish'] : 1;

$r_cat    = array_path($category_data, 0, '>', '', '--');
$cat_size = count($r_cat);
if ($cat_size > 10)
{
	$cat_size = 10;
}
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
// pr(@$_FILES);
// pr($_FILES['image']['name']);
pr(@$this->input->post());
pr($data);
?>
<?php echo form_open_multipart(base_url('admin/content_edit/'.$id), 'id="cat_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo !empty($id) ? 'Edit' : 'Add'; echo ' Article'; ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<?php
			echo form_hidden('id',$id);
			echo form_label('Title', 'title');
			echo form_input(array(
				'name'     => 'title',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$data['title']));
			echo '			<div id="title_error"></div>';
			echo form_label('Image', 'image');
			echo form_upload(array(
				'name'   => 'image',
				'class'  => 'form-control',
				'accept' => 'image/jpeg',
				'value'  => ''));
			?>
			<br>
			<div class="panel-group" id="accordion1">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <span class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion1" href="#pea_isHideToolOn1" style="cursor: pointer;display: block;" aria-expanded="false">
				    	Specify Meta Data
				    </span>
				  </div>
				  <div id="pea_isHideToolOn1" class="panel-collapse on collapse" aria-expanded="false" style="height: 0px;">
				    <div class="panel-body">
							<div class="form-group">
								<label>Meta Keyword</label>
								<textarea name="keyword" id="keyword" class="form-control"><?php echo @$data['keyword'] ?></textarea>
							</div>
							<div class="form-group">
								<label>Meta Description</label>
								<textarea name="description" id="description" class="form-control"><?php echo @$data['description'] ?></textarea>
							</div>
						</div>
				  </div>
				</div>
			</div>
			<?php
			echo form_label('Intro', 'intro');
			echo form_textarea(array(
				'name'  => 'intro',
				'class' => 'form-control',
				'rows'   => '2',
				'value' => @$data['intro']));
			echo form_label('Content', 'content');
			echo form_textarea(array(
				'name'  => 'content',
				'id'    => 'textckeditor',
				'class' => 'form-control',
				'value' => @$data['content']));

			echo form_label('Cagegory', 'category');
			?>
	 		<select name="cat_ids[]" multiple="multiple" id="cat_ids" size="<?php echo $cat_size; ?>" class="form-control">
				<?php echo createOption($r_cat, $cat_ids);?>
			</select><?php
			echo form_label('Publish', 'publish');
			echo '<div class="checkbox">';
			echo '<label>';
			echo form_checkbox(array(
				'name' => 'publish',
				'value'=> 'publish',
				'checked' => $publish
				)).' Published';
			echo '</label>';
			echo '</div>';
			?>
		</div>
		<div class="panel panel-footer">
			<?php
			echo form_button(array(
        'name'    => 'submit',
        'id'      => 'submit',
        'value'   => 'true',
        'type'    => 'success',
        'content' => 'submit',
        'class'   => 'btn btn-success'));
			echo form_button(array(
        'name'    => 'reset',
        'id'      => 'reset',
        'value'   => 'true',
        'type'    => 'reset',
        'content' => 'reset',
        'class'   => 'btn btn-warning'));
			?>
		</div>
	</div>
	<script type="text/javascript">
		CKEDITOR.replace('textckeditor');
	</script>
<?php echo form_close();


/*=====================================================
 * $data[]	= array(
 			'id'			=> $id
 		, 'par_id'	=> $par_id
 		, 'title'		=> $title);
 *====================================================*/
function array_path($data, $par_id = 0, $separate = ' / ', $prefix = '', $load_parent = '')
{
	$output = array();
	foreach((array)$data AS $dt)
	{
		if($dt['par_id'] == $par_id)
		{
			if(empty($load_parent))
			{
				$text = ($par_id==0) ? $prefix.$dt['title'] : $prefix.$separate.$dt['title'];
				$output[$dt['id']] = $text;
			}else{
				$output[$dt['id']] = ($par_id==0) ? $prefix.$dt['title'] : $prefix.$separate.$dt['title'];
				$text	= ($par_id==0) ? $prefix.$load_parent : $prefix.$separate.$load_parent;
			}
			$r = array_path($data, $dt['id'], $separate, $text, $load_parent);
			if(!empty($r)) {
				foreach($r AS $i => $j)
					$output[$i] = $j;
			}
		}
	}
	return $output;
}
function createOption($arr, $select='')
{
	$output = '';
	$valueiskey	= $check_first = false;
	foreach((array)$arr AS $key => $dt){
		if(is_array($dt)){
			list($value, $caption) = array_values($dt);
			if(empty($caption)) $caption = $value;
		}else{
			if(!$check_first) {
				if((is_numeric($key) && $key != 0)
				|| (is_string($key) && !is_numeric($key))) {
					$valueiskey = true;
				}
				$check_first = true;
			}
			if(empty($dt) && !empty($key)) $dt = $key;
			$value = $valueiskey ? $key : $dt;
			$caption = $dt;
		}
		if(isset($select)){
			if(is_array($select)) $selected = (in_array($value, $select)) ? ' selected="selected"':'';
			else    $selected = ($value==$select) ? ' selected="selected"':'';
		}else{
			$selected = '';
		}
		$output .= "<option value=\"$value\"$selected>$caption</option>";
	}
	return $output;
}

?>