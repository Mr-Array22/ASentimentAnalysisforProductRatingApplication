<h1>Manage categories</h1>

<a href="<?=base_url?>categories/create" class="button button-small">Create category</a>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>
   
    <?php while($category = $categories->fetch_object()): ?>
        <tr>
            <td><?= $category->id ?></td>
            <td><?= $category->name ?></td>
            <td>
                <a href="<?=base_url?>categories/edit&id=<?=$category->id?>" class="button button-manage">Edit</a>
                <a href="<?=base_url?>categories/delete&id=<?=$category->id?>" class="button button-manage button-red">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>