<?php
class Mindu_Heading extends \Elementor\Widget_Base
{

    use Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-heading';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Heading', 'elementor-addon');
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
        return ['Heading'];
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
            'section_title',
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
                'default' => esc_html__('Hello world', 'elementor-addon'),
                'label_block' => true,
            ]
        );



        $this->add_control(
            'text_align',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .el-align' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }
    // Content Tab End



    // Style Tab Start

    protected function register_style_section()
    {

        $this->common_trait_style('title', 'Title', '.el-title');

        $this->common_trait_style('sub_title', 'Sub Title', '.el-sub-title');

        $this->common_trait_style('content', 'Content', '.el-content');
    }
    // Style Tab End




    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
?>


        <div class="tp-section-title-wrap el-align">
            <?php if (!empty($settings['sub_title'])) : ?>

                <span class="tp-section-subtitle d-inline-block mb-10 wow fadeInUp el-sub-title" data-wow-duration=".9s" data-wow-delay=".3s">
                    <span>
                        <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.625 7.76196V10.1183C14.625 10.9741 14.1019 11.7379 13.2919 12.0954C12.3075 12.5287 10.8169 13 9 13C7.18313 13 5.6925 12.5287 4.7025 12.0954C3.89812 11.7379 3.375 10.9741 3.375 10.1183V7.76196L7.37437 9.52242C7.88625 9.74993 8.4375 9.86368 9 9.86368C9.5625 9.86368 10.1137 9.74993 10.6256 9.52242L14.625 7.76196Z" fill="currentColor" />
                            <path d="M16.8751 6.77063V10.2915C16.8751 10.5895 16.6219 10.8332 16.3126 10.8332C16.0032 10.8332 15.7501 10.5895 15.7501 10.2915V7.26898L16.8751 6.77063Z" fill="currentColor" />
                            <path d="M7.84013 8.53863C8.20856 8.70059 8.604 8.78184 9 8.78184C9.396 8.78184 9.79088 8.70113 10.1599 8.53863L17.3436 5.37631C17.7486 5.19809 18 4.82054 18 4.39099C18 3.96144 17.7486 3.58335 17.3436 3.40513L10.1599 0.24335C9.42244 -0.0811165 8.57812 -0.0811165 7.84069 0.24335L0.656438 3.40459C0.251438 3.58335 0 3.9609 0 4.39045C0 4.82 0.251438 5.19755 0.656438 5.37631L7.84013 8.53863Z" fill="currentColor" />
                        </svg>
                    </span>
                    <?php echo mc_kses($settings['sub_title']); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($settings['title'])) : ?>
                <h2 class="tp-section-title wow fadeInUp el-title" data-wow-duration=".9s" data-wow-delay=".4s"><?php echo mc_kses($settings['title']); ?></h2>
            <?php endif; ?>


            <?php if (!empty($settings['content'])) : ?>
                <p class="wow fadeInUp el-content" data-wow-duration=".9s" data-wow-delay=".5s"><?php echo mc_kses($settings['content']); ?></p>
            <?php endif; ?>

        </div>


<?php
    }
}
