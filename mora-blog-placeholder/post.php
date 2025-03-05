<?php

include 'includes/header.php';

?>
    
    <!-- Post section -->
    <section class="post_section news_post">
        <div class="container">
            <div class="row post_section_inner">
                <!-- Left_sidebar --> 
                <div class="col-lg-8">  
                    <div class="news_left_sidebar">
                        <!-- News Item -->
                        <div class="news_item news_details">
                            <?php
                            // récupération des données d'un article en fonction de son id
                            $post = $db->prepare("SELECT * FROM post WHERE id = :id");
                            $post->execute([
                                'id' => $_GET['id'],
                            ]);
                            $post = $post->fetch();

                            $publishedAt = new DateTime($post['publishedAt']);

                            // récupération de la liste des catégories liées à l'article
                            $categories = $db->prepare("SELECT category.id AS cid, category.* FROM category, post_category
                                WHERE category.id = post_category.category_id AND post_category.post_id = :post_id");
                            $categories->execute([
                                 'post_id' => $post['id'],
                            ]);
                            ?>
                            <h6><span><?php echo $publishedAt->format("d-m-Y H:i");?></span>
                                <?php
                                while ($category = $categories->fetch()) {
                                    echo '<a href="index.php?category_id='.$category['cid'].'" class="investing">'.$category['name'].'</a>';
                                }
                                ?>

                            </h6>
                            <a href="post.php" class="news_heding"><?php echo $post['title'];?></a>
                            <p><?php echo str_replace("\n", "<br>", $post['text']);?></p>
                            <div class="share_row row">
                                <div class="col-sm-6 share_area">
                                    <ul>
                                        <li>Share:</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 back_to"><a href="/"><i class="fa fa-arrow-left"></i>Back to blog</a></div>

                            </div> 
                        </div> 



                    </div>
                </div>
                
                <!-- End left_sidebar -->
                <?php
                include 'includes/sidebar.php';
                ?>
            </div>
        </div>
    </section>
    <!-- End Post section -->

<?php

include 'includes/footer.php';
