const login = document.querySelector('.login');

login.addEventListener('submit', async function(e) {

    e.preventDefault();

    const data = new FormData(this);

    await fetch("/user/check_login", {
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
             document.querySelector(".login").classList.add("visually-hidden");
             document.getElementById("outputMessage").innerHTML = `Vous êtes connecté en tant que ${response.username}`;
             document.getElementById("outputMessage").classList.add("alert-success");
             document.getElementById("outputMessage").classList.remove("visually-hidden");
        }
        else {
            document.getElementById("outputMessage").innerHTML = response.message;
            document.getElementById("outputMessage").classList.add("alert-danger");
            document.getElementById("outputMessage").classList.remove("visually-hidden");
        }
    })

})