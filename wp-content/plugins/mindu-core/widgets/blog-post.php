<?php
class Mindu_Blog_Post extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-blog-post';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Blog', 'elementor-addon');
    }

    public function get_icon(): string
    {
        return 'eicon-site-title';
    }

    public function get_categories(): array
    {
        return ['mindu-category'];
    }

    public function get_keywords(): array
    {
        return ['Blog Post'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }



    // Content Tab Start
    protected function register_controls_section()
    {


        $this->start_controls_section(
            'section_post',
            [
                'label' => esc_html__('Blog Post', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 10,
            ]

        );


        $this->add_control(
            'post_include',
            [
                'label' => esc_html__('Post In', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => tp_all_post(),
            ]
        );


        $this->add_control(
            'cat_include',
            [
                'label' => esc_html__('Category In', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => tp_all_category(),
            ]
        );


        $this->add_control(
            'post_exclude',
            [
                'label' => esc_html__('Post Exclude', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => tp_all_post(),
            ]
        );


        $this->add_control(
            'post-order',
            [
                'label' => esc_html__('Post Order', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'elementor-addon'),
                    'DESC' => esc_html__('Descending', 'elementor-addon'),
                ],
            ]
        );

        $this->add_control(
            'post-order-by',
            [
                'label' => esc_html__('Post Order By', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'elementor-addon'),
                    'title' => esc_html__('Title', 'elementor-addon'),
                    'menu_order' => esc_html__('Menu Order', 'elementor-addon'),
                    'ID' => esc_html__('ID', 'elementor-addon'),
                    'rand' => esc_html__('Random', 'elementor-addon'),
                    'modified' => esc_html__('Modified', 'elementor-addon'),
                    'author' => esc_html__('Author', 'elementor-addon'),
                    'comment_count' => esc_html__('Comment Count', 'elementor-addon'),
                    'name' => esc_html__('Name', 'elementor-addon'),
                    'parent' => esc_html__('Parent', 'elementor-addon'),
                    'menu_order' => esc_html__('Menu Order', 'elementor-addon'),
                ],
            ]
        );

        $this->end_controls_section();

        // Content Tab End



    }




    // Style Tab Start

    protected function register_style_section()
    {

        $this->common_trait_style('sub_title', 'Sub Title', '.el-sub-title');
    }
    // Style Tab End




    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'      => 'post', // e.g. 'post', 'page', or a custom post type like 'product'
            'posts_per_page' => $settings['post_per_page'],     // -1 for all posts
            'orderby'        => $settings['post-order-by'], // e.g. 'date', 'title', 'rand', etc.
            'order'          => $settings['post-order'],   // 'ASC' or '
            'post__in' => !empty($settings['post_include']) ? $settings['post_include'] : '',
            'post__not_in'   => !empty($settings['post_exclude']) ? $settings['post_exclude'] : '',         // exclude these post IDs
            
        ];
        if (!empty($settings['cat_include'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'slug', // or 'term_id', depending on what cat_include stores
                    'terms'    => $settings['cat_include'],
                ],
            ];
        }

        $query = new \WP_Query($args);





?>




        <div class="tp-blog-area">
            <div class="container">
                <div class="row">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $categories = get_the_category();
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="tp-blog-item mb-30 wow fadeInLeft" data-wow-duration=".9s" data-wow-delay=".4s">
                                <div class="tp-blog-thumb overflow-hidden mb-20">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="tp-blog-content">
                                    <h3 class="tp-blog-title fw-600 mb-20">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                                    </h3>
                                    <div class="tp-blog-meta-wrap d-flex flex-wrap gap-1">
                                        <span class="tp-blog-meta fw-500 d-inline-block">
                                            <span>
                                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.54969 4H3.64969M6.44899 6.8H3.649" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M11.7 14.5H1.9C1.1268 14.5 0.5 13.8732 0.5 13.1M0.5 13.1C0.5 12.3268 1.1268 11.7 1.9 11.7H11.7V3.3C11.7 1.98007 11.7 1.3201 11.2899 0.910053C10.8799 0.5 10.2199 0.5 8.9 0.5H4.7C2.7201 0.5 1.73015 0.5 1.11508 1.11508C0.5 1.73015 0.5 2.7201 0.5 4.7V13.1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M11.3495 11.6992C11.3495 11.6992 10.6495 12.2332 10.6495 13.0992C10.6495 13.9653 11.3495 14.4992 11.3495 14.4992" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </span>
                                        <span class="tp-blog-meta fw-500 d-inline-block">
                                            <span>
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.69231 0.5V3.30004M4.03543 0.5V3.30004" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M7.5711 1.89941H6.15688C3.4902 1.89941 2.15686 1.89941 1.32843 2.71952C0.5 3.53964 0.5 4.85959 0.5 7.49949V8.89951C0.5 11.5394 0.5 12.8594 1.32843 13.6795C2.15686 14.4996 3.4902 14.4996 6.15688 14.4996H7.5711C10.2378 14.4996 11.5711 14.4996 12.3995 13.6795C13.228 12.8594 13.228 11.5394 13.228 8.89951V7.49949C13.228 4.85959 13.228 3.53964 12.3995 2.71952C11.5711 1.89941 10.2378 1.89941 7.5711 1.89941Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M0.5 6.09961H13.228" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>



<?php
    }
}
