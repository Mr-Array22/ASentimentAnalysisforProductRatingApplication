<!-- <?php if(isset($edit) && isset($categoryOne) && is_object($categoryOne)): ?>
    <h1>Edit product <?=$categoryOne->name?></h1>
    <?php $url_action = base_url."categories/save&id=".$categoryOne->id; ?>
<?php else: ?>
    <h1>Create new category</h1>
    <?php $url_action = base_url."categories/save"; ?>
<?php endif; ?> -->


<h1>Add category</h1>

<form action="<?=$url_action?>" method="POST">
    <label for="name" >Name</label>
    <input type="text" name="name" required value="<?=isset($categoryOne) && is_object($categoryOne) ? $categoryOne->name : ''; ?>">

    <input type="submit">
</form>