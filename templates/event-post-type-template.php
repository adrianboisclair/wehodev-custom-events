<?php
/*
* rt-theme archive
*/
global $rt_sidebar_location, $rt_title, $wp_query;
$args = array(
    'numberposts' => 28,
    'post_type' => array(
        'events'
    ),
    'orderby' => 'meta_value',
    'post_status' => 'publish',
    'meta_key' => 'event-date'
//    'meta_query' => array(
//        array(
//            'key' => 'event-date',
//        )
//    )
);

$events = get_posts($args);

$rt_pagination = true;
$layout = "three"; //show posts in three columns - available values = one, two, three, four, five

if (is_day()) :
    $rt_title = sprintf(__('Daily Archives: %s', 'rt_theme'), get_the_date());
elseif (is_month()) :
    $rt_title = sprintf(__('Monthly Archives: %s', 'rt_theme'), get_the_date(__('F Y', 'rt_theme')));
elseif (is_year()) :
    $rt_title = sprintf(__('Yearly Archives: %s', 'rt_theme'), get_the_date(__('Y', 'rt_theme')));
elseif (is_author()) :
    $rt_title = sprintf(__('All posts by: %s', 'rt_theme'), get_the_author());
elseif (is_tag()) :
    $rt_title = sprintf(__('Tag Archives: %s', 'rt_theme'), single_tag_title('', false));
else :
    $rt_title = __('Events', 'rt_theme');
endif;


get_header();


?>

    <section class="content_block_background">
        <section class="content_block clearfix archives">
            <section <?php post_class("content " . $rt_sidebar_location[0]); ?> >
                <div class="row">
                    <ul id="events" style="list-style: none" data-sortable>
                        <?php foreach($events as $event) :
                            $event_image = wp_get_attachment_image_src(get_post_thumbnail_id( $event->ID ), 'full');
                            $event_link = '/events/';
                            $event_date = get_field( 'event-date', $event->ID );
                            ?>
                            <li data-date="<?php echo $event_date; ?>">
                                <a href="<?php echo $event_link; ?>">
                                    <img alt="<?php echo $event->post_title; ?>" class="" src="<?php echo $event_image[0]; ?>" style="max-width: 220px; height: auto;" />
                                </a>
                                <div class="info-container">
                                    <h2><?php echo $event->post_title; ?></h2>
                                    <p><?php echo $event->post_content; ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </section><!-- / end section .content -->


            <?php get_sidebar(); ?>
        </section>
    </section>

<?php get_footer(); ?>