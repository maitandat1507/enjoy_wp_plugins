<?php

function car_article_create() {
    global $wpdb;
    $table_name = "gn_articles";
    $id = @$_GET["id"];

    $year_model = @$_POST["year_model"];
    $price = @$_POST["price"];

    //update
    if (isset($_POST['insert'])) {
        $wpdb->insert(
                $table_name, //table
                //array('year_model' => $year_model), //data
                array(
                    'price' => $price,
                    'year_model' => $year_model
                )
        );
 
    }

    ?>

    <div class="wrap">
        <h2>Add New Car Article</h2>
        <?php if (@$_POST['insert']) { ?>
            <div class="updated"><p>Car Article inserted</p></div>
            <a href="<?php echo admin_url('admin.php?page=car-article') ?>">&laquo; Back to list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Year Model</th><td><input type="text" name="year_model" value="<?php echo $year_model; ?>"/></td></tr>
                </table>
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Price</th><td><input type="text" name="price" value="<?php echo $price; ?>"/></td></tr>
                </table>
                <input type='submit' name="insert" value='Save' class='button'>
            </form>
       <?php } ?>

    </div>
    <?php
}