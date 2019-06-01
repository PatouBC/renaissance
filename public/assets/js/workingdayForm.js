function addItemFormDeleteLink($itemFormLi) {
    var $removeFormButton = $('<button type="button">Supprimer</button>');
    $itemFormLi.append($removeFormButton);
    $removeFormButton.on('click', function(e) {
        $itemFormLi.remove();
    });
}

function addItemForm($collectionHolder, $newItemLi) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<div></div>').append(newForm);
    $newItemLi.before($newFormLi);
    addItemFormDeleteLink($newFormLi);
}

$(document).ready(function(){
    console.log("JQUERY READY");

    var $collectionHolder;
    var $addItemButton = $('<button type="button" class="add_item_link">Ajouter un créneau</button>');
    var $newItemLi = $('<div></div>').append($addItemButton);

    $collectionHolder = $('#workingday_timeslots');
    $collectionHolder.append($newItemLi);

    $collectionHolder.find('.timeslot').each(function() {
        addItemFormDeleteLink($(this));
    });
    $collectionHolder.data('index', $collectionHolder.find('.timeslot').length);
    $addItemButton.on('click', function(e) {
        addItemForm($collectionHolder, $newItemLi);
    });
});