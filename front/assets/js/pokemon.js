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
    
    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}/`);

    const pokemon = await res.json();

    let currentName = pokemon.name;

    let image = pokemon.sprites.front_default;

    const card = document.createElement('div');

    card.classList.add('pokemon-card');

    const imageContainer = document.createElement('div');

    imageContainer.classList.add('img-container');

    imageContainer.src = image;

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