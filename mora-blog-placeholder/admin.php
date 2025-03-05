<?php

include 'includes/header.php';

if ( isset($_POST['category_name']) ) {
    $addCategory = $db->prepare("INSERT INTO category (name) VALUES (:name)");
    $addCategory->execute(['name' => $_POST['category_name']]);
    header('Location: admin.php');
}

if ( isset($_POST['post_title']) ) {
    $addPost = $db->prepare("INSERT INTO post (title, text, publishedAt) VALUES (:title, :text, :publishedAt)");
    $addPost->execute([
        'title' => $_POST['post_title'],
        'text' => $_POST['post_text'],
        'publishedAt' => date('Y-m-d H:i:s'),
    ]);
    $linkCategory = $db->prepare("INSERT INTO post_category (post_id, category_id) VALUES (:post_id, :category_id)");
    $postId = $db->lastInsertId();
    foreach ($_POST['categories'] as $category) {
        $linkCategory->execute([
            'post_id' => $postId,
            'category_id' => $category,
        ]);
    }
    header('Location: /');
}

?>

    <section class="post_section news_post">
        <div class="container">
            <div class="row post_section_inner">
                <div class="col-lg-8">
                    <div class="news_left_sidebar">
                        <h2>Ajouter un articles</h2>
                        <form action="admin.php" method="post">
                            <div class="form-group">
                                <label for="post_title">Titre</label>
                                <input type="text" class="form-control" id="post_title" name="post_title" aria-describedby="titleHelp">
                                <small id="titleHelp" class="form-text text-muted">Titre de l'article max 200 caractères.</small>
                            </div>
                            <div class="form-group">
                                <label for="post_text">Article</label>
                                <textarea class="form-control" id="post_text" name="post_text" rows="3"></textarea>
                            </div>
                            <?php
                            $categories = $db->prepare("SELECT * FROM category");
                            $categories->execute();
                            while ($categorie = $categories->fetch()) {
                                echo '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="'.$categorie['id'].'" id="cat_'.$categorie['id'].'">
                                <label class="form-check-label" for="cat_'.$categorie['id'].'">
                                    '.$categorie['name'].'
                                </label>
                            </div>';
                            }
                            ?>


                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>


                        <h2>Catégories</h2>
                        <ul class="list-group">
                        <?php
                        $categories = $db->prepare("SELECT * FROM category");
                        $categories->execute();
                        while ($categorie = $categories->fetch()) {
                            echo '<li class="list-group-item">'.$categorie['name'].'</li>';
                        }
                        ?>
                        </ul>
                        <form action="admin.php" method="post">
                            <div class="form-group">
                                <label for="category_name">Ajouter une catégorie</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="categoryHelp">
                                <small id="categoryHelp" class="form-text text-muted">Nom de la catégorie</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

include 'includes/footer.php';
