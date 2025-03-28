app.controller("HomeController", function($scope, $http) {
    $http.get('http://localhost:8000/items.php')
        .then(function(r) {
            const items = r.data;
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
        })
        .catch(function(e) {
            console.error('Error fetching items', e);
        })
});