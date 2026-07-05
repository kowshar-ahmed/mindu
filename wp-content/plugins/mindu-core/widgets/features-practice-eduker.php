<?php
class Mindu_Features_Practice_Eduker extends \Elementor\Widget_Base
{

    public function get_name(): string
    {
        return 'mindu-features-practice-eduker';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Features Practice Eduker', 'elementor-addon');
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

?>





        <section class="about__area pb-120 p-relative">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-7 col-xl-7 col-lg-7">
                        <div class="about__thumb-wrapper d-sm-flex mr-20 p-relative">
                            <div class="about__shape">
                                <img class="about__shape-1 d-none d-sm-block" src="assets/img/about/about-shape-1.png" alt="">
                                <img class="about__shape-2 d-none d-sm-block" src="assets/img/about/about-shape-2.png" alt="">
                                <img class="about__shape-3" src="assets/img/about/about-shape-3.png" alt="">
                            </div>
                            <div class="about__thumb-left mr-10">
                                <div class="about__thumb-1 mb-10">
                                    <img src="assets/img/about/about-1.jpg" alt="">
                                </div>
                                <div class="about__thumb-1 mb-10 text-end">
                                    <img src="assets/img/about/about-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="about__thumb-2 mb-10">
                                <img src="assets/img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-5 col-lg-5">
                        <div class="about__content pl-70 pr-25">
                            <div class="section__title-wrapper mb-15">
                                <span class="section__title-pre">About eduker</span>
                                <h2 class="section__title">Degrees in Various academic Didciplines</h2>
                            </div>
                            <p>Not only can university offer an environment rich in our social an cultural experiences.</p>

                            <div class="about__list mb-40">
                                <ul>
                                    <li><i class="fa-solid fa-check"></i> Access to all our courses</li>
                                    <li><i class="fa-solid fa-check"></i> Learn the latest skills</li>
                                    <li><i class="fa-solid fa-check"></i> Upskill your organization</li>
                                </ul>
                            </div>

                            <div class="about__btn">
                                <a href="about.html" class="tp-btn tp-btn-2">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






<?php

    }
}
