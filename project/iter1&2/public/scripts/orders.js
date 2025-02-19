$(document).ready(function () {
    // Fetch items from the API
    $.get('../api/orders.php', function (items) { //makes request to orders.php
        console.log(items);
        const orderList = $('#purchase-history'); //orders
        orderList.empty();
        if (items.length > 0) {
            items.forEach(item => {
                const card = $(`
                    <div class="frame">
                        <h3>Order ID: ${item.OrderID}</h3>
                        <p>Date Issued: ${item.DateIssued}</p>
                        <p>Arrival Date: ${item.ArrivalDate}</p>
                        <p>Total Price: $${item.TotalPrice}</p>
                        <p>Payment Code: ${item.PaymentCode}</p>
                        <p>Store ID: ${item.StoreID}</p>
                    </div>
                `);
                orderList.append(card);
            });
        } else {
            const card = $('<div class="card"></div>').text('No orders found.');
            orderList.append(card);
        }
    }).fail(function () {
        console.error('Error fetching items');
    });
    // Fetch available stores from the API
    $.get('../api/stores.php', function (stores) { //makes request to orders.php
        const storeSelect = $('#lang'); // Store dropdown
        storeSelect.empty();

        if (stores.length > 0) {
            stores.forEach(store => {
                storeSelect.append(new Option(store.name, store.id));
            });
        } else { // This else statement should never trigger
            storeSelect.append(new Option("No stores found", "-1"));
        }
    }).fail(function () {
        console.error('Error fetching items');
    });
});