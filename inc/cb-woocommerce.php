<?php

/* Salesforce/Pardot tracking code */
add_action('wp_footer', 'pardot_tracking_func');
function pardot_tracking_func(){
?>
<script type="text/javascript">
var iframe = document.getElementById('myiframe');
iframe.src = iframe.src + window.location.search;
</script>
<script type="text/javascript">
piAId = '831213';
piCId = '99719';
</script>
<script type="text/javascript" src="https://pi.pardot.com/pd.js"></script>
<script>
    /*
piHostname = 'pi.pardot.com';
 
(function() {
    function async_load(){
        var s = document.createElement('script'); s.type = 'text/javascript';
        s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
        var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
    }
    if(window.attachEvent) {
        window.attachEvent('onload', async_load);
    }
    else {
        window.addEventListener('load', async_load, false);
    }
})();
    */
</script>
<?php
};


//add_action('fl_body_open', 'custom_total_cart_items_count');
function custom_total_cart_items_count() {
    // Below your category term ids, slugs or names to be excluded
    $excluded_terms = array('accessories'); 

    $items_count    = 0; // Initializing

    // Loop through cart items 
    foreach ( WC()->cart->get_cart() as $item ) {
        // Excluding some product category from the count
        if ( ! has_term( $excluded_terms, 'product_cat', $item['product_id'] ) ) {
            $items_count += $item['quantity'];
        }
    }
    return $items_count;
}

// Check cart items conditionally displaying an error notice and avoiding checkout
add_action( 'woocommerce_check_cart_items', 'check_cart_items_conditionally' );
function check_cart_items_conditionally() {
    $multiple_of = 9; // <= Here set the "multiple of" number
    $cart_total_sans_accessories = custom_total_cart_items_count();

    if ( ( $cart_total_sans_accessories > $multiple_of ) != 0 ) {
        wc_add_notice( sprintf( __('To buy more than ' . $multiple_of . ' products, please <a href="https://peoplesafe.co.uk/contact-us/">contact us</a>.', 'woocommerce'), $multiple_of ), 'error' );
    }

    if ( is_checkout() && ( $cart_total_sans_accessories > $multiple_of ) != 0 ) {
        wp_redirect( wc_get_cart_url() );
        exit();
    }
}

add_filter( 'woocommerce_add_to_cart_validation', 'check_cart_items_conditionally_add', 10, 5 );
function check_cart_items_conditionally_add( $passed_validation, $product_id, $quantity ){
    $multiple_of = 9; // <= Here set the "multiple of" number
    $cart_total_sans_accessories = custom_total_cart_items_count();

    if ( ( ($cart_total_sans_accessories + $quantity) > ( $multiple_of) ) != 0 ) {
        wc_add_notice( sprintf( __('To buy more than ' . $multiple_of . ' products, please <a href="https://peoplesafe.co.uk/contact-us/">contact us</a>.', 'woocommerce'), $multiple_of ), 'error' );
        $passed = false;
    } else {
        $passed = true;
    }
    return $passed;
}

// Billing email validation check error message
add_action( 'woocommerce_checkout_process', 'billing_email_validation_check' );
function billing_email_validation_check() {
    $email = $_POST['billing_email'];
    if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        // split on @ and return last value of array (the domain)
        $domain = array_pop(explode('@', $email));

        $allowed_domains = array();
        //ignored_email_domains
        if( have_rows('ignored_email_domains', 'option') ):
            while( have_rows('ignored_email_domains', 'option') ) : the_row();
                $domain_add = get_sub_field('domain');
                array_push($allowed_domains, $domain_add);
            endwhile;
        endif;
        //$allowed_domains = array("gmail.com", "outlook.com", "yahoo.com", "hotmail.com", "hotmail.co.uk", "aol.com");

        if ( !in_array($domain, $allowed_domains) ) {
            require __DIR__ . '/../salesforce/another/vendor/autoload.php';

            $password = get_field('sf_password', 'options');
            $secret = get_field('sf_secret', 'options');

            $options = [
                'grant_type' => 'password',
                //'grant_type'=> 'client_credentials',
                'client_id' => get_field('sf_client_id', 'options'),
                'client_secret' => get_field('sf_client_secret', 'options'),
                'username' => 'peoplesafe@chillibyte.co.uk',
                'password' => $password . $secret
            ];

            $salesforce = new bjsmasth\Salesforce\Authentication\PasswordAuthentication($options);
            $salesforce->setEndpoint('https://login.salesforce.com/');
            //$salesforce->setEndpoint('https://peoplesafe--staging.sandbox.lightning.force.com/');
            $salesforce->authenticate();

            $access_token = $salesforce->getAccessToken();
            $instance_url = $salesforce->getInstanceUrl();

            $query = "SELECT Name, Email FROM Contact WHERE Email LIKE '%" . $domain . "' LIMIT 1";

            $crud = new \bjsmasth\Salesforce\CRUD();
            $testing = $crud->query($query);

            if ( count($testing['records']) > 0 ) {
                wc_add_notice( __( 'Your company already has an account with us. Please <a href="mailto:checkout.support@peoplesafe.co.uk?subject=Support%20at%20Online%20Shop%20Checkout">contact us</a> to place your order.', 'woocommerce' ), 'error' );
            }
        }
    }
}

