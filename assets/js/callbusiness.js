/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function doChangeArea(regioncode){
    console.log(regioncode);
    $.ajax({
        url: base_url + "resource/loadarea",
        type: "post",
        data: "regioncode=" + regioncode,
        dataType: "json",
        beforeSend: function(){
        },               
        success: function (response) {
            console.log(response);
            $("#areacode").empty();
            $("#fmecode").empty();
            if(response.length > 1){
                $("#areacode").append(new Option('', ''));
            }
            for(i = 0; i < response.length; i++){
                $("#areacode").append(new Option(response[i]['Level2'] + ' - ' + response[i]['Level2Name'], response[i]['Level2']));
            }          
            if(response.length == 1){
                doChangeTerritory(response[0]['Level2']);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        } 
    });
}


function doChangeTerritory(areacode){
    console.log(areacode);
    $.ajax({
        url: base_url + "resource/loadterritory",
        type: "post",
        data: "areacode=" + areacode,
        dataType: "json",
        beforeSend: function(){
        },               
        success: function (response) {
            $("#fmecode").empty();
            if(response.length > 1){
                $("#fmecode").append(new Option('', ''));
            }
            for(i = 0; i < response.length; i++){
                $("#fmecode").append(new Option(response[i]['Level1StaffID'] + ' - ' + response[i]['Level1Name'], response[i]['Level1StaffID']));
            }          
           
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        } 
    });
}


function doLoadBrandDetails(level1, period, brandcode){
    $("#myModal").modal();
    $("#modalbody").html("");
    $("#modalbody").html("Loading..........");
    $("#modal-title").html("Brand details");
    console.log("level1=" + level1 + "&period=" + period + "&brandcode=" + brandcode);
    $.ajax({
        url: base_url + "resource/loadbranddetails",
        type: "post",
        data: "level1=" + level1 + "&period=" + period + "&brandcode=" + brandcode,
        beforeSend: function(){
        },               
        success: function (response) {
            $("#modalbody").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        } 
    });
}

function doLoadCustomerDetails(reporttype,datefrom,dateto,level1,productcode){
    var url = base_url + "resource/retailerdetails/?" + "reporttype=" + reporttype + "&datefrom=" + datefrom + "&dateto=" + dateto + "&level1=" + level1 + "&productcode=" + productcode;
    window.open( url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=800,height=800");
}


function doLoadSalesDetails(datefrom,dateto,level1,productcode){
    var url = base_url + "resource/retailersalesdetails/?" + "datefrom=" + datefrom + "&dateto=" + dateto + "&level1=" + level1 + "&productcode=" + productcode;
    window.open( url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=800,height=800");
}


function doLoadDoctorResourceDetails (datefrom, dateto, level1, barndcode, giftcode, literaturecode){
    $("#myModal").modal();
    $("#modalbody").html("");
    $("#modalbody").html("Loading..........");
    $("#modal-title").html("Doctor details");
    console.log("datefrom=" + datefrom + "&dateto=" + dateto + "&level1=" + level1 + "&brandcode=" + barndcode + "&gift=" + giftcode + "&literature=" + literaturecode);
    
    $.ajax({
        url: base_url + "resource/doctordetails",
        type: "post",
        data: "datefrom=" + datefrom + "&dateto=" + dateto + "&level1=" + level1 + "&brandcode=" + barndcode + "&gift=" + giftcode + "&literature=" + literaturecode,
        beforeSend: function(){
        },               
        success: function (response) {
            $("#modalbody").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        } 
    });
    
}

