<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?=__('Actions') ?></li>
		<li><?= $this->Html->link(__('Add News'), ['action' => 'add']) ?></li>
	</ul>
</nav>
<div class="users index large-9 medium-8 columns content">
	<h3><?= __('News') ?></h3>

	<form method="get" action="">
		<div id="search">
			<input type="text" name="key" style="width:300px; float:left; border:none;">
			<input type="submit" value="Search" style="height:38px; border:none; background-color:#fff;">
		</div>
	</form>

	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?= $this->Paginator->sort('id') ?></th>
				<th><?= $this->Paginator->sort('category_id') ?></th>
				<th><?= $this->Paginator->sort('title') ?></th>
				<th><?= $this->Paginator->sort('description') ?></th>
				<th><?= $this->Paginator->sort('content') ?></th>
				<th><?= $this->Paginator->sort('image') ?></th>
				<th><?= $this->Paginator->sort('author') ?></th>
				<th><?= $this->Paginator->sort('created') ?></th>
				<th><?= $this->Paginator->sort('modified') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($news as $new): ?>
				<?php //debug($new); ?> 
				<tr>
					<td><?= $this->Number->format($new->id) ?></td>
					<td><?php echo $categories[$new->category_id]; ?></td>
					<td><?= h($new->title) ?></td>
					<td><?= h(substr($new->description, 0, 50)) ?></td>
					<td><?= h(substr(strip_tags($new->content), 0, 50)) ?></td>
					<td><img src="/files/News/image/<?= h($new->image) ?>" width="100"></td>
					<td><?= h($new->author) ?></td>
					<td><?= h($new->created) ?></td>
					<td><?= h($new->modified) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'),['action' => 'view' , $new->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $new->id]) ?>
						<?= $this->Form->postLink(__('Delete'),['action' => 'delete', $new->id], ['confirm' => __('Are you sure you want to delete # {0}?', $new->id)]) ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>