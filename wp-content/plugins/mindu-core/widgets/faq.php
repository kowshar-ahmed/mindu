<?php
class Mindu_FAQ extends \Elementor\Widget_Base
{

    use \TP_Common_Style, TP_Link_Style_Trait;

    public function get_name(): string
    {
        return 'mindu-faq';
    }

    public function get_title(): string
    {
        return esc_html__('Theme FAQ', 'elementor-addon');
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
        return ['faq'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }

    protected function register_controls_section()
    {

        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Faq', 'elementor-addon'),
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
            'content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-addon'),
                'label_block' => true,
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
                    ],
                    [
                        'list_title' => 'Title #2',
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function register_style_section()
    {

        $this->tp_text_style_controls('title', 'Title', '.el-title');
        $this->tp_text_style_controls('content', 'Content', '.el-content');


        $this->start_controls_section(
            'section_title_active_style',
            [
                'label' => esc_html__('Active Title', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_active',
            [
                'label' => esc_html__('Active Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-faq-item.active .el-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }






    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>





        <div class="tp-faq">
            <div class="accordion" id="accordionExample">

                <?php foreach ($settings['list'] as $key => $item) :
                    $collapsed = ($key == 0) ? '' : 'collapsed';
                    $show = ($key == 0) ? 'show' : '';
                    $active = ($key == 0) ? 'active' : '';
                ?>
                    <div class="tp-faq-item <?php echo esc_attr($active) ?> wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                        <h2 class="accordion-header">
                            <button class="tp-faq-button el-title <?php echo esc_attr($collapsed) ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($key); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($key); ?>">
                                <?php echo esc_html($item['title']); ?>
                            </button>
                        </h2>
                        <div id="collapseOne-<?php echo esc_attr($key); ?>" class="tp-faq-collapse collapse <?php echo esc_attr($show) ?>" data-bs-parent="#accordionExample">
                            <div class="tp-faq-body">
                                <p class="el-content"> <?php echo esc_html($item['content']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>





<?php

    }
}
