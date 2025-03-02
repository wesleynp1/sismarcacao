const inputImagem = document.getElementById('inputImagem');
const imgPreview = document.getElementById('imgPreview');

const leitorDeArquivo = new FileReader();
const larguraMaxima = 1080;
const alturaMaxima = 1080;

//Quando o usuário fizer o upload o leitorDeArquivos lê os dados
inputImagem.onchange = ()=>{
    leitorDeArquivo.readAsDataURL(inputImagem.files[0]);
}

//Quando ele terminar de ler altera-se o preview
leitorDeArquivo.onload = ()=>{

    elementoImagem = document.createElement("img");    

    elementoImagem.onload = (event)=>{
        
        //mantem a proporção da imagem para não haver distorções
        if(elementoImagem.width > larguraMaxima || elementoImagem.height > alturaMaxima){
            if(elementoImagem.width  == elementoImagem.height){
                elementoImagem.width,elementoImagem.height = alturaMaxima
            }else
            if(elementoImagem.width  >  elementoImagem.height){
                elementoImagem.height = (elementoImagem.height/elementoImagem.width)*larguraMaxima;
                elementoImagem.width = larguraMaxima;               
            }else
            if((elementoImagem.height  >  elementoImagem.width)){
                elementoImagem.width = (elementoImagem.width/elementoImagem.height)*alturaMaxima;
                elementoImagem.height = alturaMaxima;
            }
        }

        //Cria um elemento canvas para redimesionar a imagem
        let meuCanvas = document.createElement("canvas");
        meuCanvas.width = elementoImagem.width;
        meuCanvas.height = elementoImagem.height;
        let contexto = meuCanvas.getContext("2d");
        contexto.drawImage(elementoImagem,0,0,elementoImagem.width,elementoImagem.height);

        //Exibe a imagem redimensionada
        urlImagemRedimesionada = meuCanvas.toDataURL();
        imgPreview.src = urlImagemRedimesionada;

        meuCanvas.toBlob(b=>{
            let arquivoImagemRedimesionada = new File([b],"imagemCarregadaPeloUsuário.png",{type: "image/png"});
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(arquivoImagemRedimesionada);

            inputImagem.files = dataTransfer.files;
        })
    }

    elementoImagem.src = leitorDeArquivo.result;
}

function getProporcaoImagem(img){

}