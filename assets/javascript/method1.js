console.log('12345')

console.log('12346')

getUFs()

console.log('12347')

function getUFs() {
    console.log('entrou');

    const url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

    const URL_TO_FETCH = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';

    fetch(URL_TO_FETCH, {
    method: 'get' // opcional
    })
    .then(function(response) {
        console.log("aqui!!!")
        console.log(response.json())
    // use a resposta
    })
    .catch(function(err) {
    console.error(err);
});

    // fetch(url)
    // .then((resp) => console.log(resp.json()))
    // .then(function(data) {
    //     let result = data.results;
    //     console.log(result)

    //     // return authors.map(function(author) {
    //     //     let li = createNode('li');
    //     //     let img = createNode('img');
    //     //     let span = createNode('span');
    //     //     img.src = author.picture.medium;
    //     //     span.innerHTML = `${author.name.first} ${author.name.last}`;
    //     //     append(li, img);
    //     //     append(li, span);
    //     //     append(ul, li);
    //     // })
    // })
    // .catch(function(error) {
    //     console.log(error);
    // });
}

