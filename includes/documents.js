var ultimoFolio = 0;

function saveDocuments() {
    var reference = db.ref('documents/' + ultimoFolio + '/');
    var doc = new jsPDF();
    reference.on('value', function(datas) {
        var data = datas.val();
        const rute = 'data:image/jpeg;base64,';
        $.each(data, function(nodo, value) {
            var imgData = rute + value.doc;
            doc.text(20, 20, 'Imagen' + nodo);
            doc.addImage(imgData, 'JPEG', 15, 40, 180, 160);
            doc.addPage();
            console.log("Resource:" + imgData);
            console.log(nodo);

        });
        doc.save('Documents-ID-' + ultimoFolio + '.pdf');
        alert("Descarga exitosa");
    });
}


//Carrousel

function inHTML(request, response) {
    return document.getElementById('image-carousel').innerHTML = response;
}

function viewDocuments(folio) {
    ultimoFolio = folio;
    var reference = db.ref('documents/' + folio + '/');
    reference.on('value', function(datas) {
        var data = datas.val();
        const rute = 'data:image/jpeg;base64,';
        var flag = true;
        var sendImage = '';
        var imgSource;
        $.each(data, function(nodo, value) {
            imgSource = rute + value.doc;
            if (flag == true) {
                sendImage += '<div class="carousel-inner"><div class="carousel-item active"><img src=' + "'" + imgSource + "'" + ' class="d-block w-100" alt="..."></div>';
                flag = false;
                console.log("Imagen 1");
            } else {
                sendImage += '<div class="carousel-item"><img src=' + "'" + imgSource + "'" + ' class="d-block w-100" alt="..."></div>';
                console.log("Imagen 2");
            }

        });
        console.log(sendImage);
        inHTML('image-carousel', sendImage);
    });

}