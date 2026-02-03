<?php 

/**
 * Swrice plugins buy now shortcodes
 */

function render_learndash_course_progress_buy_button() {
	ob_start();
	?>
	<select id="licenses">
       <option value="1" selected="selected">Single Site License</option>
       <option value="5">5-Site License</option>
    </select>
    
    <button id="purchase">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        const handler = new FS.Checkout({
            product_id: '16283',
            plan_id: '31422',
            public_key: 'pk_f570659b025f9f10ec3bd7e1ffa1a',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('purchase').addEventListener('click', (e) => {
            e.preventDefault();
            
            handler.open({
                name: 'Learndash Course Progress',
                licenses: document.getElementById('licenses').value,
                purchaseCompleted: (response) => {
                    // The logic here will be executed immediately after the purchase confirmation
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: (response) => {
                    // The logic here will be executed after the customer closes the checkout, 
                    // after a successful purchase
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
	?>
	<select id="licenses">
       <option value="1" selected="selected">Single Site License</option>
       <option value="5">5-Site License</option>
    </select>
    
    <button id="purchase">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        const handler = new FS.Checkout({
            product_id: '21131',
            plan_id: '35260',
            public_key: 'pk_5deac6b2dbfc3abf9a4a69353a522',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('purchase').addEventListener('click', (e) => {
            e.preventDefault();
            
            handler.open({
                name: 'Collapsible Sections for LearnDash',
                licenses: document.getElementById('licenses').value,
                purchaseCompleted: (response) => {
                    // The logic here will be executed immediately after the purchase confirmation
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: (response) => {
                    // The logic here will be executed after the customer closes the checkout, 
                    // after a successful purchase
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
add_shortcode('collapsible_section_for_learndash_buy_button', 'render_collapsible_section_for_learndash_buy_button');

function render_gamipress_ld_trigger_inte() {
	ob_start();
	?>
	<select id="licenses">
       <option value="1" selected="selected">Single Site License</option>
       <option value="5">5-Site License</option>
    </select>
    
    <button id="purchase">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        const handler = new FS.Checkout({
            product_id: '14127',
            plan_id: '31433',
            public_key: 'pk_8bd928ba5bd6a4cc61f733a4f75ee',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('purchase').addEventListener('click', (e) => {
            e.preventDefault();
            
            handler.open({
                name: 'GamiPress Learndash Trigger Integration',
                licenses: document.getElementById('licenses').value,
                purchaseCompleted: (response) => {
                    // The logic here will be executed immediately after the purchase confirmation
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: (response) => {
                    // The logic here will be executed after the customer closes the checkout, 
                    // after a successful purchase
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
add_shortcode('gamipress_ld_trigger_inte', 'render_gamipress_ld_trigger_inte');

function render_reaction_count_for_buddyboss_buy_button() {
	ob_start();
	?>
	<select id="licenses">
       <option value="1" selected="selected">Single Site License</option>
       <option value="unlimited">Unlimited Sites License</option>
    </select>
    
    <button id="purchase">Buy Button</button>
    
    <script type="text/javascript" src="https://checkout.freemius.com/js/v1/"></script>
    <script type="text/javascript">
        const handler = new FS.Checkout({
            product_id: '14176',
            plan_id: '23737',
            public_key: 'pk_ee417a1e27199462f36c5ec408a3d',
            image: 'https://your-plugin-site.com/logo-100x100.png'
        });
        
        document.getElementById('purchase').addEventListener('click', (e) => {
            e.preventDefault();
            
            handler.open({
                name: 'Reactions Count for Buddyboss',
                licenses: document.getElementById('licenses').value,
                purchaseCompleted: (response) => {
                    // The logic here will be executed immediately after the purchase confirmation
                    console.log('Purchase completed:', response);
                    console.log('User email:', response.user.email);
                    console.log('License key:', response.license.key);
                },
                success: (response) => {
                    // The logic here will be executed after the customer closes the checkout, 
                    // after a successful purchase
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
add_shortcode('reaction_count_for_buddyboss_buy_button', 'render_reaction_count_for_buddyboss_buy_button');