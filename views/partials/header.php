
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>

    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">

    




    
</head>
<body>
    <!-- CONTAINER -->

    <div id="container">
        
        <!-- HEADER -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/brandlogo.png" alt="Logo">
                <a href="<?=base_url?>">
                    
                </a>
            </div>
        </header>
        <!-- MENU -->
        <?php $categories = Helpers::showCategories(); ?>
        <nav id="menu">
            
            <ul>
                <li><a href="<?=base_url?>">All Products</a></li>

                
                <?php while($category = $categories->fetch_object()): ?>

                <li><a href="<?=base_url?>categories/show&id=<?=$category->id?>"><?= $category->name ?></a></li>

                <?php endwhile; ?>
            </ul>
            
        </nav>
        <!-- Content -->
        <div class="row">
        <div id="content">
        <div class="msg"><h2><?php if($_GET['msg']) echo $_GET['msg']?></h2></div>