//add_action( 'woocommerce_thankyou', 'add_custom_content_to_thankyou', 10, 1 );
add_action( 'woocommerce_payment_complete', 'update_pardot_on_order_created', 10, 2 );
function update_pardot_on_order_created( $order_id, $data ) {
// Get an instance of the WC_Order object (same as before)
    $total_sans_recurring = 0;
    $order_details = "";

    $order = wc_get_order( $order_id );
    $data = $order->get_data(); // order data
    $email = $data['billing']['email'];
    $first_name = $data['billing']['first_name'];
    $last_name = $data['billing']['last_name'];
    $company = $data['billing']['company'];
    $country = $data['billing']['country'];
    $address_1 = $data['billing']['address_1'];
    $address_2 = $data['billing']['address_2'];
    $street = $address_1 . ", " . $address_2;
    $town = $data['billing']['city'];
    $county = $data['billing']['state'];
    $postcode = $data['billing']['postcode'];

    $utm_campaign = get_post_meta( $order_id, 'utm_campaign', true );
    $utm_medium = get_post_meta( $order_id, 'utm_medium', true );
    $utm_source = get_post_meta( $order_id, 'utm_source', true );

    $shipping_address_1 = $data['shipping']['address_1'];
    $shipping_address_2 = $data['shipping']['address_2'];
    $shipping_street = $shipping_address_1 . ", " . $shipping_address_2;
    $shipping_town = $data['shipping']['city'];
    $shipping_county = $data['shipping']['state'];
    $shipping_postcode = $data['shipping']['postcode'];
    $shipping_ship_to = get_post_meta( $order_id, '_shipping_wooccm9', true );

    $phone = $data['billing']['phone'];
    $bacs_reference = get_field("bacs_reference", $order_id);
    $customer_id = get_field("customer_id", $order_id);
    $Customer_Registration_Number = get_post_meta( $order_id, '_billing_wooccm11', true );
    $phone = preg_replace("/[^0-9]/", "", $phone );

    //Order Details Begins
    // Get an instance of the WC_Order object (same as before)
    $total_sans_recurring = 0;
    $order_details = "";

    // Get an instance of the WC_Order object
    $order_data = $order->get_data(); // The Order data

    $order_id = $order_data['id'];
    $order_parent_id = $order_data['parent_id'];
    $order_status = $order_data['status'];
    $order_currency = $order_data['currency'];
    $order_version = $order_data['version'];
    $order_payment_method = $order_data['payment_method'];
    $order_payment_method_title = $order_data['payment_method_title'];
    $order_payment_method = $order_data['payment_method'];
    $order_payment_method = $order_data['payment_method'];

    ## Creation and modified WC_DateTime Object date string ##

    // Using a formated date ( with php date() function as method)
    $order_date_created = $order_data['date_created']->date('Y-m-d H:i:s');
    $order_date_modified = $order_data['date_modified']->date('Y-m-d H:i:s');

    // Using a timestamp ( with php getTimestamp() function as method)
    $order_timestamp_created = $order_data['date_created']->getTimestamp();
    $order_timestamp_modified = $order_data['date_modified']->getTimestamp();

    $order_discount_total = $order_data['discount_total'];
    $order_discount_tax = $order_data['discount_tax'];
    $order_shipping_total = $order_data['shipping_total'];
    $order_shipping_tax = $order_data['shipping_tax'];
    $order_total = $order_data['total'];
    $order_total_tax = $order_data['total_tax'];
    $order_customer_id = $order_data['customer_id']; // ... and so on

    $order_fee_data = $order->get_meta('_wcpfc_fee_summary');

    ## BILLING INFORMATION:

    $order_details .= "Contract Length: 12 Months \r\n\r\n";
    $order_details .= "Recurrence: Monthly \r\n\r\n";
    $order_details .= "Products: \r\n";
    $delivery_count = 1;

    // Iterating through each WC_Order_Item_Product objects
    foreach ($order->get_items() as $item_key => $item ):

        ## Using WC_Order_Item methods ##

        // Item ID is directly accessible from the $item_key in the foreach loop or
        $item_id = $item->get_id();

        ## Using WC_Order_Item_Product methods ##
        $product      = $item->get_product(); // Get the WC_Product object

        $product_id   = $item->get_product_id(); // the Product id
        $variation_id = $item->get_variation_id(); // the Variation id

        $item_type    = $item->get_type(); // Type of the order item ("line_item")

        $item_name    = $item->get_name(); // Name of the product
        $quantity     = $item->get_quantity();  
        $tax_class    = $item->get_tax_class();
        $line_subtotal     = $item->get_subtotal(); // Line subtotal (non discounted)
        $line_subtotal_tax = $item->get_subtotal_tax(); // Line subtotal tax (non discounted)
        $line_total        = $item->get_total(); // Line total (discounted)
        $line_total_tax    = $item->get_total_tax(); // Line total tax (discounted)

         ## Access Order Items data properties (in an array of values) ##
        $item_data    = $item->get_data();

        $product_name = $item_data['name'];
        $product_id   = $item_data['product_id'];
        $variation_id = $item_data['variation_id'];
        $quantity     = $item_data['quantity'];
        $tax_class    = $item_data['tax_class'];
        $line_subtotal     = $item_data['subtotal'];
        $line_subtotal_tax = $item_data['subtotal_tax'];
        $line_total        = $item_data['total'];
        $line_total_tax    = $item_data['total_tax'];

        //$line_total_discounted = round($line_total / $quantity, 2);
        $line_total_discounted = number_format((float)$line_total / $quantity, 2, '.', '');

        // Get data from The WC_product object using methods (examples)
        $product        = $item->get_product(); // Get the WC_Product object

        $product_type   = $product->get_type();
        $product_sku    = $product->get_sku();
        $product_price  = $product->get_price();
        $stock_quantity = $product->get_stock_quantity();

        $total_sans_recurring = $total_sans_recurring + $line_total;
        if ( $product_id == 7117 ) {
        //MySOS Premium/Standard
            if ( $variation_id == 7120 ) {
                //MySOS Premium
                $key_1_value = get_post_meta( 7194, 'fee_settings_product_cost', true );
                $order_details .= "- " . $product_name . " subscription (" . $product_sku . ") - Quantity " . $quantity . " - Price per sub £" . $key_1_value . " a month \r\n";
                if ( $product_price != $line_total_discounted ) {
                    $order_details .= "***- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
                } else {
                    $order_details .= "- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
                }
                $order_details .= "- " . $product_name . " - Tracking (Service_002) - Quantity " . $quantity . " - Price per unit/sub £0\r\n";
                $order_details .= "- " . $product_name . " - Fall Detection (Service_001) - Quantity " . $quantity . " - Price per unit/sub £0\r\n";
                $order_details .= "- " . $product_name . " - Clip Holster (MYSOS_011) - Quantity " . $quantity . " - Price per unit/sub £0\r\n";
            } else {
                //MySOS Standard
                $key_1_value = get_post_meta( 7122, 'fee_settings_product_cost', true );
                $order_details .= "- " . $product_name . " subscription (" . $product_sku . ") - Quantity " . $quantity . " - Price per sub £" . $key_1_value . " a month \r\n";
                if ( $product_price != $line_total_discounted ) {
                    $order_details .= "***- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
                } else {
                    $order_details .= "- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
                }
                $order_details .= "- " . $product_name . " - Tracking (Service_002) - Quantity " . $quantity . " - Price per unit/sub £0\r\n";
            }
        } elseif ( $product_id == 7115 ) {
            //MySOS ID Badge
            $key_1_value = get_post_meta( 7121, 'fee_settings_product_cost', true );
            $order_details .= "- " . $product_name . " subscription (" . $product_sku . ") - Quantity " . $quantity . " - Price per sub £" . $key_1_value . " a month \r\n";
            if ( $product_price != $line_total_discounted ) {
                $order_details .= "***- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
            } else {
                $order_details .= "- " . $product_name . " device (" . $product_sku . ") - Quantity " . $quantity . " - Price per device £" . $line_total_discounted . "\r\n";
            }
            $order_details .= "- " . $product_name . " - Tracking (Service_002) - Quantity " . $quantity . " - Price per unit/sub £0\r\n";

        } elseif ( $product_id == 7113 ) {
            //PS Pro App
            $key_1_value = get_post_meta( 7123, 'fee_settings_product_cost', true );
            $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
            $order_details .= "- " . $product_name . " subscription (" . $product_sku . ") - Quantity " . $quantity . " - Price per sub £" . $key_1_value . " a month \r\n";
            if ( $product_price != $line_total_discounted ) {
                $order_details .= "***- " . $product_name . " Connection fee (App_Connection_Fee_001) - Quantity " . $quantity . " - Price per connection £" . $line_total_discounted . "\r\n";
            } else {
                $order_details .= "- " . $product_name . " - Connection fee (App_Connection_Fee_001) - Quantity " . $quantity . " - Price per connection £" . $connection_fee . "\r\n";
            }
            $order_details .= "- " . $product_name . " - Welfare Checks (Service_006) - Quantity " . $quantity . " - Price per sub £0\r\n";
        } elseif ( $product_id == 7111 ) {
            //Peoplesafe SOS App
            $key_1_value = get_post_meta( 7124, 'fee_settings_product_cost', true );
            $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
            $order_details .= "- " . $product_name . " subscription (" . $product_sku . ") - Quantity " . $quantity . " - Price per sub £" . $key_1_value . " a month \r\n";
            if ( $product_price != $line_total_discounted ) {
                $order_details .= "***- " . $product_name . " Connection fee (App_Connection_Fee_001) - Quantity " . $quantity . " - Price per connection £" . $line_total_discounted . "\r\n";
            } else {
                $order_details .= "- " . $product_name . " - Connection fee (App_Connection_Fee_001) - Quantity " . $quantity . " - Price per connection £" . $connection_fee . "\r\n";
            }
        } else {
            if ( $product_price != $line_total_discounted ) {
                $order_details .= "***- " . $product_name . " (" . $product_sku . ") - Quantity " . $quantity . " - Price per unit/sub £" . $line_total_discounted . "\r\n";
            } else {
                $order_details .= "- " . $product_name . " (" . $product_sku . ") - Quantity " . $quantity . " - Price per unit/sub £" . $product_price . "\r\n";
            }
        }

        if ( ($order_shipping_total > 0) && ($product_id != 7113 && $product_id != 7111) ) {
            if ( $delivery_count == 1 ) {
                $order_details .= "- " . $product_name . " - Delivery Fee (Deliver_001) - Quantity 1 - Price £" . $order_shipping_total . " \r\n";
                $delivery_count = 0;
            } else {
                $order_details .= "- " . $product_name . " - Delivery Fee (Deliver_001) - Quantity 1 - Price £0\r\n";
            }
        }
        
        $order_details .= "\r\n";

    endforeach;

    $key = array_search('connection-fee', array_column($order_fee_data, 'id'));
    if ($key) {
        //Add Connection Fee to the One Off Cost
        $total_sans_recurring = $total_sans_recurring + $order_fee_data[$key]->total;
        //$order_details .= "- Connection Fee(s): £" . $order_fee_data[$key]->total . " \r\n";
    }
    //$order_details .= "\r\n";
    //$order_details .= "- One-off upfront cost: £" . $total_sans_recurring . " \r\n";
    //Order Details Ends

    $src = "https://safe.peoplesafe.co.uk/l/830213/2023-05-18/2fk781?";
    $src .= "first_name=" . urlencode($first_name);
    $src .= "&last_name=" . urlencode($last_name);
    $src .= "&company=" . urlencode($company);
    $src .= "&country=" . urlencode($country);
    $src .= "&street=" . urlencode($street);
    $src .= "&town=" . urlencode($town);
    $src .= "&county=" . urlencode($county);
    $src .= "&postcode=" . urlencode($postcode);
    $src .= "&phone=" . urlencode($phone);
    $src .= "&email_address=" . urlencode($email);
    $src .= "&order_id=" . urlencode($order_id);
    $src .= "&bacs_reference=" . urlencode($bacs_reference);
    $src .= "&customer_id=" . urlencode($customer_id);
    $src .= "&order_details=" . urlencode($order_details);
    $src .= "&Customer_Registration_Number=" . urlencode($Customer_Registration_Number);
    $src .= "&shipping_street=" . urlencode($shipping_street);
    //$src .= "&shipping_address_2=" . urlencode($shipping_address_2);
    $src .= "&shipping_city=" . urlencode($shipping_town);
    $src .= "&shipping_county=" . urlencode($shipping_county);
    $src .= "&shipping_postcode=" . urlencode($shipping_postcode);
    $src .= "&shipping_name=" . urlencode($shipping_ship_to);
    $src .= "&utm_source=" . urlencode($utm_source);
    $src .= "&utm_campaign=" . urlencode($utm_campaign);
    $src .= "&utm_medium=" . urlencode($utm_medium);

    $order_id = $order->get_id();
    $pardotpixel = get_post_meta($order_id, 'pardotpixel-'.$order->get_order_number(),true);
    if ( ( empty( $pardotpixel ) ) ) :
        update_post_meta($order_id, 'pardotpixel-'.$order->get_order_number(),1);
        //echo '<iframe src="' . $src . '" class="d-none"></iframe>'; // Just for testing
        $data = wp_remote_post( $src );
    endif;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {
    $tax_query = (array) $q->get( 'tax_query' );
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'accessories' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );
    $q->set( 'tax_query', $tax_query );
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );

