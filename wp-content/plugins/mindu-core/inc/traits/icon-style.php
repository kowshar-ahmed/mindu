<?php

trait TP_Icon_Style_Trait {

    protected function tp_icon_style_controls( $prefix = '',$label = 'Icon Style', $selector = '.el-icon' ) {

        $this->start_controls_section(
            $prefix . 'section_icon_style',
            [
                'label' => esc_html__( $label, 'consora-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Width
        $this->add_control(
            $prefix . 'icon_width',
            [
                'label'      => esc_html__( 'Width', 'consora-core' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ' . $selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height
        $this->add_control(
            $prefix . 'icon_height',
            [
                'label'      => esc_html__( 'Height', 'consora-core' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ' . $selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_control(
            $prefix . 'icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'consora-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius
        $this->add_control(
            $prefix . 'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'consora-core' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} ' . $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Normal / Hover Tabs
        $this->start_controls_tabs( $prefix . 'icon_style_tabs' );

        // ── Normal Tab ──
        $this->start_controls_tab(
            $prefix . 'icon_style_normal',
            [ 'label' => esc_html__( 'Normal', 'consora-core' ) ]
        );

        $this->add_control(
            $prefix . 'icon_color',
            [
                'label'     => esc_html__( 'Color', 'consora-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector           => 'color: {{VALUE}};',
                    '{{WRAPPER}} ' . $selector . ' svg'  => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . 'icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'consora-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => $prefix . 'icon_border',
                'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        $this->end_controls_tab();

        // ── Hover Tab ──
        $this->start_controls_tab(
            $prefix . 'icon_style_hover',
            [ 'label' => esc_html__( 'Hover', 'consora-core' ) ]
        );

        $this->add_control(
            $prefix . 'icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'consora-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ':hover'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} ' . $selector . ':hover svg'   => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . 'icon_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'consora-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ':hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => $prefix . 'icon_hover_border',
                'selector' => '{{WRAPPER}} ' . $selector . ':hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
}