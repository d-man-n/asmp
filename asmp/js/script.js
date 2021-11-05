

$(document).ready(function() {
//Даты
    $( "#date_enter" ).datepicker({
        dateFormat: "yy-mm-dd",
        });
    $( "#date_exit" ).datepicker({
        dateFormat: "yy-mm-dd",
        });
    $( "#date_port_exit" ).datepicker({
        dateFormat: "yy-mm-dd",
        });
    $( "#date_event" ).datepicker({
        dateFormat: "yy-mm-dd",
        });


    Data = new Date();
    if (Data.getDate()<10) day="0"+Data.getDate();
    else  day=Data.getDate();
    if (Data.getMonth()+1<10) month="0"+(Data.getMonth()+1);
    else  month=Data.getMonth()+1;
    $('#date_today').html(day+"-"+month+"-"+Data.getFullYear());


    $('#type_num').change(function(){
	if ($('#type_num').val()==0) $("#ship_imo").attr('maxlength','7');
	else $("#ship_imo").attr('maxlength','6');
	});


    $('#ship_imo').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#exp_crue_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#exp_passenger_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#draght').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#cargo_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#cargo_qty1').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#cargo_qty2').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#cargo_qty3').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
	
    $('#no_dang').click(function(){
	if ($(this).is(':checked')){
    		$('#dang').hide(100);
	    } else {
    		$('#dang').show(100);
	    }
	});    
	
    $('#dang_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#dang_qty1').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#dang_qty2').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#dang_qty3').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#fuel_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#fuel_qty1').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#fuel_qty2').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#fuel_qty3').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#water_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#food_qty').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#food_qty1').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#food_qty2').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})
    $('#food_qty3').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#shirota_grad').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#shirota_min').bind("change keyup input click", function() {
	if (this.value>59) this.value=59;
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#shirota_sec').bind("change keyup input click", function() {
	if (this.value>59) this.value=59;
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#dolgota_grad').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#dolgota_min').bind("change keyup input click", function() {
	if (this.value>59) this.value=59;
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#dolgota_sec').bind("change keyup input click", function() {
	if (this.value>59) this.value=59;
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#kurs').bind("change keyup input click", function() {
	if (this.value>360) this.value=360;
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#skorost').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9,]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#ice_thickness').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#ice_thickness1').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#ice_thickness2').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#ice_thickness3').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#air_temperature').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9+\-]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#water_temperature').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9+\-]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#wind_speed').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#visibility').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#wave_height').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            }
	})

    $('#list').click(function(){
        var otchet0="0//ASMP-V2."+$('#select_type').val()+'\n';
        var otchet1="1//"+$('#ship_name').val().toUpperCase()+"\n";
        var otchet2="2//"+$('#type_num option:selected').text()+": "+$('#ship_imo').val()+"\n";

	if ($('#select_type').val()==1)
	    {
    	    if ($('#port1').val()!="") var otchet3="3//"+$('#port1').val().toUpperCase()+"\n";
    	    else var otchet3="3//НЕТ\n";

    	    if ($('#port2').val()!="") var otchet4="4//"+$('#port2').val().toUpperCase()+"\n";
    	    else var otchet4="4//НЕТ\n";

    	    var otchet5="5//МАКС.ОСАДКА: "+$('#draght').val()+" М\n";

	    var otchet6="";
    	    if ($('#cargo_type').val()!="" || $('#cargo_qty').val()!="") otchet6=otchet6+"6//"+$('#cargo_type').val()+": "+$('#cargo_qty').val()+" МТ\n";
    	    if ($('#cargo_type1').val()!="" || $('#cargo_qty1').val()!="") otchet6=otchet6+"6//"+$('#cargo_type1').val()+": "+$('#cargo_qty1').val()+" МТ\n";
    	    if ($('#cargo_type2').val()!="" || $('#cargo_qty2').val()!="") otchet6=otchet6+"6//"+$('#cargo_type2').val()+": "+$('#cargo_qty2').val()+" МТ\n";
    	    if ($('#cargo_type3').val()!="" || $('#cargo_qty3').val()!="") otchet6=otchet6+"6//"+$('#cargo_type3').val()+": "+$('#cargo_qty3').val()+" МТ\n";
    	    if ($('#cargo_type').val()=="" && $('#cargo_qty').val()=="" && $('#cargo_type1').val()=="" && $('#cargo_qty1').val()=="" && $('#cargo_type2').val()=="" && $('#cargo_qty2').val()=="" && $('#cargo_type3').val()=="" && $('#cargo_qty3').val()=="")  otchet6="6//НЕТ\n";

	    var otchet7="";
    	    if ($('#dang_class').val()!="" || $('#dang_qty').val()!="") otchet7=otchet7+"7//"+$('#dang_class').val()+": "+$('#dang_qty').val()+" МТ\n";
    	    if ($('#dang_class1').val()!="" || $('#dang_qty1').val()!="") otchet7=otchet7+"7//"+$('#dang_class1').val()+": "+$('#dang_qty1').val()+" МТ\n";
    	    if ($('#dang_class2').val()!="" || $('#dang_qty2').val()!="") otchet7=otchet7+"7//"+$('#dang_class2').val()+": "+$('#dang_qty2').val()+" МТ\n";
    	    if ($('#dang_class3').val()!="" || $('#dang_qty3').val()!="") otchet7=otchet7+"7//"+$('#dang_class3').val()+": "+$('#dang_qty3').val()+" МТ\n";
    	    if ($('#dang_class').val()=="" && $('#dang_qty').val()=="" && $('#dang_class1').val()=="" && $('#dang_qty1').val()=="" && $('#dang_class2').val()=="" && $('#dang_qty2').val()=="" && $('#dang_class3').val()=="" && $('#dang_qty3').val()=="")  otchet7="7//НЕТ\n";

	    var otchet8="";
    	    if ($('#fuel_qty').val()!="") otchet8=otchet8+"8//"+$('#fuel_class option:selected').text()+": "+$('#fuel_qty').val()+" МТ\n";
    	    if ($('#fuel_qty1').val()!="") otchet8=otchet8+"8//"+$('#fuel_class1 option:selected').text()+": "+$('#fuel_qty1').val()+" МТ\n";
    	    if ($('#fuel_qty2').val()!="") otchet8=otchet8+"8//"+$('#fuel_class2 option:selected').text()+": "+$('#fuel_qty2').val()+" МТ\n";
    	    if ($('#fuel_qty3').val()!="") otchet8=otchet8+"8//"+$('#fuel_class3 option:selected').text()+": "+$('#fuel_qty3').val()+" МТ\n";
    	    if ($('#fuel_qty').val()=="" && $('#fuel_qty1').val()=="" && $('#fuel_qty2').val()=="" && $('#fuel_qty3').val()=="")  otchet8="8//НЕТ\n";

    	    if ($('#water_qty').val()!="") var otchet9="9//ВОДА: "+$('#water_qty').val()+" СУТОК\n";
    	    else var otchet9="9//НЕТ\n";

	    var otchet10="";
    	    if ($('#food_class').val()!="" || $('#food_qty').val()!="") otchet10=otchet10+"10//"+$('#food_class').val()+": "+$('#food_qty').val()+" СУТОК\n";
    	    if ($('#food_class1').val()!="" || $('#food_qty1').val()!="") otchet10=otchet10+"10//"+$('#food_class1').val()+": "+$('#food_qty1').val()+" СУТОК\n";
    	    if ($('#food_class2').val()!="" || $('#food_qty2').val()!="") otchet10=otchet10+"10//"+$('#food_class2').val()+": "+$('#food_qty2').val()+" СУТОК\n";
    	    if ($('#food_class3').val()!="" || $('#food_qty3').val()!="") otchet10=otchet10+"10//"+$('#food_class3').val()+": "+$('#food_qty3').val()+" СУТОК\n";
    	    if ($('#food_class').val()=="" && $('#food_qty').val()=="" && $('#food_class1').val()=="" && $('#food_qty1').val()=="" && $('#food_class2').val()=="" && $('#food_qty2').val()=="" && $('#food_class3').val()=="" && $('#food_qty3').val()=="")  otchet10="10//НЕТ\n";

	    var otchet11="11//ЭКИПАЖ: "+$('#exp_crue_qty').val()+"\n";
    	    if ($('#exp_passenger_qty').val()!="") var otchet11=otchet11+"11//ПАССАЖИРЫ: "+$('#exp_passenger_qty').val()+"\n";
    	    else otchet11=otchet11+"11//ПАССАЖИРЫ: НЕТ\n";

    	    if ($('#fault').val()!="") var otchet12="12//"+$('#fault').val()+"\n";
    	    else var otchet12="12//НЕТ\n";

    	    var otchet13="13//ВХОД ETA: "+$('#date_enter').val()+" "+$('#time_enter').val()+"24:MI МСК\n";

	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+otchet5+otchet6+otchet7+otchet8+otchet9+otchet10+otchet11+otchet12+otchet13+'</textarea>');
	    }

	if ($('#select_type').val()==2)
	    {
    	    var otchet3="3//"+$('#date_enter').val()+" "+$('#time_enter').val()+":00 МСК\n";

    	    if ($('#place').val()!="") var otchet4="4//"+$('#place').val().toUpperCase()+"\n";
    	    else var otchet4="4//НЕТ\n";
	    
    	    var otchet5="5//"+$('#shirota_grad').val()+" "+$('#shirota_min').val()+"\' "+$('#shirota_sec').val()+"\'\' N "+$('#dolgota_grad').val()+" "+$('#dolgota_min').val()+"\' "+$('#dolgota_sec').val()+"\'\' "+$('#dolgota_add').val()+"\n";
    	    var otchet6="6//"+$('#kurs').val()+" ГРАД.\n";
    	    var otchet7="7//"+$('#skorost').val()+" УЗЛ.\n";
    	    var otchet8="8//ETA "+$('#date_exit').val()+" "+$('#time_exit').val()+" МСК\n";

    	    if ($('#place_exit').val()!="") var otchet9="9//"+$('#place_exit').val().toUpperCase()+"\n";
    	    else var otchet9="9//НЕТ\n";

	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+otchet5+otchet6+otchet7+otchet8+otchet9+'</textarea>');
	    }

	if ($('#select_type').val()==3)
	    {
    	    if ($('#port1').val()!="") var otchet3="3//"+$('#port1').val().toUpperCase()+"\n";
    	    else var otchet3="3//НЕТ\n";

    	    if ($('#port2').val()!="") var otchet4="4//"+$('#port2').val().toUpperCase()+"\n";
    	    else var otchet4="4//НЕТ\n";

    	    var otchet5="5//"+$('#date_port_exit').val()+" "+$('#time_port_exit').val()+"24:MI МСК\n";

    	    var otchet6="6//МАКС.ОСАДКА: "+$('#draght').val()+" М\n";

	    var otchet7="";
    	    if ($('#cargo_type').val()!="" || $('#cargo_qty').val()!="") otchet7=otchet7+"7//"+$('#cargo_type').val()+": "+$('#cargo_qty').val()+" МТ\n";
    	    if ($('#cargo_type1').val()!="" || $('#cargo_qty1').val()!="") otchet7=otchet7+"7//"+$('#cargo_type1').val()+": "+$('#cargo_qty1').val()+" МТ\n";
    	    if ($('#cargo_type2').val()!="" || $('#cargo_qty2').val()!="") otchet7=otchet7+"7//"+$('#cargo_type2').val()+": "+$('#cargo_qty2').val()+" МТ\n";
    	    if ($('#cargo_type3').val()!="" || $('#cargo_qty3').val()!="") otchet7=otchet7+"7//"+$('#cargo_type3').val()+": "+$('#cargo_qty3').val()+" МТ\n";
    	    if ($('#cargo_type').val()=="" && $('#cargo_qty').val()=="" && $('#cargo_type1').val()=="" && $('#cargo_qty1').val()=="" && $('#cargo_type2').val()=="" && $('#cargo_qty2').val()=="" && $('#cargo_type3').val()=="" && $('#cargo_qty3').val()=="")  otchet7="7//НЕТ\n";

	    var otchet8="";
    	    if ($('#dang_class').val()!="" || $('#dang_qty').val()!="") otchet8=otchet8+"8//"+$('#dang_class').val()+": "+$('#dang_qty').val()+" МТ\n";
    	    if ($('#dang_class1').val()!="" || $('#dang_qty1').val()!="") otchet8=otchet8+"8//"+$('#dang_class1').val()+": "+$('#dang_qty1').val()+" МТ\n";
    	    if ($('#dang_class2').val()!="" || $('#dang_qty2').val()!="") otchet8=otchet8+"8//"+$('#dang_class2').val()+": "+$('#dang_qty2').val()+" МТ\n";
    	    if ($('#dang_class3').val()!="" || $('#dang_qty3').val()!="") otchet8=otchet8+"8//"+$('#dang_class3').val()+": "+$('#dang_qty3').val()+" МТ\n";
    	    if ($('#dang_class').val()=="" && $('#dang_qty').val()=="" && $('#dang_class1').val()=="" && $('#dang_qty1').val()=="" && $('#dang_class2').val()=="" && $('#dang_qty2').val()=="" && $('#dang_class3').val()=="" && $('#dang_qty3').val()=="")  otchet8="8//НЕТ\n";

	    var otchet9="";
    	    if ($('#fuel_qty').val()!="") otchet9=otchet9+"9//"+$('#fuel_class option:selected').text()+": "+$('#fuel_qty').val()+" МТ\n";
    	    if ($('#fuel_qty1').val()!="") otchet9=otchet9+"9//"+$('#fuel_class1 option:selected').text()+": "+$('#fuel_qty1').val()+" МТ\n";
    	    if ($('#fuel_qty2').val()!="") otchet9=otchet9+"9//"+$('#fuel_class2 option:selected').text()+": "+$('#fuel_qty2').val()+" МТ\n";
    	    if ($('#fuel_qty3').val()!="") otchet9=otchet9+"9//"+$('#fuel_class3 option:selected').text()+": "+$('#fuel_qty3').val()+" МТ\n";
    	    if ($('#fuel_qty').val()=="" && $('#fuel_qty1').val()=="" && $('#fuel_qty2').val()=="" && $('#fuel_qty3').val()=="")  otchet9="9//НЕТ\n";

    	    if ($('#water_qty').val()!="") var otchet10="10//ВОДА: "+$('#water_qty').val()+" СУТОК\n";
    	    else var otchet10="10//НЕТ\n";

	    var otchet11="";
    	    if ($('#food_class').val()!="" || $('#food_qty').val()!="") otchet11=otchet11+"11//"+$('#food_class').val()+": "+$('#food_qty').val()+" СУТОК\n";
    	    if ($('#food_class1').val()!="" || $('#food_qty1').val()!="") otchet11=otchet11+"11//"+$('#food_class1').val()+": "+$('#food_qty1').val()+" СУТОК\n";
    	    if ($('#food_class2').val()!="" || $('#food_qty2').val()!="") otchet11=otchet11+"11//"+$('#food_class2').val()+": "+$('#food_qty2').val()+" СУТОК\n";
    	    if ($('#food_class3').val()!="" || $('#food_qty3').val()!="") otchet11=otchet11+"11//"+$('#food_class3').val()+": "+$('#food_qty3').val()+" СУТОК\n";
    	    if ($('#food_class').val()=="" && $('#food_qty').val()=="" && $('#food_class1').val()=="" && $('#food_qty1').val()=="" && $('#food_class2').val()=="" && $('#food_qty2').val()=="" && $('#food_class3').val()=="" && $('#food_qty3').val()=="")  otchet11="11//НЕТ\n";

	    var otchet12="12//ЭКИПАЖ: "+$('#exp_crue_qty').val()+"\n";
    	    if ($('#exp_passenger_qty').val()!="") var otchet12=otchet12+"12//ПАССАЖИРЫ: "+$('#exp_passenger_qty').val()+"\n";
    	    else otchet12=otchet12+"12//ПАССАЖИРЫ: НЕТ\n";

    	    if ($('#fault').val()!="") var otchet13="13//"+$('#fault').val()+"\n";
    	    else var otchet13="13//НЕТ\n";

    	    var otchet14="14//ВЫХОД ETA: "+$('#date_exit').val()+" "+$('#time_exit').val()+"24:MI МСК\n";

    	    if ($('#place_exit').val()!="") var otchet15="15//"+$('#place_exit').val().toUpperCase()+"\n";
    	    else var otchet15="15//НЕТ\n";
	    
	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+otchet5+otchet6+otchet7+otchet8+otchet9+otchet10+otchet11+otchet12+otchet13+otchet14+otchet15+'</textarea>');
	    }

	if ($('#select_type').val()==4)
	    {
    	    var otchet3="3//"+day+"-"+month+"-"+Data.getFullYear()+" 12:00 МСК\n";
    	    var otchet4="4//"+$('#shirota_grad').val()+" "+$('#shirota_min').val()+"\' "+$('#shirota_sec').val()+"\'\' N "+$('#dolgota_grad').val()+" "+$('#dolgota_min').val()+"\' "+$('#dolgota_sec').val()+"\'\' "+$('#dolgota_add').val()+"\n";
    	    var otchet5="5//"+$('#ship_event').val()+" СМП: "+$('#date_event').val()+" "+$('#time_event').val()+":"+$('#time2_event').val()+" МСК\n";

    	    if ($('#port1').val()!="") var otchet6="6//"+$('#port1').val().toUpperCase()+"\n";
    	    else var otchet6="6//НЕТ\n";

    	    var otchet7="7//"+$('#kurs').val()+" ГРАД.\n";
    	    var otchet8="8//"+$('#skorost').val()+" УЗЛ.\n";
	    
	    var otchet9="";
    	    if ($('#ice_class').val()!=0 || $('#ice_thickness').val()!="") otchet9=otchet9+"9//"+$('#ice_class option:selected').text().toUpperCase()+": "+$('#ice_thickness').val()+" М - "+$('#ice_cohesion').val()+" Б\n";
    	    if ($('#ice_class1').val()!=0 || $('#ice_thickness1').val()!="") otchet9=otchet9+"9//"+$('#ice_class1 option:selected').text().toUpperCase()+": "+$('#ice_thickness1').val()+" М - "+$('#ice_cohesion1').val()+" Б\n";
    	    if ($('#ice_class2').val()!=0 || $('#ice_thickness2').val()!="") otchet9=otchet9+"9//"+$('#ice_class2 option:selected').text().toUpperCase()+": "+$('#ice_thickness2').val()+" М - "+$('#ice_cohesion2').val()+" Б\n";
    	    if ($('#ice_class3').val()!=0 || $('#ice_thickness3').val()!="") otchet9=otchet9+"9//"+$('#ice_class3 option:selected').text().toUpperCase()+": "+$('#ice_thickness3').val()+" М - "+$('#ice_cohesion3').val()+" Б\n";
    	    if ($('#ice_class').val()==0 && $('#ice_thickness').val()=="" && $('#ice_class1').val()==0 && $('#ice_thickness1').val()=="" && $('#ice_class2').val()==0 && $('#ice_thickness2').val()=="" && $('#ice_class3').val()==0 && $('#ice_thickness3').val()=="")  otchet9="9//НЕТ\n";

    	    var otchet10="10//ВОЗДУХ Т: "+$('#air_temperature').val()+" С\n";
    	    var otchet11="11//ВОДА Т: "+$('#water_temperature').val()+" С\n";
    	    var otchet12="12//ВЕТЕР: "+$('#wind_direction').val()+" ГРАД.\n";
    	    var otchet13="13//ВЕТЕР: "+$('#wind_speed').val()+" М/С\n";
    	    var otchet14="14//ВИДИМОСТЬ: "+$('#visibility').val()+" NM\n";
    	    var otchet15="15//ВОЛНА: "+$('#wave_height').val()+" М\n";

	    var otchet16="";
    	    if ($('#fuel_qty').val()!="") otchet16=otchet16+"16//"+$('#fuel_class option:selected').text()+": "+$('#fuel_qty').val()+" МТ\n";
    	    if ($('#fuel_qty1').val()!="") otchet16=otchet16+"16//"+$('#fuel_class1 option:selected').text()+": "+$('#fuel_qty1').val()+" МТ\n";
    	    if ($('#fuel_qty2').val()!="") otchet16=otchet16+"16//"+$('#fuel_class2 option:selected').text()+": "+$('#fuel_qty2').val()+" МТ\n";
    	    if ($('#fuel_qty3').val()!="") otchet16=otchet16+"16//"+$('#fuel_class3 option:selected').text()+": "+$('#fuel_qty3').val()+" МТ\n";
    	    if ($('#fuel_qty').val()=="" && $('#fuel_qty1').val()=="" && $('#fuel_qty2').val()=="" && $('#fuel_qty3').val()=="")  otchet16="16//НЕТ\n";

    	    if ($('#water_qty').val()!="") var otchet17="17//ВОДА: "+$('#water_qty').val()+" СУТОК\n";
    	    else var otchet17="17//НЕТ\n";

    	    if ($('#accidents').val()!="") var otchet18="18//"+$('#accidents').val().toUpperCase()+"\n";
    	    else var otchet18="18//НЕТ\n";
	    
    	    if ($('#fault').val()!="") var otchet19="19//"+$('#fault').val().toUpperCase()+"\n";
    	    else var otchet19="19//НЕТ\n";
	    
    	    if ($('#other').val()!="") var otchet20="20//"+$('#other').val().toUpperCase()+"\n";
    	    else var otchet20="20//НЕТ\n";
	    
	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+otchet5+otchet6+otchet7+otchet8+otchet9+otchet10+otchet11+otchet12+otchet13+otchet14+otchet15+otchet16+otchet17+otchet18+otchet19+otchet20+'</textarea>');
	    }

	if ($('#select_type').val()==5)
	    {
    	    var otchet3="3//"+$('#date_enter').val()+" "+$('#time_enter').val()+":00 МСК\n";

    	    if ($('#port1').val()!="") var otchet4="4//"+$('#port1').val().toUpperCase()+"\n";
    	    else var otchet4="4//НЕТ\n";
	    
	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+'</textarea>');
	    }

	if ($('#select_type').val()==6)
	    {
    	    var otchet3="3//"+$('#date_enter').val()+" "+$('#time_enter').val()+"24:MI МСК\n";

    	    if ($('#place').val()!="") var otchet4="4//"+$('#place').val().toUpperCase()+"\n";
    	    else var otchet4="4//НЕТ\n";
	    
    	    var otchet5="5//"+$('#shirota_grad').val()+" "+$('#shirota_min').val()+"\' "+$('#shirota_sec').val()+"\'\' N "+$('#dolgota_grad').val()+" "+$('#dolgota_min').val()+"\' "+$('#dolgota_sec').val()+"\'\' "+$('#dolgota_add').val()+"\n";
    	    var otchet6="6//"+$('#kurs').val()+" ГРАД.\n";
    	    var otchet7="7//"+$('#skorost').val()+" УЗЛ.\n";
	    
	    
	    $('#list_text').html('<textarea cols=100 rows=20 readonly>'+otchet0+otchet1+otchet2+otchet3+otchet4+otchet5+otchet6+otchet7+'</textarea>');
	    }
	});

    $('#select_type').change(function()
	{
	$('#form').load('/form'+$('#select_type').val()+'.html?133344554344333');
	$("#select_type").attr("disabled", "disabled");
	});
})
