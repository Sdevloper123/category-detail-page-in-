<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

get_header();
$category = get_queried_object();
$current_cat = $category->term_id;
/* echo "<pre>"; print_r($category); die(); */

$our_solution_heading = get_field('solution_heading', $category);
$case_studies_heading = get_field('case_study_heading', $category);

$solution_brought_heading = get_field('solution_brought_heading', $category);
$solution_brought_description = get_field('solution_brought_discription', $category);

$other_solution_heading = get_field('other_solution_heading', $category);
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/functionality_subpage.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/functionality_subpage_responsive.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/header-footer.css" />			
	
<section class="industries_banner_main">
	<div class="">
        <div class="owl-carousel owl-theme product_carousel">
			<?php 
			/* $terms = get_post( 'case_studies-category' ); */
			$args = array(
				'post_type' => 'home_slider',
				'orderby'   => 'post',
				'order'     => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'solutions_category',
						'field' => 'term_id',
						'terms' => $category->term_id
					)
				)
			);
			$the_query = new WP_Query( $args ); 
			?>
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="item">
				<picture>
					<source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/products/banner-mobile.png"/>
					<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large-medium' ); ?>" alt="" />
				</picture>
				<div class="banner_caption">
					<div class="section-padding-hr">
						<h2 class="main-heading"><?php the_title(); ?></h2>
						<div class="banner-text">
							<?php the_content(); ?>
							<a class="schedule-btn" href="#">Schedule My Appointment <span>»</span></a>
						</div>	
					</div>
				</div>
				<div class="banner-text-mobile">
					<?php the_content(); ?>
					<a class="schedule-btn" href="#">Schedule My Appointment <span>»</span></a>
				</div>
			</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php __('No Post'); ?></p>
			<?php endif;  ?>	
        </div>
	</div>
</section>

<section class="breadcrumb_sectopn section-padding-hr">
	<ul class="breadcrumb_list">
		<li><a href="#">Home</a></li>
		<li><a href="#">Solutions</a></li>
		<li><a href="#">Functionality</a></li>
		<li>Material Movement</li>
	</ul>
</section>	
  
<section class="our_solution section-padding-hr">
	<div class="ostab_wrapper">
		<?php
		$terms = get_post( 'solutions_category' );
		$args = array(
			'post_type' => 'solutions',
			'orderby'   => 'post',
			'order'     => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'solutions_category',
					'field' => 'term_id',
					'terms' => $category->term_id
				)
			)
		);
		$the_query = new WP_Query( $args ); 
		?>
		
		<div class="heading_block">
			<h2 class="main-heading"><?php echo $our_solution_heading; ?></h2>
		</div>
		<ul class="nav nav-tabs">
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<li class="nav-item">
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#_<?php echo get_the_ID(); ?>" type="button">
					<?php the_title(); ?>
					<span class="arrow arrow_normal"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/solution-icon.png" alt=""></span>
					<span class="arrow arrow_active"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/solution-icon-active.png" alt=""></span>
				</button>
			</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php __('No Post'); ?></p>
			<?php endif;  ?>
		</ul>
		
		<div class="tab-content">
			<?php
			$i = 1;
			$active_class= "";
			if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
			if($i == 1){
				$active_class= "active";
			} else{
				$active_class= "";
			}
			?>
			<div class="tab-pane fade <?php echo $active_class; ?>" id="_<?php echo get_the_ID(); ?>">
				<div class="solution_inner">
					<div class="copy_block">
						<h3><?php echo get_post_meta($post->ID, 'post_color_heading', true); ?></h3>
						<?php the_content(); ?>
						<?php the_excerpt(); ?>
						<ul class="thumb_list">
							<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/video-thumbnail.png" alt=""></a></li>
							<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/video-thumbnail.png" alt=""></a></li>
						</ul>
					</div>
					<div class="img_block">
						<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large-medium' ); ?>" alt="">
					</div>
				</div>
			</div>
			<?php
			$i = $i+1;
			endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php __('No Post'); ?></p>
			<?php endif;  ?>
			<div class="back_bulb">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/bulb-normal.png" alt="">
			</div>
		</div>
	</div>	
</section>

<section class="section-padding-hr cs_section">
	<div class="heading_block">
		<h2 class="main-heading"><?php echo $case_studies_heading; ?></h2>
	</div>	
	<div class="owl-carousel cs_carousel">
		<?php 
		/* $terms = get_post( 'case_studies-category' ); */
		$args = array(
			'post_type' => 'case_studies',
			'orderby'   => 'post',
			'order'     => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'solutions_category',
					'field' => 'term_id',
					'terms' => $category->term_id
				)
			)
		);
		$the_query = new WP_Query( $args ); 
		?>
		<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="item">
			<div class="copy_block">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<?php the_excerpt(); ?>
				<div class="readBtnWrap">
					<a href="#" class="btn-read"><span>Read more</span></a>
				</div>
			</div>
			<div class="img_block">
				<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large-medium' ); ?>" alt="">
			</div>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php __('No Post'); ?></p>
		<?php endif;  ?>
	</div>
