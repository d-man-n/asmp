function noneObj(scp)
    {
    $('#enterNumber'+scp).attr('disabled', false);
    $('#enterNumber'+scp).css('display', '');
    $('#enterNew'+scp).attr('disabled', false);
    $('#enterNew'+scp).css('display', '');
    $('#save'+scp).attr('disabled', true);
    $('#save'+scp).css('display', 'none');
    $('#edit'+scp).attr('disabled', true);
    $('#edit'+scp).css('display', 'none');
    $('#cansel'+scp).attr('disabled', true);
    $('#cansel'+scp).css('display', 'none');
    $('.'+scp).attr('readonly', true);
    $('.'+scp).css('background', '#efefef');
    $('.'+scp).val('');
    }

function noneArticle(scp)
    {
    $('#numberArticle'+scp).attr('disabled', false);
    $('#enterNumberArticle'+scp).attr('disabled', false);
    $('#enterNewArticle'+scp).attr('disabled', false);
    $('#addArticle'+scp).css('display', 'none');
    }

function newEdit(scp)
    {
    $('#enterNumber'+scp).attr('disabled', true);
    $('#enterNumber'+scp).css('display', '');
    $('#enterNew'+scp).attr('disabled', true);
    $('#enterNew'+scp).css('display', '');
    $('#save'+scp).attr('disabled', false);
    $('#save'+scp).css('display', '');
    $('#edit'+scp).attr('disabled', true);
    $('#edit'+scp).css('display', 'none');
    $('#cansel'+scp).attr('disabled', false);
    $('#cansel'+scp).css('display', '');
    $('.'+scp).attr('readonly', false);
    $('.'+scp).css('background', '#ffffff');
    }

function newArticle(scp)
    {
    $('#numberArticle'+scp).attr('disabled', true);
    $('#enterNumberArticle'+scp).attr('disabled', true);
    $('#enterNewArticle'+scp).attr('disabled', true);
    $('#addArticle'+scp).css('display', '');
    }

function saveEdit(scp)
    {
    $('#enterNumber'+scp).attr('disabled', false);
    $('#enterNumber'+scp).css('display', '');
    $('#enterNew'+scp).attr('disabled', false);
    $('#enterNew'+scp).css('display', '');
    $('#save'+scp).attr('disabled', true);
    $('#save'+scp).css('display', 'none');
    $('#edit'+scp).attr('disabled', false);
    $('#edit'+scp).css('display', '');
    $('#cansel'+scp).attr('disabled', true);
    $('#cansel'+scp).css('display', 'none');
    $('.'+scp).attr('readonly', true);
    $('.'+scp).css('background', '#efefef');
    }
    

	$( function() {
//Вкладки
	    $( "#tabs" ).tabs();

//Даты
	    $( "#request_req_date_create" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#request_save').load('/docs/request.php?event=save&field=REQ_DATE_CREATE&value='+encodeURIComponent($('#request_req_date_create').val()));}
		});
            $( "#request_req_date" ).datepicker({
        	dateFormat: "yy-mm-dd",
		onSelect: function(){$('#request_save').load('/docs/request.php?event=save&field=REQ_DATE&value='+encodeURIComponent($('#request_req_date').val()));}
        	});
            $( "#request_date_solution" ).datepicker({
        	dateFormat: "yy-mm-dd",
		onSelect: function(){$('#request_save').load('/docs/request.php?event=save&field=DATE_SOLUTION&value='+encodeURIComponent($('#request_date_solution').val()));}
        	});
	    $( "#request_exp_route_date_end" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#request_save').load('/docs/request.php?event=save&field=EXP_ROUTE_DATE_END&value='+encodeURIComponent($('#request_exp_route_date_end').val()));}
		});
	    $( "#request_exp_route_date_start" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#request_save').load('/docs/request.php?event=save&field=EXP_ROUTE_DATE_START&value='+encodeURIComponent($('#request_exp_route_date_start').val()));}
		});
	    $( "#solution_permited_to" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION&field=PERMITED_TO&value='+encodeURIComponent($('#solution_permited_to').val()));}
		});

	    $( "#solution_permited_from" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION&field=PERMITED_FROM&value='+encodeURIComponent($('#solution_permited_from').val()));}
		});
	    
	    $( "#solution_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION&field=SOLUTION_DATE&value='+encodeURIComponent($('#solution_date').val()));}
		});
	    
