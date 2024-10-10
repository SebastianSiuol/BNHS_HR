let designationCounter = 2;

var addCreateDesignationButton = document.getElementById("add-designation-button");
addCreateDesignationButton.addEventListener("click", addCreateDesignation);

var addEditDesignationButton = document.getElementById("add-edit-designation-button");
addEditDesignationButton.addEventListener("click", addEditDesignation)

function addCreateDesignation () {

    const newDesignationField = document.createElement('input');

    newDesignationField.className = 'block mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5';
    newDesignationField.id = `designation${designationCounter}`;
    newDesignationField.type = 'text';
    newDesignationField.placeholder = 'Designation';
    newDesignationField.setAttribute('name', 'designation[]');

    document.getElementById('designation-fields').appendChild(newDesignationField);

    designationCounter++;

    if(designationCounter === 6){
        addCreateDesignationButton.classList.add("hidden");
    }
}

function addEditDesignation () {

    console.log(existingDesignationCounter);

    const newDesignationField = document.createElement('input');

    newDesignationField.className = 'block mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5';
    newDesignationField.id = `designation${designationCounter}`;
    newDesignationField.type = 'text';
    newDesignationField.placeholder = 'Designation';
    newDesignationField.setAttribute('name', 'designation[]');

    document.getElementById('designation-fields').appendChild(newDesignationField);

    // designationCounter++;

    // if(designationCounter === 6){
    //     addDesignationButton.classList.add("hidden");
    //
    // }
}


