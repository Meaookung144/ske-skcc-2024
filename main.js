const fs = require('fs');
const filePath = './json.json'; // Path to your JSON file

// Read the JSON file
fs.readFile(filePath, 'utf8', (err, data) => {
    if (err) {
        console.error('Error reading file:', err);
        return;
    }

    // Parse the JSON data
    let jsonData = JSON.parse(data);

    // Modify the data (Example: updating a property)
    jsonData.name = "Updated Name"; // Assuming "name" is a property in your JSON

    // Stringify the modified data
    const updatedData = JSON.stringify(jsonData, null, 2); // The `null, 2` helps with formatting the JSON

    // Write the updated data back to the file
    fs.writeFile(filePath, updatedData, 'utf8', (err) => {
        if (err) {
            console.error('Error writing file:', err);
        } else {
            console.log('JSON file updated successfully!');
        }
    });
});
