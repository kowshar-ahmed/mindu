<?php
class Mindu_Hero extends \Elementor\Widget_Base
{

    public function get_name(): string
    {
        return 'mindu-hero';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Hero', 'elementor-addon');
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
        return ['Hero'];
    }

    protected function register_controls(): void
    {

        // Content Tab Start

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Title & Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title Here', 'elementor-addon'),
                'label_block' => true,

            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Hello world', 'elementor-addon'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Content Here', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Content Tab End




        // Button Tab Start

        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Button Tab End




        // Explore Button Tab Start

        $this->start_controls_section(
            'section_explore_button',
            [
                'label' => esc_html__('Button Explore', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_explore_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_explore_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'elementor-addon'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // Explore Button Tab End



        // Video Tab Start

        $this->start_controls_section(
            'section_video',
            [
                'label' => esc_html__('Video', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );



        $this->add_control(
            'video_text',
            [
                'label' => esc_html__('Video Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Text here', 'elementor-addon'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'video_text_link',
            [
                'label' => esc_html__('Video Text Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Video URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'elementor-addon'),
                'label_block' => true,
            ]
        );



        $this->end_controls_section();

        // Video Tab End






        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['button_text'])) {
            $this->add_link_attributes('button_arg', $settings['button_url']);
            $this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-square');
        }


?>




        <!-- tp-hero-area-start -->
        <div class="tp-hero-spacing z-1 tp-hero-overly p-relative bg-position" style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>)">
            <span class="tp-hero-shape upslide d-none d-lg-block">
                <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.08818 8.65422C-0.714225 8.37681 -0.40129 6.62425 1.29678 4.91129C4.56199 1.61743 9.05795 0.233121 12.2787 0.0151121C14.3756 -0.126863 15.7936 0.731707 16.3303 2.5831C16.7415 4.00185 16.2069 6.0211 14.9239 8.12529C13.1687 11.0042 10.0603 14.2686 9.03228 15.9063C8.98868 15.9754 8.94179 16.0713 8.89564 16.1835C9.49711 15.8348 10.1705 15.3438 10.9075 14.8303C14.5621 12.2837 18.843 8.43613 21.206 7.1371C21.8422 6.78902 25.9173 4.49199 27.6576 4.31741C29.1861 4.16408 30.1635 4.81473 30.6908 5.59582C31.3486 6.57011 31.5091 7.74687 31.1067 9.03364C30.4994 10.9752 27.9838 13.4718 27.2291 14.4047C24.1894 18.1274 20.9212 21.5988 17.8785 25.2786C16.6211 26.7994 15.4003 28.3544 14.2583 29.9846C14.012 30.3362 12.8719 31.7414 12.0786 33.1828C12.0233 33.2831 11.9672 33.3972 11.9137 33.5163C12.3893 33.3594 12.8522 33.0878 13.3064 32.7851C15.1882 31.5305 16.8442 29.5657 18.0934 28.3559C21.5936 24.9596 24.9364 21.329 28.5134 17.9693C30.9848 15.648 33.5629 13.4497 36.3954 11.5542C38.0288 10.4097 42.4742 7.54704 46.0436 6.62425C48.8327 5.9032 51.1817 6.45866 52.6248 8.18097C53.7829 9.56121 53.9204 11.5395 53.2837 13.7066C52.3942 16.7332 49.7044 20.2336 48.6063 21.4924C46.5133 23.8354 44.2602 26.0717 41.8393 28.1574C38.4237 31.1 34.7434 33.7786 31.5526 36.9075C30.2768 38.1587 29.0581 39.4577 27.9532 40.8574C27.4091 41.5543 25.4051 43.9174 23.9932 46.3148C23.6072 46.9703 23.5278 47.8726 23.3586 48.504C23.5863 48.4595 23.8213 48.3953 24.0534 48.3436C25.3009 48.0661 26.5233 47.4834 27.3663 47.031C30.4498 45.3741 32.9893 43.7971 35.366 41.9726C37.6924 40.1868 39.8507 38.1545 42.2273 35.5934L48.1648 29.9846C51.8092 26.3859 56.1915 30.8303 52.7537 34.2574L46.9682 39.8177C44.2387 42.58 41.7599 44.7505 39.1181 46.6594C36.4381 48.5959 33.6 50.2735 30.1508 52.0103C28.65 52.7678 26.3264 53.7109 24.1439 53.9412C22.0764 54.1593 20.1266 53.7822 18.6643 52.6102C17.3429 51.5512 16.748 49.7059 17.4339 47.3343C18.4162 43.9382 22.3396 38.6989 23.1902 37.5349C24.9457 35.068 26.9778 32.8208 29.1523 30.6855C32.0395 27.8502 35.1078 25.1447 38.2182 22.5227C40.2056 20.8473 42.2521 19.2631 44.096 17.4813C44.6719 16.9317 45.7873 15.7824 46.7567 14.4375C47.3092 13.6709 47.85 12.8631 48.1648 12.0674C48.2675 11.8076 48.3721 11.5622 48.4084 11.3192C48.4745 10.8743 48.0504 11.0206 47.6407 10.9875C46.755 11.0819 45.7645 11.3749 44.7834 11.768C42.3256 12.753 39.9179 14.2624 38.8442 14.9543C36.2126 16.7201 33.8096 18.7599 31.5273 20.9339C27.9936 24.2997 24.7382 27.9723 21.3015 31.3931C19.6505 33.0398 17.3076 35.7978 14.7196 37.1611C13.1486 37.9887 11.4827 38.3466 9.79356 38.0493C7.71098 37.6835 6.90253 36.4392 6.79782 34.8141C6.74357 33.9716 7.0048 32.8983 7.50711 31.7985C8.36245 29.9259 9.93509 27.8775 10.2473 27.4159C11.4329 25.6628 12.6995 23.9855 14.0125 22.3489C16.8101 18.8617 19.8194 15.5634 22.6447 12.0677C19.8459 13.9301 15.5012 17.7829 12.118 19.7673C10.3179 20.8231 8.67312 21.3842 7.47349 21.3739C5.35306 21.3556 4.33602 20.3531 3.85839 19.1117C3.60875 18.4626 3.52842 17.6685 3.66431 16.8259C3.85933 15.6172 4.48971 14.2646 4.99568 13.4927C5.92834 12.0743 8.46171 9.44457 10.3212 6.89784C10.9339 6.05871 12.118 4.91129 11.7937 4.48454C11.4694 4.0578 5.35071 7.48327 5.35071 7.48327C4.99681 7.68674 4.45261 8.03891 3.92977 8.27471C3.80283 8.35592 3.66167 8.42841 3.50573 8.49017C3.09015 8.65468 2.35026 8.68011 2.08818 8.65422Z" fill="currentColor" />
                </svg>
            </span>
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-xl-7">
                        <div class="tp-hero-content mb-40">

                            <?php if (!empty($settings['sub_title'])) : ?>
                                <div class="tp-hero-ratings-wrap d-inline-flex mb-15 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
                                    <span class="tp-hero-ratings-text mr-10 d-flex align-items-center">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 0L9.163 4.60778L14 5.35121L10.5 8.93586L11.326 14L7 11.6078L2.674 14L3.5 8.93586L0 5.35121L4.837 4.60778L7 0Z" fill="currentColor" />
                                        </svg>
                                        <?php echo mc_kses($settings['sub_title']); ?>
                                    </span>
                                    <div class="tp-hero-ratings">
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.89999 0L6.41408 3.22545L9.79997 3.74585L7.34998 6.2551L7.92818 9.8L4.89999 8.12545L1.87179 9.8L2.44999 6.2551L0 3.74585L3.38589 3.22545L4.89999 0Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.89999 0L6.41408 3.22545L9.79997 3.74585L7.34998 6.2551L7.92818 9.8L4.89999 8.12545L1.87179 9.8L2.44999 6.2551L0 3.74585L3.38589 3.22545L4.89999 0Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.89999 0L6.41408 3.22545L9.79997 3.74585L7.34998 6.2551L7.92818 9.8L4.89999 8.12545L1.87179 9.8L2.44999 6.2551L0 3.74585L3.38589 3.22545L4.89999 0Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.89999 0L6.41408 3.22545L9.79997 3.74585L7.34998 6.2551L7.92818 9.8L4.89999 8.12545L1.87179 9.8L2.44999 6.2551L0 3.74585L3.38589 3.22545L4.89999 0Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.89999 0L6.41408 3.22545L9.79997 3.74585L7.34998 6.2551L7.92818 9.8L4.89999 8.12545L1.87179 9.8L2.44999 6.2551L0 3.74585L3.38589 3.22545L4.89999 0Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <h2 class="tp-hero-title mb-25 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                                <?php echo mc_kses($settings['title']); ?>
                            </h2>

                            <p class="tp-hero-dec mb-30 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
                                <?php echo mc_kses($settings['content']); ?>
                            </p>

                            <?php if (!empty($settings['button_text'])) : ?>
                                <div class="wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                    <a <?php echo $this->get_render_attribute_string('button_arg'); ?>>
                                        <?php echo mc_kses($settings['button_text']); ?>
                                        <span class="ml-8">
                                            <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.71527 1L13 5.28471L8.71527 9.56941" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M1 5.28473H12.88" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['button_explore_text'])) : ?>
                                <div class="tp-hero-explore mt-115 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".8s">
                                    <a href="<?php echo esc_url($settings['button_explore_url']); ?>" class="tp-hero-btn">
                                        <svg class="mr-15" width="15" height="61" viewBox="0 0 15 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.12249 60.7077C7.73483 61.101 7.10168 61.1056 6.70832 60.718L0.298073 54.4006C-0.0952914 54.013 -0.0999129 53.3798 0.287751 52.9865C0.675414 52.5931 1.30856 52.5885 1.70193 52.9761L7.39992 58.5916L13.0153 52.8936C13.403 52.5002 14.0361 52.4956 14.4295 52.8832C14.8229 53.2709 14.8275 53.904 14.4398 54.2974L8.12249 60.7077ZM6.9723 0.00732422L7.97227 2.51429e-05L8.41022 59.9984L7.41024 60.0057L6.41027 60.013L5.97232 0.0146233L6.9723 0.00732422Z" fill="currentColor" />
                                        </svg>
                                        <?php echo mc_kses($settings['button_explore_text']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="d-flex justify-content-xl-end mb-40">
                            <div class="tp-hero-video wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
                                <video loop muted autoplay playsinline>
                                    <source src="<?php echo mc_kses($settings['video_url']); ?>" type="video/mp4">
                                </video>
                                <a href="<?php echo esc_url($settings['video_text_link']); ?>" class="tp-hero-video-btn d-flex align-items-center justify-content-between">
                                    <?php echo mc_kses($settings['video_text']); ?>
                                    <span>
                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.3245 7.25217L0.75 7.25097M9.69313 0.75C9.69313 0.75 15.7499 5.63242 15.75 7.25052C15.7502 8.86869 9.69424 13.75 9.69424 13.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tp-hero-area-end -->



<?php
    }
}
