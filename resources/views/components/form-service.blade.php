<form class="form" id="formService" action="createService" method="post" enctype="multipart/form-data">
    @csrf

    <img src="" alt="" id="imgPreview">
    <label for="inputImage">Imagem</label>
    <input type="file" name="image" id="inputImagem"  accept="image/png, image/jpeg">
    
    <label for="inputNome" >Nome</label>
    <input type="text" name="name" id="inputNome" required>
    <br>

    <label for="inputPreco">Preço</label>
    <input type="text" name="price" value="0" id="inputPreco" required>
    <br>

    <label for="inputDescricao">Descrição</label>
    <div id="editor">
        <p>Descreva o produto aqui...</p>
    </div>           
    <br>

    <input type="submit" id="botaoSubmit" value="CADASTRAR">
</form>    

<style>
    #formService{
        display: flex;        
        flex-direction: column;
    }
</style>

<script>
    const inputPreco  = document.getElementById("inputPreco");            
    const formulario  = document.getElementById("formService");
</script>
<script src="/js/inputPreco.js"></script>
<script src="/js/inputImagem.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    formulario.onsubmit = ()=>{
        let input = document.createElement("input");
        
        input.type = "text";
        input.value = quill.getSemanticHTML();
        input.name = "description";
        input.hidden = true;

        formulario.append(input);
    }
</script>