<?php
class Mindu_Team_List extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-team-list';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Team List', 'elementor-addon');
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
        return ['team', 'members'];
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
                    'style_2' => esc_html__('Layout 02', 'textdomain'),
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
            'social_layout',
            [
                'label' => esc_html__('Social Layout', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_1',
                'options' => [
                    'style_1' => esc_html__('Layout 01', 'textdomain'),
                    'style_2' => esc_html__('Layout 02', 'textdomain'),
                ],
            ]
        );



        $repeater->start_controls_tabs('button_style_tabs');


        // Information Tab

        $repeater->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Information', 'textdomain'),
            ]
        );

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
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label'       => esc_html__('URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('#', 'textdomain'),
                'label_block' => true,
            ]
        );


        $repeater->end_controls_tab();



        // Social Tab


        $repeater->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Social', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'facebook_url',
            [
                'label'       => esc_html__('Facebook URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://facebook.com/', 'textdomain'),
                'label_block' => true,
                'condition' => [
                    'social_layout' => 'style_1',
                ],
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label'       => esc_html__('Video URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://www.youtube.com/watch?v=5UY8Ne9IpaM', 'textdomain'),
                'default' => 'https://www.youtube.com/watch?v=5UY8Ne9IpaM',
                'label_block' => true,
                'condition' => [
                    'social_layout' => 'style_2',
                ],
            ]
        );

        $repeater->add_control(
            'dribbble_url',
            [
                'label'       => esc_html__('Dribbble URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://dribbble.com/', 'textdomain'),
                'label_block' => true,
                'condition' => [
                    'social_layout' => 'style_1',
                ],
            ]
        );

        $repeater->add_control(
            'x_url',
            [
                'label'       => esc_html__('X URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://x.com/', 'textdomain'),
                'label_block' => true,
                'condition' => [
                    'social_layout' => 'style_1',
                ],
            ]
        );

        $repeater->add_control(
            'instagram_url',
            [
                'label'       => esc_html__('Instagram URL', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://instagram.com/', 'textdomain'),
                'label_block' => true,
                'condition' => [
                    'social_layout' => 'style_1',
                ],
            ]
        );


        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();


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




            <div class="tp-team-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper tp-team-3-slide">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="tp-team-3-item p-relative">
                                                <div class="tp-team-3-thumb">
                                                    <img class="w-100" src="<?php echo esc_html($item['image']['url']); ?>" alt="">
                                                </div>
                                                <div class="tp-team-3-content p-absolute d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h2 class="tp-team-3-name mb-5"><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['title']); ?></a></h2>
                                                        <span class="tp-team-3-designation"><?php echo esc_html($item['designation']); ?></span>
                                                    </div>
                                                    <?php if (!empty($item['video_url'])) : ?>
                                                        <a class="tp-team-3-btn d-flex align-items-center justify-content-center" href="<?php echo esc_url($item['video_url']); ?>" target="_blank">
                                                            <svg width="23" height="19" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.5 19C13.5812 19 15.5769 18.8002 17.4264 18.4338C19.7366 17.9761 20.8918 17.7472 21.9459 16.4301C23 15.1129 23 13.601 23 10.5769V8.42315C23 5.39905 23 3.88703 21.9459 2.56988C20.8918 1.25275 19.7366 1.02391 17.4264 0.566222C15.5769 0.199802 13.5812 0 11.5 0C9.41884 0 7.42312 0.199802 5.57354 0.566222C3.26331 1.02391 2.10819 1.25275 1.05409 2.56988C0 3.88703 0 5.39905 0 8.42315V10.5769C0 13.601 0 15.1129 1.05409 16.4301C2.10819 17.7472 3.26331 17.9761 5.57354 18.4338C7.42312 18.8002 9.41884 19 11.5 19Z" fill="currentColor" />
                                                                <path d="M16.0572 9.84985C15.8865 10.5269 14.9785 11.0132 13.1624 11.9859C11.1871 13.0436 10.1994 13.5726 9.3995 13.3689C9.12856 13.2998 8.87901 13.1784 8.66947 13.0138C8.05078 12.5277 8.05078 11.5185 8.05078 9.50014C8.05078 7.48178 8.05078 6.47257 8.66947 5.98646C8.87901 5.82181 9.12856 5.70047 9.3995 5.63145C10.1994 5.42767 11.1871 5.95659 13.1624 7.01442C14.9785 7.98707 15.8865 8.47336 16.0572 9.15043C16.1153 9.38089 16.1153 9.61939 16.0572 9.84985Z" fill="currentColor" />
                                                            </svg>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tp-testimonial-2-pagination pt-60"></div>
                        </div>
                    </div>
                </div>
            </div>



        <?php else : ?>


            <div class="tp-team-area p-relative z-1 fix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper tp-team-slider wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                                <div class="swiper-wrapper">

                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="tp-team-wrap tp-team-2-wrap">
                                                <div class="tp-team-thumb p-relative mb-25">
                                                    <img class="w-100" src="<?php echo esc_html($item['image']['url']); ?>" alt="">

                                                    <div class="tp-team-social p-absolute">
                                                        <?php if (!empty($item['facebook_url']) || !empty($item['dribbble_url']) || !empty($item['x_url']) || !empty($item['instagram_url'])): ?>
                                                            <a href=" <?php echo esc_url($item['facebook_url']); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="<?php echo esc_url($item['dribbble_url']); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="<?php echo esc_url($item['x_url']); ?>">
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <circle cx="9.99991" cy="9.99991" r="8.38077" stroke="currentColor" stroke-width="1.5"></circle>
                                                                    <path d="M18.3799 11.0604C17.6032 10.9148 16.8043 10.8389 15.9891 10.8389C11.5034 10.8389 7.51372 13.1373 4.9707 16.7054" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                    <path d="M15.8665 4.13281C13.2437 7.2064 9.30255 9.16128 4.8957 9.16128C3.76828 9.16128 2.67133 9.03332 1.61914 8.79143" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                    <path d="M12.1938 18.3815C12.4039 17.3641 12.5142 16.3104 12.5142 15.2309C12.5142 9.93756 9.86111 5.26259 5.80957 2.45801" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="<?php echo esc_url($item['instagram_url']); ?>">
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1.66602 8.99935C1.66602 5.54238 1.66602 3.8139 2.73996 2.73996C3.8139 1.66602 5.54238 1.66602 8.99935 1.66602C12.4563 1.66602 14.1848 1.66602 15.2587 2.73996C16.3327 3.8139 16.3327 5.54238 16.3327 8.99935C16.3327 12.4563 16.3327 14.1848 15.2587 15.2587C14.1848 16.3327 12.4563 16.3327 8.99935 16.3327C5.54238 16.3327 3.8139 16.3327 2.73996 15.2587C1.66602 14.1848 1.66602 12.4563 1.66602 8.99935Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                    <path d="M12.4747 9.00103C12.4747 10.9195 10.9195 12.4747 9.00103 12.4747C7.08256 12.4747 5.52734 10.9195 5.52734 9.00103C5.52734 7.08256 7.08256 5.52734 9.00103 5.52734C10.9195 5.52734 12.4747 7.08256 12.4747 9.00103Z" stroke="currentColor" stroke-width="1.5"></path>
                                                                    <path d="M13.251 4.75391L13.242 4.75391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>
                                                <div class="tp-team-content text-center">
                                                    <h2 class="tp-team-title fw-600 mb-5">
                                                        <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['title']); ?></a>
                                                    </h2>
                                                    <span class="tp-team-subtitle"><?php echo esc_html($item['designation']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-50">
                            <div class="tp-testimonial-navigation tp-team-navigation tp-bounce d-flex justify-content-center">
                                <button class="tp-testimonial-prev bounce d-flex justify-content-center align-items-center rounded-circle">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8999 6.8999H0.899902" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.8999 0.899902L0.899902 6.8999L6.8999 12.8999" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span></span>
                                </button>
                                <button class="tp-testimonial-next bounce d-flex justify-content-center align-items-center rounded-circle">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.899902 6.8999H12.8999" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.8999 0.899902L12.8999 6.8999L6.8999 12.8999" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php endif; ?>

<?php

    }
}
