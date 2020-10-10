var table = [];
var item = [];
var duplicatateindex;


function doLoadExcelData(exceldata){
    if(exceldata && exceldata.length > 0){ 
        //console.log(exceldata);
        for(i = 0; i < exceldata.length; i++){
            material = exceldata[i]['materialcode']+'-'+exceldata[i]['materialname'];
            business = exceldata[i]['businesscode']+'-'+exceldata[i]['businessname'];
            plantlocation = exceldata[i]['locationcode']+'-'+exceldata[i]['locationname'];
            materialtype = exceldata[i]['materialtypecode']+'-'+exceldata[i]['materialtypename'];
            material = exceldata[i]['materialcode']+'-'+exceldata[i]['materialname'];

            item.splice(table.length, 0, material);
            table.push({"materialcode": material,"businesscode": business
                , "locationcode": plantlocation
                , "materialtypecode": materialtype
                , "materialcode": material, "effectivedate": exceldata[i]['effectivedate']
                , "buffersize": exceldata[i]['buffersize']});
        }
        loaddata();
    }
}



function validateform(){
    
}

function loaddata(){
    $("#datagrid tbody").html('');
    for(i = 0; i < table.length; i++){
        $('#datagrid tbody').append('<tr ondblclick="loadGridData(\''+ table[i]['materialcode'] + '\')">\
            <td><input type="hidden" name="businesscode[]" value="'+ table[i]['businesscode'] + '">\n\
            <input type="hidden" name="locationcode[]" value="'+ table[i]['locationcode'] + '">\n\
            <input type="hidden" name="materialtypecode[]" value="'+ table[i]['materialtypecode'] + '">\n\
            <input type="hidden" name="materialcode[]" value="'+ table[i]['materialcode'] + '">\n\
            <input type="hidden" name="effectivedate[]" value="'+ table[i]['effectivedate'] + '">\n\
            <input type="hidden" name="buffersize[]" value="'+ table[i]['buffersize'] + '">\n\
            '+ table[i]['businesscode'] + ' </td>\n\
            <td> '+ table[i]['locationcode'] + ' </td>\n\
            <td> '+ table[i]['materialtypecode'] + ' </td>\n\
            <td> '+ table[i]['materialcode'] + ' </td>\n\
            <td> '+ table[i]['effectivedate'] + ' </td>\n\
            <td> '+ table[i]['buffersize'] + ' </td>\n\
            <td> <i style="cursor: pointer;" onclick="loadGridData(\''+ table[i]['materialcode'] + '\')" class="glyphicon glyphicon-pencil"></i>\
            <i style="cursor: pointer;" onclick="doDeleteGridData(\''+ table[i]['materialcode'] + '\')" class="glyphicon glyphicon-trash"></i></td>\n\
        </tr>');
    }
    if(table.length > 0){
        $("#submit").css("display","block");
    }
}

function doDeleteGridData(materialcode){
    var table2 = [];
    for(i=0; i<table.length; i++){
        if(table[i]['materialcode'] != materialcode){
            table2[table2.length] = table[i];
        }
    }
    table = table2;
    if(table.length == 0){
        $("#datagrid tbody").html('');
        $("#submit").css("display","none");
    }else{
        loaddata();    
        $("#submit").css("display","block");
    }
    $("#table2").focus();
}


function doLoadLocation(businesscode){
    $('#locationcode').empty();
    $.ajax({
        type: "POST",
        url: base_url + "location/getlist",
        data: "businesscode=" + businesscode.split('-')[0],               
        dataType: "json",
        cache: false,
        success: function (res) {     
            if(res.length > 1){
                $('#locationcode').append('<option value=""></option>');
            }
            for(i = 0; i < res.length; i++){
                $('#locationcode').append('<option value="'+res[i]['LocationCode']+'">'+res[i]['LocationName']+'</option>');
            }
        },
        error: function (msg) {
           console.log(msg);         
        }
    })
}
