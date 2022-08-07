<h1>Manage Users</h1>

<!-- <a href="<?=base_url?>users/create" class="button button-small">Create category</a> -->

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Delete</th>
    </tr>
    
    <?php while($user = $users->fetch_object()): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->lastname ?></td>
            <td><?= $user->email ?></td>
            <td>
            <!-- <a href="<?=base_url?>users/edit&id=<?=$user->id?>" class="button button-manage">Edit</a>-->
            <a href="<?=base_url?>users/delete&id=<?=$user->id?>" class="button button-manage button-red">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
