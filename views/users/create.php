<!-- <!-- <?php if(isset($edit) && isset($userOne) && is_object($userOne)): ?>
    <h1>Edit user <?=$userOne->name?></h1>
    <?php $url_action = base_url."users/edit&id=".$userOne->id; ?> -->
<?php else: ?>
    <h1>Create new product</h1>
    <?php $url_action = base_url."users/save"; ?>
<?php endif; ?>


<h1>Add category</h1> -->

<form action="<?=$url_action?>" method="POST">
    <label for="name" >Name</label>
    <input type="text" name="name" required value="<?=isset($userOne) && is_object($userOne) ? $userOne->name : ''; ?>">
    <label for="lastname">LastName</label>
    <input type="text" name="lastname" required  value="<?=isset($userOne) && is_object($userOne) ? $userOne->lastname : ''; ?>">

    <label for="email">Email</label>
    <input type="email" name="email" required  value="<?=isset($userOne) && is_object($userOne) ? $userOne->email : ''; ?>">
        <input type="submit">
</form>
