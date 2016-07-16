<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List News'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
	<?= $this->Form->create($new,['type' => 'file']); ?>
	<fieldset>
		<legend><?= __('Add News') ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('category_id', ['options' => $categories]);
			echo $this->Form->input('type_id',['ontions' =>[]]);
			echo $this->Form->input('description');
			echo $this->Form->input('content', ['step' => 1]);
			echo $this->Form->input('image',['type' => 'file']);
			echo $this->Form->input('author');
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
<script type="text/javascript">
	$('#category-id').change(function(){

		$.ajax({
		   url: '/news/ajax',
		   data: {
		      category_id: $(this).val()
		   },
		   error: function() {
		     console.log('error here')
		   },
		   dataType: 'html',
		   success: function(data) {
		       $('#type-id').html(data);
		   },
		   type: 'POST'
		});




		});
</script>