$counterAdd = document.querySelectorAll('.counter-add');
$counterAdd.forEach(function(element) {
    element.addEventListener('click', function (e) {
        let qty = e.currentTarget.previousElementSibling;
        let qtyValue = parseInt(qty.value) + 1;
        if (qtyValue >= 99) {
            qtyValue = 99;
        }
        qty.value = qtyValue;
    });
});

$counterMinus = document.querySelectorAll('.counter-minus');
$counterMinus.forEach(function(element) {
    element.addEventListener('click', function (e) {
        let qty = e.currentTarget.nextElementSibling;
        let qtyValue = parseInt(qty.value) - 1;
        if (qtyValue < 0) {
            qtyValue = 0;
        }
        qty.value = qtyValue;
    });
});