add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
    return false;
}

//add_filter( 'woocommerce_shipping_fields', 'chillibyte_add_field' );
function chillibyte_add_field( $fields ) {
    $fields[ 'shipping_ship_to' ]   = array(
        'label'        => 'Ship To',
        'required'     => true,
        'class'        => array( 'form-row-wide', 'my-custom-class' ),
        'priority'     => 20,
        'placeholder'  => '',
    );
    return $fields;
}

function cw_change_product_price_display( $price ) {
    if ( get_the_ID() == 7117 ) {
        $key_1_value = get_post_meta( 7122, 'fee_settings_product_cost', true );
        $key_1_value_premium = get_post_meta( 7194, 'fee_settings_product_cost', true );
        $price = '<span class="hide_me">Upfront cost: ' . $price;
        $price .= '<br>Monthly cost: £' . $key_1_value . ' - £' . $key_1_value_premium . '</span>';
    } elseif ( get_the_ID() == 7115 ) {
        $key_1_value = get_post_meta( 7121, 'fee_settings_product_cost', true );
        $price = 'Upfront cost: ' . $price;
        $price .= '<br>Monthly cost: £' . $key_1_value;
    } elseif ( get_the_ID() == 7111 ) {
        //Peoplesafe SOS App
        $key_1_value = get_post_meta( 7124, 'fee_settings_product_cost', true );
        $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
        $price = 'Upfront cost: £' . $connection_fee;
        $price .= '<br>Monthly cost: £' . $key_1_value;
    } elseif ( get_the_ID() == 7113 ) {
        //PS Pro App
        $key_1_value = get_post_meta( 7123, 'fee_settings_product_cost', true );
        $connection_fee = get_post_meta( 7125, 'fee_settings_product_cost', true );
        $price = 'Upfront cost: £' . $connection_fee;
        $price .= '<br>Monthly cost: £' . $key_1_value;
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'cw_change_product_price_display' );

function mysos_standard(){
ob_start();
//$variation_price = get_variation_price_by_id(7117, 7119);
$variation_id = '7119';
$variable_product = wc_get_product($variation_id);
$regular_price = $variable_product->get_regular_price();
$sale_price = $variable_product->get_sale_price();


$key_1_value = get_post_meta( 7122, 'fee_settings_product_cost', true );
?>
<div class="woocommerce-variation-price">
    <span class="price">Upfront cost: <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">£</span><?php echo $regular_price; ?></bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">£</span><?php echo $sale_price; ?></bdi></span></ins><br>Monthly cost: £<?php echo $key_1_value; ?></span>
</div>
<?php
return ob_get_clean();

}
add_shortcode('mysos_standard','mysos_standard');

function mysos_premium(){
ob_start();
//$variation_price = get_variation_price_by_id(7117, 7120);
$variation_id = '7120';
$variable_product = wc_get_product($variation_id);
$regular_price = $variable_product->get_regular_price();
$sale_price = $variable_product->get_sale_price();
$key_1_value = get_post_meta( 7194, 'fee_settings_product_cost', true );
?>
<div class="woocommerce-variation-price">
    <span class="price">Upfront cost: <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">£</span><?php echo $regular_price; ?></bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">£</span><?php echo $sale_price; ?></bdi></span></ins><br>Monthly cost: £<?php echo $key_1_value; ?></span>
</div>
<?php
return ob_get_clean();

}
add_shortcode('mysos_premium','mysos_premium');

/**
 * @snippet       Remove Sorting Dropdown @ WooCommerce Shop & Archives
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

/**
 * Remove the order field from checkout.
 */
function devpress_remove_checkout_phone_field( $fields ) {
    unset( $fields['order']['order_comments'] );
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'devpress_remove_checkout_phone_field' );

add_filter( 'gettext', 'ecommercehints_change_ship_address_heading', 999, 3 );
function ecommercehints_change_ship_address_heading( $translated, $untranslated, $domain ) {
if ( ! is_admin() && 'woocommerce' === $domain ) {

      switch ( $translated ) {
         case 'Deliver to a different address?':
            $translated = 'Different shipping address?';
            break;
         case 'Ship to a different address?':
            $translated = 'Different shipping address?';
            break;
      }
   }
   return $translated;
}

// Add a hidden field on the checkout page
add_action('woocommerce_after_order_notes', 'checkout_source_field');

function checkout_source_field( $checkout ) {
    woocommerce_form_field( 'utm_content', array( 
        'type'          => 'hidden',
        'required'      => false,
        ), $checkout->get_value( 'utm_content' ));

    woocommerce_form_field( 'utm_source', array( 
        'type'          => 'hidden',
        'required'      => false,
        ), $checkout->get_value( 'utm_source' ));

    woocommerce_form_field( 'utm_medium', array( 
        'type'          => 'hidden',
        'required'      => false,
        ), $checkout->get_value( 'utm_medium' ));

    woocommerce_form_field( 'utm_campaign', array( 
        'type'          => 'hidden',
        'required'      => false,
        ), $checkout->get_value( 'utm_campaign' ));
}

// Update the order meta with field value
add_action('woocommerce_checkout_update_order_meta', 'checkout_source_field_update_order_meta');
function checkout_source_field_update_order_meta( $order_id ) {
    if ($_POST['utm_content']) update_post_meta( $order_id, 'utm_content', esc_attr($_POST['utm_content']));
    if ($_POST['utm_source']) update_post_meta( $order_id, 'utm_source', esc_attr($_POST['utm_source']));
    if ($_POST['utm_medium']) update_post_meta( $order_id, 'utm_medium', esc_attr($_POST['utm_medium']));
    if ($_POST['utm_campaign']) update_post_meta( $order_id, 'utm_campaign', esc_attr($_POST['utm_campaign']));
}

function shop_get_UTM() {
?>
<script>
function getQueryParam(url, param) {

  var queryString = url.split('?')[1];
  if (!queryString) return null;

  var params = queryString.split('&');
  for (var i = 0; i < params.length; i++) {
    var keyValue = params[i].split('=');
    if (keyValue[0] === param) {
      return decodeURIComponent(keyValue[1]);
    }
  }
  return null;
}

function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function storeUtmParameters() {
  var utmParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'ad_id', 'adset_id', 'campaign_id', 'site_source_name', 'adset_name'];
  var eventData = {};

  for (var i = 0; i < utmParams.length; i++) {
    var paramValue = getQueryParam(window.location.href, utmParams[i]);
    if (paramValue) {
      eventData[utmParams[i]] = paramValue;
    }
  }

  if (Object.keys(eventData).length > 0) {
    setCookie('FbAdUTMCookie', JSON.stringify(eventData), 30); // Store cookie for 30 days
  }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

// Here
storeUtmParameters();

var UTM_Cookie = JSON.parse(getCookie('FbAdUTMCookie'));
document.querySelector("#utm_content").value = UTM_Cookie.utm_content;
document.querySelector("#utm_source").value = UTM_Cookie.utm_source;
document.querySelector("#utm_medium").value = UTM_Cookie.utm_medium;
document.querySelector("#utm_campaign").value = UTM_Cookie.utm_campaign;
</script>
<?php
}
add_action('wp_footer', 'shop_get_UTM');

add_filter('gettext', 
           
           function ($translated_text, $text, $domain) {

            if ($domain == 'woocommerce') {
                switch ($translated_text) {
                    case 'Cart totals':
                        $translated_text = __('Order summary', 'woocommerce');
                        break;
                    case 'Update cart':
                        $translated_text = __('Update basket', 'woocommerce');
                        break;
                    case 'Add to cart':
                        $translated_text = __('Add to basket', 'woocommerce');
                        break;
                    case 'View cart':
                        $translated_text = __('View basket', 'woocommerce');
                        break;
                    case 'Cart updated':
                        $translated_text = __('Basket updated', 'woocommerce');
                        break;
                    case 'Your cart is currently empty':
                        $translated_text = __('Your basket is currently empty', 'woocommerce');
                        break;
                }
            }

            return $translated_text;

        }, 
20, 3);

function error_report_log_customize(){
    // error_reporting(E_ALL);
    // error_reporting(E_NOTICE);
    // error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);

    // helpful tool https://maximivanov.github.io/php-error-reporting-calculator/
}
add_action('init','error_report_log_customize');

/**
 * Renders a notice and prevents checkout if the cart
 * only contains products in a specific category
 */
function sv_wc_prevent_checkout_for_category() {
    
    // set the slug of the category for which we disallow checkout
    $category = 'accessories';
    
    // get the product category
    $product_cat = get_term_by( 'slug', $category, 'product_cat' );
    
    // sanity check to prevent fatals if the term doesn't exist
    if ( is_wp_error( $product_cat ) ) {
        return;
    }
    
    $category_name = 'Accessories';
    
    // check if this category is the only thing in the cart
    if ( sv_wc_is_category_alone_in_cart( $category ) ) {
        
        // render a notice to explain why checkout is blocked
        if ( WC()->cart->get_cart_contents_count() > 0 ) {
            wc_add_notice( 'There is an error processing your order as you cannot order an accessory without a device. Please <a href="https://peoplesafe.co.uk/contact-us/">contact us</a> if you would like to additionally order an accessory.', 'error' );
        }
    }
}
add_action( 'woocommerce_check_cart_items', 'sv_wc_prevent_checkout_for_category' );


/**
 * Checks if a cart contains exclusively products in a given category
 * 
 * @param string $category the slug of the product category
 * @return bool - true if the cart only contains the given category
 */
function sv_wc_is_category_alone_in_cart( $category ) {
        
    // check each cart item for our category
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        
        // if a product is not in our category, bail out since we know the category is not alone
        if ( ! has_term( $category, 'product_cat', $cart_item['data']->id ) ) {
            return false;
        }
    }
        
    // if we're here, all items in the cart are in our category
    return true;
}



