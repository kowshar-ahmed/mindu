<?php
class Mindu_Header_Language extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-header-language';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Header Language', 'elementor-addon');
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
        return ['Header Language'];
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
            'section_alignment',
            [
                'label' => esc_html__('Alignment', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .el-align' => 'text-align: {{VALUE}};',
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


        <?php if (has_nav_menu('lang-menu') && function_exists('language_menu')) : ?>
            <div class="tp-lang-nav el-align">
                <?php language_menu(); ?>
            </div>
        <?php else : ?>
            <div class="tp-header-menu-item tp-header-currency el-align">
                <span class="tp-header-currency-toggle" id="tp-header-currency-toggle"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/01.png" alt=""> <?php echo esc_html__('English', 'mindu'); ?></span>
                <ul>
                    <li>
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/01.png" alt=""><?php echo esc_html__('Canada', 'mindu'); ?> </a>
                    </li>
                    <li>
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/02.png" alt=""><?php echo esc_html__('Malaysia', 'mindu'); ?> </a>
                    </li>
                    <li>
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/03.png" alt=""><?php echo esc_html__('German', 'mindu'); ?> </a>
                    </li>
                    <li>

            </div>
        <?php endif; ?>




<?php
    }
}
