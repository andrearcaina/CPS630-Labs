$(document).ready(function() {
    function fetchTableData(table) {
        $.get('../api/crud.php', { action: 'select', table: table }, function(response) {
            if (response.status === 'success') {
                let rows = '';
                response.data.forEach(function(row) {
                    rows += '<tr>';
                    for (const key in row) {
                        rows += `<td contenteditable="true" data-column="${key}" data-id="${row[Object.keys(row)[0]]}" data-table="${table}">${row[key]}</td>`;
                    }
                    rows += `<td><button class="delete-btn" data-id="${row[Object.keys(row)[0]]}" data-table="${table}" data-id-column="${Object.keys(row)[0]}">Delete</button></td>`;
                    rows += '</tr>';
                });
                $(`#${table.toLowerCase()}-table tbody`).html(rows);
            } else {
                alert(response.message);
            }
        }, 'json');
    }

    $('#insert-form').on('submit', function(e) {
        e.preventDefault();
        const table = $('#table').val();
        const formData = $(this).serializeArray();
        const fields = {};
        formData.forEach(function(field) {
            if (field.name !== 'table') {
                fields[field.name] = field.value;
            }
        });
        $.post('../api/crud.php', { action: 'insert', table: table, fields: fields }, function(response) {
            if (response.status === 'success') {
                alert('Record inserted successfully!');
                location.reload();
            } else {
                alert('Error inserting record: ' + response.message);
            }
        }, 'json');
    });

    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        const table = $(this).data('table');
        const idColumn = $(this).data('id-column');
        if (confirm('Are you sure you want to delete this record?')) {
            $.post('../api/crud.php', { action: 'delete', table: table, id: id, id_column: idColumn }, function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    location.reload();
                } else {
                    alert('Error deleting record: ' + response.message);
                }
            }, 'json');
        }
    });

    let originalValue;

    $(document).on('focus', 'td[contenteditable="true"]', function() {
        originalValue = $(this).text();
    });

    $(document).on('blur', 'td[contenteditable="true"]', function() {
        const id = $(this).data('id');
        const table = $(this).data('table');
        const column = $(this).data('column');
        const value = $(this).text();
        const idColumn = $(this).closest('tr').find('td').first().data('column');

        if (value !== originalValue) {
            $.post('../api/crud.php', { action: 'update', table: table, id: id, id_column: idColumn, column: column, value: value }, function(response) {
                if (response.status === 'success') {
                    alert('Record updated successfully!');
                } else {
                    alert('Error updating record: ' + response.message);
                }
            }, 'json');
        }
    });

    $('#table').on('change', function() {
        const table = $(this).val();
        let fields = '';
        if (table === 'item') {
            fields = `
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
                <label for="made_in">Made In:</label>
                <input type="text" id="made_in" name="made_in" required>
                <label for="department_code">Department Code:</label>
                <input type="text" id="department_code" name="department_code" required>
                <label for="phone_type">Phone Type:</label>
                <input type="text" id="phone_type" name="phone_type" required>
                <label for="phone_brand">Phone Brand:</label>
                <input type="text" id="phone_brand" name="phone_brand" required>
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" required>
            `;
        } else if (table === 'trip') {
            fields = `
                <label for="source_code">Source Code:</label>
                <input type="text" id="source_code" name="source_code" required>
                <label for="destination_code">Destination Code:</label>
                <input type="text" id="destination_code" name="destination_code" required>
                <label for="distance">Distance:</label>
                <input type="number" id="distance" name="distance" step="0.01" required>
                <label for="truck_id">Truck ID:</label>
                <input type="number" id="truck_id" name="truck_id" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            `;
        } else if (table === 'truck') {
            fields = `
                <label for="truck_code">Truck Code:</label>
                <input type="text" id="truck_code" name="truck_code" required>
                <label for="availability_code">Availability Code:</label>
                <input type="text" id="availability_code" name="availability_code" required>
            `;
        } else if (table === 'users') {
            fields = `
                <label for="FirstName">First Name:</label>
                <input type="text" id="FirstName" name="FirstName" required>
                <label for="LastName">Last Name:</label>
                <input type="text" id="LastName" name="LastName" required>
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required>
                <label for="DOB">Date of Birth:</label>
                <input type="date" id="DOB" name="DOB" required>
                <label for="Pass">Password:</label>
                <input type="password" id="Pass" name="Pass" required>
                <label for="TelNo">Telephone Number:</label>
                <input type="text" id="TelNo" name="TelNo" required>
                <label for="Address">Address:</label>
                <input type="text" id="Address" name="Address" required>
                <label for="City">City:</label>
                <input type="text" id="City" name="City" required>
                <label for="PostalCode">Postal Code:</label>
                <input type="text" id="PostalCode" name="PostalCode" required>
                <label for="Balance">Balance:</label>
                <input type="number" id="Balance" name="Balance" step="0.01" required>
            `;
        } else if (table === 'shopping') {
            fields = `
                <label for="UserID">User ID:</label>
                <input type="number" id="UserID" name="UserID" required>
                <label for="ItemID">Item ID:</label>
                <input type="number" id="ItemID" name="ItemID" required>
                <label for="Quantity">Quantity:</label>
                <input type="number" id="Quantity" name="Quantity" required>
            `;
        }
        $('#form-fields').html(fields);
    }).trigger('change');

    fetchTableData('item');
    fetchTableData('trip');
    fetchTableData('truck');
    fetchTableData('users');
    fetchTableData('shopping');
});