function createDiv () {
    return document.createElement("div");
}

function createInput (name, type, value = null) {
    let input = document.createElement("input");
    input.name = name;
    input.type = type;
    input.value = value;
    return input;
}

function createTextarea (name, classname = null, value = null) {
    console.log(classname);
    let textarea = document.createElement("textarea");
    textarea.name = name;
    textarea.value = value;
    textarea.className = classname;

    return textarea;
}

function createHeader (contentCounter, level = 'h2', value = null) {
    let div = createDiv();
    div.append(
        createInput('content[' + contentCounter + '][level]', 'text', level),
        createInput('content[' + contentCounter + '][value]', 'text', value),
        createInput('content[' + contentCounter + '][type]', 'hidden', 'header')
    );

    return div;
}

function createParagraph (contentCounter, value = null) {
    let div = createDiv();
    div.append(
        createTextarea('content[' + contentCounter + '][value]', 'paragraph', value),
        createInput('content[' + contentCounter + '][type]', 'hidden', 'paragraph'),
    );

    return div;
}

function recreate(json) {

}
