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

        // Style Tab End
    }


    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>

        <div class="tp-community-item">
            <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="">
        </div>


       <?php
    }
}
