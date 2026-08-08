<?php
class Mindu_Header_Menu extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-header-menu';
    }

    public function get_title(): string
    {
        return esc_html__('Header Menu', 'elementor-addon');
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
        return ['Header Menu'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }


    //get_nav_menus
    private function get_nav_menus()
    {

        $menus = wp_get_nav_menus();
        $options = [];

        if (! empty($menus)) {

            foreach ($menus as $menu) {
                $options[$menu->term_id] = $menu->name;
            }
        }

        return $options;
    }



    // Content Tab Start
    protected function register_controls_section()
    {


        $this->start_controls_section(
            'section_menu',
            [
                'label' => esc_html__('Main Menu', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'   => __('Select Menu', 'mindu'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_nav_menus(),
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'menu_align',
            [
                'label' => 'Alignment',
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .el-menu' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Tab End


    }









    // style tab 
    protected function register_style_section()
    {

        $this->start_controls_section(
            'menu_item_style',
            [
                'label' => 'Menu Item',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .tp-menu-el > li a',
            ]
        );


        $this->start_controls_tabs('menu_item_tabs');

        // Normal
        $this->start_controls_tab('menu_item_normal', ['label' => 'Normal']);

        $this->add_control(
            'menu_color',
            [
                'label' => 'Text Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-el > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab('menu_item_hover', ['label' => 'Hover']);

        $this->add_control(
            'menu_hover_color',
            [
                'label' => 'Hover Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-el > li > a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Active
        $this->start_controls_tab('menu_item_active', ['label' => 'Active']);

        $this->add_control(
            'menu_active_color',
            [
                'label' => 'Active Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-el > li.current-menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'menu_padding',
            [
                'label' => 'Padding',
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-el > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_gap',
            [
                'label' => 'Item Gap',
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-menu-el > li' => 'margin: 0  {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }




    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['menu'])) {
            return;
        }
?>




        <div class="tp-header-left el-menu">
            <div class="tp-main-menu tp-main-menu-2 tp-menu-dropdown">
                <nav class="tp-mobile-menu-active">
                    <?php

                    wp_nav_menu(
                        [
                            'menu'        => (int) $settings['menu'],
                            'container'   => '',
                            'menu_class'  => 'tp-menu-el',
                            'fallback_cb' => 'Mindu_Walker_Nav_Menu::fallback',
                            'walker'      => new Mindu_Walker_Nav_Menu,
                        ]
                    );

                    ?>
                </nav>
            </div>
        </div>




<?php
    }
}
