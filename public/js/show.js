

// .content element
const contentEl = document.querySelector('.content');


// top and bottom overlay overlay elements
const overlayRows = [...document.querySelectorAll('.overlay__row')];

// booleen pour gérer le changement d'état
var ToggleComentBool = true;

function show(obj) {
    console.log(obj);

    // remplisage de contenu
    document.getElementById('c-img').setAttribute('src', '../' + obj.produit.photo);
    document.getElementById('c-nom').innerHTML = obj.produit.nom;

    document.getElementById('c-prix').innerHTML = new Intl.NumberFormat({ style: 'currency', currency: 'XOF' }).format(obj.produit.prix)  + ' F cfa';
    document.getElementById('c-desc').innerHTML = obj.produit.description;
    document.getElementById('c-note').innerHTML = star(Math.round(obj.moyenne * 100) / 100) ;
    document.getElementById('panier_produit_id').value = obj.produit.id;
    document.getElementById('panier_produit_price').value = obj.produit.prix;


    // les commentaire
    // ajout commentaire
    const dejaCommenter = obj.commentaire.find(commentaire => commentaire.avis.user_id === obj.user);
    
    if(!dejaCommenter){
        document.getElementById('comment_header').innerHTML += `<a class='btn btn-outline ' href=./ajout_commentaire/${obj.produit.id} > Ajouter mon commentaire +</a>`
    }

    
    obj.commentaire.forEach(e => {
        document.getElementById('fils').innerHTML +=`
        <div class="chat chat-start my-5">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                <img src="${e.user[0].photo}" />
                </div>
            </div>
            <div class="chat-header">
                ${e.user[0].prenom} ${e.user[0].nom}
                <time class="text-xs opacity-50">${dateFormat(e.avis.created_at)}</time>
            </div>
            <div class="chat-bubble">${e.avis.commentaire}</div>
            <div class="chat-footer opacity-50">
                ${star(e.avis.note)}
            </div>
        </div>
        `
    });


    gsap.timeline({
        defaults: {
            duration: 1,
            ease: 'power3.inOut'
        }
    })
        .to(overlayRows, {
            scaleY: 1
        }, 'start')
        .to(contentEl, {
            // opacity: 1,
            height: "80vh",
            pointerEvents: 'all',

        }, 'content')
        .fromTo(document.getElementById('c-img'), {
            scale: "1.5",
        }, {
            scale: "1",
        }, 'content')
        .fromTo('.e',
            {
                opacity: 0,
                y: 50
            },
            {
                opacity: 1,
                y: 0,
                stagger: 0.05
            }, 'content')

}


function closeShow() {
    gsap.timeline({
        defaults: {
            duration: 1,
            ease: 'power3.inOut'
        }
    })
        .to(contentEl, {
            // opacity: 1,
            height: "0vh",
            pointerEvents: 'none',

        }, 'content')
        .to(document.getElementById('c-img'), {
            scale: "1.5",
        }, 'content')
        .to('.e',
            {
                opacity: 0,
                y: 50,
                stagger: 0.05
            }, 'content')
        .to(overlayRows, {
            scaleY: 0
        }, 'start')


}

function toggleComment() {
    
    const text = (bool) => {
        if(bool){
            return 'voir les commentaires';
        }else{
            return 'masquer les commentaires';
        }
    }

    ToggleComentBool = !ToggleComentBool;
    document.getElementById('info').classList.toggle('d-none')
    document.getElementById('comment').classList.toggle('d-none')
    document.getElementById('toggleComment').textContent = text(ToggleComentBool)
}

function star(int) {
    html = '<div class="d-flex">';

    for (let index = 1; index < 6; index++) {
        if (index <= int) {
            html += '<i class="bi bi-star-fill" style="color : yellow;"></i>';
        } else {
            html += '<i class="bi bi-star" style="color : white;"></i>'
        }
    }

    html += '</div>'
    return html;
}

function dateFormat(time) { 
    let date = new Date(time);
    return date.toLocaleString(); 
    }

