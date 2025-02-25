$(document).ready(function () {

    // FETCH ALL STORES AND POPULATE DROPDOWN
    $.get('../api/stores.php', function (stores) { //makes request to stores.php
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

    // FETCH ALL ORDERS AND POPULATE DROPDOWN
    $.get('../api/orders.php', function (orders) { //makes request to orders.php
        const orderSelect = $('#bang'); // selects order dropdown element to edit

        orderSelect.empty();
        if (orders.length > 0) {
            orderSelect.append(new Option("All Orders", "-1")); // Default option to display all orders
            orders.forEach(order => { //grabs each order and adds it to the dropdown
                orderSelect.append(new Option(order.OrderID, order.OrderID)); //first parameter is name of option, second is value
            });
        } else {
            orderSelect.append(new Option("No Orders Found", "-1")); //If no orders are found
        }
    }).fail(function () {
        console.error('Error fetching items');
    });


    //FUNCTION TO FETCH ALL ORDERS AND DISPLAY THEM BY DEFUALT
    function fetchAllOrders() {
        $.get('../api/orders.php', function (items) { //makes request to orders.php to access the database
            const orderList = $('#purchase-history'); //selects the element to edit
            orderList.empty();
            if (items.length > 0) {
                items.forEach(item => { //maps each order to a card and updates the page to include all orders
                    const card = $(`
                            <div class="frame">
                                <h3>Order ID: ${item.OrderID}</h3>
                                <p>Store Name: ${item.name}</p>
                                <p>Date Issued: ${item.DateIssued}</p>
                                <p>Arrival Date: ${item.ArrivalDate}</p>
                                <p>Total Price: $${item.TotalPrice}</p>
                                <p>Payment Code: ${item.PaymentCode}</p>
                                <p>Truck ID: ${item.TruckID}</p>
                            </div>
                        `);
                    orderList.append(card);
                });
            } else { //if no orders are found
                const card = $('<div class="card"></div>').text('No orders found.');
                orderList.append(card);
            }
        }).fail(function () { //if the request fails
            console.error('Error fetching items');
        });
    }
    fetchAllOrders(); //DISPLAYS ALL ORDERS BY DEFAULT

    //IF USER CHANGES THE DROPDOWN, UPDATE IT ORDERS DISPLAYED TO SPEFICIED ORDER
    $('#bang').change(function () {
        const selectedOrder = $('#bang').val(); //gets the order that we want to see from the dropdown
        if (selectedOrder == "-1") {
            fetchAllOrders();
        } else { //if a specific order is selected
            $.get(`../api/orders.php`, function (items) { //makes request to orders.php to access database
                const orderList = $('#purchase-history'); //selects the element to edit
                orderList.empty();
                if (items.length > 0) {
                    items.forEach(item => {
                        if (item.OrderID == selectedOrder) { //makes sure that the order is the one that we are looking for
                            const card = $(`
                                <div class="frame">
                                    <h3>Order ID: ${item.OrderID}</h3>
                                    <p>Store Name: ${item.name}</p>
                                    <p>Date Issued: ${item.DateIssued}</p>
                                    <p>Arrival Date: ${item.ArrivalDate}</p>
                                    <p>Total Price: $${item.TotalPrice}</p>
                                    <p>Payment Code: ${item.PaymentCode}</p>
                                    <p>Truck ID: ${item.TruckID}</p>
                                </div>
                            `);
                            orderList.append(card);
                        }
                    });
                } else {
                    const card = $('<div class="card"></div>').text('No orders found.');
                    orderList.append(card);
                }
            }).fail(function () {
                console.error('Error fetching items');
            });
        }
    }
    );


    $.get('../api/invoice.php', function (invoiceDetails) {
        const [FName, LName, City, Email, TotalPrice, DateIssued, ArrivalDate, Items] = invoiceDetails;
        const invoice = $('#invoice');
        invoice.empty();
        console.log(invoiceDetails);
        if (invoiceDetails.length > 0) {
            const card = $(`
                    <div class="frame">
                        <p><strong>Name:</strong> ${FName} ${LName}</p>
                        <p><strong>Total Price:</strong> $${TotalPrice}</p>
                        <p><strong>City:</strong> ${City}</p>
                        <p><strong>Email:</strong> ${Email}</p>
                        <p><strong>Date Issued:</strong> ${DateIssued}</p>
                        <p><strong>Arrival Date:</strong> ${ArrivalDate}</p>
                        <p><strong>Items:</strong> ${Items}</p>
                    </div>
                `);
            invoice.append(card);
        } else {
            const card = $('<div class="card"></div>').text('No invoices found.');
            invoice.append(card);
        }
    }).fail(function () {
        console.error('Error fetching items');
    });
});