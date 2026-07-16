<?php
class Mindu_Image_Box extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-image-box';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Image Box', 'elementor-addon');
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
        return ['Image Box'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }


    protected function register_controls_section()
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
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Hello world', 'elementor-addon'),
                'label_block' => true,
            ]
        );
        // $this->add_control(
        //     'content',
        //     [
        //         'label' => esc_html__('Content', 'elementor-addon'),
        //         'type' => \Elementor\Controls_Manager::TEXTAREA,
        //         'default' => esc_html__('Content Here', 'elementor-addon'),
        //     ]
        // );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'elementor-addon'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // Content Tab End




        // Image Tab Start

        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],


            ]
        );


        $this->end_controls_section();

        // Image Tab End

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

        if (!empty($settings['button_text'])) {
            $this->add_link_attributes('button_arg', $settings['button_url']);
            $this->add_render_attribute('button_arg', 'class', 'tp-service-btn fw-700 tp-ff-heading el-button-text');
        }
?>





        <div class="tp-department-item mb-30 p-relative wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
            <div class="tp-department-thumb overflow-hidden p-relative">
                <img class="w-100" src="<?php echo esc_url($settings['image']['url']); ?>" alt="">
            </div>
            <div class="tp-department-content tp-bounce d-inline-flex justify-content-between align-items-center">
                <h2 class="tp-department-title mb-0"><a href="<?php echo esc_url($settings['url']); ?>" class="common-underline"><?php echo mc_kses($settings['title']); ?></a></h2>
                <a href="<?php echo esc_url($settings['url']); ?>" class="tp-department-btn bounce d-inline-flex justify-content-center align-items-center rounded-circle">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.900024 6.8999H12.9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.90002 0.899902L12.9 6.8999L6.90002 12.8999" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span></span>
                </a>
            </div>
        </div>








<?php
    }
}
