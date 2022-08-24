<h1>Criar</h1>
<div id="event-create-conteiner" class="col-md-6 offset-md-3">
    <h1>Crie seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        {{--Diretiva obrigatoria no LARAVEL, senão não permite adicionar dados no bd--}}
        {{--enctype é obrigatorio ter, caso queira receber arrquivos do formulario--}}
        <div class="form-grup">
            <label for="imagem">Foto do evento</label>
            <input type="file" class="form-controll-file" id="imagem" name="imagem" >
        </div>
        <div class="form-grup">
            <label for="title">Título</label>
            <input type="text" class="form-controll" id="title" name="title" placeholder="Digite o nome do evento">
        </div>
        <div class="form-group">
            <label for="date">Data do evento</label>
            <input type="date" name="date" id="date">
        </div>
        <div class="form-grup">
            <label for="title">Cidade</label>
            <input type="text" class="form-controll" id="cidade" name="cidade" placeholder="Digite a cidade do evento">
        </div>
        <div class="form-grup">
            <label for="title">O evento é privado</label>
            <select name="privado" id="privado" class="form-controll">
                <option value="0">Público</option>
                <option value="1">Privado</option>
            </select>
        </div>
        <div class="form-grup">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="from-controller"></textarea>   
        </div>
        <div class="from-grup">
            <label for="items">Items</label>
            <div class="from-grup">
                <input type="checkbox" name="items[]" value="palco">palco
              </div>
            <div class="from-grup">
                <input type="checkbox" name="items[]" value="bebidas">bebidas
              </div>
            <div class="from-grup">
                <input type="checkbox" name="items[]" value="brindes">brindes
            </div>
            <div class="from-grup">
                <input type="checkbox" name="items[]" value="cadeiras">cadeiras
            </div>
        </div>
        <input type="submit" class="btn btm-primary" value="Criar">
    </form>
</div>