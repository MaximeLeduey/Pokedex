const pokemonsContainer = document.querySelector('.pokemons');

const formInput = document.querySelector('#search');

let data = [];

async function fetchPokemons(number) {
 
    for(let i = 1; i <= number; i++) {
        const res =  await fetch(`https://pokeapi.co/api/v2/pokemon/${i}/`);
        const pokemon  = await res.json();
        data.push(pokemon);
    }
  


   
}

fetchPokemons(100);


async function createPokemon(name) {

    pokemonsContainer.innerHTML = "";
    
    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}/`);

    const pokemon = await res.json();

    let currentName = pokemon.name;

    let image = pokemon.sprites.front_default;

    const card = document.createElement('div');

    card.classList.add("pokemon-card");

    const imageContainer = document.createElement('div');

    imageContainer.classList.add('img-container');

    const likeContainer = document.createElement('div');

    likeContainer.classList.add('like-container');

    const like = document.createElement('img');

    likeContainer.appendChild(like);

    like.src = "/front/assets/img/like.svg";

    const img = document.createElement('img');

    img.src = image;

    imageContainer.appendChild(img);

    const nameParagraph = document.createElement('p');

    nameParagraph.textContent = currentName;

    nameParagraph.classList.add('text-center');

    card.appendChild(likeContainer);

    card.appendChild(imageContainer);

    card.appendChild(nameParagraph);

    pokemonsContainer.appendChild(card);

}


formInput.addEventListener('keyup', function(e) {

    let value = e.target.value;

    data.forEach(pokemon => {
        let name = pokemon.name;
        if(name.includes(value)) {
            createPokemon(name);
        }
    })
    
})