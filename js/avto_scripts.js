			jQuery(document).ready(function(){
            jQuery('#btn_submit').click(function(e){
                // собираем данные с формы
                var b1    = jQuery('#b1').val();
                var s1   = jQuery('#s1').val();
                 var b2    = jQuery('#b2').val();
                var s2   = jQuery('#s2').val();
                 var b3    = jQuery('#b3').val();
                var s3   = jQuery('#s3').val();
                 var b4    = jQuery('#b4').val();
                var s4   = jQuery('#s4').val();
                 var b5    = jQuery('#b5').val();
                var s5   = jQuery('#s5').val();
                 var b6    = jQuery('#b6').val();
                var s6   = jQuery('#s6').val();
                 var b7    = jQuery('#b7').val();
                var s7   = jQuery('#s7').val();
                 var b8    = jQuery('#b8').val();
                var s8   = jQuery('#s8').val();
                 var b9    = jQuery('#b9').val();
                var s9   = jQuery('#s9').val();
                 var b10    = jQuery('#b10').val();
                var s10   = jQuery('#s10').val();
                 var b11    = jQuery('#b11').val();
                var s11   = jQuery('#s11').val();
                 var b12    = jQuery('#b12').val();
                var s12   = jQuery('#s12').val();
                // отправляем данные
                jQuery.ajax({
                    url: "/wp-admin/admin-ajax.php", // куда отправляем
                    type: "post", // метод передачи
                    data: { // что отправляем
                        "b1":    b1,
                        "s1":   s1,
                        "b2":    b2,
                        "s2":   s2,
                        "b3":    b3,
                        "s3":   s3,
                        "b4":    b4,
                        "s4":   s4,
                        "b5":    b5,
                        "s5":   s5,
                        "b6":    b6,
                        "s6":   s6,
                        "b7":    b7,
                        "s7":   s7,
                        "b8":    b8,
                        "s8":   s8,
                        "b9":    b9,
                        "s9":   s9,
                        "b10":    b10,
                        "s10":   s10,
                        "b11":    b11,
                        "s11":   s11,
                        "b12":    b12,
                        "s12":   s12,
                        action: 'eco_bonus'
                    },
                    // после получения ответа сервера
                    	success: function(res){
                        jQuery('.messages').html(res);
                        console.log(res);
                    }
                });
                e.preventDefault();
            });
		});
		
		
		jQuery(document).ready(function(){
            jQuery('#btn_submit2').click(function(e){
                // собираем данные с формы
                var id_nomer  = jQuery('#id_nomer').val();
                var bonus_nomer   = jQuery('#bonus_nomer').val();                
                // отправляем данные
                jQuery.ajax({
                    url: "/wp-admin/admin-ajax.php", // куда отправляем
                    type: "post", // метод передачи
                    data: { // что отправляем
                        "id_nomer":  id_nomer,
                        "bonus_nomer":  bonus_nomer,                        
                        action: 'update_bonus'
                    },
                    // после получения ответа сервера
                    	success: function(res){
                        jQuery('.messages').html(res);
                        console.log(res);
                    }
                });
                e.preventDefault();
            });
		});
		
		
	jQuery(document).ready(function(){
            jQuery('.avto-pop-close').click(function(){
				jQuery('#avto-widgets-list').toggleClass('show_avto');
				jQuery('.desctop_hide').toggleClass('show_avto');             
				return false;
            });
	});	

	jQuery(document).ready(function(){
            jQuery('.avto-add-btn').click(function(){
				jQuery('#avto-widgets-list').toggleClass('show_avto');
				jQuery('.desctop_hide').toggleClass('show_avto');
				return false;             
            });
	});	
	
	/*Удаляем запись скидки*/
	jQuery(document).ready(function(){
            jQuery('.avto_offer_delete').click(function(e){
                // собираем данные с формы
                var id = jQuery(this).parent().parent('.line_data_id').data('id');
                alert('Запись удалена.');              
                // отправляем данные
                jQuery.ajax({
                    url: "/wp-admin/admin-ajax.php", // куда отправляем
                    type: "post", // метод передачи
                    data: { // что отправляем
                        "id":  id,                       
                        action: 'avto_offer_delete'
                    },
                    // после получения ответа сервера
                    	success: function(res){
                        jQuery('.messages').html(res);
                        console.log(res);
                         location.reload();
                    }
                });
                e.preventDefault();
            });
		});
	
	/*Новая скидка*/
	jQuery(document).ready(function(){
            jQuery('.new_price_btn').click(function(e){
                // собираем данные с формы
                var name = jQuery('.new_price_name').val();
                var avto_id = jQuery('.new_price_avto').val();
                var data_start = jQuery('.new_price_start_day').val();
                var data_finish = jQuery('.new_price_finish_day').val();
                var days = jQuery('.new_price_days_requred').val();
                var discount = jQuery('.avto_discount_value').val();         
                // отправляем данные
                if (!name || !avto_id || !days || !discount){
					alert('Заполните все поля');
				}else{
					jQuery.ajax({
		                    url: "/wp-admin/admin-ajax.php", // куда отправляем
		                    type: "post", // метод передачи
		                    data: { // что отправляем
		                        "name":  name,
		                        "avto_id":  avto_id,
		                        "data_start":  data_start,
		                        "data_finish":  data_finish,
		                        "days":  days,
		                        "discount":  discount,                      
		                        action: 'new_avtoskidki'
		                    },
		                    // после получения ответа сервера
		                    	success: function(res){
		                        jQuery('.messages').html(res);
		                        console.log(res);
		                         location.reload();
		                    }
               		 });
				}
              
                e.preventDefault();
            });
		});
