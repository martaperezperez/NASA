document.addEventListener("DOMContentLoaded", function(){
    const downloadButton = document.getElementById("download-button");

    if(downloadButton){
        downloadButton.addEventListener("click", function(e){
            e.preventDefault();
            const imageUrl = downloadButton.getAttribute("data-url");

            fetch(imageUrl)
                .then(response => response.blob())
                .then(blob => {
                    const link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "nasa_image.jpg";
                    link.click();
                })
                .catch(err => console.error("Error al descargar la imagen:", err));
        });
    }
});