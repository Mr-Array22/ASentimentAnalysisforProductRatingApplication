<h1>Manage keywords</h1>

<a href="<?=base_url?>keywords/create" class="button button-small">Create keyword</a>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Value</th>
        <th>Action</th>
    </tr>
    
    
    <?php
    $i=0;
     while($keyword = $keywords->fetch_object()): 
        $i++;
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $keyword->name ?></td>
            <td><?= $keyword->value ?></td>
            <td>
                <a href="<?=base_url?>keywords/edit&id=<?=$keyword->id?>" class="button button-manage">Edit</a>
                <a href="<?=base_url?>keywords/delete&id=<?=$keyword->id?>" class="button button-manage button-red">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>