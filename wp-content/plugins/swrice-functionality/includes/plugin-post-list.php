<?php
/**
 * Plugin Post List (One Page)
 * Description: Shortcode to display plugin posts with category filter & VIP design (Single File)
 */

if ( ! defined('ABSPATH') ) exit;

/* -------------------------------------------------
   ENQUEUE INLINE CSS + JS
--------------------------------------------------*/
add_action('wp_enqueue_scripts', function () {

    /* CSS */
    wp_register_style('ppl-inline-style', false);
    wp_enqueue_style('ppl-inline-style');

    wp_add_inline_style('ppl-inline-style', '
        .ppl-wrapper{max-width:1200px;margin:auto}
        .ppl-category-filter{padding:12px 16px;border-radius:8px;border:1px solid #ddd;margin-bottom:30px}
        .ppl-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px}
        .ppl-card{background:#fff;border-radius:16px;padding:20px;box-shadow:0 12px 30px rgba(0,0,0,.08);transition:.3s}
        .ppl-card:hover{transform:translateY(-6px);box-shadow:0 18px 45px rgba(0,0,0,.12)}
        .ppl-thumb img{border-radius:12px;margin-bottom:15px}
        .ppl-card h3{font-size:18px;margin-bottom:10px}
        .ppl-card p{font-size:14px;color:#666}
        .ppl-btn{display:inline-block;margin-top:12px;padding:10px 16px;background:linear-gradient(135deg,#4f46e5,#6366f1);color:#fff;border-radius:10px;text-decoration:none}
    ');

    /* JS */
    wp_register_script('ppl-inline-js', false, ['jquery'], null, true);
    wp_enqueue_script('ppl-inline-js');

    wp_add_inline_script('ppl-inline-js', '
        jQuery(document).on("change",".ppl-category-filter",function(){
            let cat=jQuery(this).val();
            jQuery.post("'.admin_url('admin-ajax.php').'",{
                action:"ppl_filter",
                category:cat
            },function(res){
                jQuery("#ppl-posts").html(res);
            });
        });
    ');
});

/* -------------------------------------------------
   SHORTCODE
--------------------------------------------------*/
add_shortcode('plugin_post_list', function () {

    ob_start();

    $categories = get_terms([
        'taxonomy'   => 'category',
        'hide_empty' => true
    ]);
    ?>

    <div class="ppl-wrapper">

        <select class="ppl-category-filter">
            <option value="all">All Plugins</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo esc_attr($cat->slug); ?>">
                    <?php echo esc_html($cat->name); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="ppl-grid" id="ppl-posts">
            <?php echo ppl_render_posts('all'); ?>
        </div>

    </div>

    <?php
    return ob_get_clean();
});

/* -------------------------------------------------
   RENDER POSTS
--------------------------------------------------*/
function ppl_render_posts($category) {

    $args = [
        'post_type'      => 'page',
        'posts_per_page' => 9
    ];

    if ($category !== 'all') {
        $args['tax_query'] = [[
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $category
        ]];
    }

    $q = new WP_Query($args);
    ob_start();

    if ($q->have_posts()):
        while ($q->have_posts()): $q->the_post(); ?>

            <div class="ppl-card">
                <?php if (has_post_thumbnail()): ?>
                    <div class="ppl-thumb"><?php the_post_thumbnail('medium'); ?></div>
                <?php endif; ?>
                <h3><?php the_title(); ?></h3>
                <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                <a class="ppl-btn" href="<?php the_permalink(); ?>">View Plugin</a>
            </div>

        <?php endwhile;
        wp_reset_postdata();
    else:
        echo '<p>No plugins found.</p>';
    endif;

    return ob_get_clean();
}

/* -------------------------------------------------
   AJAX FILTER
--------------------------------------------------*/
add_action('wp_ajax_ppl_filter','ppl_ajax_filter');
add_action('wp_ajax_nopriv_ppl_filter','ppl_ajax_filter');

function ppl_ajax_filter(){
    echo ppl_render_posts( sanitize_text_field($_POST['category']) );
    wp_die();
}