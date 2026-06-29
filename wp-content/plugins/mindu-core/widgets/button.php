<?php
class Mindu_Button extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-button';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Button', 'elementor-addon');
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
        return ['Button'];
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
                ],
            ]
        );

        $this->end_controls_section();

        // Section Layout Tab End




        // Section Button Tab Start

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
    }


    protected function register_style_section()
    {

        $this->common_trait_style('title', 'Title', '.el-title');
    }


    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>




        <?php if ($settings['design_style'] === 'style_2') :
            if (!empty($settings['button_text'])) {
                $this->add_link_attributes('button_arg', $settings['button_url']);
                $this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-border tp-btn-xl el-title');
            }
        ?>
            <?php if (!empty($settings['button_text'])) : ?>

                <div class="tp-md-btn">
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

        <?php else :
            if (!empty($settings['button_text'])) {
                $this->add_link_attributes('button_arg', $settings['button_url']);
                $this->add_render_attribute('button_arg', 'class', 'tp-btn tp-btn-xl el-title');
            }
        ?>
            <?php if (!empty($settings['button_text'])) : ?>
                <div class="tp-md-btn">
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
        <?php endif; ?>






<?php
    }
}
