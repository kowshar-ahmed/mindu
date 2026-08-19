<?php

trait TP_Common_Style {
    // heading 
    protected function tp_text_style_controls( $prefix = '', $label = 'Style', $selector = '', $layout = '' ) {

        $prefix = $prefix ? $prefix . '_' : '';

        $args = [
            'label' => esc_html__( $label, 'textdomain' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ];


        // Condition only if layout exists
        if ( ! empty( $layout ) ) {
            $args['condition'] = [
                'design-layout' => $layout,
            ];
        }

        $this->start_controls_section(
            $prefix . 'common_style_section',
            $args
        );

        $base = '{{WRAPPER}} ' . $selector;

        /**
         * 🔹 Color
         */
        $this->add_control(
            $prefix . 'color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base => 'color: {{VALUE}};',
                ],
            ]
        );

        /**
         * 🔹 Typography
         */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => $prefix . 'typography',
                'selector' => $base,
            ]
        );

        /**
         * 🔹 Text Transform
         */
        $this->add_control(
            $prefix . 'text_transform',
            [
                'label' => esc_html__( 'Text Transform', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => 'Default',
                    'uppercase' => 'UPPERCASE',
                    'lowercase' => 'lowercase',
                    'capitalize' => 'Capitalize',
                ],
                'selectors' => [
                    $base => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        /**
         * 🔹 Alignment
         */
        $this->add_control(
            $prefix . 'align',
            [
                'label' => esc_html__( 'Alignment', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => 'Left', 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => 'Center', 'icon' => 'eicon-text-align-center'],
                    'right' => ['title' => 'Right', 'icon' => 'eicon-text-align-right'],
                ],
                'selectors' => [
                    $base => 'text-align: {{VALUE}};',
                ],
            ]
        );

        /**
         * 🔹 Margin
         */
        $this->add_responsive_control(
            $prefix . 'margin',
            [
                'label' => esc_html__( 'Margin', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    $base => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /**
         * 🔹 Padding
         */
        $this->add_responsive_control(
            $prefix . 'padding',
            [
                'label' => esc_html__( 'Padding', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    $base => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /**
         * 🔹 Text Shadow
         */
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => $prefix . 'text_shadow',
                'selector' => $base,
            ]
        );

        /**
         * 🔹 Display (advanced but useful)
         */
        $this->add_control(
            $prefix . 'display',
            [
                'label' => esc_html__( 'Display', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => 'Default',
                    'block' => 'Block',
                    'inline-block' => 'Inline Block',
                    'inline' => 'Inline',
                ],
                'selectors' => [
                    $base => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // section 
    protected function tp_section_style_controls( $label = 'Section Style', $selector = 'el-section' ) {

        $base = '{{WRAPPER}} ' . $selector;

        $this->start_controls_section(
            'tp_section_style',
            [
                'label' => esc_html__( $label, 'textdomain' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'section_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => $base,
            ]
        );

        // Padding
        $this->add_responsive_control(
            'section_padding',
            [
                'label'      => esc_html__( 'Padding', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $base => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'section_margin',
            [
                'label'      => esc_html__( 'Margin', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    $base => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // form 
    protected function tp_form_style_controls(
        $prefix = '',
        $section_id = 'style',
        $label = 'Style',
        $selector = '',
        $layout = ''
    ) {

        $args = [
            'label' => esc_html__( $label, 'textdomain' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ];

        // Condition only if layout exists
        if ( ! empty( $layout ) ) {
            $args['condition'] = [
                'design-layout' => $layout,
            ];
        }

        $this->start_controls_section(
            $prefix . '_' . $section_id . '_section',
            $args
        );

        $base = '{{WRAPPER}} ' . $selector;

  
        /**
         * Input Typography
         */
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => $prefix . '_input_typography',
                'selector' => $base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]),
                                ' . $base . ' textarea,
                                ' . $base . ' select,
                                ' . $base . ' input::placeholder,
                                ' . $base . ' textarea::placeholder',
            ]
        );

        /**
         * Input Height
         */
        $this->add_responsive_control(
            $prefix . '_input_height',
            [
                'label'      => esc_html__( 'Input Height', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    $base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"])' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /**
         * Textarea Height
         */
        $this->add_responsive_control(
            $prefix . '_textarea_height',
            [
                'label'      => esc_html__( 'Textarea Height', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    $base . ' textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        /**
         * Border Radius
         */
        $this->add_responsive_control(
            $prefix . '_input_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    $base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]),
                    ' . $base . ' textarea,
                    ' . $base . ' select' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
/**
 * Input Margin
 */
$this->add_responsive_control(
	$prefix . '_input_margin',
	[
		'label'      => esc_html__( 'Input Margin', 'textdomain' ),
		'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', 'em', '%' ],
		'selectors'  => [
			$base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]),
			' . $base . ' textarea,
			' . $base . ' select' =>
				'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

/**
 * Input Padding
 */
$this->add_responsive_control(
	$prefix . '_input_padding',
	[
		'label'      => esc_html__( 'Input Padding', 'textdomain' ),
		'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', 'em', '%' ],
		'selectors'  => [
			$base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]),
			' . $base . ' textarea,
			' . $base . ' select' =>
				'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

/**
 * Input Border Width
 */
$this->add_responsive_control(
	$prefix . '_input_border_width',
	[
		'label'      => esc_html__( 'Border Width', 'textdomain' ),
		'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px' ],
		'selectors'  => [
			$base . ' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]),
			' . $base . ' textarea,
			' . $base . ' select' =>
				'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; border-style: solid;',
		],
	]
);
        
        /**
         * Tabs
         */
        $this->start_controls_tabs( $prefix . '_input_style_tabs' );

        /**
         * Normal Tab
         */
        $this->start_controls_tab(
            $prefix . '_input_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'textdomain' ),
            ]
        );

        $this->add_control(
            $prefix . '_input_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]),
                    ' . $base . ' textarea,
                    ' . $base . ' select' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . '_input_placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input::placeholder'    => 'color: {{VALUE}};',
                    $base . ' textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . '_input_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]),
                    ' . $base . ' textarea,
                    ' . $base . ' select' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . '_input_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]),
                    ' . $base . ' textarea,
                    ' . $base . ' select' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        /**
         * Focus Tab
         */
        $this->start_controls_tab(
            $prefix . '_input_focus_tab',
            [
                'label' => esc_html__( 'Focus', 'textdomain' ),
            ]
        );

        $this->add_control(
            $prefix . '_input_focus_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]):focus,
                    ' . $base . ' textarea:focus,
                    ' . $base . ' select:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . '_input_focus_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]):focus,
                    ' . $base . ' textarea:focus,
                    ' . $base . ' select:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $prefix . '_input_focus_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    $base . ' input:not([type="submit"]):focus,
                    ' . $base . ' textarea:focus,
                    ' . $base . ' select:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => $prefix . '_input_focus_box_shadow',
                'selector' => $base . ' input:not([type="submit"]):focus,
                                ' . $base . ' textarea:focus,
                                ' . $base . ' select:focus',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
}