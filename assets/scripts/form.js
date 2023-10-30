//Random Picture Register
// Tableau d'URLs d'images
const imageUrls = [
    '/build/images/random/1.jpg',
    '/build/images/random/2.jpg',
    '/build/images/random/3.jpg',
    '/build/images/random/4.jpg',
];

// Générer un nombre aléatoire entre 0 et 3 (pour accéder au tableau)
const randomNumber = Math.floor(Math.random() * imageUrls.length);

// Sélectionner l'élément à mettre à jour
const randomImageContainer = document.getElementById('random-image-container');

// Appliquer l'URL de l'image aléatoire en tant que background-image
randomImageContainer.style.backgroundImage = `url(${imageUrls[randomNumber]})`;