<?php

trait TP_Link_Style_Trait {

    protected function tp_link_controls_style( $prefix = '', $label = 'Button', $selector = '',$layout = '' ) {

        $prefix = $prefix ? $prefix . '_' : '';

        // base args
        $args = [
            'label' => $label,
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ];

        // condition only if layout exists
        if ( ! empty( $layout ) ) {
            $args['condition'] = [
                'design-layout' => $layout,
            ];
        }

        $this->start_controls_section(
            $prefix . '_style_section',
            $args
        );

        $base_selector = '{{WRAPPER}} ' . $selector;

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => $prefix . 'typography',
                'selector' => $base_selector,
            ]
        );

        // Padding
        $this->add_responsive_control(
            $prefix . 'padding',
            [
                'label' => 'Padding',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    $base_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            $prefix . 'radius',
            [
                'label' => 'Border Radius',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    $base_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Tabs
        $this->start_controls_tabs( $prefix . 'tabs' );

        // Normal
        $this->start_controls_tab(
            $prefix . 'normal',
            [ 'label' => 'Normal' ]
        );

        $this->add_control(
            $prefix . 'color',
            [
                'label' => 'Text Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base_selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . 'bg',
            [
                'label' => 'Background',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base_selector => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            $prefix . 'hover',
            [ 'label' => 'Hover' ]
        );

        $this->add_control(
            $prefix . 'hover_color',
            [
                'label' => 'Text Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base_selector . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . 'hover_bg',
            [
                'label' => 'Background',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base_selector . ':hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Border
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => $prefix . 'border',
                'selector' => $base_selector,
            ]
        );

        // Shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => $prefix . 'shadow',
                'selector' => $base_selector,
            ]
        );

        $this->end_controls_section();
    }
}