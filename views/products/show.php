<?php if(isset($productOne)):

    if($memberComment->num_rows){
        $memberComment1 = $memberComment->fetch_object();
        $comment_description=$memberComment1->comment_description;
        //$actionurl = base_url."products/saveComment&id=".$_GET['id']."&member_id=".$_SESSION['id'];

    }
        else{
            $comment_description="";
        //     $actionurl = base_url."products/saveComment&id=".$_GET['id'];
        }

        //echo $productRate;exit;
    ?>


<h1><?=$productOne->name?></h1>

<div id="detail-product">
    <div class="image">
        <?php if($productOne->image != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$productOne->image?>" alt="">
        <?php else: ?>
            <img src="<?=base_url?>assets/img/camiseta.png" alt="">
        <?php endif; ?>
        
        <div class="wrapper">
		<form action="<?=base_url."products/saveComment"?>" method="post" class="form">
			<input type="text" class="name" name="mem_name" placeholder="Name" value="<?=$_SESSION['user_identity']->name?>">
			<br>
			<textarea name="comment_description" cols="30" rows="10" class="message" placeholder="Message"><?=$comment_description?></textarea>
			<br>
			<input type="hidden" name="member_id" value="<?=$_SESSION['user_identity']->id?>" >
            <input type="hidden" name="product_id" value="<?=$productOne->id?>" >
			<button type="submit" class="btn" name="post_comment">Save</button>
		</form>
	</div>


    </div>
    <div class="data">
        <p class="description"><?=$productOne->description?></p>
        <p class="price"><?=$productOne->price ?></p>
        <a href="<?=base_url?>cart/add&id=<?=$productOne->id?>"class="button">Buy</a>
        <br>
        Rate <?=$productRate?>
        <br>
        <div class="containerdiv">
                <div>
                <img src="<?=base_url?>assets/img/stars_blank.png" alt="img" style="width:300px;">
                </div>
                <div class="cornerimage" style="width:<?=$productRate*10?>%;">
                <img src="<?=base_url?>assets/img/stars_full.png" alt="img" style="width:300px;">
                </div>
        </div>
        <br>
    </div>
    <br>
    <div class="content">
    <?php
        while($comment = $commentOne->fetch_object()):
            $date=date_create($comment->comment_date);
            $new_date=date_format($date,'Y-m-d h:i:sa');
            $memid=$comment->member_id;
            $memsess=$_SESSION['user_identity']->id;
        ?>
        <div class="containerdiv">
                <div>
                <img src="<?=base_url?>assets/img/stars_blank.png" alt="img" style="width:300px;">
                </div>
                <div class="cornerimage" style="width:<?=$comment->comment_value*10?>%;">
                <img src="<?=base_url?>assets/img/stars_full.png" alt="img" style="width:300px;">
                </div>
        </div>
        <div style="float:left;">
        <h2><?= $comment->member_name ?></h2>
        <h2><?=$new_date?></h2>
        <h2><?= $comment->comment_description ?></h2>
        <br>
    <?php if ($memid==$memsess):?>
        <a href="<?=base_url?>products/deletecomment&id=<?=$productOne->id?>" class="button button-manage button-red">Delete</a> 
        <?php endif;?>
        <?php endwhile; ?>
    </div>
	</div>
</div>
<?php else:?>
    <h1>Product no exist</h1>
<?php endif;?>

