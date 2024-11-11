document.addEventListener('DOMContentLoaded', function() {
    const apiUrl = 'http://localhost:5000/api/items';

    const itemsTableBody = document.querySelector('#itemsTable tbody');
    const addItemForm = document.getElementById('addItemForm');
    const nombreInput = document.getElementById('nombre');
    const descripcionInput = document.getElementById('descripcion');

    // Function to fetch and display items
    function fetchItems() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                itemsTableBody.innerHTML = '';
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.nombre}</td>
                        <td>${item.descripcion}</td>
                        <td>
                            <button onclick="editItem(${item.id}, '${item.nombre}', '${item.descripcion}')">Editar</button>
                            <button onclick="deleteItem(${item.id})">Eliminar</button>
                        </td>
                    `;
                    itemsTableBody.appendChild(row);
                });
            });
    }

    addItemForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const newItem = {
            nombre: nombreInput.value,
            descripcion: descripcionInput.value
        };
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newItem)
        })
        .then(response => response.json())
        .then(data => {
            fetchItems();
            addItemForm.reset();
        });
    });

    // Function to edit an item
    window.editItem = function(id, nombre, descripcion) {
        nombreInput.value = nombre;
        descripcionInput.value = descripcion;
        addItemForm.removeEventListener('submit', addItemFormSubmitHandler);
        addItemForm.addEventListener('submit', function updateItem(event) {
            event.preventDefault();
            const updatedItem = {
                nombre: nombreInput.value,
                descripcion: descripcionInput.value
            };
            fetch(`${apiUrl}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(updatedItem)
            })
            .then(response => response.json())
            .then(data => {
                fetchItems();
                addItemForm.reset();
                addItemForm.removeEventListener('submit', updateItem);
                addItemForm.addEventListener('submit', addItemFormSubmitHandler);
            });
        });
    };

    // Function to delete an item
    window.deleteItem = function(id) {
        fetch(`${apiUrl}/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            fetchItems();
        });
    };

    // Initial fetch of items
    fetchItems();
});