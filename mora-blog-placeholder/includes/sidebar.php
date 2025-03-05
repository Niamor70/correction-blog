<div class="col-lg-4 right_sidebar">
    <form action="/" method="get">
    <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
    </div>
    </form>
    <div class="categories">
        <h3>Post Categories</h3>
        <ul class="cpost_categories">
            <?php

            $categories = $db->prepare("SELECT * FROM category");
            $categories->execute();

            $countPost = $db->prepare("SELECT post.id FROM post, post_category 
                    WHERE post.id = post_category.post_id AND post_category.category_id = :category_id");

            while ($category = $categories->fetch()) {
                $countPost->execute([
                        "category_id" => $category['id'],
                ]);
                echo '<li><a href="/?category_id='.$category['id'].'"'.
                    ((isset($_GET['category_id']) && $_GET['category_id'] == $category['id'])?' class="active"':'')
                    .'>'.$category['name'].'<span>'.$countPost->rowCount().'</span></a></li>';
            }

            ?>
        </ul>
    </div>
</div>
