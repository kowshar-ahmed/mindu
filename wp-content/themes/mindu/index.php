<?php get_header(); ?>





<div class="tp-postbox-area pt-140 pb-100">
    <div class="container container-1324">
        <div class="row">
            <div class="col-lg-8">
                <div class="postbox-wrapper mr-50 mb-40">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php echo get_template_part('template-parts/content'); ?>
                        <?php endwhile; ?>
                        <?php else : ?>
                            <p>No posts found.</p>
                    <?php endif; ?>

                    <div class="pt-5">
                        <nav class="navigation pagination wp-pagination">
                            <div class="nav-links">
                                <a class="prev page-numbers" href="#">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.75 5.75H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.75 10.75L0.75 5.75L5.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <span class="page-numbers current" aria-current="page">01</span>
                                <a class="page-numbers" href="#">02</a>
                                <a class="page-numbers" href="#">03</a>
                                <a class="page-numbers" href="#">04</a>
                                <a class="next page-numbers" href="#">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 5.75H10.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.75 10.75L10.75 5.75L5.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tp-sidebar-wrapper">
                    <div class="tp-sidebar-search p-relative mb-40">
                        <form action="#">
                            <input class="tp-input" type="text" placeholder="Search ...">
                            <button class="tp-sidebar-search-btn">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.97222 13.1944C10.4087 13.1944 13.1944 10.4087 13.1944 6.97222C13.1944 3.53578 10.4087 0.75 6.97222 0.75C3.53578 0.75 0.75 3.53578 0.75 6.97222C0.75 10.4087 3.53578 13.1944 6.97222 13.1944Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14.75 14.7502L11.3667 11.3669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="tp-sidebar-service-list tp-sidebar-border pb-30 mb-35">
                        <h3 class="tp-sidebar-service-title mb-20 tp-ff-body">Categories</h3>
                        <ul>
                            <li>
                                <a href="service-details.html">Articles
                                    <span>(8)</span>
                                </a>
                            </li>
                            <li>
                                <a href="service-details.html">Business
                                    <span>(4)</span>
                                </a>
                            </li>
                            <li>
                                <a href="service-details.html">Family & Divorce
                                    <span>(3)</span>
                                </a>
                            </li>
                            <li>
                                <a href="service-details.html">Web Design
                                    <span>(2)</span>
                                </a>
                            </li>
                            <li>
                                <a href="service-details.html">Software
                                    <span>(8)</span>
                                </a>
                            </li>
                            <li>
                                <a href="service-details.html">Video
                                    <span>(1)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tp-sidebar-widget tp-sidebar-border pb-30 mb-35">
                        <h3 class="tp-sidebar-service-title mb-20 tp-ff-body">Recent Posts</h3>
                        <div class="tp-recent-post-content d-flex align-items-center">
                            <div class="tp-recent-post-thumb mr-15">
                                <img src="assets/img/blog/blog.jpg" alt="">
                            </div>
                            <div>
                                <span class="tp-recent-post-span">UI Desige</span>
                                <h2 class="tp-recent-post-title"><a href="blog-details.html">Google without having to hire an SEO Expert.</a></h2>
                                <div class="tp-recent-post-tag">
                                    <span>14 April, 2024</span>
                                    <span>Minute</span>
                                </div>
                            </div>
                        </div>
                        <div class="tp-recent-post-content d-flex align-items-center">
                            <div class="tp-recent-post-thumb mr-15">
                                <img src="assets/img/blog/blog-3.jpg" alt="">
                            </div>
                            <div>
                                <span class="tp-recent-post-span grey">Career</span>
                                <h2 class="tp-recent-post-title"><a href="blog-details.html">Being good cyber citizens in a digital world.</a></h2>
                                <div class="tp-recent-post-tag">
                                    <span>14 April, 2024</span>
                                    <span>Minute</span>
                                </div>
                            </div>
                        </div>
                        <div class="tp-recent-post-content d-flex align-items-center">
                            <div class="tp-recent-post-thumb mr-15">
                                <img src="assets/img/blog/blog-2.jpg" alt="">
                            </div>
                            <div>
                                <span class="tp-recent-post-span yellow">Software</span>
                                <h2 class="tp-recent-post-title"><a href="blog-details.html">The single biggest reason why startups succeed.</a></h2>
                                <div class="tp-recent-post-tag">
                                    <span>14 April, 2024</span>
                                    <span>Minute</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-sidebar-widget tp-sidebar-border pb-30 mb-50">
                        <div class="tp-sidebar-content">
                            <h3 class="tp-sidebar-service-title mb-20 tp-ff-body">Tag</h3>
                            <div class="tagcloud">
                                <a href="#">News</a>
                                <a href="#">Counseling</a>
                                <a href="#">Career</a>
                                <a href="#">Software</a>
                                <a href="#">Development</a>
                                <a href="#">Merket</a>
                                <a href="#">Life</a>
                                <a href="#">Research</a>
                                <a href="#">Research</a>
                                <a href="#">UI Desige</a>
                                <a href="#">Team</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<?php get_footer(); ?>