//Random Picture Register
// Tableau d'URLs d'images
const imageUrls = [
    '/images/random/1.jpg',
    '/images/random/2.jpg',
    '/images/random/3.jpg',
    '/images/random/4.jpg',
];

// Générer un nombre aléatoire entre 0 et 4 (pour accéder au tableau)
const randomNumber = Math.floor(Math.random() * imageUrls.length);

// Sélectionner l'élément à mettre à jour
const randomImageContainer = document.getElementById('random-image-container');

// Appliquer l'URL de l'image aléatoire en tant que background-image
randomImageContainer.style.backgroundImage = `url(${imageUrls[randomNumber]})`;
//END OF RANDOM


// REDIRECT AFTER POST TIPS
    const elementToFocus = "{{ app.session.get('element_to_focus') }}";
    if (elementToFocus) {
        const element = document.getElementById(elementToFocus);
        if (element) {
            element.scrollIntoView({behavior: 'smooth'});
        }
    }
// END OF REDIRECT

// LETTERS COUNT on POST TIPS
    const nbrLetters = document.getElementById('nbrLetters');
    const textarea = document.querySelector('textarea');
    const countChar = (text) => {
    return text.trim().length;
}
    textarea.value ="";

    textarea.addEventListener("keyup", (e) =>{
    if(e.target.value !== ""){
    nbrLetters.textContent = countChar(e.target.value);
} else{
    nbrLetters.textContent = 0;
}
})
// END OF LETTERS COUNT


