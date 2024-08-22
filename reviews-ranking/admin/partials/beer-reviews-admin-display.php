<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/johnchou71
 * @since      1.0.0
 *
 * @package    Beer_Reviews
 * @subpackage Beer_Reviews/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with PHP. -->
<div>
    <div>
        <h2>Award-Winning Beer</h2>
        <table class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>Brewery name</th>
                    <th>Beer name</th>
                    <th>Style</th>
                    <th>Alcohol Content</th>
                    <th>Bitterness</th>
                    <th>Average Rating</th>
                    <th>Beer label</th>
                    <th>Brewery label</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo esc_html($beer_reviews->beer->brewery_name); ?></th>
                    <th><?php echo esc_html($beer_reviews->beer->beer_name); ?></th>
                    <th><?php echo esc_html($beer_reviews->beer->beer_style); ?></th>
                    <th><?php echo esc_html($beer_reviews->beer->beer_abv); ?>%</th>
                    <th><?php echo esc_html($beer_reviews->beer->beer_ibu); ?></th>
                    <th><?php echo esc_html($beer_reviews->beer->rating_score); ?> / 5</th>
                    <th><?php if (!empty($beer_reviews->beer->beer_label)) : ?>
                    <img src="<?php echo esc_url($beer_reviews->beer->beer_label); ?>" alt="<?php echo esc_attr($beer_reviews->beer->beer_name); ?>"><?php endif; ?></th>
                    <th><?php if (!empty($beer_reviews->beer->brewery_label)) : ?><img src="<?php echo esc_url($beer_reviews->beer->brewery_label); ?>" alt="<?php echo esc_attr($beer_reviews->beer->brewery_name); ?>"><?php endif; ?></th>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Latest Reviews</h2>
        <table class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Rating Score</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($beer_reviews->reviews as $key => $review) : ?>
            <?php if($key==10){break;}?>
                <tr>
                    <th><?php echo $key+1; ?></th>
                    <th><?php echo esc_html($review->user_name); ?></th>
                    <th><?php echo $review->created_at; ?></th>
                    <th><?php echo $review->rating_score; ?></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>       
</div>


