<?php
    $rows = get_field('services');
?>

<?php if($rows): ?>
<ul class="list-lawyer-practice-area">
    <?php foreach($rows as $row): ?>
        <li><?= $row['service']; ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>