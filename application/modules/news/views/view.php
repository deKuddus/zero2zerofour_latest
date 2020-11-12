<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <script type="text/javascript"> var news_id = '<?php echo $news->id; ?>';</script>
    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('news_page')); ?>');">
        <div class="container">
            <h4>News Details </h4>
        </div>
    </section>

    <section class="row blog-content" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <article class="post post-type-image single-post row">
                        <div class="row featured-contents">
                            <a href="javascript:void(0)"><img src="<?php echo FILE_UPLOAD_PATH . $news->images; ?>" alt=""></a>
                        </div>
                        <div class="row article-body">
                            <h3 class="post-title"><a href="javascript:void(0)"><?php echo $news->title; ?></a></h3>
                            <ul class="post-meta nav">
                                <li class="post-date"><i class="fa fa-calendar-o"></i> <a href="javascript:void(0)"><?php echo date_format(date_create($news->created_at), 'd-M-Y'); ?></a></li>
                                <li class="post-comments"><i class="fa fa-comments"></i> <a href="#"><?php echo sizeof($comments); ?> comment</a></li>
                                <li class="posted-by"><i class="fa fa-user"></i>posted by: <a href="#"><?php echo $news->author; ?></a></li>
                                <li class="category"><i class="fa fa-folder"></i>category: <?php
$tags = json_decode($news->tags);
foreach ($tags as $tag) {
    foreach ($all_tags as $key => $t_val) {
        if ($tag == $t_val->id) {
            echo '<a hred="#">' . $t_val->name . '</a>';
        }
    }
}?></li>
                            </ul>
                            <div class="post-content row">
                                <?php echo $news->content; ?>
                            </div>
                            <div class="post-tags row">Tags: <a href="#">causes</a>, <a href="#">donate</a></div>
                        </div>
                    </article>

                    <div class="row related-posts">
                        <h4 class="this-title">Related post</h4>
                        <div class="row">
                            <?php foreach ($related_news as $key => $value) {?>
                                <div class="latest-post col-md-3 col-sm-6">
                                    <div class="row m0 featured_cont">
                                        <img src="<?php echo FILE_UPLOAD_PATH . $value->images; ?>" alt="blog images" class="img-responsive">
                                    </div>
                                    <h5 class="post-title"><a href="<?php echo base_url('news/view/' . $value->slug); ?>"><?php echo $value->title; ?></a></h5>
                                    <h6 class="post-meta"><a href="#"><?php echo $value->author; ?></a><a href="#"><?php echo date_format(date_create($value->created_at), 'd-M-Y'); ?></a></h6>
                                        <a href="<?php echo base_url('news/view/' . $value->slug); ?>" class="btn-primary btn-outline">read more</a>
                                    </div>
                            <?php }?>
                        </div>
                    </div>

                   <!--  <ul class="pager">
                        <li class="prev">
                            <a href="#">
                                <span class="post-sequence"><i class="fa fa-arrow-left"></i>previous post</span>
                                <h5 class="post-title">SEMINAR FOR Childrens to know about FUTURE</h5>
                            </a>
                        </li>
                        <li class="next">
                            <a href="#">
                                <span class="post-sequence">next post<i class="fa fa-arrow-right"></i></span>
                                <h5 class="post-title">Lorem ipsum simple donate event for child</h5>
                            </a>
                        </li>
                    </ul> -->

                    <!-- <div class="media author-about">
                        <div class="media-left">
                            <a href="#"><img src="images/post2/author.jpg" alt=""></a>
                        </div>
                        <div class="media-body media-middle">
                            <h4 class="author-title"><a href="#">jhon nudge</a></h4>
                            <p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris ellentesque habitant morbi tristique senectus et netus et malesuada.</p>
                            <a href="#" class="btn-primary btn-outline dark">View all post</a>
                        </div>
                    </div> -->

                </div>
                <div class="col-md-4 sidebar  post-sidebar">
                    <div class="row m0 widget widget-search">
                        <h4 class="widget-title">search</h4>
                        <form action="#" class="row m0 search-form" method="get" role="search">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search here">
                                <span class="input-group-addon"><button type="submit"><i class="fa fa-search"></i></button></span>
                            </div>
                        </form>
                    </div>

                    <div class="row m0 widget widget-category">
                        <h4 class="widget-title">categories</h4>
                        <ul class="nav" id="category">
                        </ul>
                    </div>

                    <div class="row m0 widget widget-recent-posts">
                        <h4 class="widget-title">recent post</h4>
                        <?php foreach ($latest_news as $key => $value) {?>
                            <div class="media recent-post">
                                <div class="media-left">
                                    <a href="<?php echo base_url('news/view/' . $value->slug); ?>">
                                    <img src="<?php echo FILE_UPLOAD_PATH . $value->images; ?>" alt="news image" height="80px" width="90px">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="title"><a href="<?php echo base_url('news/view/' . $value->slug); ?>"><?php echo $value->title; ?></a></h5>
                                    <h5 class="date"><i class="fa fa-calendar-o"></i><a href="#"><?php echo date_format(date_create($value->created_at), 'd-M-Y'); ?></a></h5>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row m0 comments">
                    <h4 class="this-title">Comments</h4>

                    <div id="display_comment"></div>

                </div>

                <form id="comment_form" method="post" class="row m0 comment-form contact-form">
                    <h4>leave a comments</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" id="comment_name" name="name" placeholder="Name">
                        <div class="form-error" style="color: red;"></div>
                    </div>
                    <input type="hidden" name="comment_id" id="comment_id" value="0">
                    <input type="hidden" name="post_id"  value="<?php echo $news->id; ?>">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                        <div class="form-error" style="color: red;"></div>
                    </div>
                    <input type="text" class="form-control" id="website" name="website" placeholder="Web Address">
                    <div class="form-group">
                        <textarea name="message" id="message" placeholder="Message" class="form-control"></textarea>
                        <div class="form-error" style="color: red;"></div>
                    </div>
                    <input type="submit" value="submit" class="btn-primary">
                </form>
            </div>
        </div>
    </section>