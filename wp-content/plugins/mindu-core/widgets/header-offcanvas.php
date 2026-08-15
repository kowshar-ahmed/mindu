<?php
class Mindu_Header_Offcanvas extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-header-offcanvas';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Header Offcanvas', 'elementor-addon');
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
        return ['Header Offcanvas'];
    }

    protected function register_controls(): void
    {
        $this->register_controls_section();
        $this->register_style_section();
    }



    // Content Tab Start
    protected function register_controls_section()
    {


        // Image Tab Start

        $this->start_controls_section(
            'section_logo',
            [
                'label' => esc_html__('Logo', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'logo',
            [
                'label' => esc_html__('Logo', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],


            ]
        );


        $this->end_controls_section();

        // Image Tab End



    }










    // Style Tab Start

    protected function register_style_section()
    {

        $this->common_trait_style('sub_title', 'Sub Title', '.el-sub-title');
    }
    // Style Tab End




    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
?>


        <div class="tp-header-toogle-wrapper">
            <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
        </div>





        <!-- tp-offcanvas start -->
        <div class="tp-offcanvas">
            <div class="tp-offcanvas-header mb-30">
                <div class="tp-offcanvas-logo">
                    <a href="index.html"><img data-width="108" src="assets/img/logo/logo.png" alt=""></a>
                </div>
                <div class="tp-offcanvas-close">
                    <button class="tp-offcanvas-close-button"><i class="fal fa-times"></i></button>
                </div>
            </div>
            <div class="tp-offcanvas-menu mb-50">
                <nav>
                </nav>
            </div>
            <div class="tp-offcanvas-content mb-40">
                <h3 class="tp-offcanvas-title"> Hello There!</h3>
                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. </p>
            </div>
            <div class="tp-offcanvas-gallery mb-50">
                <a class="popup-image" href="assets/img/gallery/gallery.jpg"><img src="assets/img/gallery/gallery.jpg" alt="tour"></a>
                <a class="popup-image" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" alt="tour"></a>
                <a class="popup-image" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" alt="tour"></a>
                <a class="popup-image" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" alt="tour"></a>
            </div>
            <div class="tp-offcanvas-info mb-50">
                <h3 class="tp-offcanvas-title">Information</h3>
                <span><a href="tel:+42077001007">+ 4 20 7700 1007</a></span>
                <span><a href="mailto:hello@mindu.com">hello@mindu.com</a></span>
                <span><a href="https://maps.google.com/?q=Avenue+de+Roma+158b,+Lisboa" target="_blank">Avenue de Roma 158b, Lisboa</a></span>
            </div>
            <div class="tp-offcanvas-social">
                <h3 class="tp-offcanvas-title"> Follow Us</h3>
                <div class="tp-offcanvas-social-inner">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9.99991" cy="9.99991" r="8.38077" stroke="currentColor" stroke-width="1.5"></circle>
                            <path d="M18.3799 11.0604C17.6032 10.9148 16.8043 10.8389 15.9891 10.8389C11.5034 10.8389 7.51372 13.1373 4.9707 16.7054" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                            <path d="M15.8665 4.13281C13.2437 7.2064 9.30255 9.16128 4.8957 9.16128C3.76828 9.16128 2.67133 9.03332 1.61914 8.79143" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                            <path d="M12.1938 18.3815C12.4039 17.3641 12.5142 16.3104 12.5142 15.2309C12.5142 9.93756 9.86111 5.26259 5.80957 2.45801" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <a href="#">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.66602 8.99935C1.66602 5.54238 1.66602 3.8139 2.73996 2.73996C3.8139 1.66602 5.54238 1.66602 8.99935 1.66602C12.4563 1.66602 14.1848 1.66602 15.2587 2.73996C16.3327 3.8139 16.3327 5.54238 16.3327 8.99935C16.3327 12.4563 16.3327 14.1848 15.2587 15.2587C14.1848 16.3327 12.4563 16.3327 8.99935 16.3327C5.54238 16.3327 3.8139 16.3327 2.73996 15.2587C1.66602 14.1848 1.66602 12.4563 1.66602 8.99935Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                            <path d="M12.4747 9.00103C12.4747 10.9195 10.9195 12.4747 9.00103 12.4747C7.08256 12.4747 5.52734 10.9195 5.52734 9.00103C5.52734 7.08256 7.08256 5.52734 9.00103 5.52734C10.9195 5.52734 12.4747 7.08256 12.4747 9.00103Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M13.251 4.75391L13.242 4.75391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="tp-offcanvas-overlay"></div>
        <!-- tp-offcanvas end -->






<?php
    }
}
