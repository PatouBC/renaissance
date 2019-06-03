function addItemFormDeleteLink($itemForm) {
    var $removeFormButton = $('<button class="btn btn-danger" type="button">Supprimer</button>');
    $itemForm.append($removeFormButton);
    $removeFormButton.on('click', function(e) {
        $itemForm.remove();
    });
}
function addItemForm($collectionHolder, $newItem) {
    var prototype;
    var index;
    var newForm;
    for(var i=0; i<4; i++){
        prototype = $collectionHolder.data('prototype');
        index = $collectionHolder.data('index');
        newForm = prototype;
        newForm = newForm.replace(/__name__/g, index);
        $collectionHolder.data('index', index + 1);
        var $newFormLi = $('<div></div>').append(newForm);
        $newItem.before($newFormLi);
        addItemFormDeleteLink($newFormLi);
    }
}

$(document).ready(function(){

    var $collectionHolder;
    var $addItemButton = $('<button type="button" class="btn btn-light add_item_link">Ajouter 4 créneaux</button>');
    var $newItem = $('<div></div>').append($addItemButton);

    $collectionHolder = $('#workingday_timeslots');
    $collectionHolder.append($newItem);

    $collectionHolder.find('.timeslot').each(function() {
        addItemFormDeleteLink($(this));

    });
    $collectionHolder.data('index', $collectionHolder.find('.timeslot').length);
    $addItemButton.on('click', function(e) {
        addItemForm($collectionHolder, $newItem);
    });
});