<div class="lx">
  <h4>Tin Chính Khác</h4>
  <?php foreach ($chunkData[1] as $new) : ?>
    <?php //debug($new); ?>
  <div class="new-box">
    <figure>
      <a href=""><img src="/files/News/image/<?= h($new->image) ?>" width="100"></a>
    </figure>
    <p><span><?= h($new->created) ?></span></p>
    <p><a href=""><?= h($new->title) ?></a></p>
  </div>
  <?php endforeach; ?>
</div>