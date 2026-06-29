<?php
class Mindu_Team extends \Elementor\Widget_Base
{
    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-team';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Team', 'elementor-addon');
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
        return ['Team', 'Members'];
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
                'default' => esc_html__('John Doe', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO & Founder', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('#', 'elementor-addon'),
                'default' => [
                    'url' => esc_html__('#', 'elementor-addon'),
                ],
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
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Image Tab End





        // Icon Tab Start

        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Social Icons', 'elementor-addon'),
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
            'social_url',
            [
                'label' => esc_html__('Social URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,

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

        // Icon Tab End
    }

    protected function register_style_section()
    {
        // Style Tab Start

        $this->common_trait_style('title', 'Title', '.el-title');
        $this->common_trait_style('content', 'Content', '.el-content');

        // Style Tab End
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

?>

        <div class="tp-team-wrap">
            <div class="tp-team-thumb p-relative mb-25">
                <img class="w-100" src="<?php echo esc_url($settings['image']['url']); ?>" alt="">
                <div class="tp-team-social p-absolute">

                    <?php foreach ($settings['list'] as $item) : ?>
                        <a href="<?php echo esc_url($item['social_url']['url']); ?>">
                            <?php if ($item['icon_style'] === 'icon') : ?>
                                <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                            <?php else : ?>
                                <?php echo $item['svg']; ?>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="tp-team-content text-center">
                <h2 class="tp-team-title fw-600 mb-5 el-title">
                    <a href="<?php echo esc_url($settings['url']['url']); ?>"><?php echo mc_kses($settings['title']); ?></a>
                </h2>
                <span class="tp-team-subtitle el-content"><?php echo mc_kses($settings['designation']); ?></span>
            </div>
        </div>


<?php
    }
}
