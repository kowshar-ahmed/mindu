<?php
class Mindu_Fact extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-fact';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Fact', 'elementor-addon');
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
        return ['fact', 'counter'];
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
                ],
            ]
        );

        $this->end_controls_section();


        // Content Tab Start

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Fact List', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'icon_style',
            [
                'label' => esc_html__('Icon Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'textdomain'),
                    'image' => esc_html__('Image', 'textdomain'),
                    'svg' => esc_html__('SVG', 'textdomain'),
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'textdomain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_style' => 'icon',
                ],
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
                'condition' => [
                    'icon_style' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'svg',
            [
                'label' => esc_html__('SVG Code', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'condition' => [
                    'icon_style' => 'svg',
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Total Students Enrolled
', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('24', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'number-text',
            [
                'label' => esc_html__('Number Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K+', 'elementor-addon'),
                'label_block' => true,
            ]
        );



        $this->add_control(
            'list',
            [
                'label' => esc_html__('Team  List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Title #1',
                    ],
                    [
                        'title' => 'Title #2',
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

        <?php if ($settings['design_style'] == 'style_2') : ?>



        <?php else : ?>



            <div class="tp-counter-area">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['list'] as $item) : ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="tp-counter-item text-center mb-30">
                                    <span class="tp-counter-icon d-inline-block mb-20 p-relative">
                                        <?php if ($item['icon_style'] === 'icon') : ?>
                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                        <?php elseif ($item['icon_style'] === 'image') : ?>
                                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                                        <?php elseif ($item['icon_style'] === 'svg') : ?>
                                            <?php echo $item['svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                    <h2 class="tp-counter-title mb-0"><span class="purecounter" data-purecounter-duration="2" data-purecounter-end="<?php echo esc_html($item['number']); ?>"><?php echo esc_html($item['number']); ?></span><?php echo esc_html($item['number-text']); ?></h2>
                                    <span class="tp-counter-subtitle"> <?php echo esc_html($item['title']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        <?php endif; ?>

<?php

    }
}
