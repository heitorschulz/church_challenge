
states_ = []
cities_ = []

async function fetchStatesJSON() {
    const URL_TO_FETCH = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome';

    const response = await fetch(URL_TO_FETCH);
    const states = await response.json();
    return states;
}

fetchStatesJSON().then(states => {
    states_ = states; // fetched movies
    console.log(states_)

    var select = document.getElementById("member_form_state");
    for (index in states_) {
        select.options[select.options.length] = new Option(states_[index].sigla, index);
    }
});

async function fetchCitiesJSON(sigla) {
    const URL_TO_FETCH = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + sigla + '/municipios';

    const response = await fetch(URL_TO_FETCH);
    const cities = await response.json();
    return cities;
}

let select = document.getElementById("member_form_state");

select.addEventListener("change", (e) => {
    status.innerText = select.value
    console.log(e)
    console.log(states_[select.value].sigla)

    fetchCitiesJSON(states_[select.value].sigla).then(cities => {
        cities_ = cities; // fetched movies
        console.log(cities_)

        var selectobject = document.getElementById("member_form_city");
        var i, L = selectobject.options.length - 1;
        for (i = L; i >= 0; i--) {
            selectobject.remove(i);
        }

        var select2 = document.getElementById("member_form_city");
        for (index in cities_) {
            select2.options[select2.options.length] = new Option(cities_[index].nome, index);
        }
    });
});

