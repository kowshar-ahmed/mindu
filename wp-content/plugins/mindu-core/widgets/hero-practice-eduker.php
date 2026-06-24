<?php
class Mindu_Hero_Practice_Eduker extends \Elementor\Widget_Base
{

    public function get_name(): string
    {
        return 'mindu-hero-practice-eduker';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Hero Practice Eduker', 'elementor-addon');
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
        return ['hero', 'practice', 'eduker'];
    }

    public function get_script_depends(): array
    {
        return ['swiper'];
    }

    protected function register_controls(): void
    {



        // Content Tab Start

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Hero Practice Eduker', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO & Founder', 'elementor-addon'),
                'label_block' => true,
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
            'content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
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
        }

?>




        <section class="slider__area">
            <div class="slider__active swiper-container"
                style="width:100%; overflow:hidden; position:relative;">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['list'] as $index => $item) :
                        $link_key = 'button_arg_' . $index;
                        $this->add_link_attributes($link_key, $item['button_url']);
                    ?>
                        <div class="slider__item swiper-slide p-relative slider__height d-flex align-items-center z-index-1"
                            style="min-height:700px; position:relative;">
                            <div class="slider__bg slider__overlay include-bg"
                                style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);
                                background-size: cover;
                                background-position: center;
                                position: absolute;
                                width: 100%; height: 100%;
                                top: 0; left: 0; z-index:0;">
                            </div>
                            <div class="container" style="position:relative; z-index:1;">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 col-sm-10">
                                        <div class="slider__content p-relative z-index-1">
                                            <span><?php echo esc_html($item['sub_title']); ?></span>
                                            <h2 class="slider__title"><?php echo esc_html($item['title']); ?></h2>
                                            <p><?php echo esc_html($item['content']); ?></p>
                                            <div class="slider__btn">
                                                <a <?php echo $this->get_render_attribute_string($link_key); ?>>
                                                    <?php echo esc_html($item['button_text']); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Navigation buttons swiper-container এর ভেতরে কিন্তু swiper-wrapper এর বাইরে -->
                <button class="slider-button-prev"
                    style="position:absolute; left:20px; top:50%; transform:translateY(-50%); z-index:10; background:rgba(255,255,255,0.2); border:none; width:50px; height:50px; border-radius:50%; cursor:pointer; color:white; font-size:18px;">
                    <i class="fa-regular fa-arrow-left"></i>
                </button>
                <button class="slider-button-next"
                    style="position:absolute; right:20px; top:50%; transform:translateY(-50%); z-index:10; background:rgba(255,255,255,0.2); border:none; width:50px; height:50px; border-radius:50%; cursor:pointer; color:white; font-size:18px;">
                    <i class="fa-regular fa-arrow-right"></i>
                </button>
            </div>
        </section>

        <script>
            (function initSlider() {
                if (typeof Swiper === 'undefined') {
                    setTimeout(initSlider, 300);
                    return;
                }
                document.querySelectorAll('.slider__active').forEach(function(el) {
                    if (el.swiper) return;
                    new Swiper(el, {
                        loop: true,
                        effect: 'fade', // ← fade effect add
                        fadeEffect: {
                            crossFade: true
                        },
                        navigation: {
                            nextEl: el.querySelector('.slider-button-next'),
                            prevEl: el.querySelector('.slider-button-prev'),
                        },
                    });
                });
            })();
        </script>


<?php

    }
}
