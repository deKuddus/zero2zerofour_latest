<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('news_page')); ?>');">
        <div class="container">
            <h4>Our News</h4>
        </div>
    </section>

 <section class="row latest_news" style="background-color: #fff;">
        <div class="container">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">NEWS OF HELPING HANDS</h6>
                <h3>LATEST NEWS AT HELPING HANDS</h3>
            </div>
            <div class="row">
                <?php if ($all_news) {foreach ($all_news as $key => $news) {?>
                <div class="latest-post col-md-3 col-sm-6" style="">
                    <div class="row m0 featured_cont">
                        <img src="<?php echo FILE_UPLOAD_PATH . $news->images; ?>" alt="blog images" class="img-responsive">
                    </div>
                    <h5 class="post-title"><a href="<?php echo base_url('news/view/' . $news->slug); ?>"><?php echo $news->title; ?></a></h5>
                    <h6 class="post-meta"><a href="#"><?php echo $news->author; ?></a><a href="#"><?php echo date_format(date_create($news->created_at), 'd-M-Y'); ?></a></h6>
                    <div class="post-excerpts row m0">
                        <style type="text/css">.post-excerpts p{line-height: 2}</style>
                        <?php echo textShort($news->content, 100); ?></div>
                    <a href="<?php echo base_url('news/view/' . $news->slug); ?>" class="btn-primary btn-outline">read more</a>
                </div>
            <?php }} else {?>
                <h3 class="text-center">No News Availabe Right Now. 🤨 🤨</h3>
            <?php }?>
            </div>
        </div>
    </section>