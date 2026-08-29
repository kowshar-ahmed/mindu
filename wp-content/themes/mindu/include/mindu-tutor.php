<?php


function mindu_course_grid()
{

$course_id = get_the_ID();
$total_lessons = tutor_utils()->get_lesson_count_by_course($course_id);
$students_count = tutor_utils()->count_enrolled_users_by_course($course_id);

    $cats = get_the_terms($course_id, 'course-category');



?>
    <div class="tp-course-item p-relative fix mb-30">
        <div class="tp-course-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'course-pink')); ?>
            </a>
        </div>
        <div class="tp-course-content">
            <div class="tp-course-tag mb-10">
                <?php
                $html = '';
                if ($cats && !is_wp_error($cats)) {
                    $count = 0;
                    foreach ($cats as $key => $cat) {
                        $html .= '<span><a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a></span>, ';
                        $count++;
                        if ($count == 1) {
                            break;
                        }
                    }
                }
                echo rtrim($html, ', ');
                ?>
            </div>
            <div class="tp-course-meta">
                <span>
                    <span>
                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5227 9.64274V1.89421C13.5227 1.11835 12.8948 0.554094 12.125 0.614551H12.0846C10.7274 0.725388 8.67148 1.42065 7.51691 2.13605L7.40552 2.20659C7.22322 2.31743 6.9092 2.31743 6.71678 2.20659L6.55476 2.10583C5.41032 1.39042 3.35437 0.715302 1.99725 0.604465C1.22754 0.544008 0.599609 1.11837 0.599609 1.88415V9.64274C0.599609 10.2574 1.10598 10.8418 1.72378 10.9123L1.90607 10.9426C3.30371 11.1239 5.47111 11.8393 6.7067 12.5144L6.73705 12.5245C6.90922 12.6253 7.19279 12.6253 7.35483 12.5245C8.59042 11.8394 10.7679 11.134 12.1757 10.9426L12.3884 10.9123C13.0163 10.8418 13.5227 10.2675 13.5227 9.64274Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.06152 2.41797V12.0507" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <?php echo esc_html($total_lessons); ?> <?php esc_html_e('Lessons', 'mindu'); ?>
                </span>
                <span>
                    <span>
                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.17071 7.1001C7.96175 7.1001 9.41368 5.64502 9.41368 3.8501C9.41368 2.05517 7.96175 0.600098 6.17071 0.600098C4.37966 0.600098 2.92773 2.05517 2.92773 3.8501C2.92773 5.64502 4.37966 7.1001 6.17071 7.1001Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.7425 13.6C11.7425 11.0845 9.24538 9.05005 6.17104 9.05005C3.0967 9.05005 0.599609 11.0845 0.599609 13.6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <?php echo esc_html($students_count); ?> <?php esc_html_e('Students', 'mindu'); ?>
                </span>
            </div>
            <h2 class="tp-course-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="tp-course-rating d-flex align-items-end justify-content-between">
                <div class="tp-course-rating-star">
                    <p>5.0<span> /5</span></p>
                    <div class="tp-course-rating-icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="tp-course-pricing home-2">
                    <span>Free</span>
                </div>
            </div>
        </div>
        <div class="tp-course-btn">
            <a href="<?php the_permalink(); ?>">Preview this Course</a>
        </div>
    </div>


<?php

}

add_action('mindu_course', 'mindu_course_grid');
