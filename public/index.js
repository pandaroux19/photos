document.addEventListener("DOMContentLoaded", () => {
    const addPhoto = document.getElementById("add-photo")
    const form = document.querySelector("#add>.input-fields")

    const box = `<input type="text" name="titre-photo[]" required placeholder="Titre"><input type="text" name="url[]" required placeholder="Lien de l'image"><input type="number" name="note[]" required placeholder="Note"><input type="text" name="tags[]" required placeholder="Les tags"><button id="remove-photo">Supprimer la photo</button>`

    if (addPhoto) {
        addPhoto.addEventListener("click", (e) => {
            e.preventDefault();
            div = document.createElement("div")
            div.innerHTML=box
            form.appendChild(div)
            removePhoto()
        })
    }


    function removePhoto(){
        const photos = document.querySelectorAll("#add>.input-fields>div")
        if (photos) {
            photos.forEach(photo => {
                photo.querySelector("#remove-photo").addEventListener("click", (e) => {
                    e.preventDefault();
                    photo.remove()
                })
            })
        }
    }
    removePhoto()
})