//Автозаполнения
            $('#numberCompany').autocomplete({
		minLength: 3,
                delay: 500,
                source: '/docs/company.php?event=ac'
            })

            $('#numberShip').autocomplete({
                minLength: 3,
                delay: 500,
                source: '/docs/ship.php?event=ac'
            })

            $('#numberPerson').autocomplete({
		minLength: 3,
                delay: 500,
                source: '/docs/person.php?event=ac'
            })
	    
            $('#request_name_port').autocomplete({
		minLength: 2,
                delay: 500,
                source: '/docs/request.php?event=ac',
                select: function(){$('#request_name_port').attr('readonly', true); $('#request_name_port').css('background', '#efefef'); $('#request_id_port_edit').css('display', '');},
                change: function(){$('#request_save').load('/docs/request.php?event=acSave&field=ID_PORT&value='+encodeURIComponent($('#request_name_port').val()));}
            })
	    
            $('#request_name_last_port').autocomplete({
		minLength: 2,
                delay: 500,
                source: '/docs/request.php?event=ac',
                select: function(){$('#request_name_last_port').attr('readonly', true); $('#request_name_last_port').css('background', '#efefef'); $('#request_id_last_port_edit').css('display', '');},
                change: function(){$('#request_save').load('/docs/request.php?event=acSave&field=ID_LAST_PORT&value='+encodeURIComponent($('#request_name_last_port').val()));}
            })
	    
            $('#request_name_first_port').autocomplete({
		minLength: 2,
                delay: 500,
                source: '/docs/request.php?event=ac',
                select: function(){$('#request_name_first_port').attr('readonly', true); $('#request_name_first_port').css('background', '#efefef'); $('#request_id_first_port_edit').css('display', '');},
                change: function(){$('#request_save').load('/docs/request.php?event=acSave&field=ID_FIRST_PORT&value='+encodeURIComponent($('#request_name_first_port').val()));}
            })
            
            $('#numberArticle1').autocomplete({
		minLength: 3,
                delay: 500,
                source: '/docs/article.php?event=ac&type='+encodeURIComponent($('#article_type1').val())
            })
            $('#numberArticle2').autocomplete({
		minLength: 3,
                delay: 500,
                source: '/docs/article.php?event=ac&type=3'
            })

	    
//Сохранение
	    $('#request_asmp_num').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=ASMP_NUM&value='+encodeURIComponent($('#request_asmp_num').val()));});
	    $('#request_req_num').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=REQ_NUM&value='+encodeURIComponent($('#request_req_num').val()));});
	    $('#request_req_num_rcpt').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=REQ_NUM_RCPT&value='+encodeURIComponent($('#request_req_num_rcpt').val()));});
