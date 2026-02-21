<?php 

/**
 * Swrice plugins buy now shortcodes
 */

function render_freemius_buy_button($atts) {
	ob_start();

	// Default attributes for shortcode
	$atts = shortcode_atts(
		[
			'name'       => 'Plugin Name',    // Checkout name
			'product_id' => '',                // Freemius product_id
			'plan_id'    => '',                // Freemius plan_id
			'public_key' => '',                // Freemius public_key
			'image'      => '',                // Logo
			'prices'     => [],                // License options
		],
		$atts,
		'freemius_buy_button'
	);

	// Generate unique IDs for multiple instances
	$uid = uniqid();
	$licenses_id = 'licenses_' . $uid;
	$purchase_id = 'purchase_' . $uid;
	?>

	<select id="<?php echo esc_attr($licenses_id); ?>" class="freemius-price-dropdown">
		<?php foreach ($atts['prices'] as $value => $label) : ?>
			<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
		<?php endforeach; ?>
	</select>

	<button class="purchase" id="<?php echo esc_attr($purchase_id); ?>">Buy Now</button>

	<script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
	<script type="text/javascript">
		var handler = new FS.Checkout({
			product_id: '<?php echo esc_js($atts['product_id']); ?>',
			plan_id: '<?php echo esc_js($atts['plan_id']); ?>',
			public_key: '<?php echo esc_js($atts['public_key']); ?>',
			image: '<?php echo esc_js($atts['image']); ?>'
		});

		document.getElementById('<?php echo esc_js($purchase_id); ?>').addEventListener('click', function (e) {
			e.preventDefault();

			handler.open({
				name: '<?php echo esc_js($atts['name']); ?>',
				licenses: document.getElementById('<?php echo esc_js($licenses_id); ?>').value,
				purchaseCompleted: function (response) {
					console.log('Purchase completed:', response);
					console.log('User email:', response.user.email);
					console.log('License key:', response.license.key);
				},
				success: function (response) {
					console.log('Checkout closed after successful purchase:', response);
					console.log('User email:', response.user.email);
					console.log('License key:', response.license.key);
				}
			});
		});
	</script>

	<?php
	return ob_get_clean();
}

// 1. Learndash Course Progress
add_shortcode('learndash_course_progress_buy_button', function() {
	return render_freemius_buy_button([
		'name'       => 'Learndash Course Progress',
		'product_id' => '16283',
		'plan_id'    => '31422',
		'public_key' => 'pk_f570659b025f9f10ec3bd7e1ffa1a',
		'image'      => 'https://s3-us-west-2.amazonaws.com/freemius/plugins/16283/icons/334c1BVTrB47erypG3tevi1U9Fv6BbNUBEiuiX.png',
		'prices'     => [
			'1'               => 'Single Site — $30 / Year',
			'5'               => '5 Sites — $60 / Year',
			'single_lifetime' => 'Single Site — $50 (Lifetime)',
			'five_lifetime'   => '5 Sites — $80 (Lifetime)',
		],
	]);
});

// 2. Collapsible Sections for LearnDash
add_shortcode('collapsible_section_for_learndash_buy_button', function() {
	return render_freemius_buy_button([
		'name'       => 'Collapsible Sections for LearnDash',
		'product_id' => '21131',
		'plan_id'    => '35260',
		'public_key' => 'pk_5deac6b2dbfc3abf9a4a69353a522',
		'image'      => 'https://s3-us-west-2.amazonaws.com/freemius/plugins/21131/icons/e8ff66040e86d323b76a1f0810f68b98.png',
		'prices'     => [
			'1'               => 'Single Site — $39 / Year',
			'5'               => '5 Sites — $99 / Year',
			'single_lifetime' => 'Single Site — $99 (Lifetime)',
			'five_lifetime'   => '5 Sites — $199 (Lifetime)',
		],
	]);
});

// 3. GamiPress Learndash Trigger Integration
add_shortcode('gamipress_ld_trigger_inte', function() {
	return render_freemius_buy_button([
		'name'       => 'GamiPress Learndash Trigger Integration',
		'product_id' => '14127',
		'plan_id'    => '31433',
		'public_key' => 'pk_8bd928ba5bd6a4cc61f733a4f75ee',
		'image'      => 'https://swrice.com/wp-content/uploads/2026/02/glti.png',
		'prices'     => [
			'1'               => 'Single Site — $30 / Year',
			'5'               => '5 Sites — $60 / Year',
			'single_lifetime' => 'Single Site — $50 (Lifetime)',
			'five_lifetime'   => '5 Sites — $80 (Lifetime)',
		],
	]);
});

// 4. Reactions Count for BuddyBoss
add_shortcode('reaction_count_for_buddyboss_buy_button', function() {
	return render_freemius_buy_button([
		'name'       => 'Reactions Count for Buddyboss',
		'product_id' => '14176',
		'plan_id'    => '23737',
		'public_key' => 'pk_ee417a1e27199462f36c5ec408a3d',
		'image'      => '',
		'prices'     => [
			'1'               => 'Single Site — $30 / Year',
			'unlimited'       => 'Unlimited Sites — $60 / Year',
			'single_lifetime' => 'Single Site — $40 (Lifetime)',
			'five_lifetime'   => 'Unlimited Sites — $100 (Lifetime)',
		],
	]);
});

