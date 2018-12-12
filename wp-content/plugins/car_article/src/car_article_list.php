<?php

function car_article_list() {
    ?>
    <div class="wrap">
        <h2>Car Article</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=car-article-create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = "gn_articles";

        $rows = $wpdb->get_results("SELECT id, year_model, price from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Model</th>
                <th class="manage-column ss-list-width">Price</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->year_model; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->price; ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=car-article-update&id=' . $row->id); ?>">Update</a>
                        <a href="<?php echo admin_url('admin.php?page=car-article-view&id=' . $row->id); ?>">View</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}