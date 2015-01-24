<?php
//Register meta boxes
add_action('admin_init', 'rw_register_meta_boxes');

function rw_register_meta_boxes()
{
    if (!class_exists('RW_Meta_Box'))
        return;
    $prefix       = 'rw_';
    $meta_boxes   = array();
		
	// All Revolution sliders in array
	$revolutionslider = array();
	if( class_exists('RevSlider') ) {
		$theslider = new RevSlider();
		$arrSliders = $theslider->getArrSliders();
		$revolutionslider[0] = 'Select a Slider';
		foreach($arrSliders as $slider) { 
			$revolutionslider[$slider->getAlias()] = $slider->getTitle();
		}
	}
	else {
		$revolutionslider[0] = 'Install Revolution Slider Plugin';
	}
	
    // Meta box to select portfolio post type
    $meta_boxes[] = array(
        'title'    => 'Post type',
        'context'  => 'side',
        'priority' => 'high',
        'pages'    => array(
            'tcsn_portfolio'
        ),
        'fields'   => array(
            array(
                'name'       => __('Select Post Type', 'rwmb'),
                'id'         => $prefix . 'portfolio_type',
                'type'       => 'select',
                'options'    => array(
                    'Image' => __('Image', 'rwmb'),
                    'Video' => __('Video', 'rwmb'),
                ),
                'multiple'    => false,
                'std'         => 'Image',
                'placeholder' => __('Select Post Type', 'rwmb'),
				'desc' => __('<br/>Preferred image size : <strong>530px x 370px</strong>', 'rwmb'),
            )
        )
    );
	
    // Meta box for video url input
    $meta_boxes[] = array(
        'title'   => 'If - Video Post',
        'pages'   => array(
            'tcsn_portfolio'
        ),
        'context'  => 'side',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => 'Video URL :',
                'id'   => $prefix . 'video_url',
                'type' => 'text',
                'size' => 27,
                'desc' => __('<br/>Video will be displayed on zoom.<br/><br/><strong>URL examples</strong><br/> Youtube - http://youtu.be/XSGBVzeBUbk <br/><br/>  Vimeo - http://vimeo.com/69228454', 'rwmb')
            ),
        )
    );
	
	// Meta box for image url input
    $meta_boxes[] = array(
        'title' => 'External Link URL',
        'pages' => array(
            'tcsn_portfolio'
        ),
        'context'  => 'side',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => '',
                'id'   => $prefix . 'link_url',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
			
			array(
				'name' => __( '</br>Check to enable external link, if unchecked, link will display portfolio details page.', 'rwmb' ),
				 'id'  => $prefix . 'external_link',
				'type' => 'checkbox',
				'std'  => 0,
			),
        )
    );
	
	// Meta box for title to large image / video
	$meta_boxes[] = array(
        'title' => 'Title to large image / video',
        'pages' => array(
            'tcsn_portfolio'
        ),
        'context'  => 'side',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => '',
                'id'   => $prefix . 'zoom_title',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
        )
    );
	
	// Meta box for portfolio details
    $meta_boxes[] = array(
        'title'   => 'Portfolio / Project Info :',
        'pages'   => array(
            'tcsn_portfolio'
        ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => '',
                'id'   => $prefix . 'pf_details',
                'type' => 'textarea',
                'size' => 40,
                'desc' => '<br/>Copy following to above textarea. You can place other content (accepts HTML) . <br/><br/> &lt;h3&gt;The Awesome Project&lt;/h3&gt;<br/>
&lt;ul class="list-border"&gt;<br/>
	&lt;li&gt;&lt;span&gt;Started on :&lt;/span&gt; Sept 2, 2012&lt;/li&gt;<br/>
	&lt;li&gt;&lt;span&gt;Challenge :&lt;/span&gt; Logo / Web / Corporate Identity&lt;/li&gt;<br/>
	&lt;li&gt;&lt;span&gt;Completed on :&lt;/span&gt; Oct 4, 2012&lt;/li&gt;<br/>
	&lt;li&gt;online /&lt;del&gt;&lt;span&gt;offline&lt;/span&gt;&lt;/del&gt;&lt;/li&gt;<br/>
&lt;/ul&gt;<br/>
&lt;a href="#" class="mybtn"&gt;Launch Project&lt;/a&gt;',
            ),
        )
    );
	
	// Meta box for video embed
    $meta_boxes[] = array(
        'title'   => 'Video Embed Code :',
        'pages'   => array(
            'tcsn_portfolio'
        ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => '',
                'id'   => $prefix . 'pf_video_embed',
                'type' => 'textarea',
                'size' => 40,
                'desc' => '',
            ),
        )
    );
	
	 // Meta box for Page - Icon enable / disable and icon path
    $meta_boxes[] = array(
        'title'    => 'Icon for title',
        'context'  => 'side',
        'priority' => 'high',
        'pages'    => array(
            'page'
        ),
        'fields'   => array(
            array(
            	'name'  => __( 'Give icon path', 'rwmb' ),
			 	'id'    => $prefix . 'icon_url',
				'desc'  => __( 'Icon url', 'rwmb' ),
				'type'  => 'text',
				'size' => 27,
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
            ),
			
			array(
			'name' => __( 'Checkbox', 'rwmb' ),
			 'id'  => $prefix . 'show_icon',
			'type' => 'checkbox',
			'std'  => 0,
		),
		
        )
    );
	
	// Meta box to select revolution slider for home page
    $meta_boxes[] = array(
        'title'    => 'Select Revolution Slider (For Home Page)',
        'context'  => 'normal',
        'priority' => 'default',
        'pages'    => array(
            'page'
        ),
        'fields'   => array(
            array(
                'name'       => __('', 'rwmb'),
                'id'         => $prefix . 'select_rev_slider',
				'desc'  => __( 'Select Revolution Slider, only if home page template selected.', 'rwmb' ),
                'type'       => 'select',
                'options'    => $revolutionslider,
                'multiple'    => false,
                'placeholder' => __('', 'rwmb')
            )
        )
    );
	
	 // Meta box for pricing column to make it featured
    $meta_boxes[] = array(
        'title'    => 'Featured Pricing Column',
        'context'  => 'side',
        'priority' => 'high',
        'pages'    => array(
            'tcsn_pricing'
        ),
        'fields'   => array(
			array(
				'name' => __( 'Check to get column featured', 'rwmb' ),
				 'id'  => $prefix . 'pricing_type',
				'type' => 'checkbox',
				'std'  => 0,
		),
		     array(
			 	'name' => __( '<br>Slug esp. if column is featured', 'rwmb' ),
                'id'   => $prefix . 'pricing_slug',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
        )
    );
	
	// Meta box for pricing info
	$meta_boxes[] = array(
        'title' => 'Pricing info',
        'pages' => array(
            'tcsn_pricing'
        ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
			array(
                'name' => 'Currency Symbol',
                'id'   => $prefix . 'pricing_currency',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
			array(
                'name' => 'Price',
                'id'   => $prefix . 'pricing_price',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
			array(
                'name' => 'Cents',
                'id'   => $prefix . 'pricing_cents',
                'type' => 'text',
                'size' => 27,
                'desc' => __('', 'rwmb')
            ),
        )
    );
	
	// Meta box to select revolution slider for gallery post
    $meta_boxes[] = array(
        'title'    => 'Select Revolution Slider (For Gallery Post)',
        'context'  => 'normal',
        'priority' => 'default',
        'pages'    => array(
            'post'
        ),
        'fields'   => array(
            array(
                'name'       => __('', 'rwmb'),
                'id'         => $prefix . 'select_gallery_rev_slider',
				'desc'  => __( 'Select Revolution Slider, only if gallery post.', 'rwmb' ),
                'type'       => 'select',
                'options'    => $revolutionslider,
                'multiple'    => false,
                'placeholder' => __('', 'rwmb')
            )
        )
    );
	
    foreach ($meta_boxes as $meta_box) {
        new RW_Meta_Box($meta_box);
    }
}