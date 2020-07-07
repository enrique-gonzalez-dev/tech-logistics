var db = firebase.database();

function value(request) {
    return document.getElementById(request).value;
}

function asignation(request, response) {
    return document.getElementById(request).value = response;
}

function printHTML(request, response) {
    return document.getElementById(request).innerHTML += response;
}

function inHTML(request, response) {
    return document.getElementById(request).innerHTML = response;

}


//Folio

function NewFolio() {
    var fol = new Date();
    return fol.getDate() + "" + (fol.getMonth() + 1) + "" + fol.getSeconds() + "" + fol.getMilliseconds();
}

function getDriverName(driver) {
    var name;
    var reference = db.ref('drivers/');
    reference.on('value', function(datas) {
        var data = datas.val();
        $.each(data, function(nodo, value) {
            if (driver == value.id) {
                name = value.name;
            }

        });

    });
    return name;
}

function newStatus() {
    return 0;
}

function estmatedTime() {
    return 'No definido';
}

function insertTask(driver, client, origin, destiny, description, date) {
    db.ref('trans/').push({
        folio: NewFolio(),
        status: newStatus(),
        nameDriver: getDriverName(driver),
        driver: driver,
        client: client,
        origin: origin,
        destiny: destiny,
        description: description,
        date: date,
        estimated: estmatedTime()
    });
}

function onClickInsert() {
    var driver = value("driver");
    var client = value("client");
    var destiny = value("destiny");
    var origin = value("origin");
    var description = value("description");
    var date = value("datePK");

    if (driver == 0 || description.length == 0 || origin.length == 0 || destiny.length == 0 || client.length == 0 || date.length == 0) {
        alert("Ingrese incidencia valida");
    } else {
        inHTML("loadTable", "");
        insertTask(driver, client, origin, destiny, description, date);
        asignation("driver", "");
        asignation("client", "");
        asignation("origin", "");
        asignation("destiny", "");
        asignation("description", "");
        asignation("datePK", "");
        alert("Incidencia creada correctamente");
    }
}

function checkStatus(ST) {
    if (ST == 0) {
        return "Surtiendo";
    }
    if (ST == 1) {
        return "En transito";
    }
    if (ST == 2) {
        return "En sitio";
    }
    if (ST == 3) {
        return "Entregado";
    } else {
        return "No existe"
    }

}

function table(folio, driver, client, origin, destiny, description, date, status, estimated) {
    return '<tr><td>' +
        folio + '</td><td>' +
        driver + '</td><td>' +
        '<button class="btn" data-toggle="modal" data-target="#modalDriver" onclick="infoDriver(\'' + driver + '\')">' +
        '<i class="fas fa-info-circle"></i></button></td><td>' +
        client + '</td><td>' +
        origin + '</td><td>' +
        destiny + '</td><td>' +
        description + '</td><td>' +
        date + '</td><td>' +
        checkStatus(status) + '</td><td>' +
        estimated + '</td></tr>';

}

var reference = db.ref('trans/');
reference.on('value', function(datas) {
    var data = datas.val();
    $.each(data, function(nodo, value) {
        if (value.status < 3) {
            var sendData = table(value.folio, value.nameDriver, value.client, value.origin,
                value.destiny, value.description, value.date, value.status, value.estimated, nodo);
            printHTML('loadTable', sendData);
        }
    });
});




//Funcion tabla terminado


function tableFin(folio, driver, client, origin, destiny, description, date) {
    return '<tr><td>' +
        folio + '</td><td>' +
        driver + '</td><td>' +
        '<button class="btn" data-toggle="modal" data-target="#modalDriver" onclick="infoDriver(\'' + driver + '\')">' +
        '<i class="fas fa-info-circle"></i></button></td><td>' +
        client + '</td><td>' +
        origin + '</td><td>' +
        destiny + '</td><td>' +
        description + '</td><td>' +
        '<button class="btn" data-toggle="modal" data-target="#exampleModalScrollable" onclick="viewDocuments(\'' + folio + '\')">' +
        '<i class="far fa-file-alt"></i></button>' + '</td></tr>';
}
var reference = db.ref('trans/');
reference.on('value', function(datas) {
    var data = datas.val();
    $.each(data, function(nodo, value) {
        if (value.status == 3) {
            var sendData = tableFin(value.folio, value.nameDriver, value.client, value.origin, value.destiny, value.description, nodo);
            printHTML('loadTableFin', sendData);
        }
    });
});

//Selection driver

//Ordenar busqueda
(function(document) {
    'use strict';

    var LightTableFilter = (function(Arr) {

        var _input;

        function _onInputEvent(e) {
            _input = e.target;
            var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
            Arr.forEach.call(tables, function(table) {
                Arr.forEach.call(table.tBodies, function(tbody) {
                    Arr.forEach.call(tbody.rows, _filter);
                });
            });
        }

        function _filter(row) {
            var text = row.textContent.toLowerCase(),
                val = _input.value.toLowerCase();
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }

        return {
            init: function() {
                var inputs = document.getElementsByClassName('light-table-filter');
                Arr.forEach.call(inputs, function(input) {
                    input.oninput = _onInputEvent;
                });
            }
        };
    })(Array.prototype);

    document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });

})(document);

//Ordenar busqueda fin
(function(document) {
    'use strict';

    var LightTableFilter = (function(Arr) {

        var _input;

        function _onInputEvent(e) {
            _input = e.target;
            var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
            Arr.forEach.call(tables, function(table) {
                Arr.forEach.call(table.tBodies, function(tbody) {
                    Arr.forEach.call(tbody.rows, _filter);
                });
            });
        }

        function _filter(row) {
            var text = row.textContent.toLowerCase(),
                val = _input.value.toLowerCase();
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }

        return {
            init: function() {
                var inputs = document.getElementsByClassName('light-table-filter2');
                Arr.forEach.call(inputs, function(input) {
                    input.oninput = _onInputEvent;
                });
            }
        };
    })(Array.prototype);

    document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });

})(document);


//Modal Info Chofer