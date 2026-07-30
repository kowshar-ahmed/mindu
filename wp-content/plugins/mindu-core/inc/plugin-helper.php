<?php


//get all category
function tp_all_category($name = 'category')
{
   $categories = get_terms(array(
      'taxonomy' => $name,
      'orderby' => 'name',
      'order' => 'ASC',
      'hide_empty' => false, // Set to true if you want to hide empty categories
   ));

   $category_list = [];
   foreach ($categories as $category) {
      $category_list[$category->slug] = $category->name;
   }

   return $category_list;
}


// get all post
function tp_all_post($post_type_name = 'post')
{
   $posts = get_posts(array(
      'post_type' => $post_type_name,
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1, // Retrieve all posts
   ));

   $post_list = array();
   foreach ($posts as $post) {
      $post_list[$post->ID] = $post->post_title;
   }

   return $post_list;
}


/**
 * Sanitize SVG markup for front-end display.
 *
 * @param  string $svg SVG markup to sanitize.
 * @return string 	  Sanitized markup.
 */
function mc_kses($tag = '')
{
   $allowed_html = [
      'a' => [
         'class'    => [],
         'href'    => [],
         'title'    => [],
         'target'    => [],
         'rel'    => [],
      ],
      'b' => [],
      'blockquote'  =>  [
         'cite' => [],
      ],
      'cite'                      => [
         'title' => [],
      ],
      'code'                      => [],
      'del'                    => [
         'datetime'   => [],
         'title'      => [],
      ],
      'div'                    => [
         'class'   => [],
         'title'   => [],
         'style'   => [],
      ],
      'dl'                     => [],
      'dt'                     => [],
      'em'                     => [],
      'h1'                     => [],
      'h2'                     => [],
      'h3'                     => [],
      'h4'                     => [],
      'h5'                     => [],
      'h6'                     => [],
      'i'                         => [
         'class' => [],
      ],
      'img'                    => [
         'alt'  => [],
         'class'   => [],
         'height' => [],
         'src'  => [],
         'width'   => [],
      ],
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
   ];

   return wp_kses($tag, $allowed_html);
}
