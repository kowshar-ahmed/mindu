<?php
class Mindu_Header_Search extends \Elementor\Widget_Base
{

    use \Common_Trait_Style;

    public function get_name(): string
    {
        return 'mindu-header-search';
    }

    public function get_title(): string
    {
        return esc_html__('Theme Header Search', 'elementor-addon');
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
        return ['Header Search'];
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


        <div class="tp-header-2-option">

            <button class="tp-header-search tp-search-click">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.6389 11.6389L14.7499 14.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M13.1941 6.97222C13.1941 3.53578 10.4084 0.75 6.97206 0.75C3.53571 0.75 0.75 3.53578 0.75 6.97222C0.75 10.4087 3.53571 13.1944 6.97206 13.1944C10.4084 13.1944 13.1941 10.4087 13.1941 6.97222Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

        </div>






        <!--search-form-start -->
        <div class="tp-offcanvas-overlay"></div>
        <div class="tp-search-form-toggle">
            <div class="container">
                <div class="row mb-70">
                    <div class="col-lg-12">
                        <div class="tp-search-top d-flex justify-content-between align-items-center">
                            <div class="cm-search-logo">
                                <a href="<?php echo home_url(); ?>"><img data-width="108" src="<?php echo esc_url($settings['logo']['url']); ?>" alt="logo"></a>
                            </div>
                            <button class="tp-search-close">
                                <i class="fa-light fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="tp-search-form">
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="tp-search-form-input">
                                    <input name="s" value="<?php echo get_search_query(); ?>" type="text" placeholder="<?php esc_attr_e('What are you looking for?', 'mindu-core'); ?>" required>
                                    <span class="tp-search-focus-border"></span>
                                    <button class="tp-search-form-icon" type="submit">
                                        <i class="fa-sharp fa-regular fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search-form-end -->






<?php
    }
}
