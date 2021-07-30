console.log('dans fichier js')



document.addEventListener('DOMContentLoaded', () => {

    // Select elements by their data attribute
    const entryElements =
        document.querySelectorAll('[data-entry-id]');

    // Map over each element and extract the data value
    const entryIds =
        Array.from(entryElements).map(
            item => item.dataset.entryId
        );

    // You'll now have an array containing string values
    console.log("message js externe3: " + entryIds); // eg: ["1", "2", "3"]
});