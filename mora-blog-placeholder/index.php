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
                        <?php

                        // récupération des articles
                        if ( isset($_GET['q'])) { // dans le cas d'une recherche depuis la bar latérale
                            $posts = $db->prepare("SELECT * FROM post 
                                WHERE title LIKE :title
                                OR text LIKE :text
                                ORDER BY publishedAt DESC");
                            $posts->execute([
                                'title' => '%'.$_GET['q'].'%',
                                'text' => '%'.$_GET['q'].'%',
                            ]);
                        } elseif ( isset($_GET['category_id'])) { // dans le cas de l'affichage d'une catégorie
                            $posts = $db->prepare("SELECT * FROM post, post_category
                                WHERE post.id = post_category.post_id AND post_category.category_id = :category_id
                                ORDER BY post.publishedAt DESC");
                            $posts->execute([
                                'category_id' => $_GET['category_id'],
                            ]);
                        } else { // sinon on affiche tous les articles de la base
                            $posts = $db->prepare("SELECT * FROM post ORDER BY publishedAt DESC");
                            $posts->execute();
                        }

                        // boucle d'affichage des articles
                        while ($post = $posts->fetch()) {
                            $publishedAt = new DateTime($post['publishedAt']);
                            echo '<div class="news_item">
                                <h6>'.$publishedAt->format("d-m-Y H:i").'</h6>
                                <a href="post.php?id='.$post['id'].'" class="news_heding">'.$post['title'].'</a>
                                <p>'.substr(str_replace("\n", "<br>", $post['text']), 0, 300).
                                ((strlen($post['text'])>300)?'...':'').'</p>
                                <a href="post.php?id='.$post['id'].'" class="red_btn">Lire la suite <i class="fa fa-arrow-right"></i></a>
                            </div>';
                        }

                        ?>
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
