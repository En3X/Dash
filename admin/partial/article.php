<link rel="stylesheet" href="./css/article.css">

<div id="articleModal" class="modal-wrapper hide">
    <div class="modal">
        <div class="modal-head kbold">
            <div><i class="fa fa-plus"></i>
                Add Article</div>
            <div>
                <i style="cursor:pointer" id="closeModal" class="fa fa-close"></i>
            </div>
        </div>
        <div class="modal-body">
            <div class="input-group">
                <input id="title" type="text" placeholder="Article Title">
            </div>
            <div class="input-group">
                <textarea id="article" placeholder="Article Description"></textarea>
            </div>
            <button id="add" class="add">
                <i class="fa fa-plus"></i>
                Add
            </button>
        </div>
    </div>
</div>