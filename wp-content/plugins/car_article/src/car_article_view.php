<?php

function car_article_view() {
    global $wpdb;
    $table_name = "gn_articles";
    $id = $_GET["id"];

    $articles = $wpdb->get_results($wpdb->prepare("SELECT id,year_model,price from $table_name where id=%s", $id));
    $article = @$articles[0];
    
    ?>

    <div class="wrap">
        <h2>Car Article</h2>
            <table class='wp-list-table widefat fixed'>
                <tr><th>Year Model</th><td><?php echo $article->year_model ?></td></tr>
            </table>
            <table class='wp-list-table widefat fixed'>
                <tr><th>Price</th><td><?php echo $article->price ?></td></tr>
            </table>
            <a href="<?php echo admin_url('admin.php?page=car-article') ?>">&laquo; Back to list</a>
    </div>
    <?php
}