add_shortcode( 'subscribe_banner', 'subscribe_banner' );
function subscribe_banner() {
    ob_start();
?>
<style>
.news_bg_gradient { 
    background: linear-gradient(to right,  #308da1 0%,#2c91a1 11%,#2d93a3 11%,#2a93a1 13%,#2c94a3 15%,#2a93a1 15%,#2b95a3 15%,#2994a1 16%,#2b95a3 17%,#2994a1 17%,#2a97a3 18%,#2895a2 20%,#2999a3 24%,#2698a2 25%,#269ba4 29%,#239aa3 29%,#269ca4 29%,#239aa3 30%,#269da4 31%,#239ba3 32%,#269da4 32%,#239ca3 32%,#249ea4 34%,#229ca3 34%,#219fa5 37%,#229ea3 38%,#23a0a5 39%,#209fa3 40%,#20a2a5 46%,#1da2a4 46%,#1da2a4 47%,#1ea6a6 51%,#1ba4a4 52%,#1ca7a6 53%,#1ba5a4 54%,#1ca7a6 54%,#19a5a4 54%,#1ca7a6 55%,#19a6a5 57%,#1aa9a6 59%,#17a8a5 59%,#18aba7 64%,#17aaa5 64%,#18aca7 64%,#14ada6 70%,#16afa7 71%,#12aea6 71%,#16afa7 72%,#12aea6 72%,#14b0a8 75%,#12afa6 76%,#14b0a8 77%,#12afa6 77%,#10b1a6 80%,#11b3a8 80%,#10b0a7 80%,#11b3a8 80%,#10b1a6 80%,#11b3a8 81%,#0fb2a7 82%,#11b4a9 83%,#0fb4a7 83%,#11b4a9 83%,#0fb4a7 84%,#0eb5a7 85%,#10b6a8 86%,#0cb5a7 87%,#0cb5a7 88%,#0eb7a9 88%,#0cb5a7 89%,#0eb7a8 89%,#0bb7a7 91%,#0db8a9 92%,#0bb7a7 93%,#0db9a9 93%,#0ab9a9 95%,#0cbba9 97%,#0abba9 99%,#07baa8 99%,#0abba9 99%,#07baa8 99%,#0abba9 100%,#07bba8 100%,#0abba9 100%,#2cc3b1 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */

}
</style>
        <div class="container p-5 mb-3 news_bg_gradient">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 text-white">
                    <div class="h2">Subscribe to our newsletter</div>
                    <div class="h5 my-4">Receive quarterly emails with the latest Peoplesafe developments including product and technology innovations, upcoming events and industry news and tips.</div>

                    <form target="_blank" method="GET" action="https://peoplesafe.co.uk/newsletter-signup/" style="height: auto; display: inline;">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="NewsletterEmail" class="form-label visually-hidden d-none">Email address</label>
                                <input type="email" class="form-control required mb-2" id="email" name="email" aria-describedby="emailHelp" placeholder="Email address" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary rounded w-100" style="font-weight: 400; min-width: auto;">Sign Up</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                    <img src="/wp-content/themes/cb-peoplesafe2024/img/Newsletter.png" class="img-fluid">
                </div>
            </div>
        </div>
<?php
    $output = ob_get_clean();
    return $output;
}

add_filter( 'gform_field_value_email', 'populate_email_newsletter' );
function populate_email_newsletter( $value ) {
    if ( $_POST['email'] ) {
        return $_POST['email'];
    } else {
        return $_GET['email'];
    }
}

function customize_wc_errors( $error ) {
    if ( strpos( $error, 'Billing ' ) !== false ) {
        $error = str_replace("Billing ", "", $error);
    }
    if ( strpos( $error, 'Company Registration Number' ) !== false ) {
        $error = str_replace("Company Registration Number", "<strong>Company Registration Number</strong>", $error);
    }
    return $error;
}
add_filter( 'woocommerce_add_error', 'customize_wc_errors' );

add_filter( 'wc_google_analytics_send_pageview', '__return_false' );

add_action( 'woocommerce_after_add_to_cart_button', 'ybc_after_add_to_cart_btn' );
function ybc_after_add_to_cart_btn(){
    global $product;
    $category = array( "Accessories" );
    if( is_product() && has_term( $category, 'product_cat', $product->get_id() ) ){
        //Do nothing
    } else {
        if ( $product->get_id() == 7111 || $product->get_id() == 7113 ) {
            echo '<p class="mt-3">Order up to 9 apps online. <a href="/contact-us/">Contact us</a> for 10 or more apps.</p>'; 
        } else {
            echo '<p class="mt-3">Order up to 9 devices online. <a href="/contact-us/">Contact us</a> for 10 or more devices.</p>'; 
        }       
    }
}