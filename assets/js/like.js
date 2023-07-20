let heartVides = document.querySelectorAll('.heartVide');
let estPlein = false;

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
                estPlein = !estPlein;
                heartVide.src = data['total_likes'] == 1 ? "../assets/svg/heartPlein.svg" : "../assets/svg/heartVide.svg";
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });

});


