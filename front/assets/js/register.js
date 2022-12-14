// redirection


async function login_controller() {
    await fetch('/user/is_logged')
    .then((result => {
        return result.text();
    }))
    .then((response => {
        response = JSON.parse(response);
        if(response.connected == 1) {
            document.location.href = "http://pokedex.test/user/search";
        }
    }))
}

login_controller();




const register = document.querySelector('.register');



 register.addEventListener('submit', async function(e) {

    e.preventDefault();
  
    const data = new FormData(this);
   
   
    await fetch("/user/check_register", {
        method : "POST",
        body : data
    })
    .then((result) => {
        // if (result.status != 200) { throw new Error("Bad Server Response"); }
        // return result
        return result.text();
      })
    .then((response) => {
        console.log(response);
        response = JSON.parse(response);
        if(response.success === 1) {
            document.getElementById("formRegister").classList.add("visually-hidden");
            document.getElementById("outputMessage").innerHTML = `Bravo ${response.username}, vous êtes désormais enregistré avec votre adresse ${response.email}`;
            document.getElementById("outputMessage").classList.add("alert-success");
            document.getElementById("outputMessage").classList.remove("visually-hidden");
            document.location.href = "http://pokedex.test/user";
        }
        else {
            document.getElementById("outputMessage").innerHTML = response.message;
            document.getElementById("outputMessage").classList.add("alert-danger");
            document.getElementById("outputMessage").classList.remove("visually-hidden");
        }
    })

    return false;

})





