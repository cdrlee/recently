<?php

/**
 * Set / get plugin default options.
 *
 * @link       http://cabrerahector.com
 * @since      2.0.0
 *
 * @package    Recently
 * @subpackage Recently/includes
 */

/**
 * Set / get plugin default options.
 *
 * @package    Recently
 * @subpackage Recently/includes
 * @author     Hector Cabrera <me@cabrerahector.com>
 */

class Recently_Settings {

    /**
     * Plugin options.
     *
     * @since   1.0.0
     * @var     array
     */
    static public $defaults = array(
        'widget_options' => array(
            'args' => array(
                'post_type' => array('post'),
                'post_status' => 'publish',
                'posts_per_page' => 10,
                'offset' => 0,
                'ignore_sticky_posts' => true
            ),
            'title' => '',
            'shorten_title' => array(
                'active' => false,
                'length' => 25,
                'words'	=> false
            ),
            'post-excerpt' => array(
                'active' => false,
                'length' => 55,
                'keep_format' => false,
                'words' => false
            ),
            'thumbnail' => array(
                'active' => false,
                'build' => 'manual',
                'width' => 50,
                'height' => 50,
                'crop' => true
            ),
            'rating' => false,
            'meta_tag' => array(
                'comment_count' => true,
                'views' => false,
                'author' => false,
                'date' => array(
                    'active' => false,
                    'format' => 'F j, Y'
                ),
                'taxonomy' =>  array(
                    'active' => false,
                    'names' => array()
                )
            ),
            'markup' => array(
                'custom_html' => false,
                'recently-start' => '<ul class="recently-list">',
                'recently-end' => '</ul>',
                'post-html' => '<li>{thumb} {title} {metadata}</li>',
                'post-start' => '<li>',
                'post-end' => '</li>',
                'title-start' => '<h2>',
                'title-end' => '</h2>'
            )
        ),
        'admin_options' => array(
            'tools' => array(
                'markup' => array(
                    'link' => array(
                        'attr' => array(
                            'rel' => 'bookmark',
                            'target' => '_self'
                        )
                    ),
                    'thumbnail' => array(
                        'source' => 'featured',
                        'field' => '',
                        'resize' => false,
                        'default' => ''
                    ),
                ),
                'data' => array(
                    'ajax' => false,
                    'cache' => array(
                        'active' => false,
                        'interval' => array(
                            'time' => 'hour',
                            'value' => 1
                        )
                    )
                ),
                'misc' => array(
                    'include_stylesheet' => true
                )
            )
        )
    );

    /**
     * Returns plugin options.
     *
     * @since    4.0.0
     * @access   public
     * @param    string   $option_set
     * @return   array
     */
    public static function get( $option_set = null ){

        $options = self::$defaults;

        if ( 'widget_options' == $option_set ) {
            return $options[ 'widget_options' ];
        }

        if ( !$admin_options = get_option( 'recently_config' ) ) {
            $admin_options = $options[ 'admin_options' ];
            add_option( 'recently_config', $admin_options );
        }
        else {
            $options[ 'admin_options' ] = Recently_Helper::merge_array_r(
                $options[ 'admin_options' ],
                (array) $admin_options
            );
        }

        if ( 'admin_options' == $option_set ) {
            return $options[ 'admin_options' ];
        }

        return $options;

    }

} // End Recently_Settings class
