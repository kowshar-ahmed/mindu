<?php
 
$categories =get_the_category();


?>



<div class="tp-blog-meta-wrap d-flex flex-wrap gap-1 mb-15">
    <span class="tp-blog-meta fw-500 d-inline-block">
        <span>
            <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.54969 4H3.64969M6.44899 6.8H3.649" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.7 14.5H1.9C1.1268 14.5 0.5 13.8732 0.5 13.1M0.5 13.1C0.5 12.3268 1.1268 11.7 1.9 11.7H11.7V3.3C11.7 1.98007 11.7 1.3201 11.2899 0.910053C10.8799 0.5 10.2199 0.5 8.9 0.5H4.7C2.7201 0.5 1.73015 0.5 1.11508 1.11508C0.5 1.73015 0.5 2.7201 0.5 4.7V13.1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.3495 11.6992C11.3495 11.6992 10.6495 12.2332 10.6495 13.0992C10.6495 13.9653 11.3495 14.4992 11.3495 14.4992" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <?php
        if (!empty($categories)) {
            echo $categories[0]->name;
        }
        ?>
    </span>
    <span class="tp-blog-meta fw-500 d-inline-block">
        <span>
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.69231 0.5V3.30004M4.03543 0.5V3.30004" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7.5711 1.89941H6.15688C3.4902 1.89941 2.15686 1.89941 1.32843 2.71952C0.5 3.53964 0.5 4.85959 0.5 7.49949V8.89951C0.5 11.5394 0.5 12.8594 1.32843 13.6795C2.15686 14.4996 3.4902 14.4996 6.15688 14.4996H7.5711C10.2378 14.4996 11.5711 14.4996 12.3995 13.6795C13.228 12.8594 13.228 11.5394 13.228 8.89951V7.49949C13.228 4.85959 13.228 3.53964 12.3995 2.71952C11.5711 1.89941 10.2378 1.89941 7.5711 1.89941Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M0.5 6.09961H13.228" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <?php echo get_the_date(); ?>
    </span>
</div>