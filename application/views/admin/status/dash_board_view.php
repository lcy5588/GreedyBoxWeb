<div id="page-items">
	<div><h2>文章统计</h2></div>
	
	<table class="table table-bordered table-striped"  style="margin-top:10px;">
    <thead>
      <tr>
        <th>类别名称</th>
        <th>标签</th>
        <th>条目</th>
		<th>点击</th>
        <th>点击/条目</th>
		
      </tr>
    </thead>
    <tbody>
	<?php if($articlequery->num_rows()>0){ ?>
	<?php
	 foreach ($articlequery->result() as $array):
	//条目开始
		?>
	<tr>
        <th><?php echo $array->name ?></th>
		<th><?php echo $array->title ?></th>
        <th><?php echo $array->count ?></th>
        <td><?php echo $array->sum ?></td>
        <td><?php if($array->count != 0) echo $array->sum/$array->count; ?></td>
     </tr>
	<?php
    //条目结束
    endforeach;?>
	<?php } ?>
        <tr>
            <th>总计</th>
			<th></th>
            <th><?php echo $article_item_count_sum; ?></th>
            <th><?php echo $article_click_count_sum; ?></th>
            <td><?php echo $article_click_count_sum/$article_item_count_sum; ?></td>
			
          </tr>
		</tbody>
  </table>

	
	
	<div><h2>商品统计</h2></div>
	
	<table class="table table-bordered table-striped"  style="margin-top:10px;">
    <thead>
      <tr>
        <th>类别名称</th>
        <th>标签</th>
        <th>条目</th>
		<th>点击</th>
        <th>点击/条目</th>
		
      </tr>
    </thead>
    <tbody>
	<?php if($itemquery->num_rows()>0){ ?>
	<?php
	 foreach ($itemquery->result() as $array):
	//条目开始
		?>
	<tr>
        <th><?php echo $array->name ?></th>
		<th><?php echo $array->title ?></th>
        <th><?php echo $array->count ?></th>
        <td><?php echo $array->sum ?></td>
        <td><?php if($array->count != 0) echo $array->sum/$array->count; ?></td>
     </tr>
	<?php
    //条目结束
    endforeach;?>
	<?php } ?>
        <tr>
            <th>总计</th>
			<th></th>
            <th><?php echo $item_item_count_sum; ?></th>
            <th><?php echo $item_click_count_sum; ?></th>
            <td><?php echo $item_click_count_sum/$item_item_count_sum; ?></td>
			
          </tr>
		</tbody>
  </table>

	
	
	<div><h2>笑点统计</h2></div>
	
	<table class="table table-bordered table-striped"  style="margin-top:10px;">
    <thead>
      <tr>
        <th>类别名称</th>
        <th>标签</th>
        <th>条目</th>
		<th>点击</th>
        <th>点击/条目</th>
		
      </tr>
    </thead>
    <tbody>
	<?php if($jokequery->num_rows()>0){ ?>
	<?php
	 foreach ($jokequery->result() as $array):
	//条目开始
		?>
	<tr>
        <th><?php echo $array->name ?></th>
		<th><?php echo $array->title ?></th>
        <th><?php echo $array->count ?></th>
        <td><?php echo $array->sum ?></td>
        <td><?php if($array->count != 0) echo $array->sum/$array->count; ?></td>
     </tr>
	<?php
    //条目结束
    endforeach;?>
	<?php } ?>
        <tr>
            <th>总计</th>
			<th></th>
            <th><?php echo $joke_item_count_sum; ?></th>
            <th><?php echo $joke_click_count_sum; ?></th>
            <td><?php echo $joke_click_count_sum/$joke_item_count_sum; ?></td>
          </tr>
		</tbody>
  </table>

  <div><h2>用户统计</h2></div>
	
	<table class="table table-bordered table-striped"  style="margin-top:10px;">
    <thead>
      <tr>
        <th>类别名称</th>
        
        <th>条目</th>
		
		
      </tr>
    </thead>
    <tbody>
        <tr>
            <th>总计</th>
			
            <th><?php echo $usercount; ?></th>
          
          </tr>
		</tbody>
  </table>
	
</div>

</div>
<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery.js'></script>
</body>
</html>