</section>

<section class="productSec section-padding-hr">
	<div class="productSecWrap">
		<h2 class="main-heading"><?php echo $solution_brought_heading; ?></h2>
		<div class="proSecDesc">
			<p><?php echo $solution_brought_description; ?></p>
		</div>
		<?php
		$taxonomy="product_cat";
		$categories = get_terms([
			'taxonomy' => $taxonomy,
			'hide_empty' => false,
			'meta_query' => array(
				array(
					'key'     => 'category_type',
					'value'   => 1,
					'compare' => '=',
				)
			)
		]);
		?>
		<div class="owl-carousel productCarousel">
			<?php foreach($categories as $category) { ?>
			<div class="item">            
				<div class="proBox">
					<div class="proImage">
						<?php
						$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
						// get the medium-sized image url
						$image = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
						if(isset($image[0]) && $image[0]){ ?>
							<img src="<?php echo $image[0];?>" alt="">
						<?php  }else{?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/product-thumb.png" alt="">
						<?php } ?>
					</div>
					<h3><span><?php echo $category->name; ?></span></h3>
					<div class="proDesc">
						<p><?php echo $category->description; ?></p>
					</div>
					<div class="readBtnWrap">
						<a href="#" class="btn-read" data-bs-toggle="modal" data-bs-target="#productModal"><span>Download</span></a>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section> 
 
<section class="main section-padding-hr contact-section">      
	<div class="contactWrap">
		<div class="contact-left">
			<h2 class="main-heading">
				Talk to our <br />
				Industry Experts <br />
				about your <br />
				needs
			</h2>
		</div>
		<div class="contact-right">
			<form class="constact-form">
				<div class="wrap-items">
					<div class="fielsWrap">
						<input type="text" placeholder="Full Name*" class="form-control"/>
					</div>
					<div class="fielsWrap">
						<input type="text" placeholder="Email Id*" class="form-control"/>
					</div>
					<div class="fielsWrap grouped">
						<select id="country-flag">
							<option>IND</option>
						</select>
						<input type="text" placeholder="Mobile no.*" class="form-control border-left-none"/>
					</div>
					<div class="fielsWrap">
						<select id="sm">
							<option value="">Media Track*</option>
							<option>Linkedin</option>
							<option>Google</option>
							<option>Digital Ads</option>
							<option>Instagram</option>
							<option>Emailer</option>
							<option>Television</option>
							<option>Tele-calling</option>
							<option>Events</option>
							<option>Channel partner</option>
							<option>PR</option>
							<option>Newspaper</option>
							<option>Magazine</option>
							<option>Airport</option>
							<option>Hoardings</option>
							<option>Referal</option>
							<option>Word of mouth</option>
							<option>Can't say</option>
						</select>
					</div>
					<div class="fielsWrap">
						<input type="text" placeholder="Organization*" class="form-control"/>
					</div>
					<div class="fielsWrap">
						<input type="text" placeholder="Position*" class="form-control"/>
					</div>
					<div class="fielsWrap">
						<select id="timeline">
							<option>Project Timeline*</option>
							<option>45 Days</option>
							<option>60 Days</option>
							<option>90 Days</option>
							<option>180 Days</option>
						</select>
					</div>
					<div class="fielsWrap grouped">
						<select id="country-code">
							<option>IND</option>
						</select>
						<select id="country-budget">
							<option>Budget*</option>
						</select>
					</div>
					<div class="fielsWrap">
						<!--<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>-->
						<div class="captcha">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/captcha.png" alt="">
						</div>
					</div>
					<div class="fielsWrap directon-column">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
							<label class="form-check-label" for="flexCheckDefault">I Agree</label>
						</div>
						<p class="term-text">
							<small>Term & Conditions. Privacy Policy. lorem ipsum tupsum oreo mario lorem ipsum tupsum oreo mariolorem ipsum tupsum oreo mario</small>
						</p>
					</div>
				</div>
				<div class="submitbutton">
					<button type="submit" class="explore">Get our quote <span>&raquo</span></button>
				</div>
			</form>
		</div>
	</div>
</section>  
 
<section class="otherIndustry section-padding-hr">
	<div class="otherIndustryWrap">
		<h2 class="main-heading"><?php echo $other_solution_heading; ?></h2>
		<div class="owl-carousel otherIndCarousel">
			<?php 
			$args = array(
				'taxonomy'   => 'solutions_category',
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => 0,
				'exclude'    => $current_cat
			);
			$cats = get_categories($args);
			foreach($cats as $cat) {
			?>
			<div class="item">
				<div class="inner">
					<div class="itemImage">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/industry1.png" alt="">
					</div>
					<div class="itemBody">
						<h3><?php echo $cat->name; ?></h3>
						<p><?php echo $cat->description; ?></p>
						<div class="readBtnWrap">
							<a href="#" class="btn-read"><span>Read more</span></a>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<div class="modal" tabindex="-1" id="productModal">
	<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" >Automated Guided Robots for Sortation and Material Handling</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="popProdcutWrap">
					<div class="popProdcut">
						<div class="popImg">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/products/popProduct1.png" alt="">
						</div>
						<div class="popProInfo">
							<div class="varientTab">
								<h4>Variants</h4>                  
								<button type="button" class="active">Zippy6</button>
								<button type="button">Zippy30</button>
								<button type="button">Zippy10</button>
								<button type="button">Zippy40</button>
							</div>
							<h4>Tech Specifications</h4>
							<ul>
								<li>Speed: <span>2m/s</span></li>
								<li>Payload from: <span>6 to 40kg</span></li>
								<li>Parcel type: <span>Totes, E-commerce parcels, Cartons</span></li>
							</ul>
						</div>
					</div>
					<div class="popProForm">
						<form class="">
							<div class="fielsWrap fullWidth">
								<input type="text" placeholder="Full Name*" class="form-control" />
							</div>
							<div class="fielsWrap fullWidth">
								<input type="text" placeholder="Email Id*" class="form-control" />
							</div>
							<div class="fielsWrap fullWidth">
								<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
							</div>
							<div class="fielsWrap directon-column fullWidth">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
									<label class="form-check-label" for="flexCheckDefault">I Agree</label>
								</div>
								<p class="term-text">
									<small>Term & Conditions. Privacy Policy. lorem ipsum tupsum oreo mario lorem ipsum tupsum oreo mariolorem ipsum tupsum oreo mario</small>
								</p>
							</div>
							<div class="submitbutton">
								<button type="submit" class="explore">Download <span>&raquo</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>  
	</div>
</div>
<!-- Product Popup end -->
<?php get_footer(); ?>
<script>
	AOS.init({
		easing: "ease-out-back",
		duration: 1000,
		disable: "mobile",
	});
	$(".product_carousel").owlCarousel({
		loop: true,
		autoplay: false,
		nav: false,
		margin: 1,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			990: {
				items: 1
			},
			1200: {
				items: 1
			},
		},
	});		
	
	$(".cs_carousel").owlCarousel({
		loop: false,
		autoplay: false,
		nav: false,
		margin: 20,
		smartSpeed: 1000,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			990: {
				items: 1
			},
			1200: {
				items: 1
			},
		},
	});	
	
	$(".productCarousel").owlCarousel({
		loop: false,
		autoplay: false,
		nav: false,
		margin: 30,
		smartSpeed: 500,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2,
				margin: 0, 
			},
			990: {
				items: 3,
				margin: 0, 
			},
			1200: {
				items: 4
			},
		},
	});	
	
	$(".otherIndCarousel").owlCarousel({
		loop: false,
		autoplay: false,
		nav: false,
		margin: 10,
		smartSpeed: 500,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			990: {
				items: 3
			},
			1200: {
				items: 4
			},
		},
	});		
</script>

<script>
	$("select").each(function () {
        var $this = $(this),
		numberOfOptions = $(this).children("option").length;

        $this.addClass("select-hidden");
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next("div.select-styled");
        $styledSelect.text($this.children("option").eq(0).text());

        var $list = $("<ul />", {
			class: "select-options",
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
			$("<li />", {
				text: $this.children("option").eq(i).text(),
				rel: $this.children("option").eq(i).val(),
			}).appendTo($list);
        }
        var $listItems = $list.children("li");
        $styledSelect.click(function (e) {
			e.stopPropagation();
			$("div.select-styled.active")
            .not(this)
            .each(function () {
				$(this).removeClass("active").next("ul.select-options").hide();
            });
			$(this).toggleClass("active").next("ul.select-options").toggle();
        });

        $listItems.click(function (e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass("active");
			$this.val($(this).attr("rel"));
			$list.hide();
        });
		$(document).click(function () {
			$styledSelect.removeClass("active");
			$list.hide();
        });
	});
</script>