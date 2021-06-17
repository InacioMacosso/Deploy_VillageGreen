////////////////////////////////////////////// Affichage produits //////////////////////////////////////////////////////

$(document).ready(function(){

    let $card = $('.instru');

    $card.click(function (e){

        let selector = $(e.target).attr('data-filter');
        $('.grid').isotope({
            filter : selector
        }).css({ margin : '20px' });

        return false;
    })
});

////////////////////////////////////////////// Message de confirmation suppression profil //////////////////////////////

    function confirmDeleteUser() {
        event.preventDefault(); // Empêche la soumission du formulaire
        var form = document.forms["delete_profil"];
        swal({
            title: "Etes-vous certain ?",
            text: "Une fois supprimé, vous ne pourrez plus voir votre profil !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Votre profil a été supprimé avec succès !", {
                        button: false,
                        icon: "success"
                    });
                    form.submit();
                } else {
                    swal("Votre profil n'a pas été supprimé !", {
                        button: "Ouf !",
                        icon: "error"
                    });
                }
            });
    }

////////////////////////////////////////////// Message de confirmation suppression profil //////////////////////////////

function confirmDeleteProduct() {
    event.preventDefault(); // Empêche la soumission du formulaire
    var form = document.forms["delete_product"];
    swal({
        title: "Etes-vous certain ?",
        text: "Une fois supprimé, vous ne pourrez plus voir le produit !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Votre produit a été supprimé avec succès !", {
                    button: false,
                    icon: "success"
                });
                form.submit();
            } else {
                swal("Votre produit n'a pas été supprimé !", {
                    button: "Ouf !",
                    icon: "error"
                });
            }
        });
}

