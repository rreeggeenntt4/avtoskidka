<?php
/*Функия при установке плагина*/
function avtoskidki_install(){
global $wpdb;    	
	$sql = "CREATE TABLE IF NOT EXISTS avtoskidki (id int auto_increment primary key, avto_id INT NOT NULL, data_start TEXT(100), data_finish TEXT(100), name TEXT(100), discount TEXT(100), days TEXT(100))";
	$wpdb->query($sql);	
	$wpdb->insert('ecobonus',
		array( 'summa' => 0, 'procent' => 0 ),
		array( 'id' => 1 ),
		array( '%d', '%d' ));
}

/*Подключаем стили*/
function avtoskidki_scripts_style(){
	wp_enqueue_style('avtoskidki_style', plugins_url('/css/avtoskidki_style.css', __FILE__) );	
		wp_enqueue_script('avto_scripts', plugins_url('/js/avto_scripts.js',__FILE__),array('jquery'), null, true);
		/*wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
		wp_enqueue_script( 'jquery' );*/
}

/*Удаление плагина автоскидки*/
function avtoskidki_delete(){
	global $wpdb;
	$sql = "DROP TABLE avtoskidki";
	$sql3 = "ALTER TABLE wp_users DROP COLUMN bonus_order, DROP COLUMN bonus_admin, DROP COLUMN bonus";
	$wpdb->query($sql);
}

/*Добавление меню в админскую часть*/
function avtoskidki_add_menu() {
    add_menu_page('Автоскидки', 'Автоскидки', 8, __FILE__, 'avto_toplevel_page');
}

/*Основная страница автоскидки*/
function avto_toplevel_page() {
	global $wpdb;
	$sql = "SELECT * FROM `avtoskidki`";
	$rs = $wpdb->get_results($sql);

    echo '<div class="wrap"><h2>Автоскидки</h2>';    
?>
<div class="theme-wrap fullwidth">
				<div class="outerwrapp-layer">
					<div class="loading_div"> <i class="icon-circle-o-notch icon-spin"></i> <br>
						Saving prices...
					</div>
					<div class="form-msg"> <i class="icon-check-circle-o"></i>
						<div class="innermsg"></div>
					</div>
				</div>
				<div class="row">
					<form name="vehicle-pricing" id="cs-booking-pricing" method="post" data-url="http://skidkiwork.ru/wp-admin/admin-ajax.php">
						<div class="cs-vehicles-prices cs-customers-area">
							<div class="cs-title"><h2>Vehicle Pricing</h2></div>
							<div class="cs-price-tabs">
								<ul>
									<p>Special Offers</p>
								</ul>
								<div class="tabs-content">
										<div id="rum-special-ofrs" class="tab-pane">
											<div class="cs_select_vehicle">
												<div id="cs_offers_add">
													<a class="avto-add-btn" data-type="offers" href="">Add New Offer</a>
												</div>
											</div>
											<div id="cs_offers_cont">
												<div class="cs-price-offers">
													<table class="cs-offers-list">
														<thead>
															<tr>
																<th>Avto ID</th>
																<th>Data start</th>
																<th>Data finish</th>
																<th>Name</th>
																<th>Discount (%)</th>
																<th>Require Days</th>
																<th>&nbsp;</th>
															</tr>
														</thead>
														<tbody id="cs_offers_tr_result">
<?php
if( $rs ) {	
	foreach ( $rs as $ID ) {

?>													
				<tr data-id="<?php echo $ID->id;?>" class="line_data_id">
						<td>
							<span class="plan-range"><?php echo $ID->avto_id;?></span>
						</td>
						<td>
							<span class="plan-range"><?php echo $ID->data_start;?></span>
						</td>
						<td>
							<span class="plan-range"><?php echo $ID->data_finish;?></span>
						</td>
						<td>
							<span class="plan-range"><?php echo $ID->name;?></span>
						</td>
						<td>
							<span class="plan-discount"><?php echo $ID->discount;?></span>
						</td>
						<td>
							<span class="plan-range"><?php echo $ID->days;?></span>
						</td>
						<td>
							<a class="avto_offer_delete"><i class="icon-trash4"></i></a>
						</td>
					</tr>
<?php
						}
}
?>
														</tbody>
													</table>
													<div class="footer footerbg">
													
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</form>
				</div>
		

<!--Всплывающая форма-->
<div class="desctop_hide"></div>
<div id="avto-widgets-list" class="wide-width">
	<div id="avto_offers_popup" style="">
					<div class="avto-popup-header">
						<h2 style="text-align: center;">New Offer</h2>
						<span class="avto-pop-close" onclick=""> <i class="icon-times"></i></span>
					</div>
					<div class="avto-popup-content">
						<div id="message" class="wp-custom-messages cs-offer-message notice notice-error" style="display:none;">
							<p></p>
						</div>
											
						<label>
							<span>Offer Name</span>
							<input class="new_price_name" type="text">
						</label>
						<label class="cs_select">
							<span>Select Vehicle</span>
							<select class="new_price_avto">
							<option value="">Выберите автомобиль</option>
							
<?php
	$sql = "SELECT * FROM `wpqm_posts` WHERE `post_type`='vehicles'";
	$arr_vehicles = $wpdb->get_results($sql);
	
	if( $arr_vehicles ) {	
	foreach ( $arr_vehicles as $ID2 ) {
		echo'<option value="'.$ID2->ID.'">';
		_e($ID2->post_title,'ru');
		echo '</option>';
		}
	}
	
							
?>
	
							</select>
						</label>
						<div class="strt-day" id="date_range_new2">
							<label>
								<span>Starts From</span>
								<input class="new_price_start_day" type="text">
							</label>
							<label>
								<span>Valid Then</span>
								<input class="new_price_finish_day" type="text">
							</label>
						</div>
						<label>
							<span>Require Days</span>
							<input class="new_price_days_requred" type="text">
						</label>
						<div class="avto_discount"><small>%</small><input type="text" class="avto_discount_value"></div>
						<div style="clear: both;"></div>
							<a class="new_price_btn" type="button">Add Offer</a>
				<!--<div id="add_offers_to_btn"></div>-->
		</div>
	</div>
</div>
<!--Завершилась всплывающая форма-->




</div>
<?php                
}

/*Новая скидка*/
function new_avtoskidki(){
	global $wpdb;
	
		$name = $_POST['name'];
		$avto_id = $_POST['avto_id'];
		$data_start = $_POST['data_start'];
		$data_finish = $_POST['data_finish'];
		$days = $_POST['days'];
		$discount = $_POST['discount'];
		
	if( isset($name) && isset($avto_id) && isset($data_start) && isset($data_finish) && isset($days) && isset($discount))
	{				
		$wpdb->insert('avtoskidki',array( 'avto_id' => $avto_id, 'data_start' => $data_start, 'data_finish' => $data_finish, 'name' => $name, 'discount' => $discount, 'days' => $days),array( '%d','%s','%s','%s','%s','%d' ));
		$wpdb->get_results($sql);		
	}
	wp_die('Запрос завершен, изменения будут видны после перезагрузки страницы!');	
}

/*Удаление скидки*/
function avto_offer_delete(){
	global $wpdb;
	if( isset($_POST['id']))
	{
		$id = $_POST['id'];
		$sql = "DELETE FROM `avtoskidki` WHERE `id`='".$id."'";
		$wpdb->get_results($sql);		
	}
	wp_die('Запрос завершен, изменения будут видны после перезагрузки страницы!');	
}

?>