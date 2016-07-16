<div class="col-sm-7">
  
  <figure id="img-new">
    <a href="detai.html"><img src="/files/News/image/<?php echo($latestNews['image']); ?>"></a>
  </figure>
  <h4><a href=""><?php echo($latestNews['title']); ?></a></h4>
  <p><?php echo($latestNews['description']); ?></p>

</div>
<div class="col-sm-5">
  Tin mới nhất »
  <?php foreach ($chunkData[0] as $new) : ?>
    <div class="new-box">
      <figure>
        <a href="detai.html"><img src="/files/News/image/<?= h($new->image) ?>" width="100"></a>
      </figure>
      <p><span><?= h($new->created) ?></span></p>
      <?= $this->Html->link(__(h($new->title)),['action' => 'view' , $new->id]) ?>
    </div>
    <?php endforeach; ?>
</div>