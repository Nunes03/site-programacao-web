var photoPath = "../../assets/";

validateUserPhoto();

function validateUserPhoto() {

    fetch('components\login\login.css')
    .then(response => response.text())
    .then(text => {
      const array = text.split("\n");
      console.log(array);
    });

const fs = require('../../assets/emptyPicture.jpg');
if (!fs) {
    photoPath =+ "emptyPicture"
 } else {
    photoPath =+ "userPicture"
}

}

function setForm(user) {
    const password = document.getElementById("password");
}