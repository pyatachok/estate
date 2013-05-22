

function addTagForm(collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.data('prototype');

    // get the new index
    var index = collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li class="row"></li>').append(newForm);
    $newLinkLi.before($newFormLi);
    
    
    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);
}


function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<div class="span=3"><a href="#" class="btn btn-small">Delete Field</a></div>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) { 
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

// Get the ul that holds the collection of tags
var collectionHolder = $('ul.field_values');

// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="add_field_link btn btn-small">Add Field</a>');
var $newLinkLi = $('<li class="row"></li>').append($addTagLink);

jQuery(document).ready(function() {
    // add a delete link to all of the existing tag form li elements
    collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });
    
    
    // add the "add a tag" anchor and li to the tags ul
    collectionHolder.append($newLinkLi);

    // current timestamp, use that as the new
    // index when inserting a new item (e.g. 2)
    collectionHolder.data('index', new Date().getTime());

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm(collectionHolder, $newLinkLi);
    });
});

