<?php
class Mindu_Video extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-video';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Video', 'elementor-addon');
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
        return ['Video'];
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
            'section_video',
            [
                'label' => esc_html__('Video', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Video URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=example', 'elementor-addon'),
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










    // Style Tab Start

    protected function register_style_section()
    {

        $this->common_trait_style('sub_title', 'Sub Title', '.el-sub-title');
    }
    // Style Tab End




    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
?>







        <div class="tp-video-area tp-video-spacing p-relative z-1 bg-position" style="background-image: url(<?php echo esc_url($settings['image']['url']); ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tp-video-wrap text-center">
                            <a class="popup-video tp-video-btn d-inline-flex justify-content-center align-items-center rounded-circle" href="<?php echo esc_url($settings['video_url']); ?>">
                                <svg width="32" height="36" viewBox="0 0 32 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30 14.3982C32.6667 15.9378 32.6667 19.7868 30 21.3264L6 35.1828C3.33333 36.7224 2.02534e-06 34.7979 2.15994e-06 31.7187L3.37131e-06 4.0059C3.5059e-06 0.926698 3.33334 -0.997804 6 0.541797L30 14.3982Z" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<?php
    }
}
