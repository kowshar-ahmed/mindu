<?php
class Mindu_Header_Offcanvas extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-header-offcanvas';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Header Offcanvas', 'elementor-addon');
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
        return ['Header Offcanvas'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }



    // Content Tab Start
    protected function register_controls_section()
    {


        // Image Tab Start

        $this->start_controls_section(
            'section_logo',
            [
                'label' => esc_html__('Logo', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'logo',
            [
                'label' => esc_html__('Logo', 'textdomain'),
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

        $offcanvas_id = get_theme_mod('tp_offcanvas_global',);

        $offcanvas = is_object($offcanvas_id) ? $offcanvas_id->ID : (int) $offcanvas_id;
?>


        <div class="tp-header-toogle-wrapper">
            <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
        </div>





        <!-- tp-offcanvas start -->
        <div class="tp-offcanvas">
            <div class="tp-offcanvas-header mb-30">
                <div class="tp-offcanvas-logo">
                    <a href="<?php echo home_url(); ?>"><img data-width="108" src="<?php echo esc_url($settings['logo']['url']); ?>" alt=""></a>
                </div>
                <div class="tp-offcanvas-close">
                    <button class="tp-offcanvas-close-button"><i class="fal fa-times"></i></button>
                </div>
            </div>
            <div class="tp-offcanvas-menu mb-50">
                <nav>
                </nav>
            </div>

            <?php if (class_exists('\Elementor\Plugin') && $offcanvas) : ?>

                <div class="el-offcanvas">

                    <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content($offcanvas, true); ?>

                </div>
            <?php endif; ?>

        </div>
        <div class="tp-offcanvas-overlay"></div>
        <!-- tp-offcanvas end -->






<?php
    }
}
