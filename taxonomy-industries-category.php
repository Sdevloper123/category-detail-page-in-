<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */
get_header();
?>

<?php
$category = get_queried_object();
$current_cat = $category->term_id;
$args = array(
    'post_type' => 'industries',
    'orderby' => 'post',
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'industries-category',
            'field' => 'term_id',
            'terms' => $current_cat
        )
    )
);
$the_query = new WP_Query($args);



?>

<?php

$post_id = $the_query->post->ID;
$banner_image = get_field('banner_image', $post_id);
$banner_heading = get_field('banner_heading', $post_id);
$banner_title = get_field('banner_title', $post_id);



?>


<section class="banner_sec inner_page_bnr">
    <div class="banner_bg"> <img src="<?php echo $banner_image; ?>" alt=""> </div>
    <div class="wrapper">
        <div class="banner_cnt">
            <h3>
                <?php echo get_the_title() ?>
            </h3>
            <h1>
                <?php echo $banner_heading; ?>
            </h1>
            <p>
                <?php echo $banner_title; ?>
            </p>
        </div>
    </div>
</section>



<?php


$category = get_queried_object();
$current_cat = $category->term_id;
$args = array(
    'post_type' => 'industries',
    'orderby' => 'post',
    'order' => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'industries-category',
            'field' => 'term_id',
            'terms' => $current_cat
        )
    )
);
$the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()): ?>
    <?php while ($the_query->have_posts()):
        $the_query->the_post();

        ?>

        <?php
        $video_link = get_field('youtube_video', get_the_id());
        $youtube_thumbnail = get_field('youtube_thumbnail', get_the_id());
        $upload_video = get_field('upload_video', get_the_id());
        $video_id = get_field('video_id', get_the_id());

        $business_lits = get_field('business_lits', get_the_id());
        $technology_lists = get_field('technology_lists', get_the_id());
        $sub_title = get_field('sub_title', get_the_id());

        ?>

        <section class="data_managment">

            <div class=" wrapper">
                <div class="data_managment_inner">
                    <div class="data_managment_left">
                        <?php if ($video_link) { ?>
                            <iframe allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed"
                                src="<?php echo $video_link; ?>" width="100%" height="270">
                            </iframe>
                        <?php } elseif ($upload_video) { ?>
                            <video autoplay muted loop playsinline preload="metadata">
                                <source type="video/mp4" src="<?php echo $upload_video; ?>">
                            </video>
                        <?php } else { ?>
                            <iframe src="https://fast.wistia.net/embed/iframe/<?php echo $video_id; ?>?seo=true&videoFoam=false"
                                title="Lenny's Halloween Costume Video" allow="autoplay; fullscreen" allowtransparency="true"
                                frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" msallowfullscreen
                                width="620" height="349"></iframe>
                            <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>
                        <?php } ?>

                    </div>
                    <div class="data_managment_right">
                        <div class="small_cnt">
                            <?php echo $category->name; ?>
                        </div>
                        <h2>
                            <?php echo get_the_title(); ?>
                        </h2>
                        <p>
                            <?php $content = get_the_content();
                            ;
                            echo $content;
                            ?>
                        </p>

                        <div class="get_list">

                            <?php if ($video_link) { ?>
                                <a href="<?php echo $video_link; ?>" class="copy_text"> GET LINK </a> <span class="copy_msg"></span>

                            <?php } elseif ($upload_video) { ?>
                                <a href="<?php echo $upload_video; ?>" class="copy_text"> GET LINK </a> <span
                                    class="copy_msg"></span>

                            <?php } else { ?>
                                <a href='<?php echo "https://fast.wistia.net/embed/iframe/" . $video_id ?>' class="copy_text"> GET
                                    LINK </a> <span class="copy_msg"></span>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="technology_part">
                    <h3> Technology: </h3>
                    <ul>
                        <?php foreach ($technology_lists as $technology_item): ?>
                            <li>
                                <?php echo $technology_item['technology_title']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="cusiness_use_case">
                    <h3> Business Use Cases: </h3>
                    <ul>
                        <?php foreach ($business_lits as $business_item): ?>
                            <li>
                                <?php echo $business_item['business_title']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>


    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php get_footer(); ?>


<script>
    $(".copy_text").click(function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));
        var copyText = $(this).attr('href');
        document.addEventListener('copy', function (e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);

        document.execCommand('copy');
        console.log('copied text : ', copyText);
        $(this).text("Copied");
        document.execCommand("copy");
        $(this).parents().eq(0).find(".copy_msg").text("Copied");
        $(this).parents().eq(0).find(".copy_msg").fadeOut('5000');
    })
</script>