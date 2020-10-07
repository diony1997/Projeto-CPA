var array_imagens = [imagem1.png, imagem2.jpg, imagem3.png, imagem4.jpg];

function displayImage()
{
    var num = Math.floor(Math.random() * (array_imagens.length+1));
    document.canvas.src = array_imagens[num];
}