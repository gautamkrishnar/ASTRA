<?php
/**
 * The main template file
 *
 *
 * @package Doors
 * @subpackage Doors
 * @since Doors 1.0
*/
 header();
 

?>

<div id="main-content" class="main-content">
    <section id="blogpage">
        <?php
        $blog_title = get_option('blog_title', FALSE);
        $blogDes = get_option('blogDes', FALSE);
        $sbp = get_option('sidebarPosition', FALSE);
        ?>
        <div class="container">
            <?php if ($blog_title != ''): ?>
                <div class="row titlerow">
                    <h3 class="sectiontitle wow fadeInDown text-center" style="width: 100%;" data-wow-duration="700ms" data-wow-delay="300ms"><?php echo $blog_title; ?></h3>
                    <hr class="title-border">
                    <div class="clearfix"></div>
                    <div class="col-sm-6 col-sm-offset-3">
                        <p class="wow fadeInUp text-center" data-wow-duration="700ms" data-wow-delay="300ms">
                            <?php echo $blogDes; ?>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
            <div class="row blog-item">	
                <?php
                if ($sbp == 'leftSidebar'):
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="sidebar doorssidebar">
                            <?php
                            dynamic_sidebar('sidebar-1');
                            ?>                       
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = get_the_post_thumbnail(get_the_ID(), 'full', 'img-responsive');
                                } else {
                                    $thumb = '<img src="http://placehold.it/241x355" class="img-responsive" alt="' . get_the_title() . '"/>';
                                }
                                ?>
                                <div class="single-blog wow fadeInUp" data-wow-duration="700ms">
                                    <div class="blog-image">
                                        <a href="<?php echo get_the_permalink(); ?>"><?php echo $thumb; ?></a>
                                        <div class="post-date">
                                            <p><?php the_time('j') ?><span><?php the_time('F') ?></span></p>
                                        </div>
                                    </div>
                                    <div class="entry-content">							
                                        <a href="<?php echo get_the_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>
                                        <div class="entry-meta">
                                            <span><a href="#" class="text-capitalize"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="#"><i class="fa fa-comments"></i> <?php echo comments_number('0', '1', '%'); ?></a></span>
                                        </div>
                                        <p><?php echo substr(get_the_content(), 0, 111); ?></p>
                                        <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                                <?php
                            }
                            echo tw_paging_nav();
                        } else {
                            echo '<h1 class="text-center">Insert Some Post First</h1>';
                        }
                        ?>

                    </div>
                <?php else: ?>
                    <div class="col-sm-12 col-md-8">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = get_the_post_thumbnail(get_the_ID(), 'full', 'img-responsive');
                                } else {
                                    $thumb = '<img src="http://placehold.it/241x355" class="img-responsive" alt="' . get_the_title() . '"/>';
                                }
                                ?>
                                <div class="single-blog wow fadeInUp" data-wow-duration="700ms">
                                    <div class="blog-image">
                                        <a href="<?php echo get_the_permalink(); ?>"><?php echo $thumb; ?></a>
                                        <div class="post-date">
                                            <p><?php the_time('j') ?><span><?php the_time('F') ?></span></p>
                                        </div>
                                    </div>
                                    <div class="entry-content">							
                                        <a href="<?php echo get_the_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>
                                        <div class="entry-meta">
                                            <span><a href="#" class="text-capitalize"><i class="fa fa-user"></i> Posted By: <?php echo get_the_author(); ?></a></span>
                                            <span><a href="#"><i class="fa fa-comments"></i> <?php echo comments_number('0', '1', '%'); ?></a></span>
                                        </div>
                                        <p><?php echo substr(get_the_content(), 0, 111); ?></p>
                                        <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                                <?php
                            }
                            echo tw_paging_nav();
                        } else {
                            echo '<h1 class="text-center">Insert Some Post First</h1>';
                        }
                        ?>

                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="sidebar doorssidebar">
                            <?php
                            dynamic_sidebar('sidebar-1');
                            ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div><!--/.blog-item-->
        </div>
    </section> 
</div><!-- #main-content -->

<?php
get_footer();
