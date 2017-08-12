<?php
/*
* Event Post Type Template
*/

$args = array(
    'numberposts' => -1,
    'post_type' => array('events'),
    'orderby' => 'meta_value',
    'post_status' => 'publish',
    'meta_key' => 'event-date'
);
$events = get_posts($args);
get_header();
?>
    <section class="content_block_background">
        <section class="content_block clearfix archives">
            <section <?php post_class("content "); ?> >
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