<?php
class Mindu_Testimonial extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-testimonial';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Testimonial', 'elementor-addon');
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
        return ['testimonial'];
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
                    'style_3' => esc_html__('Layout 03', 'textdomain'),
                ],
            ]
        );

        $this->end_controls_section();


        // Content Tab Start

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Testimonial', 'elementor-addon'),
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
            'content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-addon'),
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
            'logo',
            [
                'label' => esc_html__('Choose Logo', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Brand List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => 'Title #1',
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'list_title' => 'Title #2',
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

        <?php if ($settings['design_style'] === 'style_2') : ?>

            <div class="tp-testimonial-area" data-bg-color="#fbf9f5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper tp-testimonial-2-slide wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                                <div class="swiper-wrapper">

                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="tp-testimonial-2-item">
                                                <div class="tp-testimonial-2-avatar-wrap d-flex align-items-center">
                                                    <div class="tp-testimonial-2-avatar">
                                                        <img src="<?php echo esc_html($item['image']['url']); ?>" alt="<?php echo esc_html($item['title']); ?>">
                                                    </div>
                                                    <div class="tp-testimonial-2-avatar">
                                                        <span class="tp-testimonial-2-avatar-title fw-700 d-block"><?php echo esc_html($item['title']); ?></span>
                                                        <span class="tp-testimonial-2-avatar-pos"><?php echo esc_html($item['designation']); ?></span>
                                                    </div>
                                                </div>
                                                <span class="tp-testimonial-2-shape d-block">
                                                    <svg height="15" viewBox="0 0 540 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 13.353H77.8537L91.0244 1.35303L104.195 13.353H540" stroke="white" stroke-width="2" />
                                                    </svg>
                                                </span>
                                                <div class="tp-testimonial-2-content">
                                                    <p class="tp-testimonial-2-dec tp-ff-heading fw-600 mb-35"><?php echo esc_html($item['content']); ?></p>
                                                    <div class="tp-testimonial-2-ratings">
                                                        <span>
                                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5 0L11.1265 5.26604L17 6.11567L12.75 10.2124L13.753 16L8.5 13.266L3.247 16L4.25 10.2124L0 6.11567L5.8735 5.26604L8.5 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5 0L11.1265 5.26604L17 6.11567L12.75 10.2124L13.753 16L8.5 13.266L3.247 16L4.25 10.2124L0 6.11567L5.8735 5.26604L8.5 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5 0L11.1265 5.26604L17 6.11567L12.75 10.2124L13.753 16L8.5 13.266L3.247 16L4.25 10.2124L0 6.11567L5.8735 5.26604L8.5 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5 0L11.1265 5.26604L17 6.11567L12.75 10.2124L13.753 16L8.5 13.266L3.247 16L4.25 10.2124L0 6.11567L5.8735 5.26604L8.5 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5 0L11.1265 5.26604L17 6.11567L12.75 10.2124L13.753 16L8.5 13.266L3.247 16L4.25 10.2124L0 6.11567L5.8735 5.26604L8.5 0Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </div>
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


        <?php elseif ($settings['design_style'] === 'style_3') : ?>



            <div class="tp-testimonial-area">
                <div class="container">
                    <div class="row">

                        <?php foreach ($settings['list'] as $item) : ?>
                            <div class="col-xxl-6">
                                <div class="tp-testimonial-3-item fix mb-30 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="tp-testimonial-3-thumb">
                                                <img class="w-100" src="<?php echo esc_html($item['image']['url']); ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="tp-testimonial-3-content ml-35">
                                                <img class="mb-50" src="<?php echo esc_html($item['logo']['url']); ?>" alt="">
                                                <h2 class="tp-testimonial-3-dec mb-55"><?php echo esc_html($item['content']); ?></h2>
                                                <span class="tp-testimonial-3-name fw-600 d-block"><?php echo esc_html($item['title']); ?></span>
                                                <span class="tp-testimonial-3-designation fw-500"><?php echo esc_html($item['designation']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>



        <?php else : ?>

            <div class="tp-testimonial-area">
                <div class="container">
                    <div class="row justify-content-center p-relative wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                        <div class="col-xxl-9 col-xl-10 col-lg-12">
                            <div class="swiper tp-testimonial-slider">
                                <div class="swiper-wrapper">

                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6">
                                                    <div class="tp-testimonial-thumb ml-45 mb-30">
                                                        <img src="<?php echo esc_html($item['image']['url']); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="tp-testimonial-content mb-30">
                                                        <div class="tp-testimonial-ratings mb-20">
                                                            <span>
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3251 11.1971C14.092 11.4349 13.985 11.7788 14.0381 12.116L14.8381 16.7768C14.9055 17.1718 14.7472 17.5716 14.4331 17.7999C14.1253 18.0367 13.7159 18.0651 13.3802 17.8757L9.39466 15.6874C9.25608 15.6097 9.1022 15.568 8.94472 15.5633H8.70085C8.61626 15.5765 8.53347 15.605 8.45788 15.6485L4.4714 17.8472C4.27433 17.9514 4.05116 17.9884 3.83249 17.9514C3.29976 17.8453 2.9443 17.3111 3.03159 16.7474L3.83249 12.0867C3.88558 11.7466 3.77849 11.4008 3.54543 11.1593L0.29595 7.84369C0.0241851 7.56613 -0.0703026 7.14931 0.0538812 6.77323C0.174465 6.3981 0.482225 6.12433 0.853877 6.06275L5.32629 5.37975C5.66645 5.3428 5.96521 5.12492 6.11819 4.80284L8.08893 0.549437C8.13573 0.454706 8.19602 0.367554 8.26891 0.293665L8.3499 0.227353C8.39219 0.178093 8.44079 0.137359 8.49478 0.104204L8.59287 0.0663114L8.74585 0H9.1247C9.46305 0.0369449 9.76091 0.250089 9.91659 0.568383L11.9134 4.80284C12.0574 5.11261 12.3373 5.32764 12.6603 5.37975L17.1328 6.06275C17.5107 6.11959 17.8266 6.39431 17.9516 6.77323C18.0695 7.1531 17.9678 7.56992 17.6907 7.84369L14.3251 11.1971Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <span>
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3251 11.1971C14.092 11.4349 13.985 11.7788 14.0381 12.116L14.8381 16.7768C14.9055 17.1718 14.7472 17.5716 14.4331 17.7999C14.1253 18.0367 13.7159 18.0651 13.3802 17.8757L9.39466 15.6874C9.25608 15.6097 9.1022 15.568 8.94472 15.5633H8.70085C8.61626 15.5765 8.53347 15.605 8.45788 15.6485L4.4714 17.8472C4.27433 17.9514 4.05116 17.9884 3.83249 17.9514C3.29976 17.8453 2.9443 17.3111 3.03159 16.7474L3.83249 12.0867C3.88558 11.7466 3.77849 11.4008 3.54543 11.1593L0.29595 7.84369C0.0241851 7.56613 -0.0703026 7.14931 0.0538812 6.77323C0.174465 6.3981 0.482225 6.12433 0.853877 6.06275L5.32629 5.37975C5.66645 5.3428 5.96521 5.12492 6.11819 4.80284L8.08893 0.549437C8.13573 0.454706 8.19602 0.367554 8.26891 0.293665L8.3499 0.227353C8.39219 0.178093 8.44079 0.137359 8.49478 0.104204L8.59287 0.0663114L8.74585 0H9.1247C9.46305 0.0369449 9.76091 0.250089 9.91659 0.568383L11.9134 4.80284C12.0574 5.11261 12.3373 5.32764 12.6603 5.37975L17.1328 6.06275C17.5107 6.11959 17.8266 6.39431 17.9516 6.77323C18.0695 7.1531 17.9678 7.56992 17.6907 7.84369L14.3251 11.1971Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <span>
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3251 11.1971C14.092 11.4349 13.985 11.7788 14.0381 12.116L14.8381 16.7768C14.9055 17.1718 14.7472 17.5716 14.4331 17.7999C14.1253 18.0367 13.7159 18.0651 13.3802 17.8757L9.39466 15.6874C9.25608 15.6097 9.1022 15.568 8.94472 15.5633H8.70085C8.61626 15.5765 8.53347 15.605 8.45788 15.6485L4.4714 17.8472C4.27433 17.9514 4.05116 17.9884 3.83249 17.9514C3.29976 17.8453 2.9443 17.3111 3.03159 16.7474L3.83249 12.0867C3.88558 11.7466 3.77849 11.4008 3.54543 11.1593L0.29595 7.84369C0.0241851 7.56613 -0.0703026 7.14931 0.0538812 6.77323C0.174465 6.3981 0.482225 6.12433 0.853877 6.06275L5.32629 5.37975C5.66645 5.3428 5.96521 5.12492 6.11819 4.80284L8.08893 0.549437C8.13573 0.454706 8.19602 0.367554 8.26891 0.293665L8.3499 0.227353C8.39219 0.178093 8.44079 0.137359 8.49478 0.104204L8.59287 0.0663114L8.74585 0H9.1247C9.46305 0.0369449 9.76091 0.250089 9.91659 0.568383L11.9134 4.80284C12.0574 5.11261 12.3373 5.32764 12.6603 5.37975L17.1328 6.06275C17.5107 6.11959 17.8266 6.39431 17.9516 6.77323C18.0695 7.1531 17.9678 7.56992 17.6907 7.84369L14.3251 11.1971Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <span>
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3251 11.1971C14.092 11.4349 13.985 11.7788 14.0381 12.116L14.8381 16.7768C14.9055 17.1718 14.7472 17.5716 14.4331 17.7999C14.1253 18.0367 13.7159 18.0651 13.3802 17.8757L9.39466 15.6874C9.25608 15.6097 9.1022 15.568 8.94472 15.5633H8.70085C8.61626 15.5765 8.53347 15.605 8.45788 15.6485L4.4714 17.8472C4.27433 17.9514 4.05116 17.9884 3.83249 17.9514C3.29976 17.8453 2.9443 17.3111 3.03159 16.7474L3.83249 12.0867C3.88558 11.7466 3.77849 11.4008 3.54543 11.1593L0.29595 7.84369C0.0241851 7.56613 -0.0703026 7.14931 0.0538812 6.77323C0.174465 6.3981 0.482225 6.12433 0.853877 6.06275L5.32629 5.37975C5.66645 5.3428 5.96521 5.12492 6.11819 4.80284L8.08893 0.549437C8.13573 0.454706 8.19602 0.367554 8.26891 0.293665L8.3499 0.227353C8.39219 0.178093 8.44079 0.137359 8.49478 0.104204L8.59287 0.0663114L8.74585 0H9.1247C9.46305 0.0369449 9.76091 0.250089 9.91659 0.568383L11.9134 4.80284C12.0574 5.11261 12.3373 5.32764 12.6603 5.37975L17.1328 6.06275C17.5107 6.11959 17.8266 6.39431 17.9516 6.77323C18.0695 7.1531 17.9678 7.56992 17.6907 7.84369L14.3251 11.1971Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <span>
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.3251 11.1971C14.092 11.4349 13.985 11.7788 14.0381 12.116L14.8381 16.7768C14.9055 17.1718 14.7472 17.5716 14.4331 17.7999C14.1253 18.0367 13.7159 18.0651 13.3802 17.8757L9.39466 15.6874C9.25608 15.6097 9.1022 15.568 8.94472 15.5633H8.70085C8.61626 15.5765 8.53347 15.605 8.45788 15.6485L4.4714 17.8472C4.27433 17.9514 4.05116 17.9884 3.83249 17.9514C3.29976 17.8453 2.9443 17.3111 3.03159 16.7474L3.83249 12.0867C3.88558 11.7466 3.77849 11.4008 3.54543 11.1593L0.29595 7.84369C0.0241851 7.56613 -0.0703026 7.14931 0.0538812 6.77323C0.174465 6.3981 0.482225 6.12433 0.853877 6.06275L5.32629 5.37975C5.66645 5.3428 5.96521 5.12492 6.11819 4.80284L8.08893 0.549437C8.13573 0.454706 8.19602 0.367554 8.26891 0.293665L8.3499 0.227353C8.39219 0.178093 8.44079 0.137359 8.49478 0.104204L8.59287 0.0663114L8.74585 0H9.1247C9.46305 0.0369449 9.76091 0.250089 9.91659 0.568383L11.9134 4.80284C12.0574 5.11261 12.3373 5.32764 12.6603 5.37975L17.1328 6.06275C17.5107 6.11959 17.8266 6.39431 17.9516 6.77323C18.0695 7.1531 17.9678 7.56992 17.6907 7.84369L14.3251 11.1971Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <p class="tp-testimonial-dec tp-ff-heading fw-600 mb-75">
                                                            <?php echo esc_html($item['content']); ?>
                                                        </p>
                                                        <div class="tp-testimonial-name">
                                                            <span class="tp-ff-heading fw-600"><?php echo esc_html($item['title']); ?></span>
                                                            <p class="mb-0"><?php echo esc_html($item['designation']); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="tp-testimonial-navigation tp-bounce p-absolute d-flex justify-content-between">
                                <button class="tp-testimonial-prev bounce d-flex justify-content-center align-items-center rounded-circle">
                                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span></span>
                                </button>
                                <button class="tp-testimonial-next bounce d-flex justify-content-center align-items-center rounded-circle">
                                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
