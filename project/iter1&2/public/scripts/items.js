$(document).ready(function() {
    function fetchItems(filters = {}) {
        $.get('../api/items.php', filters, function(items) {
            const itemList = $('#item-list');
            itemList.empty();
            if (items.length > 0) {
                items.forEach(item => {
                    const card = $(`
                        <div class="card" id="${item.ItemID}">
                            <h3>${item.Item_name}</h3>
                            <p>$${item.Price}</p>
                            <img src="${item.Image_URL}" alt="${item.Item_name}" class="card-image">
                        </div>
                    `);
                    itemList.append(card);
                });
                $(".card").draggable({
                    revert: "invalid",
                    cursor: "move",
                    helper: "clone"
                });
            } else {
                const card = $('<div class="card"></div>').text('No items found.');
                itemList.append(card);
            }
        }).fail(function() {
            console.error('Error fetching items');
        });
        $.get('../api/cart.php', function(items) {
            const itemList = $('#cartitem-list');
            itemList.empty();
            if (items.length > 0) {
                items.forEach(item => {
                    const card = $(`
                        <div class="card" id="${item.ItemID}">
                            <h3>${item.Item_name}</h3>
                            <p>$${item.Price}</p>
                            <img src="${item.Image_URL}" alt="${item.Item_name}" class="card-image">
                            <p>Quantity: ${item.Quantity}</p> 
                        </div>
                    `);
                    itemList.append(card);
                });
            } else {
                const card = $('<div class="card"></div>').text('No items found.');
                itemList.append(card);
            }
        }).fail(function() {
            console.error('Error fetching items');
        });
    }

    $("#cart").droppable({
        accept: ".card", // Only accepts items of the class card
        drop: function(event, ui) {
            let item_id = ui.draggable.attr("id"); // Get the item id
            //alert("Added item: " +item_id+" to the cart!"); // Temporary alert, will be replaced by API call
            $.ajax({
                url: '../api/cart.php',
                method: 'POST',
                data: { item_id: item_id},
                success: function(response) {
                    console.log("Server response: " + response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            })
        }
    })
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        const filters = {
            'price-min': $('#price-min').val(),
            'price-max': $('#price-max').val(),
            os: $('#os').val(),
            brand: $('#brand').val()
        };
        fetchItems(filters);
    });

    fetchItems();
});
