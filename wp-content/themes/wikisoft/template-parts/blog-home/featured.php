<?php 
    $wikisoft_fp = new WP_Query([
        'meta_key' => 'featured',
        'meta_value' => 1,
        'posts_per_page' => 3
    ]);

    $featured_posts = [];

    if ($wikisoft_fp->post_count > 1):
    while($wikisoft_fp->have_posts()) {
        $wikisoft_fp->the_post();
        $categories = get_the_category();
        $random_cat = $categories[mt_rand(0, count($categories)-1)];
        $featured_posts[] = [
            'id' => get_the_ID(),
            'post_thumbnails' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
            'title' => get_the_title(),
            'author' => get_the_author_meta('display_name'),
            'avater' => get_avatar_url(get_the_author_meta('ID')),
            'date' => get_the_date(),
            'category_name' => $random_cat->name,
            'category_ID' => $random_cat->cat_ID
        ];
    }
    wp_reset_query();
?>
<div class="pageheader-content row">
    <div class="col-full">
        <div class="featured">
            <div class="featured__column featured__column--big">
                <div class="entry" style="background-image:url('<?php echo esc_url($featured_posts[0]['post_thumbnails']); ?>');">
                    
                    <div class="entry__content">
                        <span class="entry__category">
                            <a href="<?php echo esc_url(get_category_link($featured_posts[0]['category_ID'])); ?>">
                                <?php echo esc_html($featured_posts[0]['category_name']); ?>
                            </a>
                        </span>

                        <h1>
                            <a href="<?php esc_url(the_permalink($featured_posts[0]['id'])); ?>" title="<?php echo esc_attr($featured_posts[0]['title']); ?>">
                                <?php echo esc_html($featured_posts[0]['title']); ?>
                            </a>
                        </h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($featured_posts[0]['avater']); ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li>
                                    <a href="#0">
                                        <?php echo esc_html($featured_posts[0]['author']); ?>
                                    </a>
                                </li>
                                <li>
                                    <?php echo esc_html($featured_posts[0]['date']); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div> 
            </div> 

            <div class="featured__column featured__column--small">
                <?php 
                    for($i = 1; $i < 3; $i++) : 
                ?>
                <div class="entry" style="background-image:url('<?php echo esc_url($featured_posts[$i]['post_thumbnails']); ?>');">
                    
                    <div class="entry__content">
                        <span class="entry__category">
                            <a href="<?php echo esc_url(get_category_link($featured_posts[$i]['category_ID'])); ?>">
                                <?php echo esc_html($featured_posts[$i]['category_name']); ?>
                            </a>
                        </span>

                        <h1>
                            <a href="<?php esc_url(the_permalink($featured_posts[$i]['id'])); ?>" title="<?php echo esc_attr($featured_posts[$i]['title']); ?>">
                                <?php echo esc_html($featured_posts[$i]['title']); ?>
                            </a>
                        </h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo esc_url($featured_posts[$i]['avater']); ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li>
                                    <a href="#0">
                                        <?php echo esc_html($featured_posts[$i]['author']); ?>  
                                    </a>
                                </li>
                                <li>
                                    <?php echo esc_html($featured_posts[$i]['date']); ?>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div> 
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div> 
<?php endif; ?>