/*1.1*/    $('#company_name_rus').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=NAME_RUS&value='+encodeURIComponent($('#company_name_rus').val()));});
/*1.2*/    $('#company_name_eng').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=NAME_ENG&value='+encodeURIComponent($('#company_name_eng').val()));});
/*1.3*/    $('#company_address_rus').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=ADDRESS_RUS&value='+encodeURIComponent($('#company_address_rus').val()));});
/*1.4*/    $('#company_address_eng').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=ADDRESS_ENG&value='+encodeURIComponent($('#company_address_eng').val()));});
/*1.5*/    $('#company_phone').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=PHONE&value='+encodeURIComponent($('#company_phone').val()));});
/*1.6*/    $('#company_fax').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=FAX&value='+encodeURIComponent($('#company_fax').val()));});
/*1.7*/    $('#company_email').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=EMAIL&value='+encodeURIComponent($('#company_email').val()));});
/*1.8*/    $('#company_head_post').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=HEAD_POST&value='+encodeURIComponent($('#company_head_post').val()));});
/*1.9*/    $('#company_head_name').change(function(){$('#saveCompanyDiv').load('/docs/company.php?event=save_tmp&field=HEAD_NAME&value='+encodeURIComponent($('#company_head_name').val()));});
/*1.10*/    $('#request_id_role').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_ROLE&value='+encodeURIComponent($('#request_id_role').val()));});
/*2.1*/    $('#ship_name_rus').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=NAME_RUS&value='+encodeURIComponent($('#ship_name_rus').val()));});
/*2.2*/    $('#ship_name_eng').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=NAME_ENG&value='+encodeURIComponent($('#ship_name_eng').val()));});
/*2.3*/    $('#ship_imo').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=IMO&value='+encodeURIComponent($('#ship_imo').val()));});
/*2.4*/    $('#ship_call_sign').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=CALL_SIGN&value='+encodeURIComponent($('#ship_call_sign').val()));});
/*2.5*/    $('#ship_mmsi').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=MMSI&value='+encodeURIComponent($('#ship_mmsi').val()));});
/*2.6*/    $('#ship_rmrs').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=RMRS&value='+encodeURIComponent($('#ship_rmrs').val()));});
/*2.7*/    $('#ship_rrr').change(function(){$('#saveShipDiv').load('/docs/ship.php?event=save_tmp&field=RRR&value='+encodeURIComponent($('#ship_rrr').val()));});
/*2.8*/    $('#request_id_country').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_COUNTRY&value='+encodeURIComponent($('#request_id_country').val()));});
/*2.9*/    $('#request_id_port').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_PORT&value='+encodeURIComponent($('#request_id_port').val()));});
/*2.10*/    $('#request_id_ship_type').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_SHIP_TYPE&value='+encodeURIComponent($('#request_id_ship_type').val()));});
/*2.11*/    $('#request_id_class_soc').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_CLASS_SOC&value='+encodeURIComponent($('#request_id_class_soc').val()));});
/*2.13*/    $('#request_id_ice_cat').change(function(){
					    $('#request_save').load('/docs/request.php?event=save&field=ID_ICE_CAT&value='+encodeURIComponent($('#request_id_ice_cat').val()));
					    $('.ice_cat_info_div').load('/docs/request.php?event=iceCatInfo&value='+encodeURIComponent($('#request_id_ice_cat').val()));
					    });
