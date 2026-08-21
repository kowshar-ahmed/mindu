<?php
class Mindu_Storie_List extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-storie-list';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Storie List', 'elementor-addon');
    }

    public function get_icon(): string
    {
        return 'eicon-parallax';
    }

    public function get_categories(): array
    {
        return ['mindu-category'];
    }

    public function get_keywords(): array
    {
        return ['story', 'storie', 'list', 'mindu'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }

    protected function register_controls_section()
    {


        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Design Layout', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'design_style',
            [
                'label' => esc_html__('Design Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => esc_html__('Layout 01', 'textdomain'),
                ],
            ]
        );

        $this->end_controls_section();


        // Content Tab Start

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Team List', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO & Founder', 'elementor-addon'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('4.5 Rating', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => esc_html__('Video URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=5UY8Ne9IpaM', 'elementor-addon'),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => esc_html__('Team  List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Title #1',
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'title' => 'Title #2',
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Content Tab End



    }



    protected function register_style_section()
    {
        // Style Tab Start

        $this->common_trait_style('title', 'Title', '.el-title');
        $this->common_trait_style('content', 'Content', '.el-content');
        $this->common_trait_style('button_content', 'Button Content', '.el-button-text');

        // Style Tab End
    }


    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['design_style'] == 'style_2') : ?>

        <?php else : ?>





            <div class="tp-department-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper tp-department-3-slide wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="tp-department-3-item mb-30">
                                                <div class="tp-department-3-thumb p-relative fix mb-25">
                                                    <img class="w-100" src="<?php echo esc_html($item['image']['url']); ?>" alt="">
                                                    <a class="popup-video tp-department-3-video-btn d-inline-flex justify-content-center align-items-center rounded-circle" href="<?php echo esc_url($item['video_url']); ?>">
                                                        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M21 10.6635C22.3333 11.4333 22.3333 13.3578 21 14.1276L3 24.5199C1.66666 25.2897 6.86406e-07 24.3274 7.53704e-07 22.7878L1.66223e-06 2.0032C1.72953e-06 0.4636 1.66667 -0.498649 3 0.271152L21 10.6635Z" fill="currentColor" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="tp-department-3-content d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <span class="tp-department-3-name d-block fw-600"><?php echo esc_html($item['title']); ?></span>
                                                        <span class="tp-department-3-batch fw-500"><?php echo esc_html($item['designation']); ?></span>
                                                    </div>
                                                    <div class="tp-department-3-rating-wrap d-inline-flex align-items-center gap-2">
                                                        <span class="tp-department-3-rating d-inline-flex align-items-center justify-content-center">
                                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7 0L9.163 4.60778L14 5.35121L10.5 8.93586L11.326 14L7 11.6078L2.674 14L3.5 8.93586L0 5.35121L4.837 4.60778L7 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <span class="tp-department-3-rating-count fw-500"><?php echo esc_html($item['rating']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <?php endif; ?>

<?php

    }
}
