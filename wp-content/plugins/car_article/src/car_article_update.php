<?php

function car_article_update() {
    global $wpdb;
    $table_name = "gn_articles";
    $id = $_GET["id"];

    $year_model = $_POST["year_model"];
    $price = $_POST["price"];

    //update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array(
                    'price' => $price,
                    'year_model' => $year_model
                ), //data
                array('id' => $id)
        );
    }
    //delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $articles = $wpdb->get_results($wpdb->prepare("SELECT id,year_model,price from $table_name where id=%s", $id));
        foreach ($articles as $item) {
            $year_model = $item->year_model;
            $price = $item->price;
        }
    }
    ?>

    <div class="wrap">
        <h2>Car Article</h2>

        <?php if (@$_POST['delete']) { ?>
            <div class="updated"><p>Car Article deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=car-article') ?>">&laquo; Back to list</a>

        <?php } else if (@$_POST['update']) { ?>
            <div class="updated"><p>Car Article updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=car-article') ?>">&laquo; Back to list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Year Model</th><td><input type="text" name="year_model" value="<?php echo $year_model; ?>"/></td></tr>
                </table>
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Price</th><td><input type="text" name="price" value="<?php echo $price; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Do you want delete it?')">
            </form>
        <?php } ?>

    </div>
    <?php
}