/*2.12*/    $('#request_class').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=CLASS&value='+encodeURIComponent($('#request_class').val()));});
/*2.14*/    $('#request_vessel_length').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=VESSEL_LENGTH&value='+encodeURIComponent($('#request_vessel_length').val()));});
/*2.15*/    $('#request_vessel_width').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=VESSEL_WIDTH&value='+encodeURIComponent($('#request_vessel_width').val()));});
/*2.16*/    $('#request_draght').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=DRAGHT&value='+encodeURIComponent($('#request_draght').val()));});
/*2.17*/    $('#request_ice_belt_width').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=ICE_BELT_WIDTH&value='+encodeURIComponent($('#request_ice_belt_width').val()));});
/*2.18*/    $('#request_gross_tonnage').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=GROSS_TONNAGE&value='+encodeURIComponent($('#request_gross_tonnage').val()));});
/*2.19*/    $('#request_engine_power').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=ENGINE_POWER&value='+encodeURIComponent($('#request_engine_power').val()));});
/*2.20*/    $('#request_fuel_consumption').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=FUEL_CONSUMPTION&value='+encodeURIComponent($('#request_fuel_consumption').val()));});
/*2.21*/    $('#request_bow_constr_detail').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=BOW_CONSTR_DETAIL&value='+encodeURIComponent($('#request_bow_constr_detail').val()));});
/*2.22*/    $('#request_stern_constr_detail').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=STERN_CONSTR_DETAIL&value='+encodeURIComponent($('#request_stern_constr_detail').val()));});
/*2.23*/    $('#request_vessel_phone').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=VESSEL_PHONE&value='+encodeURIComponent($('#request_vessel_phone').val()));});
/*2.24*/    $('#request_vessel_fax').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=VESSEL_FAX&value='+encodeURIComponent($('#request_vessel_fax').val()));});
/*2.25*/    $('#request_vessel_email').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=VESSEL_EMAIL&value='+encodeURIComponent($('#request_vessel_email').val()));});
/*3.1*/     $('#request_route_desc').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=ROUTE_DESC&value='+encodeURIComponent($('#request_route_desc').val()));});
/*3.4*/
/*3.5*/
/*3.6*/     $('#request_exp_crue_qty').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=EXP_CRUE_QTY&value='+encodeURIComponent($('#request_exp_crue_qty').val()));});
/*3.7*/     $('#request_exp_passenger_qty').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=EXP_PASSENGER_QTY&value='+encodeURIComponent($('#request_exp_passenger_qty').val()));});
/*3.8*/     $('#request_cargo_type').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=CARGO_TYPE&value='+encodeURIComponent($('#request_cargo_type').val()));});
/*3.9*/     $('#request_cargo_qty').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=CARGO_QTY&value='+encodeURIComponent($('#request_cargo_qty').val()));});
/*3.10*/     $('#request_dang_class').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=DANG_CLASS&value='+encodeURIComponent($('#request_dang_class').val()));});
/*3.11*/     $('#request_dang_qty').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=DANG_QTY&value='+encodeURIComponent($('#request_dang_qty').val()));});
/*3.12*/     $('#request_ice_nav_experience').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=ICE_NAV_EXPERIENCE&value='+encodeURIComponent($('#request_ice_nav_experience').val()));});
/*3.12*/     $('#request_tug_object_desc').blur(function(){$('#request_save').load('/docs/request.php?event=save&field=TUG_OBJECT_DESC&value='+encodeURIComponent($('#request_tug_object_desc').val()));});
/*4.1*/    $('#person_name_rus').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=NAME_RUS&value='+encodeURIComponent($('#person_name_rus').val()));});
/*4.2*/    $('#person_shortname_rus').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=SHORTNAME_RUS&value='+encodeURIComponent($('#person_shortname_rus').val()));});
/*4.3*/    $('#person_name_eng').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=NAME_ENG&value='+encodeURIComponent($('#person_name_eng').val()));});
/*4.4*/    $('#person_shortname_eng').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=SHORTNAME_ENG&value='+encodeURIComponent($('#person_shortname_eng').val()));});
/*4.5*/    $('#person_phone').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=PHONE&value='+encodeURIComponent($('#person_phone').val()));});
/*4.6*/    $('#person_fax').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=FAX&value='+encodeURIComponent($('#person_fax').val()));});
/*4.7*/    $('#person_email').change(function(){$('#savePersonDiv').load('/docs/person.php?event=save_tmp&field=EMAIL&value='+encodeURIComponent($('#person_email').val()));});
/*4.8*/    $('#request_id_signer_post').change(function(){$('#request_save').load('/docs/request.php?event=save&field=ID_SIGNER_POST&value='+encodeURIComponent($('#request_id_signer_post').val()));});

	    $('#request_display_flag').change(function(){$('#request_save').load('/docs/request.php?event=save&field=DISPLAY_FLAG&value='+encodeURIComponent($('#request_display_flag').val()));});
	    $('#request_solution').change(function(){$('#request_save').load('/docs/request.php?event=save&field=SOLUTION&value='+encodeURIComponent($('#request_solution').val()));});
	    $('#request_lang_sol').change(function(){$('#request_save').load('/docs/request.php?event=save&field=LANG_SOL&value='+encodeURIComponent($('#request_lang_sol').val()));});

	    $('#solution_num').blur(function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION&field=SOLUTION_NUM&value='+encodeURIComponent($('#solution_num').val()));});
	    $('#solution_article_text_rus1').blur(function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION_ARTICLE&field=TEXT_RUS&num=1&value='+encodeURIComponent($('#solution_article_text_rus1').val()));});
	    $('#solution_article_text_eng1').blur(function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION_ARTICLE&field=TEXT_ENG&num=1&value='+encodeURIComponent($('#solution_article_text_eng1').val()));});
	    $('#solution_article_text_rus2').blur(function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION_ARTICLE&field=TEXT_RUS&num=2&value='+encodeURIComponent($('#solution_article_text_rus2').val()));});
	    $('#solution_article_text_eng2').blur(function(){$('#solution_save').load('/docs/request.php?event=sol_save&table=SOLUTION_ARTICLE&field=TEXT_ENG&num=2&value='+encodeURIComponent($('#solution_article_text_eng2').val()));});

	  });

        function saveSel(id, type_id){$('#request_save').load('/docs/files.php?event=savesel&id='+id+'&type_id='+type_id);}
	function delFile(thisid, file_id)
    	    {
    	    $(thisid).parent('li').remove();
    	    $("#request_save").load('/docs/files.php?event=delFile&id='+file_id);
    	    }

//Кнопки
        $(document).ready(function() {

	    var order = 0;
            $('#sortable').sortable(
        	{
                opacity: 0.6,
                update: function() {
                    order = $('#sortable').sortable('toArray');
                    $('p#info').load('/docs/sortable-pr.php?db=SOLUTION_ARTICLE&items=' + order.join(','));
                    }
                });

            $('.ice_cat_info').hover(
                function(){ $('.ice_cat_info_div').slideDown('normal') },
                function(){ $('.ice_cat_info_div').slideUp('fast') }
                )

////Данные по компании
            $('#enterNumberCompany').click(function(){
                id=encodeURIComponent($('#numberCompany').val());
                $('#dataCompany').load('/docs/company.php?event=dataCompany&id='+id);
            });
            $('#enterNewCompany').click(function(){
        	newEdit('Company');
		$('.Company').val('');
                $('#saveCompanyDiv').load('/docs/company.php?event=editCompany');
            });
            $('#saveCompany').click(function(){
                $('#saveCompanyDiv').load('/docs/company.php?event=saveCompany');
		saveEdit('Company');
            });
            $('#canselCompany').click(function(){
                id=encodeURIComponent($('#request_id_company').val());
                $('#dataCompany').load('/docs/company.php?event=dataCompany&cancel=1&id='+id);
                $('#saveCompanyDiv').html('');
            });
            $('#editCompany').click(function(){
                id=encodeURIComponent($('#request_id_company').val());
                $('#saveCompanyDiv').load('/docs/company.php?event=editCompany&id='+id);
		newEdit('Company');
            });
            
////Данные по судну
            $('#enterNumberShip').click(function(){
                id=encodeURIComponent($('#numberShip').val());
                $('#dataShip').load('/docs/ship.php?event=dataShip&id='+id);
            });
            $('#enterNewShip').click(function(){
        	newEdit('Ship');
		$('.Ship').val('');
                $('#saveShipDiv').load('/docs/ship.php?event=editShip');
            });
            $('#saveShip').click(function(){
                $('#saveShipDiv').load('/docs/ship.php?event=saveShip');
		saveEdit('Ship');
            });
            $('#canselShip').click(function(){
                id=encodeURIComponent($('#request_id_ship').val());
                $('#dataShip').load('/docs/ship.php?event=dataShip&cancel=1&id='+id);
                $('#saveShipDiv').html('');
            });
            $('#editShip').click(function(){
                id=encodeURIComponent($('#request_id_ship').val());
                $('#saveShipDiv').load('/docs/ship.php?event=editShip&id='+id);
		newEdit('Ship');
            });
            
            $('#request_id_port_edit').click(function(){
                $('#request_name_port').attr('readonly', false);
                $('#request_name_port').css('background', '#ffffff');
                $('#request_id_port_edit').css('display', 'none');
            });
            
////Данные по маршруту
            $('#request_id_last_port_edit').click(function(){
                $('#request_name_last_port').attr('readonly', false);
                $('#request_name_last_port').css('background', '#ffffff');
                $('#request_id_last_port_edit').css('display', 'none');
            });
            
            $('#request_id_first_port_edit').click(function(){
                $('#request_name_first_port').attr('readonly', false);
                $('#request_name_first_port').css('background', '#ffffff');
                $('#request_id_first_port_edit').css('display', 'none');
            });
            
////Данные о физ лице - Заявителе    
            $('#enterNumberPerson').click(function(){
                id=encodeURIComponent($('#numberPerson').val());
                $('#dataPerson').load('/docs/person.php?event=dataPerson&id='+id);
            });

            $('#enterNewPerson').click(function(){
        	newEdit('Person');
		$('.Person').val('');
                $('#savePersonDiv').load('/docs/person.php?event=editPerson');
            });
            $('#savePerson').click(function(){
                $('#savePersonDiv').load('/docs/person.php?event=savePerson');
		saveEdit('Person');
            });
            $('#canselPerson').click(function(){
                id=encodeURIComponent($('#request_id_person').val());
                $('#dataPerson').load('/docs/person.php?event=dataPerson&cancel=1&id='+id);
                $('#savePersonDiv').html('');
            });
            $('#editPerson').click(function(){
                id=encodeURIComponent($('#request_id_person').val());
                $('#savePersonDiv').load('/docs/person.php?event=editPerson&id='+id);
		newEdit('Person');
            });

////Данные по статьям
            $('#enterNumberArticle1').click(function(){
                id=encodeURIComponent($('#numberArticle1').val());
                type=encodeURIComponent($('#article_type1').val());
                $('#dataArticle1').load('/docs/article.php?event=dataArticle&id='+id+'&num=1&type='+type);
            });

            $('#enterNumberArticle2').click(function(){
                id=encodeURIComponent($('#numberArticle2').val());
                type=encodeURIComponent($('#article_type2').val());
                $('#dataArticle2').load('/docs/article.php?event=dataArticle&id='+id+'&num=2&type='+type);
            });

            $('#enterNewArticle1').click(function(){
        	newArticle(1);
            });
            $('#enterNewArticle2').click(function(){
        	newArticle(2);
            });
            
            $('#canselArticle1').click(function(){
        	noneArticle(1);
            });
            $('#canselArticle2').click(function(){
        	noneArticle(2);
            });
            
            $('#saveArticle1').click(function(){
                type=encodeURIComponent($('#article_type1').val());
                text_rus=encodeURIComponent($('#article_text_rus1').val());
                text_eng=encodeURIComponent($('#article_text_eng1').val());
                $('#dataArticle1').load('/docs/article.php?event=dataArticle&new=1&text_rus='+text_rus+'&text_eng='+text_eng+'&num=1&type='+type);
        	noneArticle(1);
            });
            $('#saveArticle2').click(function(){
                type=encodeURIComponent($('#article_type2').val());
                text_rus=encodeURIComponent($('#article_text_rus2').val());
                text_eng=encodeURIComponent($('#article_text_eng2').val());
                $('#dataArticle2').load('/docs/article.php?event=dataArticle&new=1&text_rus='+text_rus+'&text_eng='+text_eng+'&num=2&type='+type);
        	noneArticle(2);
            });
            
//Сформировать - очистить
            $('#addRequestBt').click(function(){
        	mess="";
        	if ($('#request_id_company').val()==0){mess=mess+'Отсутствуют данные по компании\n';}
        	if ($('#request_id_role').val()==0){mess=mess+'Не заполнен пункт 1.10\n';}
        	if ($('#request_id_ship').val()==0){mess=mess+'Отсутствуют данные по судну\n';}
        	if ($('#request_id_country').val()==0){mess=mess+'Не заполнен пункт 2.8\n';}
        	if ($('#request_id_port').val()==''){mess=mess+'Не заполнен пункт 2.9\n';}
        	if ($('#request_id_ship_type').val()==0){mess=mess+'Не заполнен пункт 2.10\n';}
        	if ($('#request_id_class_soc').val()==0){mess=mess+'Не заполнен пункт 2.11\n';}
        	if ($('#request_class').val()==''){mess=mess+'Не заполнен пункт 2.12\n';}
        	if ($('#request_id_ice_cat').val()==0){mess=mess+'Не заполнен пункт 2.13\n';}
        	if ($('#request_vessel_length').val()==''){mess=mess+'Не заполнен пункт 2.14\n';}
        	if ($('#request_vessel_width').val()==''){mess=mess+'Не заполнен пункт 2.15\n';}
        	if ($('#request_vessel_draght').val()==''){mess=mess+'Не заполнен пункт 2.16\n';}
        	if ($('#request_vessel_ice_belt_width').val()==''){mess=mess+'Не заполнен пункт 2.17\n';}
        	if ($('#request_gross_tonnage').val()==''){mess=mess+'Не заполнен пункт 2.18\n';}
        	if ($('#request_engine_power').val()==''){mess=mess+'Не заполнен пункт 2.19\n';}
        	if ($('#request_fuel_consumption').val()==''){mess=mess+'Не заполнен пункт 2.20\n';}
        	if ($('#request_bow_constr_detail').val()==''){mess=mess+'Не заполнен пункт 2.21\n';}
        	if ($('#request_stern_constr_detail').val()==''){mess=mess+'Не заполнен пункт 2.22\n';}
        	if ($('#request_vessel_phone').val()==''){mess=mess+'Не заполнен пункт 2.23\n';}
        	if ($('#request_vessel_fax').val()==''){mess=mess+'Не заполнен пункт 2.24\n';}
        	if ($('#request_vessel_email').val()==''){mess=mess+'Не заполнен пункт 2.25\n';}
        	if ($('#request_route_desc').val()==''){mess=mess+'Не заполнен пункт 3.1\n';}
        	if ($('#request_exp_route_date_start').val()==''){mess=mess+'Не заполнен пункт 3.2\n';}
        	if ($('#request_exp_route_date_end').val()==''){mess=mess+'Не заполнен пункт 3.3\n';}
        	if ($('#request_id_last_port').val()==''){mess=mess+'Не заполнен пункт 3.4\n';}
        	if ($('#request_id_first_port').val()==''){mess=mess+'Не заполнен пункт 3.5\n';}
        	if ($('#request_exp_crue_qty').val()==''){mess=mess+'Не заполнен пункт 3.6\n';}
        	if ($('#request_exp_passenger_qty').val()==''){mess=mess+'Не заполнен пункт 3.7\n';}
        	if ($('#request_cargo_type').val()==''){mess=mess+'Не заполнен пункт 3.8\n';}
        	if ($('#request_cargo_qty').val()==''){mess=mess+'Не заполнен пункт 3.9\n';}
        	if ($('#request_dang_class').val()==''){mess=mess+'Не заполнен пункт 3.10\n';}
        	if ($('#request_dang_qty').val()==''){mess=mess+'Не заполнен пункт 3.11\n';}
        	if ($('#request_ice_nav_experience').val()==''){mess=mess+'Не заполнен пункт 3.12\n';}
        	if ($('#request_tug_object_desc').val()==''){mess=mess+'Не заполнен пункт 3.13\n';}
        	if ($('#request_id_person').val()==0){mess=mess+'Отсутствуют данные о заявителе\n';}
        	if ($('#request_id_signer_post').val()==0){mess=mess+'Не заполнен пункт 4.8\n';}
        	
        	if (mess!=""){alert(mess);}
        	else {$('#request_save').load('/docs/request.php?event=addRequest');}
        	});
            $('#clearRequestBt').click(function(){$('#request_save').load('/docs/request.php?event=clearRequest');});
            $('#addfile').click(function(){$('#file_save').load('/docs/addfile.php');});
        });
