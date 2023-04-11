<div class="row mb-1">
    <div class="col-md-4 col-12">
        <label for="date" class="obligatoire col-form-label">Date de l'épreuve</label>
        <input id="date"
               type='date'
               style="width: 160px;"
               required
               class="form-control ctrl ">
        <div class='messageErreur'></div>
    </div>
    <div class="col-md-8 col-12">
        <label for="nom" class="obligatoire col-form-label">Nom </label>
        <input id="nom"
               type="text"
               required
               maxlength="100"
               pattern="^[0-9A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ._-]+$"
               class="form-control ctrl"
               autocomplete="off">
        <div class='messageErreur'></div>
    </div>
</div>

<label for="description" class="obligatoire col-form-label">Description</label>
<textarea id='description' required minlength="30" pattern="[^<>]" required style="min-height: 250px"
          class="form-control "></textarea>
<div id="messageDescription" class='messageErreur'></div>

<div class="row mt-3">
    <div class="col-sm-12 col-md-6 ">
        <label class='col-form-label' for="dateOuverture">Début inscription </label>
        <input id='dateOuverture' type="date"
               style="width: 160px;"
               class="form-control ctrl">
        <div class='messageErreur'></div>
    </div>
    <div class="col-sm-12 col-md-6 ">
        <label class='col-form-label' for="dateFermeture">Fin inscription</label>
        <input id='dateFermeture' type="date"
               style="width: 160px;"
               class="form-control ctrl">
        <div class='messageErreur'></div>
    </div>
</div>

<label class='col-form-label' for="urlInscription">Url pour s'inscrire</label>
<input id='urlInscription'
       type="text"
       class="form-control ctrl"
       minlength='10'
       maxlength='150'
       pattern="^((http:\/\/|https:\/\/)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)"
       autocomplete="off">
<div class='messageErreur'></div>

<label class='col-form-label' for="urlInscrit">Url pour voir les inscrits</label>
<input id='urlInscrit'
       type="text"
       class="form-control ctrl"
       minlength='10'
       maxlength='150'
       pattern="^((http:\/\/|https:\/\/)?(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)"
       autocomplete="off">
<div class='messageErreur'></div>