/*
function render_learndash_course_progress_buy_button() {
	ob_start();

	$uid = uniqid(); // unique per shortcode
	$licenses_id = 'licenses_' . $uid;
	$purchase_id = 'purchase_' . $uid;
	?>

    <select id="<?php echo esc_attr($licenses_id); ?>" class="freemius-price-dropdown">
        <option value="1" selected>Single Site — $30 / Year</option>
        <option value="5">5 Sites — $60 / Year</option>
        <option value="single_lifetime">Single Site — $50 (Lifetime)</option>
        <option value="five_lifetime">5 Sites — $80 (Lifetime)</option>
    </select>

    <button class="purchase" id="<?php echo esc_attr($purchase_id); ?>">Buy Now</button>

    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        var handler = new FS.Checkout({
            product_id: '16283',
            plan_id: '31422',
            public_key: 'pk_f570659b025f9f10ec3bd7e1ffa1a',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('<?php echo esc_js($purchase_id); ?>').addEventListener('click', (e) => {
            e.preventDefault();
            
            handler.open({
                name: 'Learndash Course Progress',
                licenses: document.getElementById('<?php echo esc_js($licenses_id); ?>').value,
                purchaseCompleted: (response) => {
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: (response) => {
                    console.log('Checkout closed after successful purchase:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                }
            });
        });
    </script>

	<?php
	return ob_get_clean();
}
add_shortcode('learndash_course_progress_buy_button', 'render_learndash_course_progress_buy_button');

function render_collapsible_section_for_learndash_buy_button() {
	ob_start();

	$uid = uniqid();
	$licenses_id = 'licenses_' . $uid;
	$purchase_id = 'purchase_' . $uid;
	?>

	<select id="<?php echo esc_attr($licenses_id); ?>" class="freemius-price-dropdown">
        <option value="1" selected>Single Site — $39 / Year</option>
        <option value="5">5 Sites — $99 / Year</option>
        <option value="single_lifetime">Single Site — $99 (Lifetime)</option>
        <option value="five_lifetime">5 Sites — $199 (Lifetime)</option>
    </select>
    
    <button class="purchase" id="<?php echo esc_attr($purchase_id); ?>">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>

    <script type="text/javascript">
        var handler = new FS.Checkout({
            product_id: '21131',
            plan_id: '35260',
            public_key: 'pk_5deac6b2dbfc3abf9a4a69353a522',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('<?php echo esc_js($purchase_id); ?>').addEventListener('click', function (e) {
            e.preventDefault();
            
            handler.open({
                name: 'Collapsible Sections for LearnDash',
                licenses: document.getElementById('<?php echo esc_js($licenses_id); ?>').value,
                purchaseCompleted: function (response) {
                    console.log('Purchase completed:', response);
                },
                success: function (response) {
                    console.log('Checkout closed after successful purchase:', response);
                }
            });
        });
    </script>

	<?php
	return ob_get_clean();
}
add_shortcode('collapsible_section_for_learndash_buy_button','render_collapsible_section_for_learndash_buy_button');

function render_gamipress_ld_trigger_inte() {
	ob_start();

	$uid = uniqid();
	$licenses_id = 'licenses_' . $uid;
	$purchase_id = 'purchase_' . $uid;
	?>

	<select id="<?php echo esc_attr($licenses_id); ?>" class="freemius-price-dropdown">
        <option value="1" selected>Single Site — $30 / Year</option>
        <option value="5">5 Sites — $60 / Year</option>
        <option value="single_lifetime">Single Site — $50 (Lifetime)</option>
        <option value="five_lifetime">5 Sites — $80 (Lifetime)</option>
    </select>
    
    <button class="purchase" id="<?php echo esc_attr($purchase_id); ?>">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        var handler = new FS.Checkout({
            product_id: '14127',
            plan_id: '31433',
            public_key: 'pk_8bd928ba5bd6a4cc61f733a4f75ee',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('<?php echo esc_js($purchase_id); ?>').addEventListener('click', function (e) {
            e.preventDefault();
            
            handler.open({
                name: 'GamiPress Learndash Trigger Integration',
                licenses: document.getElementById('<?php echo esc_js($licenses_id); ?>').value,
                purchaseCompleted: function (response) {
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: function (response) {
                    console.log('Checkout closed after successful purchase:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                }
            });
        });
    </script>

	<?php
	return ob_get_clean();
}
add_shortcode('gamipress_ld_trigger_inte','render_gamipress_ld_trigger_inte');


function render_reaction_count_for_buddyboss_buy_button() {
	ob_start();

	$uid = uniqid();
	$licenses_id = 'licenses_' . $uid;
	$purchase_id = 'purchase_' . $uid;
	?>

	<select id="<?php echo esc_attr($licenses_id); ?>" class="freemius-price-dropdown">
       <option value="1" selected>Single Site — $30 / Year</option>
       <option value="unlimited">Unlimited Sites $60 / Year</option>
       <option value="single_lifetime">Single Site — $40 (Lifetime)</option>
       <option value="five_lifetime">Unlimited Sites — $100 (Lifetime)</option>
    </select>
    
    <button class="purchase" id="<?php echo esc_attr($purchase_id); ?>">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        var handler = new FS.Checkout({
            product_id: '14176',
            plan_id: '23737',
            public_key: 'pk_ee417a1e27199462f36c5ec408a3d',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('<?php echo esc_js($purchase_id); ?>').addEventListener('click', function (e) {
            e.preventDefault();
            
            handler.open({
                name: 'Reactions Count for Buddyboss',
                licenses: document.getElementById('<?php echo esc_js($licenses_id); ?>').value,
                purchaseCompleted: function (response) {
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: function (response) {
                    console.log('Checkout closed after successful purchase:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                }
            });
        });
    </script>

	<?php
	return ob_get_clean();
}
add_shortcode('reaction_count_for_buddyboss_buy_button','render_reaction_count_for_buddyboss_buy_button'); */