$(document).ready(function() {
    function fetchItems(filters = {}) {
        $.get('../api/items.php', filters, function(items) {
            const itemList = $('#item-list');
            itemList.empty();
            if (items.length > 0) {
                items.forEach(item => {
                    const card = $(`
                        <div class="card">
                            <h3>${item.Item_name}</h3>
                            <p>$${item.Price}</p>
                            <img src="${item.Image_URL}" alt="${item.Item_name}" class="card-image">
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
