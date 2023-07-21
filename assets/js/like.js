let heartVides = document.querySelectorAll('.heartVide');

heartVides.forEach(heartVide => {

    heartVide.addEventListener('click', (e) => {
        e.preventDefault();

        // parentNode = heartVide.parentNode
        // console.log(parentNode)
        let postId = heartVide.dataset.post; // id du post que je souhaites liker/dé-liker


        fetch(`api.php?id=${postId}`) // on utilise le fetch pour envoyer la requête

            .then(heartVide => heartVide.json())
            .then(data => {
                console.log(data); // on traite la réponse si il faut

                heartVide.src = data === 'likes' ? "../assets/svg/heartPlein.svg" : "../assets/svg/heartVide.svg";

                test()

            })
            .catch(error => {
                console.error('Error:', error);
            });

    });

});


function test() {

    let articles = document.querySelectorAll('article[data-article]');

    articles.forEach(function (article) {

        let postId = article.dataset.article; // id du post que je souhaites liker/dé-liker

        fetch(`api.php?post=${postId}`) // on utilise le fetch pour envoyer la requête

            .then(reponse => reponse.json())
            .then(data => {
                console.log(data); // on traite la réponse si il faut


                let likeCounter = document.querySelector('span[data-article="'+ postId +'"]');
                console.log(likeCounter); // on traite

                // Mise à jour du compteur de likes
                likeCounter.innerHTML = data['total_likes']; // Mettre à jour le contenu du compteur avec le nombre de likes

            })
            .catch(error => {
                console.error('Error:', error);
            });

    });


}

document.addEventListener('DOMContentLoaded', test); // Le HTML est chargé, je fait ce que je veux