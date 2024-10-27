<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.tailwindcss.css">
</head>
<style>
    body{
        background-color: black;
        color: white;
        font-family: 'IBM Plex Sans Thai', sans-serif;
        font-size: small;
        overflow: hidden;
    }
</style>
<body>
    <div id="image"></div>
    <div id="content"></div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        setInterval(() => {
        fetch('config.json')
        .then(response => response.json())
        .then(data => {
            const imageContainer = document.getElementById('image');
            const existingImg = imageContainer.querySelector('img');
            const existingOverlay = imageContainer.querySelector('div');
            if(id >= 20 && id <= 30){
                
            }else{
                if (data.value === 'same' || data.status === 'same') {
                    if (existingImg && existingImg.alt !== 'Default Image') {
                        imageContainer.removeChild(existingImg);
                    }
                    if (!existingImg) {
                        const newImg = document.createElement('img');
                        newImg.src = 'image/default.png';
                        newImg.alt = 'Default Image';
                        newImg.style.width = '100vw';
                        newImg.style.height = '100vh';
                        newImg.style.objectFit = 'cover';
                        imageContainer.appendChild(newImg);
                    }
                    if (existingOverlay) {
                        imageContainer.removeChild(existingOverlay);
                    }
                } else if(data.value === 'black' || data.status === 'black'){
                    if (existingImg && existingImg.alt !== 'Default Image') {
                        imageContainer.removeChild(existingImg);
                    }
                    if (!existingImg) {
                        const newImg = document.createElement('img');
                        newImg.src = 'image/black.png';
                        newImg.alt = 'Default Image';
                        newImg.style.width = '100vw';
                        newImg.style.height = '100vh';
                        newImg.style.objectFit = 'cover';
                        imageContainer.appendChild(newImg);
                    }
                    if (existingOverlay) {
                        imageContainer.removeChild(existingOverlay);
                    }
                } else if(data.value === 'one' || data.status === 'one'){
                    if (existingImg && existingImg.alt !== 'Default Image') {
                        imageContainer.removeChild(existingImg);
                    }
                    if(id>2){

                    }
                    if (existingOverlay) {
                        imageContainer.removeChild(existingOverlay);
                    }
                } else {
                    if (existingImg) {
                        if (existingImg.alt === 'Default Image') {
                            imageContainer.removeChild(existingImg);
                        }
                    }
                    if (!existingOverlay) {
                        const textOverlay = document.createElement('div');
                        textOverlay.innerText = 'Page ID : ' + id;
                        textOverlay.style.position = 'absolute';
                        textOverlay.style.top = '25px';
                        textOverlay.style.left = '25px';
                        textOverlay.style.color = 'white';
                        textOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                        textOverlay.style.padding = '1px';
                        textOverlay.style.borderRadius = '1px';
                        imageContainer.appendChild(textOverlay);
                    }
                    const images = {
                        '1': '1.png',
                        '2': '2.png',
                        '3': '3.png',
                        '4': '4.png',
                        '5': '5.png',
                        '6': '6.png',
                        '7': '7.png',
                        '8': '8.png',
                    };
                    if (images[id]) {
                        if (existingImg && existingImg.alt !== 'Default Image') {
                            imageContainer.removeChild(existingImg);
                        }
                        const img = document.createElement('img');
                        img.src = 'image/' + images[id];
                        img.alt = 'Image for ID ' + id;
                        img.style.width = '100vw';
                        img.style.height = '100vh';
                        img.style.objectFit = 'cover';
                        imageContainer.appendChild(img);
                    } else {
                        if (!existingOverlay) {
                            const noImageMessage = document.createElement('div');
                            noImageMessage.innerText = 'Image not found for ID: ' + id;
                            noImageMessage.style.color = 'white';
                            imageContainer.appendChild(noImageMessage);
                        }
                    }
                }
            }
        })
        .catch(error => console.error('Error fetching config.json:', error));
}, 300);
    </script>
</body>
</html>