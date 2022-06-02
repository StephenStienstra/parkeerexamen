function BuildMapMarker(adres, postcode, aantalplekken, ID_Parkeerplaats, latitude, longitude){

    var popupcontent = `

        <div class="row">
            <p class="col-xs-1 center-block text-center">
                Adres: `+adres+`<br>
                Postcode: `+postcode+`<br>
                Aantal plekken: `+aantalplekken+`<br>
            </p>
            <div class="col-xs-1 center-block text-center">
                <input type="hidden" name="ID_Parkeerplaats" value="`+ID_Parkeerplaats+`">
                <input name ="start" type="submit" class="btn btn-primary" value="Start parkeren">

            </div>
        </div>

    `;
    L.marker([latitude, longitude]).addTo(map)
    .bindPopup(popupcontent)
    .openPopup();

}
