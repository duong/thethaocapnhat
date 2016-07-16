<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bookmarks Tag'), ['action' => 'edit', $bookmarksTag->bookmark_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bookmarks Tag'), ['action' => 'delete', $bookmarksTag->bookmark_id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarksTag->bookmark_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bookmarks Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bookmarks Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bookmark'), ['controller' => 'Bookmarks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookmarksTags view large-9 medium-8 columns content">
    <h3><?= h($bookmarksTag->bookmark_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Bookmark') ?></th>
            <td><?= $bookmarksTag->has('bookmark') ? $this->Html->link($bookmarksTag->bookmark->title, ['controller' => 'Bookmarks', 'action' => 'view', $bookmarksTag->bookmark->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tag') ?></th>
            <td><?= $bookmarksTag->has('tag') ? $this->Html->link($bookmarksTag->tag->title, ['controller' => 'Tags', 'action' => 'view', $bookmarksTag->tag->id]) : '' ?></td>
        </tr>
    </table>
</div>
