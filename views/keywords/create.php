<?php if(isset($edit) && isset($keywordOne) && is_object($keywordOne)): ?>
    <h1>Edit product <?=$keywordOne->name?></h1>
    <?php $url_action = base_url."keywords/save&id=".$keywordOne->id; ?>
<?php else: ?>
    <h1>Add new Keyword</h1>
    <?php $url_action = base_url."keywords/save"; ?>
<?php endif; ?>

<h1>Add keyword</h1>

<form action="<?=$url_action?>" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" required value="<?=isset($keywordOne) && is_object($keywordOne) ? $keywordOne->name : ''; ?>">
    <label for="name">Value</label>
    <input type="text" name="value" required value="<?=isset($keywordOne) && is_object($keywordOne) ? $keywordOne->value : ''; ?>">
    <input type="submit">
</form>