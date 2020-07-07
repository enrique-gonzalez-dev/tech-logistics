function infoDriver(driver) {
    var reference = db.ref('drivers/');
    reference.on('value', function(datas) {
        var data = datas.val();
        var sendOption;
        $.each(data, function(nodo, value) {
            if (driver == value.name) {
                sendOption = '<label> Nombre del Chofer: ' + value.name + '</label><br>' +
                    '<label> ID/No. de Telefono: ' + value.id + '</label><br>';
                inHTML('editData', sendOption);
            }

        });
    });
}

function drivers() {
    var reference = db.ref('drivers/');
    reference.on('value', function(datas) {
        var data = datas.val();
        var flag = true;
        var sendOption;
        $.each(data, function(nodo, value) {
            if (flag) {
                sendOption = '<select name="driverList" id="driver" class="form-control"><option value="0" >Seleccione Chofer</option>';
                flag = false;
            }
            sendOption += '<option value="' + value.id + '">' + value.name + '</option>';
            inHTML('option', sendOption);
        });
    });
}