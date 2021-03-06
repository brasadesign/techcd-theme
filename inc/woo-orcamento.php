<?php
class Woo_Orcamento{
	public function __construct() {
		add_action('woocommerce_checkout_order_processed',array($this,'order'));
		add_filter('woocommerce_order_button_text',array($this,'change_order_text'));
		add_filter('woocommerce_product_single_add_to_cart_text',array($this,'change_buy_text'));
		add_action('woocommerce_cart_actions',array($this,'change_cart_text'));
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        add_action( 'woocommerce_after_shop_loop_item_title', array($this,'remove_text'), 10 );
        add_action( 'woocommerce_single_product_summary', array($this,'remove_text'), 10 );
        add_filter( 'gettext', array($this,'gettext'), 20, 3 );
        add_filter('woocommerce_shipping_fields', array($this, 'remove_shipping'));
        add_action('admin_init',array($this,'update_options'));
	}
	public function order($id,$posted){
		$url = admin_url() . 'post.php?post='.$id.'&action=edit';
		$message = 'Você recebeu um novo pedido de orçamento: ';
		$message .= $url;
        wp_mail( get_bloginfo('admin_email'), get_bloginfo('admin_email'), $message, $headers );
    }
    public function change_order_text($text){
    	return __('Finalizar Orçamento','techcd-theme');
    }
    public function change_buy_text(){
    	return __('Adicionar ao carrinho','techcd-theme');
    }
    public function change_cart_text(){
    	_e('<input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="Finalizar Orçamento">','techcd-theme');
    	return false;
    }
    public function remove_text(){
    	echo '';
    }
    public function gettext($translated_text, $untranslated_text, $domain){
    	$pos = strpos($translated_text, 'foi adicionado com sucesso ao seu carrinho.');
    	if($pos !== false){
    		$translated_text = str_replace('carrinho', 'orçamento', $translated_text);
    	}
    	$pos = strpos($translated_text, 'Atualizar carrinho');
    	if($pos !== false){
    		$translated_text = str_replace('carrinho', 'orçamento', $translated_text);
    	}
    	$pos = strpos($translated_text, 'Crie uma conta preenchendo as informações abaixo. Se você já comprou conosco antes, faça o login no topo da página.');
    	if($pos !== false){
    		$translated_text = 'Crie uma conta preenchendo as informações abaixo. Se você já fez um orçamento conosco antes, faça o login no topo da página.';
    	}
    	$pos = strpos($translated_text, 'Ver carrinho');
    	if($pos !== false){
    		$translated_text = 'Ver Orçamento';
    	}
    	$pos = strpos($translated_text, 'Detalhes da cobrança');
    	if($pos !== false){
    		$translated_text = 'Detalhes do Cadastro';
    	}
    	$pos = strpos($translated_text, 'Seu carrinho está vazio.');
    	if($pos !== false){
    		$translated_text = 'Seu orçamento está vazio.';
    	}
    	$pos = strpos($translated_text, 'Resultados da pesquisa por:');
    	if($pos !== false){
    		$translated_text = str_replace('Resultados da pesquisa por:', 'Resultados para:', $translated_text);
    	}
    	return $translated_text;
    }
    public function remove_shipping($fields){
    	return array();
    }
    public function update_options(){
    	$opts = get_option('woocommerce_new_order_settings');
    	if($opts['enabled'] != 'no'){
    		$opts['enabled'] = 'no';
    		update_option( 'woocommerce_new_order_settings', $opts );
    	}
    	$opts = get_option('woocommerce_customer_processing_order_settings');
    	if($opts['enabled'] != 'no'){
    		$opts['enabled'] = 'no';
    		update_option( 'woocommerce_customer_processing_order_settings', $opts );
    	}
		if(is_admin() && isset($_GET['activated']) && $_GET['activated'] == true){
			$page = get_page_by_path(__('orcamento','techcd-theme'));
			if($page == null){
				$args = array(
					'post_title' => __('Orçamento','techcd-theme'),
					'post_type' => 'page',
				    'post_status' => 'publish',
				    'post_name'   => __('orcamento','techcd-theme'),
				    'post_content' => '[woocommerce_cart]'
					);
				$id = wp_insert_post( $args, false );
				if($id != 0){
					update_option( 'woocommerce_cart_page_id', $id );
				}
			}
			$page = get_page_by_path(__('finalizar-orcamento','techcd-theme'));
			if($page == null){
				$args = array(
					'post_title' => __('Finalizar Orçamento','techcd-theme'),
					'post_type' => 'page',
				    'post_status' => 'publish',
				    'post_name'   => __('finalizar-orcamento','techcd-theme'),
				    'post_content' => '[woocommerce_checkout]'
					);
				$id = wp_insert_post( $args, false );
				if($id != 0){
					update_option( 'woocommerce_checkout_page_id', $id );
				}
			}
			$page = get_page_by_path(__('vitrine','techcd-theme'));
			if($page == null){
				$args = array(
					'post_title' => __('Vitrine','techcd-theme'),
					'post_type' => 'page',
				    'post_status' => 'publish',
				    'post_name'   => __('vitrine','techcd-theme'),
					);
				$id = wp_insert_post( $args, false );
				if($id != 0){
					update_option( 'woocommerce_shop_page_id', $id );
				}
			}
		    $page = get_page_by_title( 'Slider Home', OBJECT, 'brasa_slider_cpt' );
			if($page == null){
				$args = array(
					'post_title' => __('Slider Home','techcd-theme'),
					'post_type' => 'brasa_slider_cpt',
				    'post_status' => 'publish',
				    'post_name'   => __('slider_home','techcd-theme'),
					);
				wp_insert_post( $args, false );
			}
		}
    }
}
new Woo_Orcamento();
?>
