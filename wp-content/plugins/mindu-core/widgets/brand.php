<?php
class Mindu_Brand extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-brand';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Brand', 'elementor-addon');
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
        return ['brand'];
    }


    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }

    protected function register_controls_section()
    {


        // Section Layout Tab Start


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



        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('Brand', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'list_title' => 'Title #2',
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_section()
    {
        $this->common_trait_style('sub_title', 'Sub Title', '.el-sub-title');
        $this->common_trait_style('title', 'Title', '.el-title');
        $this->common_trait_style('content', 'Content', '.el-content');
        $this->common_trait_style('button_content', 'Button Content', '.el-button-content');
        $this->common_trait_style('button_explore_content', 'Button Explore Content', '.el-button-explore-content');
        $this->common_trait_style('video_content', 'Video Content', '.el-video-content');
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['design_style'] == 'style_2') :

        ?>

            <div class="tp-brand-area fix p-relative m-z-1">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper tp-brand-slider tp-brand-2-slider">
                                <div class="swiper-wrapper slide-transtion">

                                    <?php foreach ($settings['list'] as $item) : ?>
                                        <div class="swiper-slide">
                                            <div class="tp-brand-item">
                                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        <?php else : ?>

            <div class="tp-brand-area fix">
                <div class="swiper tp-brand-slider">
                    <div class="swiper-wrapper slide-transtion">
                        <?php foreach ($settings['list'] as $item) : ?>
                            <div class="swiper-slide">
                                <div class="tp-brand-item">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
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
