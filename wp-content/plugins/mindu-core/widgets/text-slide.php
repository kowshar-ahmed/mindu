<?php
class Mindu_Text_Slide extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-text-slide';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Text Slide', 'elementor-addon');
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
        return ['text', 'slide'];
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
                'label' => esc_html__('Text Slide', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow your skills today', 'elementor-addon'),
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




            <div class="tp-text-slider-area">
                <div class="swiper tp-text-slider-active">
                    <div class="swiper-wrapper slide-transtion">
                        <?php foreach ($settings['list'] as $item) : ?>
                            <div class="swiper-slide">
                                <div>
                                    <h2 class="tp-text-title"> <?php echo esc_html($item['title']); ?>
                                        <svg width="92" height="40" viewBox="0 0 92 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="72" cy="20" r="19.25" stroke="#B7B8B8" stroke-width="1.5" />
                                            <circle cx="20" cy="20" r="19.25" stroke="#B7B8B8" stroke-width="1.5" />
                                        </svg>
                                    </h2>
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
